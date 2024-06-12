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

class Faq extends ControllerBase
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


	function getSearchfaq(Request $request){
		global $base_url;
		$search = !empty($request->get('search')) ? $request->get('search'): array();
		$ea_query = \Drupal::entityQuery('node')
			->range(0, 9)
			->condition('status', 1)
			->condition('type', 'faq', '=');
		if(!empty($search)){
			$ea_query->condition('title', '%'.$search.'%', 'LIKE');
		}
		$ea_query->accessCheck(TRUE);
		$ea_nids = $ea_query->sort('created', 'DESC')->execute();

		$ea_query1 = \Drupal::entityQuery('node')
			->condition('status', 1)
			->condition('type', 'faq', '=');
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
			$html .='<div class="accordion">';
			$html .='<div class="row">';
			$itemNumber = 1;
			foreach ($ea_nodes as $key => $node) {
				$nid = $node->get('nid')->value;
				$title = $node->get('title')->value;
				$body = $node->get('body')->value;
				$date = $node->get('created')->value;
				$final_date = date("d F Y", $date);

				$alias_url = $base_url.\Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);
				$response['faq'][$key]['title'] = $title;
				$response['faq'][$key]['body'] = $body;
				$response['faq'][$key]['date'] = $final_date;
			$html .='
				<div class="col-lg-6 col-md-6 mb-4">
                            <article class="accordion-item rounded">
                                <span class="accordion-label"> '. $itemNumber . ') '.$title.'</span>
                                <div class="accordion-content">
                                    <p>'.$body.'</p>
                                </div>
                            </article>
                </div>';
				$itemNumber++;
			}


			$html .='</div>';

			
			$html .= '
			<script>
				$(document).ready(function() {
					$(".accordion .accordion-item .accordion-label").on("click", function () {
						let $clickedItem = $(this);
						if ($clickedItem.hasClass("cw-open")) {
							$clickedItem.removeClass("cw-open");
						} else {
							$(".accordion .accordion-item .accordion-label").removeClass("cw-open");
							$clickedItem.addClass("cw-open");
						}
					});
				});
			</script>';

		}else{
			$html .='No Testimonials found.';
		}
		$ajax_resp = new JsonResponse(array("html"=>$html));
		return ($ajax_resp);
	}



	function getCategoryfaq(Request $request){
		global $base_url;
		$cat_id = !empty($request->get('cat_id')) ? $request->get('cat_id'): array();
		$username = $request->get('username');
		$user = \Drupal\user\Entity\User::load($username);
		$uid = $user->id();
		$ea_query = \Drupal::entityQuery('node')
			->range(0, 6)
			->condition('status', 1)
			->condition('type', 'faq')
			->condition('uid', $uid);
	
		if (!empty($cat_id)) {
			$ea_query->condition('field_faqcategory', $cat_id);
		}

		$ea_query->accessCheck(TRUE);
		$ea_nids = $ea_query->sort('created', 'DESC')->execute();
		$ea_nodes = Node::loadMultiple($ea_nids);
		if($cat_id == NULL){
			$author_uid = $uid;
			$article_query = \Drupal::entityQuery('node')
			->condition('status', 1)
			->condition('type', 'faq')
			->condition('uid', $author_uid)
			->accessCheck(TRUE); 
		$article_count = $article_query->count()->execute();
		$node_count = $article_count;
		}else{
			$node_count = count($ea_nodes);
		}
	
		$html = '';
		$html .='<h5 class="p-3">'.$node_count.' Results</h5>';
		if(!empty($ea_nodes)){
			$html .='<div class="accordion">';
			$html .='<div class="row">';
			$itemNumber = 1;
			foreach ($ea_nodes as $key => $node) {
				$nid = $node->get('nid')->value;
				$title = $node->get('title')->value;
				$body = $node->get('body')->value;
				$date = $node->get('created')->value;
				$final_date = date("d F Y", $date);

				$alias_url = $base_url.\Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);
				$response['faq'][$key]['title'] = $title;
				$response['faq'][$key]['body'] = $body;
				$response['faq'][$key]['date'] = $final_date;
				$html .='

				<div class="col-lg-6 col-md-6 mb-4">
                            <article class="accordion-item rounded">
                                <span class="accordion-label"> ' . $itemNumber . ')  '.$title.'</span>
                                <div class="accordion-content">
                                    <p>'.$body.'</p>
                                </div>
                            </article>
							
                </div>';
				$itemNumber++;
			}
			$html .='</div>';
			$html .='</div>';

			$html .= '
			<script>
				$(document).ready(function() {
					$(".accordion .accordion-item .accordion-label").on("click", function () {
						let $clickedItem = $(this);
						if ($clickedItem.hasClass("cw-open")) {
							$clickedItem.removeClass("cw-open");
						} else {
							$(".accordion .accordion-item .accordion-label").removeClass("cw-open");
							$clickedItem.addClass("cw-open");
						}
					});
				});
			</script>';



		}else{
			$html .='No Faq found.';
		}
		$ajax_resp = new JsonResponse(array("html"=>$html));
		return ($ajax_resp);


	}


}

?>