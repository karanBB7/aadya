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

class Article extends ControllerBase
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


	function getSearchNews(Request $request){
		global $base_url;
		$search = !empty($request->get('search')) ? $request->get('search'): array();
		$ea_query = \Drupal::entityQuery('node')
			->range(0, 6)
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
			$html .='<div class="row">';
			foreach ($ea_nodes as $key => $node) {
				$nid = $node->get('nid')->value;
				$title = $node->get('title')->value;
				$body = $node->get('body')->value;
				$date = $node->get('created')->value;
				$final_date = date("d F Y", $date);
				$article = $node->field_image->getValue();
				$article_id = $article[0]['target_id'];
				$article_img = "";

				$author_uid = $node->getOwnerId();
				$author = \Drupal\user\Entity\User::load($author_uid);
				$author_name = $author ? $author->getDisplayName() : 'Unknown';

				$alias_url = $base_url.\Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);
				$response['article'][$key]['alias_url'] = $alias_url;
				if(!empty($article_id)){
					$article_img = \Drupal\file\Entity\File::load($article_id)->createFileUrl();
				}
				$alias_url = $base_url.\Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);

				$sanitized_title = str_replace(' ', '-', $title);
				$url = "/linqmd/blog/" . $author_name . "/" . $sanitized_title;

				$html .='<div class="col-lg-4 col-md-6 col-sm-4 d-none d-sm-block">
							<div class="articele-wrapper pb-5">
							<div class="article-image">
								<img src="'.$article_img.'" width="100%">
							</div>	
								<div class="d-flex mx-4 mt-2">
									<div class="offset-lg-0 text-capitalize">By '.$author_name.' </div>
									<div class="offset-lg-1">'.$final_date.'</div>
								</div>
								<div class="p-4 pt-0">
									<h6 class="pt-3 "><b>'.$title.'</b></h6>

									<div class="article-content" style="max-height: 3em; overflow: hidden; text-overflow: ellipsis;">
									'.$body.'
									</div>
									<a href="'.$url.'" traget="_blank"><button class="readMore p-2 float-start col-sm-7 mt-3">Read More</button></a>

								</div>
							</div>
						</div>';
			}
			$html .='</div>';


			$html .='<div class="owl-carousel blogslider d-block d-sm-none">';

			foreach ($ea_nodes as $key => $node) {
				$nid = $node->get('nid')->value;
				$title = $node->get('title')->value;
				$body = $node->get('body')->value;
				$date = $node->get('created')->value;
				$final_date = date("d F Y", $date);
				$article = $node->field_image->getValue();
				$article_id = $article[0]['target_id'];
				$article_img = "";

				$author_uid = $node->getOwnerId();
				$author = \Drupal\user\Entity\User::load($author_uid);
				$author_name = $author ? $author->getDisplayName() : 'Unknown';

				if(!empty($article_id)){
					$article_img = \Drupal\file\Entity\File::load($article_id)->createFileUrl();
				}
				$alias_url = $base_url.\Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);
				$html .='

					<div class="articele-wrapper pb-5 mx-auto">
						<img src="'.$article_img.'" width="100%">
						<div class="d-flex mx-4 mt-2">
							<div class="offset-lg-0 text-capitalize">by '.$author_name.'</div>
							<div class="offset-lg-1">'.$final_date.'</div>
						</div>
						<div class="p-4 pt-0">

							<h6 class="pt-3 "><b>'.$title.'</b></h6>

							<div class="article-content" style="max-height: 3em; overflow: hidden; text-overflow: ellipsis;">
									'.$body.'
									</div>
									<a href="'.$url.'" traget="_blank"><button class="readMore p-2 float-start col-sm-7 mt-3">Read More</button></a>
						</div>
				</div>';

			}

			$html .='</div>';

			$html .='<script>
			$(document).ready(function() {
				$(".blogslider").owlCarousel({
					loop: true,
					margin: 15,
					responsive: {
						0: {
							items: 1,
							nav: true
						}
					}
				});
				
			});
			</script>';


		}else{
			$html .='No Articles found.';
		}
		$ajax_resp = new JsonResponse(array("html"=>$html));
		return ($ajax_resp);
	}




    
	function getCategoryNews(Request $request){
		global $base_url;
		$cat_id = !empty($request->get('cat_id')) ? $request->get('cat_id'): array();
		$username = $request->get('username');
		$user = \Drupal\user\Entity\User::load($username);
		$uid = $user->id();
		$ea_query = \Drupal::entityQuery('node')
			->range(0, 6)
			->condition('status', 1)
			->condition('type', 'article')
			->condition('uid', $uid);
	
		if (!empty($cat_id)) {
			$ea_query->condition('field_category', $cat_id);
		}
		$ea_query->accessCheck(TRUE);
		$ea_nids = $ea_query->sort('created', 'DESC')->execute();
		$ea_nodes = Node::loadMultiple($ea_nids);
		if($cat_id == NULL){
			$author_uid = $uid;
			$article_query = \Drupal::entityQuery('node')
			->condition('status', 1)
			->condition('type', 'article')
			->condition('uid', $author_uid)
			->accessCheck(TRUE); 
		$article_count = $article_query->count()->execute();
		$node_count = $article_count;
		}else{
			$node_count = count($ea_nodes);
		}
		$html .= '<h5 class="p-3">' . $node_count . ' Results</h5>';

		if(!empty($ea_nodes)){
			$html .='<div class="row">';
			foreach ($ea_nodes as $key => $node) {
				$nid = $node->get('nid')->value;
				$title = $node->get('title')->value;
				$body = $node->get('body')->value;
				$date = $node->get('created')->value;
				$final_date = date("d F Y", $date);
				$article = $node->field_image->getValue();
				$article_id = $article[0]['target_id'];
				$article_img = "";

				$author_uid = $node->getOwnerId();
				$author = \Drupal\user\Entity\User::load($author_uid);
				$author_name = $author ? $author->getDisplayName() : 'Unknown';
				
				if(!empty($article_id)){
					$article_img = \Drupal\file\Entity\File::load($article_id)->createFileUrl();
				}
				$alias_url = \Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);

				$sanitized_title = str_replace(' ', '-', $title);
				$url = "/linqmd/blog/" . $author_name . "/" . $sanitized_title;

				$html .='
				<div class="col-lg-4 col-md-6 col-sm-4 d-none d-sm-block">
							<div class="articele-wrapper pb-5">
								<div class="article-image">
									<img src="'.$article_img.'" width="100%">
								</div>

								<div class="d-flex mx-4 mt-2">
									<div class="offset-lg-0 text-capitalize">By '.$author_name.' </div>
									<div class="offset-lg-1">'.$final_date.'</div>
								</div>
								<div class="p-4 pt-0">
									<h6 class="pt-3 "><b>'.$title.'</b></h6>

									<div class="article-content" style="max-height: 3em; overflow: hidden; text-overflow: ellipsis;">
									'.$body.'
									</div>
									<a href="'.$url.'" traget="_blank"><button class="readMore p-2 float-start col-sm-7 mt-3">Read More</button></a>


								</div>
							</div>
				</div>';
			}

			$html .='</div>';



			$html .= '<div class="owl-carousel blogslider d-block d-sm-none">';
			foreach ($ea_nodes as $key => $node) {
				$nid = $node->get('nid')->value;
				$title = $node->get('title')->value;
				$body = $node->get('body')->value;
				$date = $node->get('created')->value;
				$final_date = date("d F Y", $date);
				$article = $node->field_image->getValue();
				$article_id = $article[0]['target_id'];
				$article_img = "";
			
				$author_uid = $node->getOwnerId();
				$author = \Drupal\user\Entity\User::load($author_uid);
				$author_name = $author ? $author->getDisplayName() : 'Unknown';
			
				if(!empty($article_id)){
					$article_img = \Drupal\file\Entity\File::load($article_id)->createFileUrl();
				}
				$alias_url = $base_url.\Drupal::service('path_alias.manager')->getAliasByPath('/node/'.$nid);

				$sanitized_title = str_replace(' ', '-', $title);
				$url = "/linqmd/blog/" . $author_name . "/" . $sanitized_title;

				$html .= '
					  <div class="articele-wrapper pb-5 mx-auto">
                                <img src="'.$article_img.'" width="100%">
                                <div class="d-flex mx-4 mt-2">
                                    <div class="offset-lg-0 text-capitalize">By '.$author_name.'</div>
                                    <div class="offset-lg-1">'.$final_date.'</div>
                                </div>
                                <div class="p-4 pt-0">

                                    <h6 class="pt-3 "><b>'.$title.'</b></h6>
                                     <div class="article-content" style="max-height: 3em; overflow: hidden; text-overflow: ellipsis;">
                                         '.$body.'
                                      </div>
                                      <a href="'.$url.'" traget="_blank"><button class="readMore p-2 float-start col-sm-7 mt-3">Read More</button></a>

                                </div>
                            </div>
				'; 
			}
			
			$html .= '</div>';
			
			$html .= '<script>
			$(document).ready(function() {
				$(".blogslider").owlCarousel({
					loop: true,
					margin: 15,
					responsive: {
						0: {
							items: 1,
							nav: true
						}
					}
				});
			});
			</script>';
			

			if ($node_count > 6) {
				$html .= '<a href="/linqmd/blog/'.$author_name.'" traget="_blank"><button class="readMore mx-auto d-block  p-2 col-sm-2 mt-3">More Blogs</button></a>';
			}

		}else{
			$html .='No Articles found.';
		}
		$ajax_resp = new JsonResponse(array("html"=>$html));
		return ($ajax_resp);
	}


}

?>