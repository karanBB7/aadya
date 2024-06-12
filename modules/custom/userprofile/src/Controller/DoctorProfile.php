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
		if(!empty($uid)){
			$user = \Drupal\user\Entity\User::load($uid);
			$para = $user->get("field_paragraphtheme1")->getValue();
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




			$search = !empty($request->get('search')) ? $request->get('search') : '';
			$username = $request->get('username');
			$users = \Drupal::entityTypeManager()->getStorage('user')->loadByProperties(['name' => $username]);
			$user = reset($users);
			
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
			if(!empty($search)){
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
					$test_img = "";
					if (!empty($node->field_patienpicture->getValue())) {
						$test = $node->field_patienpicture->getValue();
						$test_id = $test[0]['target_id'];
						if(!empty($test_id)){
							$test_img = \Drupal\file\Entity\File::load($test_id)->createFileUrl();
						}
					}
			
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
						$response['patient_testimonials'][$key]['thumb'] = $test_img;
						$response['patient_testimonials'][$key]['alias_url'] = $alias_url;
						$response['patient_testimonials'][$key]['title'] = $title;
						$response['patient_testimonials'][$key]['date'] = $final_date;
						$response['patient_testimonials'][$key]['content'] = $content;
						$response['patient_testimonials'][$key]['patienname'] = $patienname;
					}
				}
			}
			


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
				$response['faqtags'][$key1]['term_name'] = $term_name;
				$response['faqtags'][$key1]['term_id'] = $term_id;
			}


			
			$filtered_node_count = count($response['faq']);
			$response['faquid'] = $uid;
			$response['node_count_faq'] = $filtered_node_count;
			$response['profile_theme'] = $profile_theme;




		}


		
		// echo "<pre>";
		// print_r($response);


		return array(
			'#theme' => 'profile_doctor_template',
			'#arr_data' => $response,
		);
	}
	


}

?>