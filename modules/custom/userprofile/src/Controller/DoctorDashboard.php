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
	public function doctorDashboard(Request $request){
		global $base_url;
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
		
		$query = $connection->select('doctor_availability','ba')
			->fields('ba');
		$query->condition('user_id', $user_id);
		$query->condition('in_out', '2');
		$result = $query->execute();
		$doctor_availability = $result->fetchAll();
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
			
			$field_morning_slots = !empty($clinicparagraph->get('field_morning_slots')->getValue()) ? $clinicparagraph->get('field_morning_slots')->getValue(): '';
			$field_afternoon_slots = !empty($clinicparagraph->get('field_afternoon_slots')->getValue()) ? $clinicparagraph->get('field_afternoon_slots')->getValue(): '';
			$field_evening_slots = !empty($clinicparagraph->get('field_evening_slots')->getValue()) ? $clinicparagraph->get('field_evening_slots')->getValue(): '';
			$morning_slots = [];
			$afternoon_slots = [];
			$evening_slots = [];
			$mornig_data = [];
			$afternoon_data = [];
			$evening_data = [];
			$doctor_availability = [];
			foreach($dates as $value){
				$booking_dates = (!empty($month) && !empty($year)) ? $year.'-'.$month.'-'.$value['date'] : date("Y-m-".$value['date']);

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

				foreach($field_morning_slots as $key => $morning_slot){
					$mr_slot = Term::load($morning_slot['target_id']);
					if (!empty($mornig_data[$booking_dates][$mr_slot->getName()])) {
						$morning_slots[$booking_dates][$mr_slot->getName()] = $mornig_data[$booking_dates][$mr_slot->getName()];
					} else {
						$morning_slots[$booking_dates][$mr_slot->getName()] = $mr_slot->getName();
					}
				}
				foreach($field_afternoon_slots as $key1 => $afternoon_slot){
					$aft_slot = Term::load($afternoon_slot['target_id']);
					if (!empty($afternoon_data) && !empty($afternoon_data[$booking_dates][$aft_slot->getName()])) {
						$afternoon_slots[$booking_dates][$aft_slot->getName()] = $afternoon_data[$booking_dates][$aft_slot->getName()];
					} else {
						$afternoon_slots[$booking_dates][$aft_slot->getName()] = $aft_slot->getName();
					}
				}
				foreach($field_evening_slots as $key2 => $evening_slot){
					$ev_slot = Term::load($evening_slot['target_id']);
					if (!empty($evening_data[$booking_dates][$ev_slot->getName()])) {
						$evening_slots[$booking_dates][$ev_slot->getName()] = $evening_data[$booking_dates][$ev_slot->getName()];
					} else {
						$evening_slots[$booking_dates][$ev_slot->getName()] = $ev_slot->getName();
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
		
		// Query to fetch users except admin
		$query = $user_storage->getQuery()
			->condition('status', 1) // Optional: Filter by user status (active)
			->condition('uid', 1, '<>'); // Exclude user ID 1 (admin user)
		$query->accessCheck(TRUE);
		$user_ids = $query->execute();
		$usernames = array();
		if (!empty($user_ids)) {
			 foreach ($user_ids as $user) {
				$usera = \Drupal\user\Entity\User::load($user);
				$usernames[$user] = $usera->getAccountName();
			}
		}
		
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
		}else{
			$query = $connection->update('doctor_availability')
			  ->fields([
				'in_out' => '1',
			])
			->condition('user_id', $user_id)
			->condition('out_date', $date)
			->execute();
		}
		
		$query = $connection->update('booking_appointment')
		  ->fields([
			'status' => '2',
		])
		->condition('user_id', $user_id)
		->condition('booking_date', $date)
		->execute();
		$ajax_resp = new JsonResponse(array("status"=>'success'));
		return ($ajax_resp);
		exit;
	}

	public function getHospital(Request $request){
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
				foreach ($childPara as $key =>$valuechild) {
					$paragraph = Paragraph::load($valuechild["target_id"]);
					$clinctarget_id = !empty($paragraph->get('field_clinic_name')->getValue()) ? $paragraph->get('field_clinic_name')->getValue()[0]['target_id']: '';
					$clincterm = Term::load($clinctarget_id);
					$clinic_name = $clincterm->getName();
					$address = $clincterm->get('field_address')->getValue()[0]['value'];
					$data[$key]['clinic_name'] = $clinic_name;
					$data[$key]['target_id'] = $valuechild["target_id"];
				}
			}
		}
		$html .='<option value="">Select Hospital</option>';
		if(!empty($data)){
			foreach($data as $row){
				$selected = ($row['target_id'] == '34') ? 'selected' : '';
				$html .='<option value="'.$row['target_id'].'">'.$row['clinic_name'].'</option>';
			}
		}
		$ajax_resp = new JsonResponse(array("html"=>$html));
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
				<button type="submit" class="bg-danger cancel_appoiment" data-id="'.$id.'">Cancel appointment</button>
			</form>';
		}
		$ajax_resp = new JsonResponse(array("html"=>$html));
		return ($ajax_resp);
		exit;
	}
	public function cancelAppointment(Request $request){
		$id = !empty($request->get('id')) ? $request->get('id') : '';
		$connection = Database::getConnection();
		$query = $connection->update('booking_appointment')
		  ->fields([
			'status' => '2',
		])
		->condition('id', $id)
		->execute();
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
		$ajax_resp = new JsonResponse(array("success"=>"Booking Appointment Successfully."));
		return ($ajax_resp);
		exit;

	}
}
?>