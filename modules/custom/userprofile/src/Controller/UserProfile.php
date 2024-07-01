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
		$user = \Drupal\user\Entity\User::load($uid);
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
		// $node_count = count($ea_nids1);
		$response['article'] = [];
		$ea_nodes = Node::loadMultiple($ea_nids);
		foreach ($ea_nodes as $key => $node) {
			
			$doctor_ids = array_column($node->field_doctor->getValue(), 'target_id');
			if (in_array($uid, $doctor_ids)) {
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
			}
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
		->condition('type', 'patient_testimonials', '=');
		if(!empty($search)){
			$ea_query2->condition('title', $search);
		}
		$ea_query2->accessCheck(TRUE);
		$ea_nids2 = $ea_query2->sort('created', 'DESC')->execute();
		$response['patient_testimonials'] = [];

		$ea_nodes2 = Node::loadMultiple($ea_nids2);

		foreach ($ea_nodes2 as $key => $node) {
			$doctor_ids = array_column($node->field_select_doctor->getValue(), 'target_id');
			if (in_array($uid, $doctor_ids)) {
				$nid = $node->get('nid')->value;
				$title = $node->get('title')->value;
				$date = $node->get('created')->value;
				$final_date = date("d F Y", $date);
				$test = $node->field_patienpicture->getValue();
				$test_id = $test[0]['target_id'];
				$test_img = "";
				$content = $node->field_content->getValue()[0]['value'];
				$patienname = $node->field_patienname->getValue()[0]['value'];
		
				if (!empty($test_id)) {
					$test_img = \Drupal\file\Entity\File::load($test_id)->createFileUrl();
				}
		
				$alias_url = $base_url . \Drupal::service('path_alias.manager')->getAliasByPath('/node/' . $nid);
				$response['patient_testimonials'][$key]['thumb'] = $test_img;
				$response['patient_testimonials'][$key]['alias_url'] = $alias_url;
				$response['patient_testimonials'][$key]['title'] = $title;
				$response['patient_testimonials'][$key]['date'] = $final_date;
				$response['patient_testimonials'][$key]['content'] = $content;
				$response['patient_testimonials'][$key]['patienname'] = $patienname;
				$response['patient_testimonials'][$key]['doc'] = $doctor_ids;
			}
		}
		

		$response['node_count_testimonials'] = $node_count2;
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
			$doctor_ids = array_column($node->field_faqdoctor->getValue(), 'target_id');			
			if(in_array($uid, $doctor_ids)) {
				$nid = $node->get('nid')->value;
				$title = $node->get('title')->value;
				$body = $node->get('body')->value;
				$date = $node->get('created')->value;
				$final_date = date("d F Y", $date);

				$alias_url = $base_url.\Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);
				$response['faq'][$key]['title'] = $title;
				$response['faq'][$key]['body'] = $body;
				$response['faq'][$key]['date'] = $final_date;

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
		$response['node_count_faq'] = $filtered_node_count;
		$response['profile_theme'] = $profile_theme;


		// echo "<pre>";
		// print_r($response);


		return array(
			'#theme' => 'profile_template',
			'#arr_data' => $response,
		);

	

	}


	public function commentSave(Request $request){
		$name = !empty($request->get('username')) ? $request->get('username') : '';
		$email = !empty($request->get('email')) ? $request->get('email') : '';
		$comment = !empty($request->get('comment')) ? $request->get('comment') : '';
		$node_id = !empty($request->get('node_id')) ? $request->get('node_id') : '';
		$comment_entity = \Drupal::entityTypeManager()->getStorage('comment')->create([
		  'comment_body' => $comment,
		  'author_name' => $name,
		  'author_email' => $email,
		  'published' => TRUE,
		  'nid' => $node_id,
		  'comment_type' => 'comment',
		]);
		$comment_entity->save();
		// $comment_entity = \Drupal::entityCreate('comment');
	 //    $comment_entity->setCommentBody($comment);
	 //    $comment_entity->setAuthorName($name);
	 //    $comment_entity->setAuthorEmail($email);
	 //    $comment_entity->setPublished(TRUE);
	 //    $comment_entity->setNodeId($node_id);
	 //    $comment_entity->save();
		$responseData = [
			"status" => "Sucess",
			"message" => "Comment saved.",
		];
		return new JsonResponse($responseData);
		exit;
	}


}
