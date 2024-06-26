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
		$user = \Drupal\user\Entity\User::load($uid);

		$username = $user ? $user->getDisplayName() : '';


		$para = $user->get("field_paragraphtheme1")->getValue();

		
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
						$data[$key]['clinic_name'] = $clinic_name;
						$data[$key]['target_id'] = $valuechild["target_id"];
						$data[$key]['address'] = $address;
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
			->range(0, 3)
			->condition('status', 1)
			->condition('type', 'article', '=');
		if(!empty($search)){
			$ea_query->condition('title', $search);
		}
		$ea_query->accessCheck(TRUE);
		$ea_nids = $ea_query->sort('created', 'DESC')->execute();

		$ea_query1 = \Drupal::entityQuery('node')
			->condition('status', 1)
			->condition('type', 'article', '=');
		if(!empty($search)){
			$ea_query1->condition('title', $search);
		}


		$ea_query1->accessCheck(TRUE);
		$ea_nids1 = $ea_query1->sort('created', 'DESC')->execute();






		$search = !empty($request->get('search')) ? $request->get('search') : '';
		$users = \Drupal::entityTypeManager()->getStorage('user')->loadByProperties(['name' => $username]);
		$user = reset($users);
		$response['article'] = []; 
		
		if ($user) {
			$uid = $user->id();
		
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
			$ea_nodes = Node::loadMultiple($ea_nids);
		
			foreach ($ea_nodes as $key => $node) {
				$nid = $node->id();
				$title = $node->getTitle();
				$body = $node->get('body')->value;
				$date = $node->getCreatedTime();
				$final_date = date("d F Y", $date);
		
				$article = $node->get('field_image')->getValue();
				$article_id = $article[0]['target_id'] ?? null;
				$article_img = "";
		
				if (!empty($article_id)) {
					$file = \Drupal\file\Entity\File::load($article_id);
					if ($file) {
						$article_img = $file->createFileUrl();
					}
				}
		
				$author_name = $user->getDisplayName();
				$alias_url = \Drupal::service('path_alias.manager')->getAliasByPath('/node/' . $nid);
				$response['article'][$key]['thumb'] = $article_img;
				$response['article'][$key]['alias_url'] = $alias_url;
				$response['article'][$key]['title'] = $title;
				$response['article'][$key]['date'] = $final_date;
				$response['article'][$key]['author'] = $author_name;
				$response['article'][$key]['body'] = $body;
			}
		}
		if (isset($response['article']) && !empty($response['article'])) {
			$filtered_node_count_article = count($response['article']);
		} else {
			$filtered_node_count_article = 0;
		}
		
		$terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('news_categoery');
		foreach ($terms as $key1 => $term) {
			$term_news = Term::load($term->tid);
			$term_name = $term_news->getName();
			$term_id = $term_news->id();
			$response['news_categoery'][$key1]['term_name'] = $term_name;
			$response['news_categoery'][$key1]['term_id'] = $term_id;
		}

		$response['auth_na'] = $uid;
		$response['node_count'] = $filtered_node_count_article;
		$response['profile_theme'] = $profile_theme;

		$ea_query2 = \Drupal::entityQuery('node')
		->condition('status', 1)
		->condition('type', 'patient_testimonials', '=');
		if(!empty($search)){
			$ea_query2->condition('title', $search);
		}
		$ea_query2->accessCheck(TRUE);
		$ea_nids2 = $ea_query2->sort('created', 'DESC')->execute();
		$response['patient_testimonials'] = [];

		$ea_nodes2 = Node::loadMultiple($ea_nids2);

		foreach ($ea_nodes2 as $key => $node) {
			if ($uid) {
				$nid = $node->get('nid')->value ?? null;
				$title = $node->get('title')->value ?? '';
				$date = $node->get('created')->value ?? null;
				$final_date = $date ? date("d F Y", $date) : '';
				$content = !empty($node->field_content->getValue()) && isset($node->field_content->getValue()[0]['value']) ? $node->field_content->getValue()[0]['value'] : '';
				$patienname = !empty($node->field_patienname->getValue()) && isset($node->field_patienname->getValue()[0]['value']) ? $node->field_patienname->getValue()[0]['value'] : '';
		

		
				$author_uid = $node->getOwnerId();
				$author = \Drupal\user\Entity\User::load($author_uid);
				$author_name = $author ? $author->getDisplayName() : 'Unknown';
		
				if ($username == $author_name) {
					$alias_url = \Drupal::service('path_alias.manager')->getAliasByPath('/node/' . $nid);
					$response['patient_testimonials'][$key]['thumb'] = $test_img;
					$response['patient_testimonials'][$key]['alias_url'] = $alias_url;
					$response['patient_testimonials'][$key]['title'] = $title;
					$response['patient_testimonials'][$key]['date'] = $final_date;
					$response['patient_testimonials'][$key]['content'] = $content;
					$response['patient_testimonials'][$key]['patienname'] = $patienname;

					$paragraphs = $node->get('field_picture')->referencedEntities();
					$images = [];
					foreach ($paragraphs as $paragraph) {
						if ($paragraph->hasField('field_patient_picture')) {
							$file = $paragraph->get('field_patient_picture')->entity;
							if ($file) {
								$file_url = \Drupal::service('file_url_generator')->generateAbsoluteString($file->getFileUri());
								$images[] = $file_url;
							}
						}
					}

					$video_paragraphs = $node->get('field_videos')->referencedEntities();
					$videos = [];
					foreach ($video_paragraphs as $video_paragraph) {
						if ($video_paragraph->hasField('field_patient_videos')) {
							$video_url = $video_paragraph->get('field_patient_videos')->value;
							if ($video_url) {
								$videos[] = $video_url;
							}
						}
					}

					$response['patient_testimonials'][$key]['videos'] = $videos;
					$response['patient_testimonials'][$key]['images'] = $images;
				}
			}
		}
		
		$response['profile_theme'] = $profile_theme;
		$terms2 = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('patient_testimonials');
		foreach ($terms2 as $key1 => $term) {
			$term_news = Term::load($term->tid);
			$term_name = $term_news->getName();
			$term_id = $term_news->id();
			$response['patient_testimonialstags'][$key1]['term_name'] = $term_name;
			$response['patient_testimonialstags'][$key1]['term_id'] = $term_id;
		}

		$filtered_node_count = count($response['patient_testimonials']);
		$response['testimonialuid'] = $uid;
		$response['node_count_testimonials'] = $filtered_node_count;
		$response['profile_theme'] = $profile_theme;
		$ea_query3 = \Drupal::entityQuery('node')
		->condition('status', 1)
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
			if ($uid) {
				$nid = $node->get('nid')->value;
				$title = $node->get('title')->value;
				$body = $node->get('body')->value;
				$date = $node->get('created')->value;
				$final_date = date("d F Y", $date);
				$author_uid = $node->getOwnerId();
				$author = \Drupal\user\Entity\User::load($author_uid);
				$author_name = $author ? $author->getDisplayName() : 'Unknown';
				if ($username == $author_name) {
					$alias_url = $base_url.\Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);
					$response['faq'][$key]['title'] = $title;
					$response['faq'][$key]['body'] = $body;
					$response['faq'][$key]['date'] = $final_date;
				}

			}
		}

		
		$terms3 = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('faq');
		foreach ($terms3 as $key1 => $term) {
			$term_news = Term::load($term->tid);
			$term_name = $term_news->getName();
			$term_id = $term_news->id();
			$response['faqtags'][$key1]['term_name'] = $term_name;
			$response['faqtags'][$key1]['term_id'] = $term_id;
		}


		
		$filtered_node_count = count($response['faq']);
		$response['faquid'] = $uid;
		$response['node_count_faq'] = $filtered_node_count;
		$response['profile_theme'] = $profile_theme;


		// echo "<pre>";
		// print_r($response);


		return array(
			'#theme' => 'profile_template',
			'#arr_data' => $response,
		);

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
		// $text_sms = $random_otp.' is your one-time verification code. Please do not share this code with anyone. Team Nestle MyToddler';
		// $mob_text = urlencode($text_sms);
		// $url_sms = 'https://pgapi.vispl.in/fe/api/v1/send?username=mytoddler.trans&password='.$pgapipass.'&unicode=false&from=NESTOD&to='.$mobile.'&text='.$mob_text.'&dltContentId=1707166063589359389';
		// try {
		//   $curl = curl_init();
		//   curl_setopt_array($curl, array(
		//   CURLOPT_URL => $url_sms,
		//   CURLOPT_RETURNTRANSFER => true,
		//   CURLOPT_ENCODING => "",
		//   CURLOPT_MAXREDIRS => 10,
		//   CURLOPT_TIMEOUT => 0,
		//   CURLOPT_FOLLOWLOCATION => true,
		//   CURLOPT_CUSTOMREQUEST => "GET",
		//   CURLOPT_SSL_VERIFYPEER => 'false',
		//   ));
		//   $response1 = curl_exec($curl);
		//   curl_close($curl);
		// }
		// catch (RequestException $e) {
		// }
		$ajax_resp = new JsonResponse(array("status"=>"sucess",'message'=>$message));
		return ($ajax_resp);
		exit;
	}
	public function OtpVerifyBookingAppointment(Request $request){
		$otp = !empty($request->get('otp')) ? $request->get('otp') : '';
		$generated_otp = $_SESSION['generated_otp'];
		if($otp != 9999){
		//if($otp != $generated_otp){
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
			$name = !empty($decode_body['name']) ? $decode_body['name'] : "";

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
				$vocabulary = \Drupal\taxonomy\Entity\Vocabulary::load('clinic');
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
					// print_r($booking_date);exit;
					if(!empty($booking_date)){
						$query = $connection->update('booking_appointment')
						  ->fields([
							'status' => '2',
						  ])
						  ->condition('id', $booking_date)
						  ->execute();
						$responseData = [
							"status" => "sucess",
							"message" => "Booking cancel successfully.",
						];
					}
				}
				
				else{
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
				if (!empty($booking_rows)) {
					$connection = Database::getConnection();
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













