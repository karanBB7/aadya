<?php

namespace Drupal\userprofile\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Entity\EntityFieldManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\Core\Path\PathMatcher;
use Drupal\taxonomy\Entity\Vocabulary;
use Drupal\media\Entity\Media;
use Drupal\file\Entity\File;
use Drupal\Core\Url;
use Drupal\userprofile\LoadFields;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Datetime\DateFormatter;
use Drupal\Core\Database\Database;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\File\FileUrlGeneratorInterface;



class DoctorDashboard extends ControllerBase
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
	public function doctorDashboard(Request $request){
		global $base_url;
		$current_user = \Drupal::currentUser();
		$current_user = $current_user->id();
		$current_user_load = \Drupal\user\Entity\User::load($current_user);
		$doctors = $current_user_load->get("field_doctores")->getValue();
		$doctor_clinic = !empty($current_user_load->get("field_doctor_clinic")->getValue()) ? $current_user_load->get("field_doctor_clinic")->getValue()[0]['target_id'] : '';

		$clincterm = Term::load($doctor_clinic);
		$clinic_name = $clincterm->getName();
		$address = $clincterm->get('field_address')->getValue()[0]['value'];
		$response['clinic_name'] = !empty($clinic_name) ? $clinic_name : '';
		$response['target_id'] = !empty($doctor_clinic) ? $doctor_clinic : '';
		$usernames = array();
		if (!empty($doctors)) {
			foreach ($doctors as $user) {
				$usera = \Drupal\user\Entity\User::load($user['target_id']);
				$usernames[$user['target_id']] = $usera->getAccountName();
			}
		}
		
		$connection = Database::getConnection();
		$user_id = !empty($request->get('doctor')) ? $request->get('doctor') : '';
		$clinic = !empty($request->get('hospital')) ? $request->get('hospital') : '';
		$month = !empty($request->get('month')) ? $request->get('month') : '';
		$year = !empty($request->get('year')) ? $request->get('year') : '';
		$response['user_id'] = $user_id;
		$response['clinic'] = $clinic;
		$response['select_month'] = $month;
		$response['select_year'] = $year;
		$dates = array();
		$date_html = '';
		$selectd_date = date($year.'-'.$month.'-01');
		if(!empty($year) && !empty($month)){
			$current_date = new DrupalDateTime($selectd_date);
		}else{
			$current_date = new DrupalDateTime();
		}
		
		
		for ($i = 0; $i < 7; $i++) {
			$dates[$i]['date'] = $current_date->format('d');
			$dates[$i]['day'] = $current_date->format('l');
			$dates[$i]['fulldate'] = $current_date->format('Y-m-d');
			$query = $connection->select('doctor_availability','ba')
			->fields('ba');
			$query->condition('user_id', $user_id);
			$query->condition('out_date', $current_date->format('Y-m-d'));
			$query->condition('in_out', '2');
			$result = $query->execute();
			$doctor_availability = $result->fetchAll();
			if(!empty($doctor_availability)){
				foreach($doctor_availability as $value){
					if($value->out_date == $current_date->format('Y-m-d')){
						$dates[$i]['doctor_availability'] = 'off';
					}
				}
			}else{
				$dates[$i]['doctor_availability'] = 'on';
			}
			$current_date->modify('+1 day');
		}
		
		if(!empty($user_id)){
			$user = \Drupal\user\Entity\User::load($user_id);
			if(!empty($clinic)){
				$para1 = $user->get("field_book_appointment")->getValue();
				foreach ($para1 as $value) {
					$paragraph = Paragraph::load($value["target_id"]);
					// Paragraph type could be also useful.
					$prgTypeId = $paragraph->getType();

					//load Paragraph type & field
					$get_paragraph = $this->loadfields->getFieldDetails(
						"paragraph",
						$prgTypeId
					);
					foreach ($get_paragraph as $name => $type) {
						$childPara = $paragraph->get($name)->getValue();
						foreach ($childPara as $key =>$valuechild) {
							$paragraph = Paragraph::load($valuechild["target_id"]);
							$clinctarget_id = !empty($paragraph->get('field_clinic_name')->getValue()) ? $paragraph->get('field_clinic_name')->getValue()[0]['target_id']: '';
							$clincterm = Term::load($clinctarget_id);
							$clinic_name = $clincterm->getName();
							$data[$key]['clinic_name'] = $clinic_name;
							$data[$key]['target_id'] = $valuechild["target_id"];
						}
					}
				
				}
				$response['hospitals'] = $data;
			}
			$para = $user->get("field_paragraphtheme1")->getValue();
			foreach ($para as $value) {
				$paragraph = Paragraph::load($value["target_id"]);
				// Paragraph type could be also useful.
				$prgTypeId = $paragraph->getType();

				//load Paragraph type & field
				$get_paragraph = $this->loadfields->getFieldDetails(
					"paragraph",
					$prgTypeId
				);

				if (empty($get_paragraph)) {
					$data = null;
					if ($prgTypeId == "statecity") {
						$data = $this->loadfields->getStateCity();
					}
				} else {
					foreach ($get_paragraph as $name => $type) {
						//field type is paragraph
						if ($type["type"] == "entity_reference_revisions") {
							$childPara = $paragraph->get($name)->getValue();
							$getSubParaCount = $this->loadfields->getCount(
								$childPara
							);
							$name1 = $name;
							if (!empty($getSubParaCount)) {
								$getSubParaCountCnt =
									$getSubParaCount[$name1]["count"] ?? 0;
							} else {
								$getSubParaCountCnt = 0;
							}
							foreach ($childPara as $valuechild) {
								if ($getSubParaCountCnt != 1) {
									$data[
										$name
									][] = $this->loadfields->getFieldParaValue(
										$name,
										$valuechild["target_id"]
									);
								} else {
									$data[
										$name
									] = $this->loadfields->getFieldParaValue(
										$name,
										$valuechild["target_id"]
									);
								}
							}
						}  else {
							$data[$name] = $this->loadfields->getFieldValue(
								$paragraph,
								$name,
								$type["type"],
								$value["target_id"]
							);
						}
					}
				}

				if ($getParaCount[$prgTypeId]["count"] != 1) {
					$response[$prgTypeId] = $data;
				} else {
					$response[$prgTypeId] = $data;
				}
				unset($data);
			}
			$clinicparagraph = Paragraph::load($clinic);
			if(!empty($clinicparagraph)){
				$field_morning_slots = !empty($clinicparagraph->get('field_morning_slots')->getValue()) ? $clinicparagraph->get('field_morning_slots')->getValue(): '';
				$field_afternoon_slots = !empty($clinicparagraph->get('field_afternoon_slots')->getValue()) ? $clinicparagraph->get('field_afternoon_slots')->getValue(): '';
				$field_evening_slots = !empty($clinicparagraph->get('field_evening_slots')->getValue()) ? $clinicparagraph->get('field_evening_slots')->getValue(): '';
				$duration = !empty($clinicparagraph->get('field_duration')->getValue()) ? $clinicparagraph->get('field_duration')->getValue()[0]['value']: '';
				$weekdays = !empty($clinicparagraph->get('field_weekdays')->getValue()) ? $clinicparagraph->get('field_weekdays')->getValue(): '';
				$weekdays_select = [];
				if(!empty($weekdays)){
					foreach($weekdays as $value){
						$weekday_slot = Term::load($value['target_id']);
						$weekdays_select[] = $weekday_slot->getName();
					}
				}
			}
			$morning_slots = array();
			$afternoon_slots = [];
			$evening_slots = [];
			$mornig_data = [];
			$afternoon_data = [];
			$evening_data = [];
			$doctor_availability = [];
			$morningslots= [];
			$afternoonslots= [];
			$eveningslots= [];
			foreach($dates as $value){
				$booking_dates = (!empty($month) && !empty($year)) ? $year.'-'.$month.'-'.$value['date'] : date("Y-m-".$value['date']);
				$select_day = date("l",strtotime($booking_dates));
				$query = $connection->select('doctor_availability','ba')
					->fields('ba');
				$query->condition('user_id', $user_id);
				$query->condition('out_date', $booking_dates);
				$query->condition('in_out', '2');
				$result = $query->execute();
				$doctor_availability1 = $result->fetchAssoc();
				$doctor_availability[$booking_dates] = $doctor_availability1;

				$query = $connection->select('booking_appointment','ba')
				->fields('ba');
				$query->condition('time_slot_name', 'Morning');
				$query->condition('clinic_target_id', $clinic);
				$query->condition('booking_date', $booking_dates);
				$condition_group = $query->orConditionGroup()
					->condition('status', '1')
					->condition('status', '3', '=');
				$query->condition($condition_group);
				$result = $query->execute();
				$morning_rows = $result->fetchAll();
				$morning_book_slot = [];
				if(!empty($morning_rows)){
					foreach($morning_rows as $key => $row){
						$morning_book_slot[] = $row->time_slot;
						$mornig_data[$booking_dates][$row->time_slot][$row->id][] = $row->patient_name;
					}
				}

				$query1 = $connection->select('booking_appointment','ba')
				->fields('ba');
				$query1->condition('time_slot_name', 'After Noon');
				$query1->condition('clinic_target_id', $clinic);
				$query1->condition('booking_date', $booking_dates);
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
						$afternoon_data[$booking_dates][$row->time_slot][$row->id][] = $row->patient_name;
					}
				}
				$query2 = $connection->select('booking_appointment','ba')
					->fields('ba');
				$query2->condition('time_slot_name', 'Evening');
				$query2->condition('clinic_target_id', $clinic);
				$query2->condition('booking_date', $booking_dates);
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
						$evening_data[$booking_dates][$row->time_slot][$row->id][] = $row->patient_name;
					}
				}

				if(!empty($duration)){
					foreach($field_morning_slots as $key => $morning_slot){
						$mr_slot = Term::load($morning_slot['target_id']);
						$morningslots[] = $mr_slot->getName();
					}
					if(!empty($morningslots)){
						$duation_slots = $this->durationwiseslot($morningslots,$duration);
						foreach($duation_slots as $value){
							if(!empty($weekdays_select) && in_array($select_day, $weekdays_select)){
								if (!empty($mornig_data[$booking_dates][$value])) {
									$morning_slots[$booking_dates][$value] = $mornig_data[$booking_dates][$value];
								} else {
									$morning_slots[$booking_dates][$value] = $value;
								}
							}else{
								$morning_slots[$booking_dates][$value] = '--';
							}
						}
					}else{
						$morning_slots[$booking_dates] = '--';
					}
					
				}else{
					if(!empty($weekdays_select) && in_array($select_day, $weekdays_select)){
						foreach($field_morning_slots as $key => $morning_slot){
							$mr_slot = Term::load($morning_slot['target_id']);
							if (!empty($mornig_data[$booking_dates][$mr_slot->getName()])) {
								$morning_slots[$booking_dates][$mr_slot->getName()] = $mornig_data[$booking_dates][$mr_slot->getName()];
							} else {
								$morning_slots[$booking_dates][$mr_slot->getName()] = $mr_slot->getName();
							}
						}
					}else{
						$morning_slots[$booking_dates][$value] = '--';
					}
				}
				if(!empty($duration)){
					foreach($field_afternoon_slots as $key1 => $afternoon_slot){
						$aft_slot = Term::load($afternoon_slot['target_id']);
						$afternoonslots[] = $aft_slot->getName();
					}
					if(!empty($afternoonslots)){
						$duation_slots = $this->durationwiseslot($afternoonslots,$duration);
						foreach($duation_slots as $value){
							if(!empty($weekdays_select) && in_array($select_day, $weekdays_select)){
								if (!empty($afternoon_data[$booking_dates][$value])) {
									$afternoon_slots[$booking_dates][$value] = $afternoon_data[$booking_dates][$value];
								} else {
									$afternoon_slots[$booking_dates][$value] = $value;
								}
							}else{
								$afternoon_slots[$booking_dates][$value] = '--';
							}
						}
					}else{
						$afternoon_slots[$booking_dates] = '--';
					}
					
				}else{
					if(!empty($weekdays_select) && in_array($select_day, $weekdays_select)){
						foreach($field_afternoon_slots as $key1 => $afternoon_slot){
							$aft_slot = Term::load($afternoon_slot['target_id']);
							if (!empty($afternoon_data) && !empty($afternoon_data[$booking_dates][$aft_slot->getName()])) {
								$afternoon_slots[$booking_dates][$aft_slot->getName()] = $afternoon_data[$booking_dates][$aft_slot->getName()];
							} else {
								$afternoon_slots[$booking_dates][$aft_slot->getName()] = $aft_slot->getName();
							}
						}
					}else{
						$afternoon_slots[$booking_dates][$value] = '--';
					}
				}
				if(!empty($duration)){
					foreach($field_evening_slots as $key2 => $evening_slot){
						$ev_slot = Term::load($evening_slot['target_id']);
						$eveningslots[] = $ev_slot->getName();
					}
					if(!empty($eveningslots)){
						$duation_slots = $this->durationwiseslot($eveningslots,$duration);
						foreach($duation_slots as $value){
							if(!empty($weekdays_select) && in_array($select_day, $weekdays_select)){
								if (!empty($evening_data[$booking_dates][$value])) {
									$evening_slots[$booking_dates][$value] = $evening_data[$booking_dates][$value];
								} else {
									$evening_slots[$booking_dates][$value] = $value;
								}
							}else{
								$evening_slots[$booking_dates][$value] = '--';
							}
						}
					}else{
						$evening_slots[$booking_dates] = '--';
					}
					
				}else{
					if(!empty($weekdays_select) && in_array($select_day, $weekdays_select)){
						foreach($field_evening_slots as $key2 => $evening_slot){
							$ev_slot = Term::load($evening_slot['target_id']);
							if (!empty($evening_data[$booking_dates][$ev_slot->getName()])) {
								$evening_slots[$booking_dates][$ev_slot->getName()] = $evening_data[$booking_dates][$ev_slot->getName()];
							} else {
								$evening_slots[$booking_dates][$ev_slot->getName()] = $ev_slot->getName();
							}
						}
					}else{
						$evening_slots[$booking_dates][$value] = '--';
					}
				}
			}
		}
		$response['doctor_availability'] = !empty($doctor_availability) ? $doctor_availability : '';
		$response['morning_slots'] = !empty($morning_slots) ? $morning_slots : '';
		$response['afternoon_slots'] = !empty($afternoon_slots) ? $afternoon_slots : '';
		$response['evening_slots'] = !empty($evening_slots) ? $evening_slots : '';
		$months = [];
		$years = [];
		$currentMonth = (int) date('n'); // Current month as a number (1-12)
		$currentYear = (int) date('Y'); // Current year

		// Loop through 12 months starting from the current month
		for ($month = $currentMonth; $month <= 12; $month++) {
		    // Create a DrupalDateTime object for the month
		    $date = new DrupalDateTime($currentYear . '-' . $month . '-01');
		    
		    // Format the month name using Drupal's date formatter service
		    $monthName = \Drupal::service('date.formatter')->format($date->getTimestamp(), 'custom', 'F');
		    
		    // Add the month name to the $months array
		    $months[$month] = $monthName; // Store month name with its index (1-12)
		}
		$years = date('Y');
		// for($z = date("Y"); $z >= date("Y") - 10; $z--){
		// 	$years[$z] = $z;
		// }
		// Whole month date get
		// $currentDate = new DrupalDateTime('now');
	
		// // Get the year and month
		// $year = $currentDate->format('Y');
		// $month = $currentDate->format('m');
		
		// // Calculate the number of days in the month
		// $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		
		// // Array to store formatted dates
		// $datesOfMonth = [];
		
		// // Loop through each day of the month
		// for ($day = 1; $day <= $daysInMonth; $day++) {
		// 	// Create a new DateTime object for each day
		// 	$date = new DrupalDateTime("$year-$month-$day");
			
		// 	// Format the date
		// 	$formattedDate = \Drupal::service('date.formatter')->format($date->getTimestamp(), 'custom', 'd F Y');
		// 	$formatteddat = \Drupal::service('date.formatter')->format($date->getTimestamp(), 'custom', 'l');
		// 	// Add the formatted date to the array
		// 	$datesOfMonth[] = $formattedDate;
		// }
		
		$users = [];
		$entity_type_manager = \Drupal::entityTypeManager();
		$user_storage = $entity_type_manager->getStorage('user');
		
		
		$response['months'] = $months;
		$response['years'] = $years;
		$response['usernames'] = $usernames;
		$response['selecteddates'] = $dates;
		return array(
			'#theme' => 'dashboard_template',
			'#arr_data' => $response,
		);
	}

	public function doctorAvailability(Request $request){
		$user_id = !empty($request->get('user_id')) ? $request->get('user_id') : '';
		$date = !empty($request->get('date')) ? $request->get('date') : '';
		$switch_data = !empty($request->get('switch_data')) ? $request->get('switch_data') : '';
		$connection = Database::getConnection();
		$query = $connection->select('doctor_availability','ba')
					->fields('ba');
		$query->condition('user_id', $user_id);
		$query->condition('out_date', $date);
		$result = $query->execute();
		$doctor_availability1 = $result->fetchAssoc();
		$table = 'doctor_availability';
		if($switch_data == 'out'){
			if(!empty($doctor_availability1)){
				$query = $connection->update('doctor_availability')
				  ->fields([
					'in_out' => '2',
				])
				->condition('user_id', $user_id)
				->condition('out_date', $date)
				->execute();
			}else{
				$fields = array(
					'user_id' => $user_id,
					'out_date' => $date,
					'in_out' => '2',
					'created_date' => date('Y-m-d H:i:s'),
				);		
				\Drupal::database()->insert($table)
					->fields($fields)
					->execute();
			}
			$query = $connection->update('booking_appointment')->fields([
				'status' => '2',
			])
			->condition('user_id', $user_id)
			->condition('booking_date', $date)
			->execute();
			$query1 = $connection->select('booking_appointment','ba')
			->fields('ba')
			->condition('status', '2')
			->condition('user_id', $user_id)
			->condition('booking_date', $date);
			$result1 = $query1->execute();
			$rows = $result1->fetchAll();
			if(!empty($rows)){
				foreach($rows as $value){
					$usera = \Drupal\user\Entity\User::load($value->user_id);
					$usernames = $usera->getAccountName();
					$date = new DrupalDateTime($value->booking_date);
					$date_booking = \Drupal::service('date.formatter')->format($date->getTimestamp(), 'custom', 'l jSF');
					$text_sms = 'Dear '.$value->patient_name.', your appointment with Dr.'.$usernames.' at  on '.$date_booking.' at '.$value->time_slot.' is cancelled. WhatsApp us on 9376005515 to book an appointment. Aadya Health Sciences.';
					$mob_text = str_replace('+', '%20', urlencode($text_sms));
					$url_sms = 'https://onlysms.co.in/api/sms.aspx?UserID=adhspl&UserPass=Adh909@&MobileNo='.$value->mobile_number.'&GSMID=AADHSP&PEID=1701171921100574462&Message='.$mob_text.'&TEMPID=1707171930774075419&UNICODE=TEXT';
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
			}
		}else{
			$query = $connection->update('doctor_availability')
			  ->fields([
				'in_out' => '1',
			])
			->condition('user_id', $user_id)
			->condition('out_date', $date)
			->execute();
		}
		
		
		$ajax_resp = new JsonResponse(array("status"=>'success'));
		return ($ajax_resp);
		exit;
	}

	public function getHospital(Request $request){
		$current_user = \Drupal::currentUser();
		$current_user = $current_user->id();
		$current_user_load = \Drupal\user\Entity\User::load($current_user);
		$doctor_clinics = !empty($current_user_load->get("field_doctor_clinic")->getValue()) ? $current_user_load->get("field_doctor_clinic")->getValue()[0]['target_id'] : '';
		$user_id = !empty($request->get('user_id')) ? $request->get('user_id') : '';
		$user = \Drupal\user\Entity\User::load($user_id);
		$para1 = $user->get("field_book_appointment")->getValue();
		
		$html = '';
		foreach ($para1 as $value) {
			$paragraph = Paragraph::load($value["target_id"]);
			// Paragraph type could be also useful.
			$prgTypeId = $paragraph->getType();

			//load Paragraph type & field
			$get_paragraph = $this->loadfields->getFieldDetails(
				"paragraph",
				$prgTypeId
			);
			foreach ($get_paragraph as $name => $type) {
				$childPara = $paragraph->get($name)->getValue();
				$i = 0;
				foreach ($childPara as $key =>$valuechild) {
					$paragraph = Paragraph::load($valuechild["target_id"]);
					$clinctarget_id = !empty($paragraph->get('field_clinic_name')->getValue()) ? $paragraph->get('field_clinic_name')->getValue()[0]['target_id']: '';
					//if($doctor_clinics == $clinctarget_id){
						$clincterm = Term::load($clinctarget_id);
						$clinic_name = $clincterm->getName();
						$address = $clincterm->get('field_address')->getValue()[0]['value'];
						$data[$i]['clinic_name'] = $clinic_name;
						$data[$i]['target_id'] = $valuechild["target_id"];
						$data[$i]['clinctarget_id'] = $clinctarget_id;
					//}
					$i++;
				}
			}
		}
		$html .='<option value="">Select Hospital</option>';
		if(!empty($data)){
			foreach($data as $row){
				$selected = ($row['clinctarget_id'] == $doctor_clinics) ? 'selected' : '';
				$html .='<option value="'.$row['target_id'].'" '.$selected.'>'.$row['clinic_name'].'</option>';
			}
		}
		$ajax_resp = new JsonResponse(array("html"=>$html,'doctor_clinics'=>$data[0]['target_id']));
		return ($ajax_resp);
		exit;
	}

	public function getAppointmentData(Request $request){
		$id = !empty($request->get('id')) ? $request->get('id') : '';
		$connection = Database::getConnection();
		$query = $connection->select('booking_appointment','ba')
		->fields('ba');
		$query->condition('id', $id);
		$result = $query->execute();
		$rows = $result->fetchAll();
		$html = '';
		if(!empty($rows)){
			$html .='<form class="mx-2 my-3">
				<div class="mb-3">
					<label for="modalContentn" class="form-label">
						Name:
						<span class="modal-body" id="modalContentn">
							'.$rows[0]->patient_name.'
						</span>
					</label>
				</div>
				<div class="mb-3">
					<label for="exampleInputPassword1" class="form-label">
					Phone Number: <span>'.$rows[0]->mobile_number.'</span>
					</label>
				</div>
				<div class="d-flex justify-content-between">
					<div>
						<label for="modalContentn" class="form-label">
							Appointment Time:
							<span class="time-display" id="modalTimeDisplay">
								'.$rows[0]->time_slot.'
							</span>
						</label>
					</div>
					<div>
						<label for="exampleInputPassword1" class="form-label">
						Appointment Date: <span>'.date("d/m/Y",strtotime($rows[0]->booking_date)).'</span>
						</label>
					</div>
				</div>
				<button type="button" class="bg-danger cancel_appoiment" data-id="'.$id.'">Cancel appointment</button>
			</form>';
		}
		$ajax_resp = new JsonResponse(array("html"=>$html));
		return ($ajax_resp);
		exit;
	}
	public function cancelAppointment(Request $request){
		$id = !empty($request->get('id')) ? $request->get('id') : '';
		$connection = Database::getConnection();
		$query1 = $connection->select('booking_appointment','ba')
		->fields('ba');
		$query1->condition('id', $id);
		$result = $query1->execute();
		$rows = $result->fetchAll();

		$query = $connection->update('booking_appointment')
		  ->fields([
			'status' => '2',
		])
		->condition('id', $id)
		->execute();
		$usera = \Drupal\user\Entity\User::load($rows[0]->user_id);
		$usernames = $usera->getAccountName();
		$date = new DrupalDateTime($rows[0]->booking_date);
	    $date_booking = \Drupal::service('date.formatter')->format($date->getTimestamp(), 'custom', 'l jSF');
		$text_sms = 'Dear '.$rows[0]->patient_name.', your appointment with Dr.'.$usernames.' at  on '.$date_booking.' at '.$rows[0]->time_slot.' is cancelled. WhatsApp us on 9376005515 to book an appointment. Aadya Health Sciences.';
		$mob_text = str_replace('+', '%20', urlencode($text_sms));
		$url_sms = 'https://onlysms.co.in/api/sms.aspx?UserID=adhspl&UserPass=Adh909@&MobileNo='.$rows[0]->mobile_number.'&GSMID=AADHSP&PEID=1701171921100574462&Message='.$mob_text.'&TEMPID=1707171930774075419&UNICODE=TEXT';
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
		$ajax_resp = new JsonResponse(array("success"=>"Appointment Cancel Successfully."));
		return ($ajax_resp);
		exit;
	}
	public function adminBookingAppointment(Request $request){
		$phone_number = !empty($request->get('phone_number')) ? $request->get('phone_number') : '';
		$paitent_name = !empty($request->get('paitent_name')) ? $request->get('paitent_name') : '';
		$time_slot = !empty($request->get('time_slot')) ? $request->get('time_slot') : '';
		$time_slot_name = !empty($request->get('time_slot_name')) ? $request->get('time_slot_name') : '';
		$booking_date = !empty($request->get('booking_date')) ? $request->get('booking_date') : '';
		$doctor = !empty($request->get('doctor')) ? $request->get('doctor') : '';
		$hospital = !empty($request->get('hospital')) ? $request->get('hospital') : '';
		$hospital_name = !empty($request->get('hospital_name')) ? $request->get('hospital_name') : '';
		$table = 'booking_appointment';
		$fields = array(
			'mobile_number' => $phone_number,
			'clinic_target_id' => $hospital,
			'clinic_name' => $hospital_name,
			'time_slot' => $time_slot,
			'time_slot_name' => $time_slot_name,
			'booking_date' => $booking_date,
			'user_id' => $doctor,
			'patient_name' => $paitent_name,
			'source' => 'Admin',
			'request' => '',
			'status' => '1',
			'created_date' => date('Y-m-d H:i:s'),
		);			
		\Drupal::database()->insert($table)
			->fields($fields)
			->execute();
		$usera = \Drupal\user\Entity\User::load($doctor);
		$usernames = $usera->getAccountName();
		$date = new DrupalDateTime($booking_date);
	    $date_booking = \Drupal::service('date.formatter')->format($date->getTimestamp(), 'custom', 'l jSF');
		$text_sms = 'Dear '.$paitent_name.'!, your appointment with Dr.'.$usernames.' at '.$date_booking.' on '.$time_slot.' at '.$hospital_name.' is confirmed. WhatsApp us on 9376005515 to cancel or reschedule. Aadya Health Sciences.';
		$mob_text = str_replace('+', '%20', urlencode($text_sms));
		$url_sms = 'https://onlysms.co.in/api/sms.aspx?UserID=adhspl&UserPass=Adh909@&MobileNo='.$phone_number.'&GSMID=AADHSP&PEID=1701171921100574462&Message='.$mob_text.'&TEMPID=1707171930778294643&UNICODE=TEXT';
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
		$ajax_resp = new JsonResponse(array("success"=>"Booking Appointment Successfully."));
		return ($ajax_resp);
		exit;

	}
}
?>