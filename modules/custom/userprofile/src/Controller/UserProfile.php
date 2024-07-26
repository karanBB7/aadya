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
class UserProfile extends ControllerBase
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


public function getProfile(Request $request)
	{
		global $base_url;
		$uid = \Drupal::currentUser()->id();
		
		if ($uid == 0) {
			return $this->redirect('userprofile.homepage');
		  }
		$user = \Drupal\user\Entity\User::load($uid);

		$user_full_name = '';
		$para = $user->get("field_paragraphtheme1")->getValue();
		if (!empty($para) && isset($para[0]['target_id'])) {
			$paragraph = \Drupal\paragraphs\Entity\Paragraph::load($para[0]['target_id']);
			if ($paragraph instanceof \Drupal\paragraphs\Entity\Paragraph) {
				$user_full_name = $paragraph->get('field_name')->value;
			}
		}

		$para = $user->get("field_paragraphtheme1")->getValue();
		$appointment_type = $user->get("field_type")->getValue();
		$doctor_type = !empty($user->get("field_type")->getValue()) ? $user->get("field_type")->getValue()[0]['value'] : '';
		$profile_theme = !empty($user->get("field_profile_theme")->getValue()) ? $user->get("field_profile_theme")->getValue()[0]['value'] : '';
		$getParaCount = $this->loadfields->getCount($para);
		
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
		$para1 = $user->get("field_book_appointment")->getValue();
		$getParaCount1 = $this->loadfields->getCount($para1);
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
					
					foreach ($childPara as $key =>$valuechild) {
						$paragraph = Paragraph::load($valuechild["target_id"]);
						$clinctarget_id = !empty($paragraph->get('field_clinic_name')->getValue()) ? $paragraph->get('field_clinic_name')->getValue()[0]['target_id']: '';
						$clincterm = Term::load($clinctarget_id);
						$clinic_name = $clincterm->getName();
						$address = $clincterm->get('field_address')->getValue()[0]['value'];
						$clinc_number = $clincterm->get('field_clinic_phone_number')->getValue()[0]['value'];

						$instructions = $clincterm->get('field_instructions')->getValue()[0]['value'];

						$data[$key]['clinic_name'] = $clinic_name;
						$data[$key]['target_id'] = $valuechild["target_id"];
						$data[$key]['address'] = $address;
						$data[$key]['clinc_number'] = $clinc_number;
						$data[$key]['instructions'] = $instructions;

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

			if ($getParaCount1[$prgTypeId]["count"] != 1) {
				$response[$prgTypeId] = $data;
			} else {
				$response[$prgTypeId] = $data;
			}
			unset($data);
		}
		
		//$currentDate = new DrupalDateTime();
		$dates = array();
		$current_date = new DrupalDateTime();
		for ($i = 0; $i < 7; $i++) {
			$dates[$current_date->format('D')] = $current_date->format('d');
			$current_date->modify('+1 day');
		}
		$response['dates'] = $dates;
		$response['user_id'] = $uid;
		$response['doctor_type'] = $doctor_type;
		$search = !empty($request->get('search')) ? $request->get('search'): array();
		$ea_query = \Drupal::entityQuery('node')
			->condition('status', 1)
			->condition('type', 'article', '=')
			->condition('uid', $uid) 
			->sort('created', 'DESC')
			->range(0, 6) 
			->accessCheck(TRUE);
	
		if (!empty($search)) {
			$ea_query->condition('title', '%' . $search . '%', 'LIKE');
		}
		$ea_nids = $ea_query->execute();
		
		$ea_query1 = \Drupal::entityQuery('node')
			->condition('status', 1)
			->condition('type', 'article', '=')
			->condition('uid', $uid) 
			->sort('created', 'DESC')
			->accessCheck(TRUE);
		if(!empty($search)){
			$ea_query1->condition('title', $search);
		}
		$ea_nids1 = $ea_query1->sort('created', 'DESC')->execute();
		// $node_count = count($ea_nids1);
		$response['article'] = [];
		$ea_nodes = Node::loadMultiple($ea_nids);
		foreach ($ea_nodes as $key => $node) {
			if ($node->hasField('field_doctor') && !$node->get('field_doctor')->isEmpty()) {
				$doctor_ids = array_column($node->get('field_doctor')->getValue(), 'target_id');
			} else {
				$doctor_ids = [];
				// Handle the case where there are no doctors or the field does not exist
			}
						
			//$doctor_ids = array_column($node->field_doctor->getValue(), 'target_id');
			//if (in_array($uid, $doctor_ids)) {
				$nid = $node->get('nid')->value;
				$title = $node->get('title')->value;
				$body = $node->get('body')->value;
				$date = $node->get('created')->value;
				$final_date = date("d F Y", $date);
				$article = $node->field_image->getValue();
				$article_id = $article[0]['target_id'];
				$article_img = "";
				$author = $node->field_author->getValue()[0]['value'];



				if(!empty($article_id)){
					$article_img = \Drupal\file\Entity\File::load($article_id)->createFileUrl();
				}

				$alias_url = $base_url.\Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);
				$response['article'][$key]['thumb'] = $article_img;
				$response['article'][$key]['alias_url'] = $alias_url;
				$response['article'][$key]['title'] = $title;
				$response['article'][$key]['date'] = $final_date;
				$response['article'][$key]['author'] = $author;
				$response['article'][$key]['body'] = $body;
				$response['article'][$key]['user_full_name'] = $user_full_name; 

			//}
		}

		
		$terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('news_categoery');
		foreach ($terms as $key1 => $term) {
			$term_news = Term::load($term->tid);
			$term_name = $term_news->getName();
			$term_id = $term_news->id();
			$response['news_categoery'][$key1]['term_name'] = $term_name;
			$response['news_categoery'][$key1]['term_id'] = $term_id;
		}


		$filtered_node_count_article = count($response['article']);
		$response['node_count'] = $filtered_node_count_article;
		$response['profile_theme'] = $profile_theme;



		$ea_query2 = \Drupal::entityQuery('node')
		->condition('status', 1)
		->condition('uid', $uid) 
		->condition('type', 'patient_testimonials', '=');
		if(!empty($search)){
			$ea_query2->condition('title', $search);
		}
		$ea_query2->accessCheck(TRUE);
		$ea_nids2 = $ea_query2->sort('created', 'DESC')->execute();
		$response['patient_testimonials'] = [];

		$ea_nodes2 = Node::loadMultiple($ea_nids2);

		foreach ($ea_nodes2 as $key => $node) {
			if ($node->hasField('field_doctor') && !$node->get('field_doctor')->isEmpty()) {
				$doctor_ids = array_column($node->get('field_doctor')->getValue(), 'target_id');
			} else {
				$doctor_ids = [];
				// Handle the case where there are no doctors or the field does not exist
			}

			//$doctor_ids = array_column($node->field_select_doctor->getValue(), 'target_id');
			//if (in_array($uid, $doctor_ids)) {
				$nid = $node->get('nid')->value;
				$title = $node->get('title')->value;
				$date = $node->get('created')->value;
				$final_date = date("d F Y", $date);
				
				$test_img = "";
				$content = $node->field_content->getValue()[0]['value'];
				$patienname = $node->field_patienname->getValue()[0]['value'];
				$test = !empty($node->field_patienpicture) ? $node->field_patienpicture->getValue() : '';
				if(!empty($test)){
					$test_id = $test[0]['target_id'];
				if (!empty($test_id)) {
					$test_img = \Drupal\file\Entity\File::load($test_id)->createFileUrl();
				}
				}
				
		
				$alias_url = $base_url . \Drupal::service('path_alias.manager')->getAliasByPath('/node/' . $nid);
				$response['patient_testimonials'][$key]['thumb'] = $test_img;
				$response['patient_testimonials'][$key]['alias_url'] = $alias_url;
				$response['patient_testimonials'][$key]['title'] = $title;
				$response['patient_testimonials'][$key]['date'] = $final_date;
				$response['patient_testimonials'][$key]['content'] = $content;
				$response['patient_testimonials'][$key]['patienname'] = $patienname;
				$response['patient_testimonials'][$key]['doc'] = $doctor_ids;
			//}
		}
		

		$response['node_count_testimonials'] = $node_count2;
		$response['profile_theme'] = $profile_theme;

		$terms2 = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('patient_testimonials');

		foreach ($terms2 as $key1 => $term) {
		  $term_news = Term::load($term->tid);
		  $term_name = $term_news->getName();
		  $term_id = $term_news->id();

		  // Retrieve nodes that have this taxonomy term selected
		  $node_query = \Drupal::entityQuery('node')
			->condition('status', 1)
			->condition('type', 'patient_testimonials', '=')
			->condition('uid', $uid)
			->condition('field_patientcategory', $term_id, '=')
			->accessCheck(TRUE);

		  $node_ids = $node_query->execute();
		  // Load the nodes
		  $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($node_ids);

		  // Add the nodes to the response
		  $response['patient_testimonialstags'][$key1]['term_name'] = $term_name;
		  $response['patient_testimonialstags'][$key1]['term_id'] = $term_id;
		  $response['patient_testimonialstags'][$key1]['nodes'] = [];

			foreach ($nodes as $node) {
				$response['patient_testimonialstags'][$key1]['nodes'][] = [
			  		'nid' => $node->id(),
			  		'title' => $node->getTitle(),
			  		// Add other node fields as needed
				];
		  	}
		}
		


		$filtered_node_count = count($response['patient_testimonials']);

		$response['node_count_testimonials'] = $filtered_node_count;
		$response['profile_theme'] = $profile_theme;



		$ea_query3 = \Drupal::entityQuery('node')
		->condition('status', 1)
		->condition('uid', $uid) 
		->condition('type', 'faq', '=');
		if(!empty($search)){
			$ea_query3->condition('title', $search);
		}
		$ea_query3->accessCheck(TRUE);
		$ea_nids3 = $ea_query3->sort('created', 'DESC')->execute();
		// $node_count3 = count($ea_nids3);
		$response['faq'] = [];
		$ea_nodes3 = Node::loadMultiple($ea_nids3);

		foreach ($ea_nodes3 as $key => $node) {
			if ($node->hasField('field_doctor') && !$node->get('field_doctor')->isEmpty()) {
				$doctor_ids = array_column($node->get('field_doctor')->getValue(), 'target_id');
			} else {
				$doctor_ids = [];
				// Handle the case where there are no doctors or the field does not exist
			}

			//$doctor_ids = array_column($node->field_faqdoctor->getValue(), 'target_id');			
			//if(in_array($uid, $doctor_ids)) {
				$nid = $node->get('nid')->value;
				$title = $node->get('title')->value;
				$body = $node->get('body')->value;
				$date = $node->get('created')->value;
				$final_date = date("d F Y", $date);

				$alias_url = $base_url.\Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);
				$response['faq'][$key]['title'] = $title;
				$response['faq'][$key]['body'] = $body;
				$response['faq'][$key]['date'] = $final_date;

			//}
		}

		$terms3 = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('faq');

		foreach ($terms3 as $key1 => $term) {
		  $term_news = Term::load($term->tid);
		  $term_name = $term_news->getName();
		  $term_id = $term_news->id();

		  // Retrieve nodes that have this taxonomy term selected
		  $node_query = \Drupal::entityQuery('node')
			->condition('status', 1)
			->condition('uid', $uid)
			->condition('type', 'faq', '=')
			->condition('field_faqcategory', $term_id, '=')
			->accessCheck(TRUE);

		  $node_ids = $node_query->execute();
		  // Load the nodes
		  $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($node_ids);

		  // Add the nodes to the response
		  $response['faqtags'][$key1]['term_name'] = $term_name;
		  $response['faqtags'][$key1]['term_id'] = $term_id;
		  $response['faqtags'][$key1]['nodes'] = [];

			foreach ($nodes as $node) {
				$response['faqtags'][$key1]['nodes'][] = [
			  		'nid' => $node->id(),
			  		'title' => $node->getTitle(),
			  		// Add other node fields as needed
				];
		  	}
		}


		
		$filtered_node_count = count($response['faq']);
		$response['node_count_faq'] = $filtered_node_count;
		$response['profile_theme'] = $profile_theme;

		$type_value = $appointment_type[0]['value'];
		$response['appointmentType'] = $type_value;
		return array(
			'#theme' => 'profile_template',
			'#arr_data' => $response,
		);

	

	}







<<<<<<< HEAD
=======
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
			$text_sms = 'Dear '.$fullname.'!, your request for an appointment with '.$field_name_value.' at '.$formatted_bookingtimeslot.' on '.$date_booking.' at '.$clinicname.' is accepted. Someone from the clinic will call and confirm the appointment shortly. WhatsApp us on +91 8861191019 to cancel or reschedule. Aadya Health Sciences.';
		} else {
			$text_sms = 'Dear '.$fullname.', your appointment with '.$field_name_value.' at '.$clinicname.' on '.$date_booking.' at '.$formatted_bookingtimeslot.' is confirmed. WhatsApp us on +91 8861191019 to cancel or reschedule. Aadya Health Sciences.';
		}



		if($doctor_type === "request"){
			$text_sms2 = 'Dear '.$fullname.', your appointment with '.$field_name_value.' at '.$clinicname.' on '.$date_booking.' at '.$formatted_bookingtimeslot.' is confirmed. WhatsApp us on +91 8861191019 to cancel or reschedule. Aadya Health Sciences.';


			$mob_text = str_replace('+', '%20', urlencode($text_sms2));

			$url_sms = 'https://onlysms.co.in/api/sms.aspx?UserID=adhspl&UserPass=Adh909@&MobileNo='.$clinic_phone_number.'&GSMID=AADHSP&PEID=1701171921100574462&Message='.$mob_text.'&TEMPID=1707171930778294643&UNICODE=TEXT';
			
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

>>>>>>> 37e909f711b18bff7d01a6d043f8782342da7282
	public function commentSave(Request $request){
		$name = !empty($request->get('username')) ? $request->get('username') : '';
		$email = !empty($request->get('email')) ? $request->get('email') : '';
		$comment = !empty($request->get('comment')) ? $request->get('comment') : '';
		$node_id = !empty($request->get('node_id')) ? $request->get('node_id') : '';
		$comment_entity = \Drupal::entityTypeManager()->getStorage('comment')->create([
			'entity_type' => 'node',
			'field_name' => 'comment',
			'comment_body' => $comment,
			'field_email_address' => $email,
			'field_fullname' => $name,
			'author_name' => $name,
			'author_email' => $email,
			'status' => \Drupal\comment\Entity\Comment::PUBLISHED,
			'entity_id' => $node_id,
			'uid' => 0,
			'comment_type' => 'comment',
		]);
		$comment_entity->save();
		$responseData = [
			"status" => "Sucess",
			"message" => "Comment saved.",
		];
		return new JsonResponse($responseData);
		exit;
	}


}
