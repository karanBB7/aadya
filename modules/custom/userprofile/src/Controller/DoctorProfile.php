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


class DoctorProfile extends ControllerBase
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


    function getDoctorProfile(Request $request,$username){
		$response = [];
		$query = \Drupal::database()->select('users_field_data', 'u');
		//$query->addField('u', 'name');
		$query->addField('u', 'uid');
		$query->condition('u.name', $username);
		$uid = $query->execute()->fetchField();

		if (empty($uid)) {
			return $this->redirect('userprofile.error_404');
		}

		if(!empty($uid)){
			$user = \Drupal\user\Entity\User::load($uid);
			$para = $user->get("field_paragraphtheme1")->getValue();

			$appointment_type = $user->get("field_type")->getValue();

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
						
						foreach ($childPara as $key => $valuechild) {
							$childParagraph = Paragraph::load($valuechild["target_id"]);
							if (!$childParagraph) {
								\Drupal::logger('userprofile')->warning('Failed to load child paragraph with ID: @id', ['@id' => $valuechild["target_id"]]);
								continue;
							}
			
							$clinctarget_id = $childParagraph->get('field_clinic_name')->getValue()[0]['target_id'] ?? null;
							if ($clinctarget_id) {
								$clincterm = Term::load($clinctarget_id);
								if ($clincterm) {
									$clinic_name = $clincterm->getName();
									$address = $clincterm->get('field_address')->getValue()[0]['value'] ?? '';
									$instructions = $clincterm->get('field_instructions')->getValue()[0]['value'] ?? '';

								} else {
									$clinic_name = '';
									$address = '';
									$instructions = '';
									\Drupal::logger('userprofile')->warning('Failed to load term with ID: @id', ['@id' => $clinctarget_id]);
								}
							} else {
								$clinic_name = '';
								$address = '';
								$instructions = '';
							}
			
							$data[$key]['clinic_name'] = $clinic_name;
							$data[$key]['target_id'] = $valuechild["target_id"];
							$data[$key]['address'] = $address;
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






			$search = !empty($request->get('search')) ? $request->get('search') : '';
			$username = $request->get('username');
			$users = \Drupal::entityTypeManager()->getStorage('user')->loadByProperties(['name' => $username]);
			$user = reset($users);
			
			if ($user) {
				$uid = $user->id();

				$user_full_name = '';
				$para = $user->get("field_paragraphtheme1")->getValue();
				if (!empty($para) && isset($para[0]['target_id'])) {
					$paragraph = \Drupal\paragraphs\Entity\Paragraph::load($para[0]['target_id']);
					if ($paragraph instanceof \Drupal\paragraphs\Entity\Paragraph) {
						$user_full_name = $paragraph->get('field_name')->value;
					}
				}
			
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
				$response['article'] = [];
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
					$response['article'][$key]['user_full_name'] = $user_full_name;
				}
			
			} 
			
			$response['auth_na'] = $uid;
			$filtered_node_count_article = count($response['article']);
			$response['node_count'] = $filtered_node_count_article;
			$response['profile_theme'] = $profile_theme;
			


			$terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('news_categoery');
			foreach ($terms as $key1 => $term) {
				$term_news = Term::load($term->tid);
				$term_name = $term_news->getName();
				$term_id = $term_news->id();
				$response['news_categoery'][$key1]['term_name'] = $term_name;
				$response['news_categoery'][$key1]['term_id'] = $term_id;
			}



			$ea_query2 = \Drupal::entityQuery('node')
			->condition('status', 1)
			->condition('type', 'patient_testimonials', '=');
		if (!empty($search)) {
			$ea_query2->condition('title', $search);
		}
		$ea_query2->accessCheck(TRUE);
		$ea_nids2 = $ea_query2->sort('created', 'DESC')->execute();
		// $node_count2 = count($ea_nids2);
		$response['patient_testimonials'] = [];
		$ea_nodes2 = Node::loadMultiple($ea_nids2);
		
		foreach ($ea_nodes2 as $key => $node) {
			if ($uid) {
				$nid = $node->get('nid')->value;
				$title = $node->get('title')->value;
				$date = $node->get('created')->value;
				$final_date = date("d F Y", $date);
		
				$content = "";
				if (!empty($node->field_content->getValue())) {
					$content = $node->field_content->getValue()[0]['value'];
				}
				$patienname = "";
				if (!empty($node->field_patienname->getValue())) {
					$patienname = $node->field_patienname->getValue()[0]['value'];
				}
		
				$author_uid = $node->getOwnerId();
				$author = \Drupal\user\Entity\User::load($author_uid);
				$author_name = $author ? $author->getDisplayName() : 'Unknown';
		
				if ($username == $author_name) {
					$alias_url = \Drupal::service('path_alias.manager')->getAliasByPath('/node/' . $nid);
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
		
		// echo "<pre>";
		// print_r($response);

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
			/*$terms2 = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('patient_testimonials');
			foreach ($terms2 as $key1 => $term) {
				$term_news = Term::load($term->tid);
				$term_name = $term_news->getName();
				$term_id = $term_news->id();
				$response['patient_testimonialstags'][$key1]['term_name'] = $term_name;
				$response['patient_testimonialstags'][$key1]['term_id'] = $term_id;
			}*/

			$filtered_node_count = count($response['patient_testimonials']);
			$response['testimonialuid'] = $uid;
			$response['node_count_testimonials'] = $filtered_node_count;
			$response['profile_theme'] = $profile_theme;






			// $ea_query3 = \Drupal::entityQuery('node')
			// ->condition('status', 1)
			// ->condition('type', 'faq', '=');

			$ea_query3 = \Drupal::entityQuery('node')
			->range(0, 6)
			->condition('status', 1)
			->condition('type', 'faq')
			->condition('uid', $uid);


			if(!empty($search)){
				$ea_query3->condition('title', $search);
			}
			$ea_query3->accessCheck(TRUE);
			$ea_nids3 = $ea_query3->sort('created', 'DESC')->execute();
			// $node_count3 = count($ea_nids3);
			$response['faq'] = [];
			$ea_nodes3 = Node::loadMultiple($ea_nids3);

			foreach ($ea_nodes3 as $key => $node) {
							
				if($uid) {
					$nid = $node->get('nid')->value;
					$title = $node->get('title')->value;
					$body = $node->get('body')->value;
					$date = $node->get('created')->value;
					$final_date = date("d F Y", $date);
					$author_uid = $node->getOwnerId();
					$author = \Drupal\user\Entity\User::load($author_uid);
					$author_name = $author ? $author->getDisplayName() : 'Unknown';
					if($username == $author_name) {
						$alias_url = \Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);
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
			// $terms3 = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('faq');
			// foreach ($terms3 as $key1 => $term) {
			// 	$term_news = Term::load($term->tid);
			// 	$term_name = $term_news->getName();
			// 	$term_id = $term_news->id();
			// 	$response['faqtags'][$key1]['term_name'] = $term_name;
			// 	$response['faqtags'][$key1]['term_id'] = $term_id;
			// }


			
			$filtered_node_count = count($response['faq']);
			$response['faquid'] = $uid;
			$response['node_count_faq'] = $filtered_node_count;
			$response['profile_theme'] = $profile_theme;
			$type_value = $appointment_type[0]['value'];
			$response['appointmentType'] = $type_value;

		}

		$response['username'] = $username;
		
		// echo "<pre>";
		// print_r($response);


		return array(
			'#theme' => 'profile_doctor_template',
			'#arr_data' => $response,
		);



	}
	

		public function notfound() {
		return [
			'#theme' => 'error_page',
			'#arr_data' => [
				'message' => 'The requested doctor profile was not found.',
			],
		];
	}


}

?>