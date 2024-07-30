<?php

namespace Drupal\userprofile\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Entity\EntityFieldManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\userprofile\LoadFields;
use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\Core\Path\PathMatcher;
use Drupal\taxonomy\Entity\Vocabulary;
use Drupal\media\Entity\Media;
use Drupal\file\Entity\File;
use Drupal\Core\Url;
use Drupal\Core\Database\Database;
use Drupal\user\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Session\AccountInterface;	


/**
 * Controller routines for userprofile routes.
 */
class Appointments extends ControllerBase
{
	/**
	 * @var Drupal\userprofile\LoadFields
	 */
	protected $loadfields;

	/**
	 * @param Drupal\userprofile\LoadFields $fields
	 */
	public function __construct(LoadFields $loadfields)
	{
		$this->loadfields = $loadfields;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function create(ContainerInterface $container)
	{
		return new static($container->get("userprofile.field_details"));
	}



	public function generateTimesInInterval($start, $end, $interval) {
		$times = [];
		$currentTime = strtotime($start);
		$endTime = strtotime($end);
		
		while ($currentTime <= $endTime) {
			$times[] = date('g:i A', $currentTime);
			$currentTime += $interval * 60; // Add interval in seconds
		}
		
		return $times;
	}


	public function durationwiseslot($slot,$duration){
		$adjustedTimes = [];
		for ($i = 0; $i < count($slot) - 1; $i++) {
			$start = strtotime($slot[$i]);
			$end = strtotime($slot[$i + 1]);
			
			// Generate times in 10-minute intervals between $times[$i] and $times[$i + 1]
			$generatedTimes = $this->generateTimesInInterval($slot[$i], $slot[$i + 1], $duration);
			
			// Merge generated times into adjustedTimes array
			$adjustedTimes = array_merge($adjustedTimes, $generatedTimes);
		}
		return $adjustedTimes;
	}


	
	public function getBookingTimeSlot(Request $request){
		$target_id = !empty($request->get('target_id')) ? $request->get('target_id') : '';
		$current_date1 = !empty($request->get('current_date')) ? $request->get('current_date') : '';
		$month = !empty($request->get('month')) ? $request->get('month') : '';
		$year = !empty($request->get('year')) ? $request->get('year') : '';
		$current_date = date("Y-m-d",strtotime($year.'-'.$month.'-'.$current_date1));
		$select_day = date("l",strtotime($current_date));
		$html = '';
		$paragraph = Paragraph::load($target_id);
		$connection = Database::getConnection();
		$query = $connection->select('booking_appointment','ba')
		->fields('ba');
		$query->condition('time_slot_name', 'Morning');
		$query->condition('clinic_target_id', $target_id);
		$query->condition('booking_date', $current_date);
		$condition_group = $query->orConditionGroup()
		  ->condition('status', '1')
		  ->condition('status', '3', '=');
		$query->condition($condition_group);
		$result = $query->execute();
		$morning_rows = $result->fetchAll();
		$morning_book_slot = [];
		if(!empty($morning_rows)){
			foreach($morning_rows as $row){
				$morning_book_slot[] = $row->time_slot;
			}
		}
		$query1 = $connection->select('booking_appointment','ba')
		->fields('ba');
		$query1->condition('time_slot_name', 'After Noon');
		$query1->condition('clinic_target_id', $target_id);
		$query1->condition('booking_date', $current_date);
		$condition_group = $query1->orConditionGroup()
		  ->condition('status', '1')
		  ->condition('status', '3', '=');
		$query1->condition($condition_group);
		$result1 = $query1->execute();
		$afternoon_rows = $result1->fetchAll();
		$afternoon_book_slot = [];
		if(!empty($afternoon_rows)){
			foreach($afternoon_rows as $row){
				$afternoon_book_slot[] = $row->time_slot;
			}
		}
		$query2 = $connection->select('booking_appointment','ba')
		->fields('ba');
		$query2->condition('time_slot_name', 'Evening');
		$query2->condition('clinic_target_id', $target_id);
		$query2->condition('booking_date', $current_date);
		$condition_group = $query2->orConditionGroup()
		  ->condition('status', '1')
		  ->condition('status', '3', '=');
		$query2->condition($condition_group);
		$result2 = $query2->execute();
		$evening_rows = $result2->fetchAll();
		$evening_book_slot = [];
		if(!empty($evening_rows)){
			foreach($evening_rows as $row){
				$evening_book_slot[] = $row->time_slot;
			}
		}

		$duration = !empty($paragraph->get('field_duration')->getValue()) ? $paragraph->get('field_duration')->getValue()[0]['value']: '';
		
		$field_unavailability_from = !empty($paragraph->get('field_unavailability_from')->getValue()) ? $paragraph->get('field_unavailability_from')->getValue()[0]['value']: '';
		$field_unavailability_to = !empty($paragraph->get('field_unavailability_to')->getValue()) ? $paragraph->get('field_unavailability_to')->getValue()[0]['value']: '';
		$unavailability_morning = [];
		$unavailability_afternoon = [];
		$unavailability_evening = [];

		if($field_unavailability_from <= $current_date && $field_unavailability_to >= $current_date){
			$field_unavailability_morning_slo = !empty($paragraph->get('field_unavailability_morning_slo')->getValue()) ? $paragraph->get('field_unavailability_morning_slo')->getValue(): '';
			foreach($field_unavailability_morning_slo as $unavailability_morning_slot){
				$un_mr_slot = Term::load($unavailability_morning_slot['target_id']);
				$unavailability_morning[] = $un_mr_slot->getName();
			}
			$field_unavailability_noon_slots = !empty($paragraph->get('field_unavailability_noon_slots')->getValue()) ? $paragraph->get('field_unavailability_noon_slots')->getValue(): '';
			foreach($field_unavailability_noon_slots as $unavailability_afternoon_slot){
				$un_aft_slot = Term::load($unavailability_afternoon_slot['target_id']);
				$unavailability_afternoon[] = $un_aft_slot->getName();
			}
			$field_unavailability_evening_slo = !empty($paragraph->get('field_unavailability_evening_slo')->getValue()) ? $paragraph->get('field_unavailability_evening_slo')->getValue(): '';
			foreach($field_unavailability_evening_slo as $unavailability_evening_slot){
				$un_ev_slot = Term::load($unavailability_evening_slot['target_id']);
				$unavailability_evening[] = $un_ev_slot->getName();
			}
			
		}
		$weekdays = !empty($paragraph->get('field_weekdays')->getValue()) ? $paragraph->get('field_weekdays')->getValue(): '';
		$weekdays_select = [];
		if(!empty($weekdays)){
			foreach($weekdays as $value){
				$weekday_slot = Term::load($value['target_id']);
				$weekdays_select[] = $weekday_slot->getName();
			}
		}
		$clinctarget_id = !empty($paragraph->get('field_clinic_name')->getValue()) ? $paragraph->get('field_clinic_name')->getValue()[0]['target_id']: '';
		$clincterm = Term::load($clinctarget_id);
		$clinic_name = $clincterm->getName();
		$field_morning_slots = !empty($paragraph->get('field_morning_slots')->getValue()) ? $paragraph->get('field_morning_slots')->getValue(): '';
		
		$field_morning_slots = !empty($paragraph->get('field_morning_slots')->getValue()) ? $paragraph->get('field_morning_slots')->getValue(): '';
		$morning_slot_count = is_array($field_morning_slots) ? count($field_morning_slots) : 0;
		
		
		$mroning_slot = [] ;
		$i = 0;
		foreach($field_morning_slots as $key => $morning_slot){
			$mr_slot = Term::load($morning_slot['target_id']);
			$mroning_slot[] = $mr_slot->getName();
		}
		if(!empty($duration)){
			if(!empty($weekdays_select) && in_array($select_day, $weekdays_select)){
				$duation_slots = $this->durationwiseslot($mroning_slot,$duration);
				$mornig_slot_du = !empty($duation_slots) ? count($duation_slots): 0;
				$html .='<div class="col-sm-12 morning-slot"><div class="fs-3 pt-5"><b>Morning ('.$mornig_slot_du.' slots)</b></div>';
				foreach($duation_slots as $value){
					if(!empty($unavailability_morning) && in_array($value, $unavailability_morning)){
						$html .= '<button class="ap-book mx-1 closed p-3 mt-2"><b>'.$value.' </b> <span class="text-warning">No Slot Available</span></button>';
					}elseif(!empty($morning_book_slot) && in_array($value, $morning_book_slot)){
						$html .= '<button class="ap-book mx-1 closed p-3 mt-2"><b>'.$value.' </b> <span class="text-warning"></span></button>';
					}else{
						$html .= '<button class="ap-book mx-1 openPopup p-3 mt-2" data-clinicname="'.$clinic_name.'" data-target_id="'.$target_id.'" data-time-slot="'.$value.'" data-slot-name="Morning" data-date="'.date("d/m",strtotime($current_date)).'"><b>'.$value.' </b> <span class="text-danger"></span></button>';
					}
				}
			}else{
				$html .='<div class="col-sm-12 morning-slot"><div class="fs-3 pt-5"><b>Morning (0 slots)</b></div>';
			}
			$html .='</div>';
		}else{
			if(!empty($weekdays_select) && in_array($select_day, $weekdays_select)){
				$html .='<div class="col-sm-12 morning-slot"><div class="fs-3 pt-5"><b>Morning ('.$morning_slot_count.' slots)</b></div>';
				foreach($mroning_slot as $value){
					if(!empty($unavailability_morning) && in_array($value, $unavailability_morning)){
						$html .= '<button class="ap-book mx-1 closed p-3 mt-2"><b>'.$value.' </b> <span class="text-warning">No Slot Available</span></button>';
					}elseif(!empty($morning_book_slot) && in_array($value, $morning_book_slot)){
						$html .= '<button class="ap-book mx-1 closed p-3 mt-2"><b>'.$value.' </b> <span class="text-warning"></span></button>';
					}else{
						$html .= '<button class="ap-book mx-1 openPopup p-3 mt-2" data-clinicname="'.$clinic_name.'" data-target_id="'.$target_id.'" data-time-slot="'.$value.'" data-slot-name="Morning" data-date="'.date("d/m",strtotime($current_date)).'"><b>'.$value.' </b> <span class="text-danger"></span></button>';
					}
				}
			}else{
				$html .='<div class="col-sm-12 morning-slot"><div class="fs-3 pt-5"><b>Morning (0 slots)</b></div>';
			}
			$html .='</div>';
		}
		
		$field_afternoon_slots = !empty($paragraph->get('field_afternoon_slots')->getValue()) ? $paragraph->get('field_afternoon_slots')->getValue(): '';
		$afternoon_slot_count = !empty($field_afternoon_slots) ? count($field_afternoon_slots): 0;
		$after_slots = [];
		foreach($field_afternoon_slots as $afternoon_slot){
			$after_slot = Term::load($afternoon_slot['target_id']);
			$after_slots[] = $after_slot->getName();
		}
		if(!empty($duration)){
			if(!empty($weekdays_select) && in_array($select_day, $weekdays_select)){
				$duation_slots = $this->durationwiseslot($after_slots,$duration);
				$after_slot_du = !empty($duation_slots) ? count($duation_slots): 0;
				$html .='<div class="col-sm-12 afternoon-slot"><div class="fs-3 pt-5"><b>After Noon ('.$after_slot_du.' slots)</b></div>';
				foreach($duation_slots as $value){
					if(!empty($unavailability_afternoon) && in_array($value, $unavailability_afternoon)){
						$html .= '<button class="ap-book mx-1 closed p-3 mt-2"><b>'.$value.' </b> <span class="text-warning">No Slot Available</span></button>';
					}elseif(!empty($afternoon_book_slot) && in_array($value, $afternoon_book_slot)){
						$html .= '<button class="ap-book mx-1 closed p-3 mt-2"><b>'.$value.' </b> <span class="text-warning"></span></button>';
					}else{
						$html .= '<button class="ap-book mx-1 openPopup p-3 mt-2" data-clinicname="'.$clinic_name.'" data-target_id="'.$target_id.'" data-time-slot="'.$value.'" data-slot-name="After Noon" data-date="'.date("d/m",strtotime($current_date)).'"><b>'.$value.' </b> <span class="text-danger"></span></button>';
					}
				}
			}else{
				$html .='<div class="col-sm-12 afternoon-slot"><div class="fs-3 pt-5"><b>After Noon (0 slots)</b></div>';
			}
			$html .='</div>';
		}else{
			if(!empty($weekdays_select) && in_array($select_day, $weekdays_select)){
				$html .='<div class="col-sm-12 afternoon-slot"><div class="fs-3 pt-5"><b>After Noon ('.$afternoon_slot_count.' slots)</b></div>';
				foreach($after_slots as $value){
					if(!empty($unavailability_afternoon) && in_array($value, $unavailability_afternoon)){
						$html .= '<button class="ap-book mx-1 closed p-3 mt-2"><b>'.$value.' </b> <span class="text-warning">No Slot Available</span></button>';
					}elseif(!empty($afternoon_book_slot) && in_array($value, $afternoon_book_slot)){
						$html .= '<button class="ap-book mx-1 closed p-3 mt-2"><b>'.$value.' </b> <span class="text-warning"></span></button>';
					}else{
						$html .= '<button class="ap-book mx-1 openPopup p-3 mt-2" data-clinicname="'.$clinic_name.'" data-target_id="'.$target_id.'" data-time-slot="'.$value.'" data-slot-name="After Noon" data-date="'.date("d/m",strtotime($current_date)).'"><b>'.$value.' </b> <span class="text-danger"></span></button>';
					}
				}
				
			}else{
				$html .='<div class="col-sm-12 afternoon-slot"><div class="fs-3 pt-5"><b>After Noon (0 slots)</b></div>';
			}
			$html .='</div>';
		}
		
		$field_evening_slots = !empty($paragraph->get('field_evening_slots')->getValue()) ? $paragraph->get('field_evening_slots')->getValue(): '';
		$evening_slot_count = !empty($field_evening_slots) ? count($field_evening_slots) : 0;
		$eveningslots = [];
		foreach($field_evening_slots as $evening_slot){
			$even_slot = Term::load($evening_slot['target_id']);
			$eveningslots[] = $even_slot->getName();
		}
		if(!empty($duration)){
			if(!empty($weekdays_select) && in_array($select_day, $weekdays_select)){
				$duation_slots = $this->durationwiseslot($eveningslots,$duration);
				$eveing_slot_du = !empty($duation_slots) ? count($duation_slots): 0;
				$html .='<div class="col-sm-12 evening-slot"><div class="fs-3 pt-5"><b>Evening ('.$eveing_slot_du.' slots)</b></div>';
				foreach($duation_slots as $value){
					if(!empty($unavailability_evening) && in_array($value, $unavailability_evening)){
						$html .= '<button class="ap-book mx-1 closed p-3 mt-2"><b>'.$value.' </b> <span class="text-warning">No Slot Available</span></button>';
					}elseif(!empty($evening_book_slot) && in_array($value, $evening_book_slot)){
						$html .= '<button class="ap-book mx-1 closed p-3 mt-2"><b>'.$value.' </b> <span class="text-warning"></span></button>';
					}else{
						$html .= '<button class="ap-book mx-1 openPopup p-3 mt-2" data-clinicname="'.$clinic_name.'" data-target_id="'.$target_id.'" data-time-slot="'.$value.'" data-slot-name="Evening" data-date="'.date("d/m",strtotime($current_date)).'"><b>'.$value.' </b> <span class="text-danger"></span></button>';
					}
				}
			}else{
				$html .='<div class="col-sm-12 evening-slot"><div class="fs-3 pt-5"><b>Evening (0 slots)</b></div>';
			}
			$html .='</div>';
		}else{
			if(!empty($weekdays_select) && in_array($select_day, $weekdays_select)){
				$html .='<div class="col-sm-12 evening-slot"><div class="fs-3 pt-5"><b>Evening ('.$evening_slot_count.' slots)</b></div>';
				foreach($eveningslots as $value){
					if(!empty($unavailability_evening) && in_array($value, $unavailability_evening)){
						$html .= '<button class="ap-book mx-1 closed p-3 mt-2"><b>'.$value.' </b> <span class="text-warning">No Slot Available</span></button>';
					}elseif(!empty($evening_book_slot) && in_array($value, $evening_book_slot)){
						$html .= '<button class="ap-book mx-1 closed p-3 mt-2"><b>'.$value.' </b> <span class="text-warning"></span></button>';
					}else{
						$html .= '<button class="ap-book mx-1 openPopup p-3 mt-2" data-clinicname="'.$clinic_name.'" data-target_id="'.$target_id.'" data-time-slot="'.$value.'" data-slot-name="Evening" data-date="'.date("d/m",strtotime($current_date)).'"><b>'.$value.' </b> <span class="text-danger"></span></button>';
					}
				}
			}else{
				$html .='<div class="col-sm-12 evening-slot"><div class="fs-3 pt-5"><b>Evening (0 slots)</b></div>';
			}
			$html .='</div>';
		}
		
		$ajax_resp = new JsonResponse(array("html"=>$html));
		return ($ajax_resp);

	}


	
	public function generateOtp(Request $request){
		$connection = Database::getConnection();
		$phonenumber = !empty($request->get('phonenumber')) ? $request->get('phonenumber') : '';
		$type = !empty($request->get('type')) ? $request->get('type') : '';
		$doc_name = !empty($request->get('doc_name')) ? $request->get('doc_name') : '';
		$otp_length = 4;
		$otp = '';
		for ($i = 0; $i < $otp_length; $i++) {
			$otp .= rand(0, 9);
		}
		$_SESSION['generated_otp'] = $otp;
		$_SESSION['phonenumber'] = $phonenumber;
		if($type == '1'){
			$table = 'otp_expiry';
			$fields = array(
				'mobile_number' => $phonenumber,
				'otp' => $otp,
				'expiry' => '0',
				'created_date' => date('Y-m-d H:i:s'),
			);
			// Insert data into the custom table.
			\Drupal::database()->insert($table)
				->fields($fields)
				->execute();
			$message = 'OTP send successfully.';
		}
		if($type == '2'){
			$table = 'otp_expiry';
			$query = $connection->update('otp_expiry')
			  ->fields([
				'otp' => $otp,
				'expiry' => '0',
			])
			  ->condition('mobile_number', $phonenumber)
			  ->execute();
			$message = 'OTP resend successfully.';
		}
		// $text_sms = 'Hi! OTP for booking an appointment with me is: '.$otp.'. Please do not share it with anyone. Aadya Health Science.';
		$text_sms = 'Hi! OTP for booking an appointment with '.$doc_name.' is: '.$otp.'. Please do not share it with anyone. Aadya Health Sciences.';
		$mob_text = urlencode($text_sms);

		$url_sms = 'https://onlysms.co.in/api/otp.aspx?UserID=adhsplotp&UserPass=Adh909@&MobileNo='.$phonenumber.'&GSMID=AADHSP&PEID=1701171921100574462&Message='.$mob_text.'&TEMPID=1707171930776525622&UNICODE=TEXT';


		try {
		  $curl = curl_init();
		  curl_setopt_array($curl, array(
		  CURLOPT_URL => $url_sms,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_SSL_VERIFYPEER => 'false',
		  ));
		  $response1 = curl_exec($curl);
		  curl_close($curl);
		}
		catch (RequestException $e) {
		}
		$ajax_resp = new JsonResponse(array("status"=>"sucess",'message'=>$message));
		return ($ajax_resp);
		exit;
	}
	public function OtpVerifyBookingAppointment(Request $request){
		$otp = !empty($request->get('otp')) ? $request->get('otp') : '';
		$generated_otp = $_SESSION['generated_otp'];
		if($otp != $generated_otp){
			$ajax_resp = new JsonResponse(array("error"=>"Please enter valid otp.",'message'=>''));
			return ($ajax_resp);
			exit;
		}
		$ajax_resp = new JsonResponse(array("status"=>"sucess",'message'=>'OTP verify.'));
		return ($ajax_resp);
		exit;
	}

	public function bookingAppointmentSlot(Request $request){
		$phone = !empty($request->get('phonenumber')) ? $request->get('phonenumber') : '';
		$phonenumber = "91". $phone;
		$clinicname = !empty($request->get('clinicname')) ? $request->get('clinicname') : '';
		$clinic_target_id = !empty($request->get('clinic_target_id')) ? $request->get('clinic_target_id') : '';
		$bookingtimeslot = !empty($request->get('bookingtimeslot')) ? $request->get('bookingtimeslot') : '';
		$bookingtime = !empty($request->get('bookingtime')) ? $request->get('bookingtime') : '';
		$fullname = !empty($request->get('fullname')) ? $request->get('fullname') : '';
		$booking_date = !empty($request->get('booking_date')) ? date('Y-m-'.$request->get('booking_date')) : '';
		$terms = !empty($request->get('terms')) ? $request->get('terms') : '0';
		$reason = !empty($request->get('reason')) ? $request->get('reason') : '';
		$firsttime = !empty($request->get('firsttime')) ? $request->get('firsttime') : '0';
		$user_id = !empty($request->get('user_id')) ? $request->get('user_id') : '';
		$doctor_type = !empty($request->get('doctor_type')) ? $request->get('doctor_type') : '';
		$clinic_phone_number = !empty($request->get('clinic_phone_number')) ? $request->get('clinic_phone_number') : '';

		$usera = \Drupal\user\Entity\User::load($user_id);

		$para = $usera->get("field_paragraphtheme1")->getValue();
		$field_name_value = '';
		if (!empty($para) && isset($para[0]['target_id'])) {
			$paragraph = \Drupal\paragraphs\Entity\Paragraph::load($para[0]['target_id']);
			if ($paragraph) {
				$field_name_value = $paragraph->get('field_name')->value;
			}
		}



		$usernames = $usera->getAccountName();

		$formatted_bookingtimeslot = date("g:iA", strtotime($bookingtimeslot));
		$date = new DrupalDateTime($booking_date);
		$date_booking = \Drupal::service('date.formatter')->format($date->getTimestamp(), 'custom', 'l jSF');
		$date_booking = preg_replace('/(\d+)(st|nd|rd|th)/', '$1$2 ', $date_booking);

		if($doctor_type === "request"){
            $text_sms = 'Dear ' . $fullname . '!, your request for an appointment with ' . $field_name_value . ' at ' . $formatted_bookingtimeslot . ' on ' . $date_booking . ' at ' . $clinicname . ' is accepted. Someone from the clinic will call and confirm the appointment shortly. WhatsApp us on +91 8861191019 to cancel or reschedule. Aadya Health Sciences.';
            $mob_text = str_replace('+', '%20', urlencode($text_sms));
            $url_sms = 'https://onlysms.co.in/api/sms.aspx?UserID=adhspl&UserPass=Adh909@&MobileNo=' . $phonenumber . '&GSMID=AADHSP&PEID=1701171921100574462&Message=' . $mob_text . '&TEMPID=1707172182530222588&UNICODE=TEXT';
            
            try {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url_sms,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                ));
                $response = curl_exec($curl);
                curl_close($curl);
            } catch (\Exception $e) {
                // Handle the exception if needed
            }

            // Second SMS to the clinic
            $text_sms2 = ' ' . $fullname . ' has requested an appointment with ' . $field_name_value . ' on ' . $date_booking . ', ' . $formatted_bookingtimeslot . ' at ' . $clinicname . ', please call ' . $phonenumber . ' and confirm the appointment. Aadya Health Sciences.';
            $mob_text2 = str_replace('+', '%20', urlencode($text_sms2));
            $url_sms2 = 'https://onlysms.co.in/api/sms.aspx?UserID=adhspl&UserPass=Adh909@&MobileNo=' . $clinic_phone_number . '&GSMID=AADHSP&PEID=1701171921100574462&Message=' . $mob_text2 . '&TEMPID=1707172197927510568&UNICODE=TEXT';
            
            try {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url_sms2,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                ));
                $response = curl_exec($curl);
                curl_close($curl);
            } catch (\Exception $e) {
                // Handle the exception if needed
            }


		} else {
			$text_sms = 'Dear '.$fullname.', your appointment with '.$field_name_value.' at '.$clinicname.' on '.$date_booking.' at '.$formatted_bookingtimeslot.' is confirmed. WhatsApp us on +91 8861191019 to cancel or reschedule. Aadya Health Sciences.';

			$mob_text = str_replace('+', '%20', urlencode($text_sms));

			$url_sms = 'https://onlysms.co.in/api/sms.aspx?UserID=adhspl&UserPass=Adh909@&MobileNo='.$phonenumber.'&GSMID=AADHSP&PEID=1701171921100574462&Message='.$mob_text.'&TEMPID=1707171930778294643&UNICODE=TEXT';
			
			try {
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $url_sms,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => '',
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => 'GET',
				));
	
				$response = curl_exec($curl);
	
				curl_close($curl);
			}
			catch (RequestException $e) {
			}
		}



		// if($doctor_type === "request"){
		// 	// $text_sms2 = 'Dear '.$fullname.', your appointment with '.$field_name_value.' at '.$clinicname.' on '.$date_booking.' at '.$formatted_bookingtimeslot.' is confirmed. WhatsApp us on +91 8861191019 to cancel or reschedule. Aadya Health Sciences.';

		// 	$text_sms2 = ' '.$fullname.' has requested an appointment with '.$field_name_value.' on '.$date_booking. ', '.$formatted_bookingtimeslot.' at '.$clinicname.', please call '.$phonenumber.' and confirm the appointment. Aadya Health Sciences.';


		// 	$mob_text = str_replace('+', '%20', urlencode($text_sms2));

		// 	$url_sms = 'https://onlysms.co.in/api/sms.aspx?UserID=adhspl&UserPass=Adh909@&MobileNo='.$clinic_phone_number.'&GSMID=AADHSP&PEID=1701171921100574462&Message='.$mob_text.'&TEMPID=1707172182539434761&UNICODE=TEXT';
			
		// 	try {
		// 		$curl = curl_init();
		// 		curl_setopt_array($curl, array(
		// 		  CURLOPT_URL => $url_sms,
		// 		  CURLOPT_RETURNTRANSFER => true,
		// 		  CURLOPT_ENCODING => '',
		// 		  CURLOPT_MAXREDIRS => 10,
		// 		  CURLOPT_TIMEOUT => 0,
		// 		  CURLOPT_FOLLOWLOCATION => true,
		// 		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		// 		  CURLOPT_CUSTOMREQUEST => 'GET',
		// 		));
	
		// 		$response = curl_exec($curl);
	
		// 		curl_close($curl);
		// 	}
		// 	catch (RequestException $e) {
		// 	}

		// }





		$table = 'booking_appointment';
		$fields = array(
			'mobile_number' => $phonenumber,
			'clinic_target_id' => $clinic_target_id,
			'clinic_name' => $clinicname,
			'time_slot' => $bookingtimeslot,
			'time_slot_name' => $bookingtime,
			'booking_date' => date("Y-m-d",strtotime($booking_date)),
			'patient_name' => $fullname,
			'status' => '1',
			'source' => 'website',
			'user_id' => $user_id,
			'terms' => $terms,
			'visit_reason' => $reason,
			'visit_firsttime' => $firsttime,
			'type' => $doctor_type,
			'created_date' => date('Y-m-d H:i:s'),
			'clinic_phone_number' => $clinic_phone_number,
		);
		// Insert data into the custom table.
		\Drupal::database()->insert($table)
			->fields($fields)
			->execute();
		unset($_SESSION['generated_otp']);

		if($doctor_type == 'request'){
			$html = '';
			$html .='<h2 class="popupconfirmation">Request for appointment is Accepted</h2>
					<p id="hospital">Hospital Name: <b>'.$clinicname.'</b></p>
					<p id="hospital">Time Slot: <b>'.$bookingtime.'</b></p>
					<p id="appointment">Appointment Date : <b>'.$booking_date.'</b></p>
					<p id="appointment">Appointment Time : <b>'.$bookingtimeslot.'</b></p>
	
	
					<div class="btn">
						<button class="close-btn">Close</button>
					</div>';
			}else{
			$html = '';
			$html .='<h2 class="popupconfirmation">Booking Confirmation</h2>
					<p id="hospital">Hospital Name: <b>'.$clinicname.'</b></p>
					<p id="hospital">Time Slot: <b>'.$bookingtime.'</b></p>
					<p id="appointment">Appointment Date : <b>'.$booking_date.'</b></p>
					<p id="appointment">Appointment Time : <b>'.$bookingtimeslot.'</b></p>
					<div class="btn">
						<button class="close-btn">Close</button>
					</div>';
			}

		$ajax_resp = new JsonResponse(array("status"=>"sucess",'error'=>'','msg'=>'Booking is Successful','html'=>$html));
		return ($ajax_resp);
		exit;
	}

	
	public function bookAppointmentData(Request $request){
		$connection = Database::getConnection();
		$from_date = $request->query->get('from_date');
		$to_date = $request->query->get('to_date');
		$clinic_name = $request->query->get('clinic_name');
		$query = $connection->select('booking_appointment','ba')
		->fields('ba');
		if(!empty($clinic_name)){
			$query->condition('ba.clinic_name', $clinic_name, 'LIKE');
		}
		if (!empty($from_date) && !empty($to_date)) {
		  $query->condition('ba.booking_date', $from_date, '>=')
			->condition('ba.booking_date', $to_date, '<=');
		}
		$result = $query->execute();
		$data = $result->fetchAll();
		$final_data = array();

		$vocabulary = \Drupal\taxonomy\Entity\Vocabulary::load('clinic');
		$termStorage = \Drupal::entityTypeManager()->getStorage('taxonomy_term');
		$terms = $termStorage->loadTree($vocabulary->id(), 0, NULL, TRUE);
		$clinc_arr =array();
		foreach ($terms as $term) {
			$clinc_arr[$term->id()] = $term->getName();
		}
		$final_data['data'] = $data;
		$final_data['clinic'] = $clinc_arr;
		$final_data['from_date'] = $from_date;
		$final_data['to_date'] = $to_date;
		$final_data['clinic_name'] = $clinic_name;
		return [
		  '#theme' => 'book_appointment_template',
		  '#arr_data' => $final_data,
		];
	}

}
