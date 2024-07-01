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
class Appointment extends ControllerBase
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

    public function getBookingTimeSlot(Request $request){
		$target_id = !empty($request->get('target_id')) ? $request->get('target_id') : '';
		$current_date = !empty($request->get('current_date')) ? date('Y-m-'.$request->get('current_date')) : '';
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
		// $query->condition('status', '1');
		// $query->condition('status', '3');
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
		// $query1->condition('status', '1');
		// $query1->condition('status', '3');
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
		$clinctarget_id = !empty($paragraph->get('field_clinic_name')->getValue()) ? $paragraph->get('field_clinic_name')->getValue()[0]['target_id']: '';
		$clincterm = Term::load($clinctarget_id);
		$clinic_name = $clincterm->getName();
		$field_morning_slots = !empty($paragraph->get('field_morning_slots')->getValue()) ? $paragraph->get('field_morning_slots')->getValue(): '';
		$morning_slot_count = count($field_morning_slots);
		$html .='<div class="col-sm-12"><div class="fs-3 pt-5"><b>Morning ('.$morning_slot_count.' slots)</b></div>';
		foreach($field_morning_slots as $morning_slot){
			$mr_slot = Term::load($morning_slot['target_id']);
			if(!empty($unavailability_morning) && in_array($mr_slot->getName(), $unavailability_morning)){
				$html .= '<button class="ap-book closed p-3 mt-2"><b>'.$mr_slot->getName().' </b> <span class="text-warning">No Slot Available</span></button>';
			}elseif(!empty($morning_book_slot) && in_array($mr_slot->getName(), $morning_book_slot)){
				$html .= '<button class="ap-book closed p-3 mt-2"><b>'.$mr_slot->getName().' </b> <span class="text-warning"></span></button>';
			}else{
				$html .= '<button class="ap-book openPopup p-3 mt-2" data-clinicname="'.$clinic_name.'" data-target_id="'.$target_id.'" data-time-slot="'.$mr_slot->getName().'" data-slot-name="Morning"><b>'.$mr_slot->getName().' </b> <span class="text-danger"></span></button>';
			}
		}
		
		$html .='</div>';
		$field_afternoon_slots = !empty($paragraph->get('field_afternoon_slots')->getValue()) ? $paragraph->get('field_afternoon_slots')->getValue(): '';
		$afternoon_slot_count = count($field_afternoon_slots);
		$html .='<div class="col-sm-12"><div class="fs-3 pt-5"><b>After Noon ('.$afternoon_slot_count.' slots)</b></div>';
		foreach($field_afternoon_slots as $afternoon_slot){
			$after_slot = Term::load($afternoon_slot['target_id']);
			if(!empty($unavailability_afternoon) && in_array($after_slot->getName(), $unavailability_afternoon)){
				$html .= '<button class="ap-book closed p-3 mt-2"><b>'.$after_slot->getName().' </b> <span class="text-warning">No Slot Available</span></button>';
			}elseif(!empty($afternoon_book_slot) && in_array($after_slot->getName(), $afternoon_book_slot)){
				$html .= '<button class="ap-book closed p-3 mt-2"><b>'.$after_slot->getName().' </b> <span class="text-warning"></span></button>';
			}else{
				$html .= '<button class="ap-book openPopup p-3 mt-2" data-clinicname="'.$clinic_name.'" data-target_id="'.$target_id.'" data-time-slot="'.$after_slot->getName().'" data-slot-name="After Noon"><b>'.$after_slot->getName().' </b> <span class="text-danger"></span></button>';
			}
		}
		$html .='</div>';
		$field_evening_slots = !empty($paragraph->get('field_evening_slots')->getValue()) ? $paragraph->get('field_evening_slots')->getValue(): '';
		$evening_slot_count = count($field_evening_slots);
		$html .='<div class="col-sm-12"><div class="fs-3 pt-5"><b>Evening ('.$evening_slot_count.' slots)</b></div>';
		foreach($field_evening_slots as $evening_slot){
			$ev_slot = Term::load($evening_slot['target_id']);
			if(!empty($unavailability_evening) && in_array($ev_slot->getName(), $unavailability_evening)){
				$html .= '<button class="ap-book closed p-3 mt-2"><b>'.$ev_slot->getName().' </b> <span class="text-warning">No Slot Available</span></button>';
			}elseif(!empty($evening_book_slot) && in_array($ev_slot->getName(), $evening_book_slot)){
				$html .= '<button class="ap-book closed p-3 mt-2"><b>'.$ev_slot->getName().' </b> <span class="text-warning"></span></button>';
			}else{
				$html .= '<button class="ap-book openPopup p-3 mt-2" data-clinicname="'.$clinic_name.'" data-target_id="'.$target_id.'" data-time-slot="'.$ev_slot->getName().'" data-slot-name="Evening"><b>'.$ev_slot->getName().' </b> <span class="text-danger"></span></button>';
			}
		}
		$html .='</div>';
		$ajax_resp = new JsonResponse(array("html"=>$html));
		return ($ajax_resp);

	}

    
	public function generateOtp(Request $request){
		$connection = Database::getConnection();
		$phonenumber = !empty($request->get('phonenumber')) ? $request->get('phonenumber') : '';
		$type = !empty($request->get('type')) ? $request->get('type') : '';
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
		$text_sms = 'Hi! OTP for booking an appointment with Me is: '.$otp.'. Please do not share it with anyone. Aadya Health Sciences.';
		$mob_text = urlencode($text_sms);
		$url_sms = 'https://onlysms.co.in/api/sms.aspx?UserID=adhspl&UserPass=Adh909@&MobileNo='.$phonenumber.'&GSMID=AADHSP&PEID=1701171921100574462&Message='.$mob_text.'&TEMPID=1707171930776525622&UNICODE=TEXT';
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
		$phonenumber = !empty($request->get('phonenumber')) ? $request->get('phonenumber') : '';
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
		$usera = \Drupal\user\Entity\User::load($user_id);
		$usernames = $usera->getAccountName();
		$date = new DrupalDateTime($booking_date);
		$date_booking = \Drupal::service('date.formatter')->format($date->getTimestamp(), 'custom', 'l jSF');
		$text_sms = 'Dear '.$fullname.'!, your appointment with Dr.'.$usernames.' at '.$date_booking.' on '.$bookingtimeslot.' at '.$clinicname.' is confirmed. WhatsApp us on 9376005515 to cancel or reschedule. Aadya Health Sciences.';
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
		$table = 'booking_appointment';
		$fields = array(
			'mobile_number' => $phonenumber,
			'clinic_target_id' => $clinic_target_id,
			'clinic_name' => $clinicname,
			'time_slot' => $bookingtimeslot,
			'time_slot_name' => $bookingtime,
			'booking_date' => $booking_date,
			'patient_name' => $fullname,
			'status' => '1',
			'source' => 'website',
			'user_id' => $user_id,
			'terms' => $terms,
			'visit_reason' => $reason,
			'visit_firsttime' => $firsttime,
			'type' => $doctor_type,
			'created_date' => date('Y-m-d H:i:s'),
		);
		// Insert data into the custom table.
		\Drupal::database()->insert($table)
			->fields($fields)
			->execute();
		unset($_SESSION['generated_otp']);

		$html = '';
		$html .='<h2>Booking Confirmation</h2>
				<p id="hospital">Hospital Name: <b>'.$clinicname.'</b></p>
				<p id="hospital">Time Slot: <b>'.$bookingtime.'</b></p>
				<p id="appointment">Appointment Date & Time: <b>'.$booking_date.':'.$bookingtimeslot.'</b></p>
				<div class="btn">
					<button class="close-btn">Close</button>
				</div>';

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

		$vocabulary = \Drupal\taxonomy\Entity\Vocabulary::load('clinc');
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