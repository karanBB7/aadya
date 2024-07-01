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
class Webhook extends ControllerBase
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

	public function webhookAppointment(Request $request){
		$auth = !empty($request->headers->get('authorization')) ? $request->headers->get('authorization') : "";
		$authorization = str_replace('Basic', '', $auth);
		$responseData = array();
		$connection = Database::getConnection();
		if(trim($authorization) == 'bGlucW1kOlNAaVBrSG1GU2FpOXo='){
			$getContent = $request->getContent();
			$decode_body = json_decode($getContent, true);
			$username = !empty($decode_body['username']) ? $decode_body['username'] : "";
			$mobilenumber = !empty($decode_body['mobilenumber']) ? $decode_body['mobilenumber'] : "";
			$list_type = !empty($decode_body['type']) ? $decode_body['type'] : "";
			$clinic = !empty($decode_body['clinic']) ? $decode_body['clinic'] : "";
			$date = !empty($decode_body['date']) ? $decode_body['date'] : "";
			$slotname = !empty($decode_body['slot_name']) ? $decode_body['slot_name'] : "";
			$name = !empty($decode_body['name']) ? $decode_body['name'] : "";
			if($slotname == 'morning'){
				$slot_name = 'Morning';
			}else if($slotname == 'afternoon'){
				$slot_name = 'After Noon';
			}else if($slotname == 'evening'){
				$slot_name = 'Evening';
			}
			$slot_time = !empty($decode_body['slot_time']) ? $decode_body['slot_time'] : "";
			$booking_date = !empty($decode_body['booking_date']) ? $decode_body['booking_date'] : "";
			$patient_name = !empty($decode_body['name']) ? $decode_body['name'] : "";

			$list_message = array("1"=>"Book Appointment","2"=>"Reschedule","3"=>"Cancel Appointment","4"=>"Show appointment details");
			if(empty($list_type)){
				$responseData = ["list_message" => $list_message];
			}
			$query = \Drupal::database()->select('users_field_data', 'u');
			$query->addField('u', 'uid');
			$query->condition('u.name', $username);
			$uid = $query->execute()->fetchField();
			if(!empty($uid)){
				$user = \Drupal\user\Entity\User::load($uid);
				$para1 = $user->get("field_book_appointment")->getValue();
				$doctor_type = !empty($user->get("field_type")->getValue()) ? $user->get("field_type")->getValue()[0]['value'] : '';
				foreach ($para1 as $value) {
					$paragraph = Paragraph::load($value["target_id"]);
					$prgTypeId = $paragraph->getType();
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
							$data[$valuechild["target_id"]] = $clinic_name;
						}
					}
				}
			}
			if($list_type == '1'){
				$vocabulary = \Drupal\taxonomy\Entity\Vocabulary::load('clinc');
				$termStorage = \Drupal::entityTypeManager()->getStorage('taxonomy_term');
				$terms = $termStorage->loadTree($vocabulary->id(), 0, NULL, TRUE);
				$clinic_arr =array();
				foreach ($terms as $term) {
					$clinic_arr[$term->id()] = $term->getName();
				}
				$slotsdate = array('1'=>"Today","2"=>"Tomorrow","3"=>"day after");
				$responseData = ["date"=>$slotsdate];
				if(!empty($date)){
					$responseData = ["clinic" => $data];
					if(!empty($clinic)){
						if($date == '1'){
							$select_date = date("Y-m-d");
						}else if($date == '2'){
							$select_date = date("Y-m-d",strtotime("tomorrow"));
						}else if($date == '3'){
							$date = date("Y-m-d");
							$mod_date = strtotime($date."+ 2 days");
							$select_date = date("Y-m-d",$mod_date);
						}
						$query = $connection->select('booking_appointment','ba')
						->fields('ba');
						$query->condition('time_slot_name', 'Morning');
						$query->condition('clinic_target_id', $clinic);
						$query->condition('booking_date', $select_date);
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
						$query1->condition('clinic_target_id', $clinic);
						$query1->condition('booking_date', $select_date);
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
						$query2->condition('clinic_target_id', $clinic);
						$query2->condition('booking_date', $select_date);
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
						$paragraph = Paragraph::load($clinic);
						$field_clinic_name = !empty($paragraph->get('field_clinic_name')->getValue()) ? $paragraph->get('field_clinic_name')->getValue()[0]['target_id']: '';
						$clincterm = Term::load($field_clinic_name);
						$clinic_name = $clincterm->getName();
						$field_morning_slots = !empty($paragraph->get('field_morning_slots')->getValue()) ? $paragraph->get('field_morning_slots')->getValue(): '';
						$slots =array();
						foreach($field_morning_slots as $key=> $morning_slot){
							$mr_slot = Term::load($morning_slot['target_id']);
							if(!in_array($mr_slot->getName(), $morning_book_slot)){
								$slots['morning_slot'][$mr_slot->getName()] = $mr_slot->getName();
							}
						}
						$field_afternoon_slots = !empty($paragraph->get('field_afternoon_slots')->getValue()) ? $paragraph->get('field_afternoon_slots')->getValue(): '';
						foreach($field_afternoon_slots as $key=> $afternoon_slot){
							$aft_slot = Term::load($afternoon_slot['target_id']);
							if(!in_array($aft_slot->getName(), $afternoon_book_slot)){
								$slots['afternoon_slot'][$aft_slot->getName()] = $aft_slot->getName();
							}
						}
						$field_evening_slots = !empty($paragraph->get('field_evening_slots')->getValue()) ? $paragraph->get('field_evening_slots')->getValue(): '';
						foreach($field_evening_slots as $key=> $evening_slot){
							$ev_slot = Term::load($evening_slot['target_id']);
							if(!in_array($ev_slot->getName(), $evening_book_slot)){
								$slots['evening_slot'][$ev_slot->getName()] = $ev_slot->getName();
							}
						}
						$responseData = ['slots'=>$slots];
						if(!empty($slot_time)){
							$table = 'booking_appointment';
							$fields = array(
								'mobile_number' => $mobilenumber,
								'clinic_target_id' => $clinic,
								'clinic_name' => $clinic_name,
								'time_slot' => $slot_time,
								'time_slot_name' => $slot_name,
								'booking_date' => $select_date,
								'user_id' => $uid,
								'patient_name' => $patient_name,
								'source' => 'Whatsapp',
								'request' => $getContent,
								'status' => '1',
								'type'=>$doctor_type,
								'created_date' => date('Y-m-d H:i:s'),
							);			
							\Drupal::database()->insert($table)
								->fields($fields)
								->execute();
								$responseData = [
									"status" => "Sucess",
									"message" => "Booking Sucessfully.",
									"type"=>$doctor_type
								];
							$usera = \Drupal\user\Entity\User::load($uid);
							$usernames = $usera->getAccountName();
							$date = new DrupalDateTime($select_date);
							$date_booking = \Drupal::service('date.formatter')->format($date->getTimestamp(), 'custom', 'l jSF');
							$text_sms = 'Dear '.$patient_name.'!, your appointment with Dr.'.$usernames.' at '.$date_booking.' on '.$slot_time.' at '.$clinic_name.' is confirmed. WhatsApp us on 9376005515 to cancel or reschedule. Aadya Health Sciences.';
							$mob_text = str_replace('+', '%20', urlencode($text_sms));
							$url_sms = 'https://onlysms.co.in/api/sms.aspx?UserID=adhspl&UserPass=Adh909@&MobileNo='.$mobilenumber.'&GSMID=AADHSP&PEID=1701171921100574462&Message='.$mob_text.'&TEMPID=1707171930778294643&UNICODE=TEXT';
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
				}
			}
			if($list_type == '2'){
				$query = $connection->select('booking_appointment','ba')
				->fields('ba');
				$current_date = date('Y-m-d');
				$query->condition('mobile_number', $mobilenumber);
				$condition_group = $query->orConditionGroup()
				  ->condition('status', '1')
				  ->condition('status', '3', '=');
				$query->condition($condition_group);
				$query->condition('booking_date',$current_date,'>=');
				$result = $query->execute();
				$booking_rows = $result->fetchAll();
				$booking_dates = array();
				if(!empty($booking_rows)){
					foreach ($booking_rows as $key => $value) {
						$booking_dates[$value->id] = $value->booking_date.' '.$value->time_slot;
					}
					$responseData = ["booking_date" => $booking_dates];
					if(!empty($booking_date)){
						$slotsdate = array('1'=>"Today","2"=>"Tomorrow","3"=>"day after");
						$responseData = ["date"=>$slotsdate];
						if(!empty($date)){
							if($date == '1'){
								$select_date = date("Y-m-d");
							}else if($date == '2'){
								$select_date = date("Y-m-d",strtotime("tomorrow"));
							}else if($date == '3'){
								$date = date("Y-m-d");
								$mod_date = strtotime($date."+ 2 days");
								$select_date = date("Y-m-d",$mod_date);
							}
							$query = $connection->select('booking_appointment','ba')
							->fields('ba');
							$query->condition('id', $booking_date);
							$result = $query->execute();
							$user_booking_data = $result->fetchAll();
							$clinic = $user_booking_data[0]->clinic_target_id;

							$query = $connection->select('booking_appointment','ba')
							->fields('ba');
							$query->condition('time_slot_name', 'Morning');
							$query->condition('clinic_target_id', $clinic);
							$query->condition('booking_date', $select_date);
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
							$query1->condition('clinic_target_id', $clinic);
							$query1->condition('booking_date', $select_date);
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
							$query2->condition('clinic_target_id', $clinic);
							$query2->condition('booking_date', $select_date);
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
							$paragraph = Paragraph::load($clinic);
							$field_morning_slots = !empty($paragraph->get('field_morning_slots')->getValue()) ? $paragraph->get('field_morning_slots')->getValue(): '';
							$slots =array();
							foreach($field_morning_slots as $key=> $morning_slot){
								$mr_slot = Term::load($morning_slot['target_id']);
								if(!in_array($mr_slot->getName(), $morning_book_slot)){
									$slots['morning_slot'][$mr_slot->getName()] = $mr_slot->getName();
								}
							}
							$field_afternoon_slots = !empty($paragraph->get('field_afternoon_slots')->getValue()) ? $paragraph->get('field_afternoon_slots')->getValue(): '';
							foreach($field_afternoon_slots as $key=> $afternoon_slot){
								$aft_slot = Term::load($afternoon_slot['target_id']);
								if(!in_array($aft_slot->getName(), $afternoon_book_slot)){
									$slots['afternoon_slot'][$aft_slot->getName()] = $aft_slot->getName();
								}
							}
							$field_evening_slots = !empty($paragraph->get('field_evening_slots')->getValue()) ? $paragraph->get('field_evening_slots')->getValue(): '';
							foreach($field_evening_slots as $key=> $evening_slot){
								$ev_slot = Term::load($evening_slot['target_id']);
								if(!in_array($ev_slot->getName(), $evening_book_slot)){
									$slots['evening_slot'][$ev_slot->getName()] = $ev_slot->getName();
								}
							}
							$responseData = ['slots'=>$slots];
							if(!empty($slot_time)){
								$query2 = $connection->select('booking_appointment','ba')->fields('ba');
								$query2->condition('id',$booking_date);
								$result1 = $query2->execute();
								$rows = $result1->fetchAll();
								$usera = \Drupal\user\Entity\User::load($rows[0]->user_id);
								$usernames = $usera->getAccountName();
								$date = new DrupalDateTime($rows[0]->booking_date);
								$date_booking = \Drupal::service('date.formatter')->format($date->getTimestamp(), 'custom', 'l jSF');
								$rescdate = new DrupalDateTime($select_date);
								$date_resc_booking = \Drupal::service('date.formatter')->format($rescdate->getTimestamp(), 'custom', 'l jSF');
								$text_sms = 'Dear '.$rows[0]->patient_name.', your appointment with Dr.'.$usernames.' at '.$date_booking.' on '.$rows[0]->time_slot.' at '.$rows[0]->clinic_name.' is now rescheduled to '.$date_resc_booking.' on '.$slot_time.'  due to Reason1 Reason2.Sorry for the inconvenience, please WhatsApp us on 9376005515 to cancel or reschedule. Aadya Health Sciences.';
								$mob_text = str_replace('+', '%20', urlencode($text_sms));
								$url_sms = 'https://onlysms.co.in/api/sms.aspx?UserID=adhspl&UserPass=Adh909@&MobileNo='.$rows[0]->mobile_number.'&GSMID=AADHSP&PEID=1701171921100574462&Message='.$mob_text.'&TEMPID=1707171930723897877&UNICODE=TEXT';
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
								$query = $connection->update('booking_appointment')
								  ->fields([
									'status' => '3',
									'time_slot' => $slot_time,
									'time_slot_name' => $slot_name,
									'booking_date' => $select_date,
								])
								  ->condition('id', $booking_date)
								  ->execute();
								$responseData = [
									"status" => "success",
									"message" => "Booking Reschedule Sucessfully.",
								];
							}
						}
					}
				}else{
					$responseData = [
						"status" => "error",
						"message" => "No booking avaliable.",
					];
				}
			}
			if($list_type == '3'){
				$current_date = date('Y-m-d');
				$query = $connection->select('booking_appointment','ba')
				->fields('ba');
				$query->condition('mobile_number', $mobilenumber);
				$condition_group = $query->orConditionGroup()
				->condition('status', '1')
				->condition('status', '3', '=');
				$query->condition('booking_date',$current_date,'>=');
				$query->condition($condition_group);
				$result = $query->execute();
				$booking_rows = $result->fetchAll();
				$booking_dates = array();
				if(!empty($booking_rows)){
					foreach ($booking_rows as $key => $value) {
						$booking_dates[$value->id] = $value->booking_date.' '.$value->time_slot;
					}
					$responseData = ["booking_date" => $booking_dates];
					if(!empty($booking_date)){
						$query1 = $connection->update('booking_appointment')
						  ->fields([
							'status' => '2',
						  ])
						  ->condition('id', $booking_date)
						  ->execute();
						$query2 = $connection->select('booking_appointment','ba')->fields('ba');
						$query2->condition('id',$booking_date);
						$result1 = $query2->execute();
						$rows = $result1->fetchAll();
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
						$responseData = [
							"status" => "sucess",
							"message" => "Booking cancel successfully.",
						];
					}
				}else{
					$responseData = [
						"status" => "error",
						"message" => "No booking avaliable.",
					];
				}
			}
			if($list_type == '4'){
				$current_date = date('Y-m-d');
				$query = $connection->select('booking_appointment','ba')
				->fields('ba');
				$query->condition('mobile_number', $mobilenumber);
				$condition_group = $query->orConditionGroup()
					  ->condition('status', '1')
					  ->condition('status', '3', '=');
				$query->condition($condition_group);
				$query->condition('booking_date',$current_date,'>=');
				$result = $query->execute();
				$booking_rows = $result->fetchAll();
				$booking_data = array();
				if(!empty($booking_rows)){
					foreach ($booking_rows as $key => $value) {
						$query = $connection->select('users_field_data', 'u')
							->fields('u', ['name'])
							->condition('u.uid', $value->user_id)
							->execute();
						$request_data = json_decode($value->request, true);	
						$user = $query->fetchAssoc();
						$booking_data[$key]['clinic_name'] = $value->clinic_name;
						$booking_data[$key]['Time'] = $value->time_slot;
						$booking_data[$key]['booking_date'] = $value->booking_date;
						$booking_data[$key]['username'] = $user ? $user['name'] : 'Unknown';
						$booking_data[$key]['patient_name'] = $request_data['name'] ?? 'Unknown';
						$booking_data[$key]['type'] = $value->type;
					}
				}
				$responseData = [
					"booking_data" => $booking_data,
				];
			}
		}else{
			$responseData = [
				"status" => "error",
				"message" => "Authorization failed.",
			];
		}
		return new JsonResponse($responseData);
	}
}