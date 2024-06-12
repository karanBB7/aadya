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

class Testimonial extends ControllerBase
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


	function getSearchTestimonials(Request $request){
		global $base_url;
		$search = !empty($request->get('search')) ? $request->get('search'): array();
		$ea_query = \Drupal::entityQuery('node')
			->range(0, 50)
			->condition('status', 1)
			->condition('type', 'patient_testimonials', '=');
		if(!empty($search)){
			$ea_query->condition('title', '%'.$search.'%', 'LIKE');
		}
		$ea_query->accessCheck(TRUE);
		$ea_nids = $ea_query->sort('created', 'DESC')->execute();

		$ea_query1 = \Drupal::entityQuery('node')
			->condition('status', 1)
			->condition('type', 'patient_testimonials', '=');
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
			

			
		$html .='<div class="row owl-carousel testimonial-slider pt-3">';
		foreach ($ea_nodes as $key => $node) {

			$nid = $node->get('nid')->value;
			$title = $node->get('title')->value;
			$date = $node->get('created')->value;
			$final_date = date("d F Y", $date);
			$test = $node->field_patienpicture->getValue();
			$test_id = $test[0]['target_id'];
			$test_img = "";
			$content = $node->field_content->getValue()[0]['value'];
			$patienname = $node->field_patienname->getValue()[0]['value'];



			if(!empty($test_id)){
				$test_img = \Drupal\file\Entity\File::load($test_id)->createFileUrl();
			}
			$alias_url = $base_url.\Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);
			$html .='
			<div class="test-wrapp">
			<div class="p-3">
				<div class="quotes"><i class="fa-solid fa-quote-left"></i></div>
				<b>'.$title.'</b><br>
			<div class="testimonial-content" style="max-height: 3em; overflow: hidden; text-overflow: ellipsis;">
			'.$content.'
			</div>
			<a class="readMoreLink">Read more</a>
				<div class="row">
					<div class="col-sm-3">
						<img src="'.$test_img.'" class="pt-2 timg img-fluid d-block mx-auto">
					</div>
					<div class="col-md-12 col-sm-6 pt-2">
						<div class="fw-bolder">'.$patienname.'</div>
					</div>
				</div>

			</div>
		</div>';

		}


		$html .='</div>';

		$html .='<script>
		$(document).ready(function() {
			$(".testimonial-slider").owlCarousel({
				loop: false,
				margin: 15,
				responsive: {
					0: {
						items: 1,
						 nav:true
					},
					600:{
						items:2,
						nav:true
					},
					1000:{
						items:3,
						nav:true
					}
				}
			});

			$(".testimonial-content").each(function() {
				var content = $(this);
				var readMoreLink = content.siblings(".readMoreLink");
					var contentHeight = content[0].scrollHeight;
					if (contentHeight > 3 * parseInt(content.css("line-height"))) {
					content.addClass("collapsed");
					readMoreLink.show();
		
					readMoreLink.click(function(e) {
						e.preventDefault();
						content.toggleClass("expanded");
						if (content.hasClass("expanded")) {
							content.css("max-height", "none");
							readMoreLink.text("Read less");
						} else {
							content.css("max-height", "3em");
							readMoreLink.text("Read more");
						}
					});
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



	
	function getCategoryTestimonials(Request $request){

		global $base_url;
		$cat_id = !empty($request->get('cat_id')) ? $request->get('cat_id'): array();
		$username = $request->get('username');
		$user = \Drupal\user\Entity\User::load($username);
		$uid = $user->id();
		$ea_query = \Drupal::entityQuery('node')
			->range(0, 6)
			->condition('status', 1)
			->condition('type', 'patient_testimonials')
			->condition('uid', $uid);

		if (!empty($cat_id)) {
			$ea_query->condition('field_patientcategory', $cat_id);
		}
		$ea_query->accessCheck(TRUE);
		$ea_nids = $ea_query->sort('created', 'DESC')->execute();
		$ea_nodes = Node::loadMultiple($ea_nids);
		if($cat_id == NULL){
			$author_uid = $uid;
			$article_query = \Drupal::entityQuery('node')
			->condition('status', 1)
			->condition('type', 'patient_testimonials')
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


			$html .='<div class="row">';


			$html .='<div class="row owl-carousel testimonial-slider pt-3">';
			foreach ($ea_nodes as $key => $node) {

				$nid = $node->get('nid')->value;
				$title = $node->get('title')->value;
				$date = $node->get('created')->value;
				$final_date = date("d F Y", $date);
				$test = $node->field_patienpicture->getValue();
				$test_id = $test[0]['target_id'];
				$test_img = "";
				$content = $node->field_content->getValue()[0]['value'];
				$patienname = $node->field_patienname->getValue()[0]['value'];



				if(!empty($test_id)){
					$test_img = \Drupal\file\Entity\File::load($test_id)->createFileUrl();
				}
				$alias_url = $base_url.\Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);
				$html .='
				
				<div class="test-wrapp">
					<div class="p-3">
						<div class="quotes"><i class="fa-solid fa-quote-left"></i></div>
						<b>'.$title.'</b><br>
					<div class="testimonial-content" style="max-height: 3em; overflow: hidden; text-overflow: ellipsis;">
					'.$content.'
					</div>
					<a class="readMoreLink">Read more</a>
						<div class="row">
							<div class="col-sm-3">
								<img src="'.$test_img.'" class="pt-2 timg img-fluid d-block mx-auto">
							</div>
							<div class="col-md-12 col-sm-6 pt-2">
								<div class="fw-bolder">'.$patienname.'</div>
							</div>
						</div>

					</div>
				</div>';


			}


			$html .='</div>';

			$html .='<script>
			$(document).ready(function() {
				$(".testimonial-slider").owlCarousel({
					loop: false,
					margin: 15,
					responsive: {
						0: {
							items: 1,
							nav:true
						},
						600:{
							items:2,
							nav:true
						},
						1000:{
							items:3,
							nav:true
						}
					}
				});

				$(".testimonial-content").each(function() {
					var content = $(this);
					var readMoreLink = content.siblings(".readMoreLink");
						var contentHeight = content[0].scrollHeight;
						if (contentHeight > 3 * parseInt(content.css("line-height"))) {
						content.addClass("collapsed");
						readMoreLink.show();
			
						readMoreLink.click(function(e) {
							e.preventDefault();
							content.toggleClass("expanded");
							if (content.hasClass("expanded")) {
								content.css("max-height", "none");
								readMoreLink.text("Read less");
							} else {
								content.css("max-height", "3em");
								readMoreLink.text("Read more");
							}
						});
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


}

?>