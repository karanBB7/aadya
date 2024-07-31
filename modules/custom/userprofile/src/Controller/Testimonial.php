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
		$uid = $request->get('uid');
		$search = !empty($request->get('search')) ? $request->get('search'): array();
		
		$ea_query = \Drupal::entityQuery('node')
			->range(0, 50)
			->condition('status', 1)
			->condition('type', 'patient_testimonials', '=')
			->condition('uid', $uid);
	
		if(!empty($search)){
			$ea_query->condition('title', '%'.$search.'%', 'LIKE');
		}
		$ea_query->accessCheck(TRUE);
		$ea_nids = $ea_query->sort('created', 'DESC')->execute();
	
		$ea_query1 = \Drupal::entityQuery('node')
			->condition('status', 1)
			->condition('type', 'patient_testimonials', '=')
			->condition('uid', $uid); 
	
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
			$content = $node->field_content->getValue()[0]['value'];
			$patienname = $node->field_patienname->getValue()[0]['value'];
		
			$images = [];
			if ($node->hasField('field_picture') && !$node->get('field_picture')->isEmpty()) {
				$paragraphs = $node->get('field_picture')->referencedEntities();
				foreach ($paragraphs as $paragraph) {
					if ($paragraph->hasField('field_patient_picture') && !$paragraph->get('field_patient_picture')->isEmpty()) {
						$file = $paragraph->get('field_patient_picture')->entity;
						if ($file) {
							$file_url = \Drupal::service('file_url_generator')->generateAbsoluteString($file->getFileUri());
							$images[] = $file_url;
						}
					}
				}
			}
		
			$videos = [];
			if ($node->hasField('field_videos') && !$node->get('field_videos')->isEmpty()) {
				$video_paragraphs = $node->get('field_videos')->referencedEntities();
				foreach ($video_paragraphs as $video_paragraph) {
					if ($video_paragraph->hasField('field_patient_videos') && !$video_paragraph->get('field_patient_videos')->isEmpty()) {
						$video_url = $video_paragraph->get('field_patient_videos')->value;
						if ($video_url) {
							$videos[] = $video_url;
						}
					}
				}
			}
		
			$tags = [];
			if ($node->hasField('field_testimonial_tags') && !$node->get('field_testimonial_tags')->isEmpty()) {
				$tags_paragraphs = $node->get('field_testimonial_tags')->referencedEntities();
				foreach ($tags_paragraphs as $tags_paragraph) {
					if ($tags_paragraph->hasField('field_tags')) {
						$tags_field = $tags_paragraph->get('field_tags');
						foreach ($tags_field as $tag_item) {
							$tag_value = $tag_item->value;
							if ($tag_value) {
								$tags[] = $tag_value;
							}
						}
					}
				}
			}
		
			$html .= '<div class="test-wrapp">
						<div class="p-3">
							<div class="quotes"><i class="fa-solid fa-quote-left"></i></div>
							<b>' . $title . '</b><br>
							<div class="testimonial-content" style="max-height: 3em; overflow: hidden; text-overflow: ellipsis;">'
								. $content .
							'</div>
							<a class="readMoreLink">Read more</a>
							<div class="owl-carousel owl-theme patient">';
		
			foreach ($images as $image) {
				$html .= '<div class="item">
							<div class="patient-imag-wrapper">
								<img src="' . $image . '" class="patientImg pt-2 d-block mx-auto">
							</div>
						  </div>';
			}
		
			foreach ($videos as $video) {
				$html .= '<div class="item">
							<div class="patient-imag-wrapper">
								<span class="link-patient" style="display:none;">' . $video . '</span>
								<iframe class="youtube-iframe-patient" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
							</div>
						  </div>';
			}
		
			$html .= '</div>
					  <div class="fw-bolder">' . $patienname . '</div>
					  </div>';
		
			$html .= '<div class="col-md-12 col-sm-6 pt-2 p-0 m-0">';
			foreach ($tags as $tag) {
				$html .= '<button class="rel-btn p-2 m-2 btn"><h3 class="fs-6 m-0">' . $tag . '</h3></button>';
			}
			$html .= '</div>';
		
			$html .= '</div>';
		}


		$html .= '</div>';


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


			$(".patient").owlCarousel({
					center: true,
					loop: true,
					margin: 15,
					items:1,
					nav:true
				});


				function extractVideoID(url) {
					const urlObj = new URL(url);
					return urlObj.searchParams.get("v");
				}
				$(".link-patient").each(function(index) {
					const youtubeLink = $(this).text().trim();
					const videoID = extractVideoID(youtubeLink);
					if (videoID) {
						const iframeSrc = `https://www.youtube.com/embed/${videoID}?si=83oiblxyjFLcMFmN`;
						$(".youtube-iframe-patient").eq(index).attr("src", iframeSrc);
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
		if(!empty($username )){
			$user = \Drupal\user\Entity\User::load($username);
			$uid = $user->id();
		}else{
			$uid = \Drupal::currentUser()->id();
		}
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
				$content = $node->field_content->getValue()[0]['value'];
				$patienname = $node->field_patienname->getValue()[0]['value'];
			
				$images = [];
				if ($node->hasField('field_picture') && !$node->get('field_picture')->isEmpty()) {
					$paragraphs = $node->get('field_picture')->referencedEntities();
					foreach ($paragraphs as $paragraph) {
						if ($paragraph->hasField('field_patient_picture') && !$paragraph->get('field_patient_picture')->isEmpty()) {
							$file = $paragraph->get('field_patient_picture')->entity;
							if ($file) {
								$file_url = \Drupal::service('file_url_generator')->generateAbsoluteString($file->getFileUri());
								$images[] = $file_url;
							}
						}
					}
				}
			
				$videos = [];
				if ($node->hasField('field_videos') && !$node->get('field_videos')->isEmpty()) {
					$video_paragraphs = $node->get('field_videos')->referencedEntities();
					foreach ($video_paragraphs as $video_paragraph) {
						if ($video_paragraph->hasField('field_patient_videos') && !$video_paragraph->get('field_patient_videos')->isEmpty()) {
							$video_url = $video_paragraph->get('field_patient_videos')->value;
							if ($video_url) {
								$videos[] = $video_url;
							}
						}
					}
				}
			
				$tags = [];
				if ($node->hasField('field_testimonial_tags') && !$node->get('field_testimonial_tags')->isEmpty()) {
					$tags_paragraphs = $node->get('field_testimonial_tags')->referencedEntities();
					foreach ($tags_paragraphs as $tags_paragraph) {
						if ($tags_paragraph->hasField('field_tags')) {
							$tags_field = $tags_paragraph->get('field_tags');
							foreach ($tags_field as $tag_item) {
								$tag_value = $tag_item->value;
								if ($tag_value) {
									$tags[] = $tag_value;
								}
							}
						}
					}
				}
			
				$html .= '<div class="test-wrapp">
							<div class="p-3">
								<div class="quotes"><i class="fa-solid fa-quote-left"></i></div>
								<b>' . $title . '</b><br>
								<div class="testimonial-content" style="max-height: 3em; overflow: hidden; text-overflow: ellipsis;">'
									. $content .
								'</div>
								<a class="readMoreLink">Read more</a>
								<div class="owl-carousel owl-theme patient">';
			
				foreach ($images as $image) {
					$html .= '<div class="item">
								<div class="patient-imag-wrapper">
									<img src="' . $image . '" class="patientImg pt-2 d-block mx-auto">
								</div>
							  </div>';
				}
			
				foreach ($videos as $video) {
					$html .= '<div class="item">
								<div class="patient-imag-wrapper">
									<span class="link-patient" style="display:none;">' . $video . '</span>
									<iframe class="youtube-iframe-patient" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
								</div>
							  </div>';
				}
			
				$html .= '</div>
						  <div class="fw-bolder">' . $patienname . '</div>
						  </div>';
			
				$html .= '<div class="col-md-12 col-sm-6 pt-2 p-0 m-0">';
				foreach ($tags as $tag) {
					$html .= '<button class="rel-btn p-2 m-2 btn"><h3 class="fs-6 m-0">' . $tag . '</h3></button>';
				}
				$html .= '</div>';
			
				$html .= '</div>'; 
			}


			$html .= '</div>';



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

				
				$(".patient").owlCarousel({
					center: true,
					loop: true,
					margin: 15,
					items:1,
					nav:true
				});


				function extractVideoID(url) {
					const urlObj = new URL(url);
					return urlObj.searchParams.get("v");
				}
				$(".link-patient").each(function(index) {
					const youtubeLink = $(this).text().trim();
					const videoID = extractVideoID(youtubeLink);
					if (videoID) {
						const iframeSrc = `https://www.youtube.com/embed/${videoID}?si=83oiblxyjFLcMFmN`;
						$(".youtube-iframe-patient").eq(index).attr("src", iframeSrc);
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