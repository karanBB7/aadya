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
		$node_count = count($ea_nids1);
		$ea_nodes = Node::loadMultiple($ea_nids);
		foreach ($ea_nodes as $key => $node) {
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
		$terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('news_categoery');
		foreach ($terms as $key1 => $term) {
			$term_news = Term::load($term->tid);
			$term_name = $term_news->getName();
			$term_id = $term_news->id();
			$response['news_categoery'][$key1]['term_name'] = $term_name;
			$response['news_categoery'][$key1]['term_id'] = $term_id;
		}
		$response['node_count'] = $node_count;
		$response['profile_theme'] = $profile_theme;
		return array(
			'#theme' => 'profile_template',
			'#arr_data' => $response,
		);
	}

	function getSearchNews(Request $request){
		$search = !empty($request->get('search')) ? $request->get('search'): array();
		$ea_query = \Drupal::entityQuery('node')
			->range(0, 3)
			->condition('status', 1)
			->condition('type', 'article', '=');
		if(!empty($search)){
			$ea_query->condition('title', '%'.$search.'%', 'LIKE');
		}
		$ea_query->accessCheck(TRUE);
		$ea_nids = $ea_query->sort('created', 'DESC')->execute();

		$ea_query1 = \Drupal::entityQuery('node')
			->condition('status', 1)
			->condition('type', 'article', '=');
		if(!empty($search)){
			$ea_query1->condition('title', '%'.$search.'%', 'LIKE');
		}
		$ea_query1->accessCheck(TRUE);
		$ea_nids1 = $ea_query1->sort('created', 'DESC')->execute();
		$node_count = count($ea_nids1);
		$ea_nodes = Node::loadMultiple($ea_nids);
		$html = '';
		$html .='<h5 class="p-3">'.$node_count.' Results</h5>';
		if(!empty($ea_nodes)){
			foreach ($ea_nodes as $key => $node) {
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
				$html .='<div class="col-lg-4 col-md-6 col-sm-4">
							<div class="articele-wrapper pb-5">
								<img src="'.$article_img.'" width="100%">
								<div class="d-flex mx-4 mt-2">
									<div class="offset-lg-0">By '.$author.' </div>
									<div class="offset-lg-1">'.$final_date.'</div>
								</div>
								<div class="p-4 pt-0">
									<h6 class="pt-3 "><b>'.$title.'</b></h6>
									<div>'.$body.'
										<button class="readMore p-2 float-start col-sm-7 mt-3">Read More</button>
									</div>
								</div>
							</div>
						</div>';
			}
		}else{
			$html .='No Articles found.';
		}
		$ajax_resp = new JsonResponse(array("html"=>$html));
		return ($ajax_resp);
	}
	function getCategoryNews(Request $request){
		$cat_id = !empty($request->get('cat_id')) ? $request->get('cat_id'): array();
		$ea_query = \Drupal::entityQuery('node')
			->range(0, 3)
			->condition('status', 1)
			->condition('type', 'article', '=');
		if(!empty($cat_id)){
			$ea_query->condition('field_category', $cat_id, '=');
		}
		$ea_query->accessCheck(TRUE);
		$ea_nids = $ea_query->sort('created', 'DESC')->execute();

		$ea_query1 = \Drupal::entityQuery('node')
			->condition('status', 1)
			->condition('type', 'article', '=');
		if(!empty($cat_id)){
			$ea_query1->condition('field_category', $cat_id, '=');
		}
		$ea_query1->accessCheck(TRUE);
		$ea_nids1 = $ea_query1->sort('created', 'DESC')->execute();
		$node_count = count($ea_nids1);
		$ea_nodes = Node::loadMultiple($ea_nids);
		$html = '';
		$html .='<h5 class="p-3">'.$node_count.' Results</h5>';
		if(!empty($ea_nodes)){
			foreach ($ea_nodes as $key => $node) {
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
				$html .='<div class="col-lg-4 col-md-6 col-sm-4">
							<div class="articele-wrapper pb-5">
								<img src="'.$article_img.'" width="100%">
								<div class="d-flex mx-4 mt-2">
									<div class="offset-lg-0">By '.$author.' </div>
									<div class="offset-lg-1">'.$final_date.'</div>
								</div>
								<div class="p-4 pt-0">
									<h6 class="pt-3 "><b>'.$title.'</b></h6>
									<div>'.$body.'
										<button class="readMore p-2 float-start col-sm-7 mt-3">Read More</button>
									</div>
								</div>
							</div>
						</div>';
			}
		}else{
			$html .='No Articles found.';
		}
		$ajax_resp = new JsonResponse(array("html"=>$html));
		return ($ajax_resp);
	}
	function getDoctorProfile(Request $request,$username){
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
			$node_count = count($ea_nids1);
			$ea_nodes = Node::loadMultiple($ea_nids);
			foreach ($ea_nodes as $key => $node) {
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
			$terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('news_categoery');
			foreach ($terms as $key1 => $term) {
				$term_news = Term::load($term->tid);
				$term_name = $term_news->getName();
				$term_id = $term_news->id();
				$response['news_categoery'][$key1]['term_name'] = $term_name;
				$response['news_categoery'][$key1]['term_id'] = $term_id;
			}
			$response['node_count'] = $node_count;
			$response['profile_theme'] = $profile_theme;
		}


		echo "<pre>";
		print_r($response);


		return array(
			'#theme' => 'profile_doctor_template',
			'#arr_data' => $response,
		);
	}
}