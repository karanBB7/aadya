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

class Blog extends ControllerBase
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


    function getBlog(Request $request, $title, $username) {
        global $base_url;
        $response = [];
    
        $decoded_title = str_replace('-', ' ', $title);
        $query = \Drupal::entityQuery('node')
            ->condition('status', 1)
            ->condition('type', 'article')
            ->condition('title', $decoded_title)
            ->range(0, 1)
            ->accessCheck(TRUE);
    
        $node_id = $query->execute();
    
        $node_ids = $query->execute();
        $node_id = reset($node_ids);
        $node = Node::load($node_id);
    
        if ($node) {

            $title = $node->getTitle();
            $body = $node->get('body')->value;
            $date = $node->getCreatedTime();
            $final_date = \Drupal::service('date.formatter')->format($date, 'custom', 'd F Y');
            $article = $node->field_image->entity;
            $article_img = "";
            $author_uid = $node->getOwnerId(); 
            $author = \Drupal\user\Entity\User::load($author_uid);
            $author_name = $author ? $author->getDisplayName() : 'Unknown';

            
            $user_full_name = '';
            if ($author) {
                $para = $author->get("field_paragraphtheme1")->getValue();
                if (!empty($para) && isset($para[0]['target_id'])) {
                    $paragraph = \Drupal\paragraphs\Entity\Paragraph::load($para[0]['target_id']);
                    if ($paragraph instanceof \Drupal\paragraphs\Entity\Paragraph) {
                        $user_full_name = $paragraph->get('field_name')->value;
                    }
                }
            }
    
            if (!empty($article)) {
                $article_img = $article->createFileUrl();
            }
    
            $alias_url = \Drupal::service('path_alias.manager')->getAliasByPath('/node/' . $node_id);
    
            $response['article'][] = [
                'thumb' => $article_img,
                'alias_url' => $alias_url,
                'title' => $title,
                'date' => $final_date,
                'author' => $author_name,
                'body' => $body,
                'node_id' => $node_id,
                'user_full_name' => $user_full_name,
            ];
            $response['node_id'] = $node_id;
            $response['username'] = $username;
            $response['title'] = $title;
            $response['base_url'] = $base_url;


        }
        
        $entityTypeManager = \Drupal::service('entity_type.manager');

              // Load comments associated with the node.
        $query = $entityTypeManager->getStorage('comment')->getQuery();
        $query->condition('entity_type', 'node')
            ->condition('entity_id', $node_id)
            ->condition('status', \Drupal\comment\Entity\Comment::PUBLISHED);
          // Execute the query and fetch comment IDs.
        $query->accessCheck(TRUE);
        $comment_ids = $query->execute();
        $comments = $entityTypeManager->getStorage('comment')->loadMultiple($comment_ids);
        $comments_info = [];
        foreach ($comments as $comment) {
            $name = $comment->get('field_fullname')->value;
            $email = $comment->get('field_email_address')->value;
            $comment_body = $comment->get('comment_body')->value;
            $created = $comment->getCreatedTime();

            $comments_info[] = [
              'name' => $name,
              'email' => $email,
              'comment_body' => $comment_body,
              'created' => date('F d,Y',$created),
            ];
        }
        $response['comments_info'] = $comments_info;
        $connection = Database::getConnection();
        $query = $connection->select('node_field_data', 'nfd')
            ->fields('nfd', ['nid'])
            ->condition('status', 1)
            ->condition('type', 'article')
            ->condition('uid', $author_uid) 
            ->range(0, 3);
    
        $query->addExpression('RAND()', 'random_sort');
        $query->orderBy('random_sort');
    
        $result = $query->execute();
        $random_articles = $result->fetchCol();
        $random_article_nodes = Node::loadMultiple($random_articles);
    
        foreach ($random_article_nodes as $random_node) {
            if ($random_node->id() != $node_id) {
                $random_title = $random_node->getTitle();
                $random_article = $random_node->field_image->entity;
                $random_article_img = "";
    
                $random_author_uid = $random_node->getOwnerId();
                $random_author = \Drupal\user\Entity\User::load($random_author_uid);
                $random_author_name = $random_author ? $random_author->getDisplayName() : '';

                $random_user_full_name = '';
                if ($random_author) {
                    $random_para = $random_author->get("field_paragraphtheme1")->getValue();
                    if (!empty($random_para) && isset($random_para[0]['target_id'])) {
                        $random_paragraph = \Drupal\paragraphs\Entity\Paragraph::load($random_para[0]['target_id']);
                        if ($random_paragraph instanceof \Drupal\paragraphs\Entity\Paragraph) {
                            $random_user_full_name = $random_paragraph->get('field_name')->value;
                        }
                    }
                }
    
                $random_alias_url = \Drupal::service('path_alias.manager')->getAliasByPath('/node/' . $random_node->id());
    
                if (!empty($random_article)) {
                    $random_article_img = $random_article->createFileUrl();
                }
    
                $response['random_articles'][] = [
                    'thumb' => $random_article_img,
                    'alias_url' => $random_alias_url,
                    'title' => $random_title,
                    'author' => $random_author_name,
                    'random_user_full_name' => $random_user_full_name,
                    'base_url' => $base_url,
                ];
            }
        }
    
        // echo "<pre>";
        // print_r($response);exit;
    
        return [
            '#theme' => 'profile_blog_template',
            '#arr_data' => $response,
        ];
    }
    

    function getAllBlog(Request $request, $username) {
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
                ->accessCheck(TRUE);
        
            if (!empty($search)) {
                $ea_query->condition('title', '%' . $search . '%', 'LIKE');
            }
            $ea_nids = $ea_query->execute();
            $ea_nodes = Node::loadMultiple($ea_nids);
            
            $page = $request->query->get('page') ?? 1;
            $items_per_page = 5;
            $total_items = count($ea_nodes);
            $total_pages = ceil($total_items / $items_per_page);
            $offset = ($page - 1) * $items_per_page;
            
            $ea_nodes = array_slice($ea_nodes, $offset, $items_per_page);


            $user_full_name = '';
            $para = $user->get("field_paragraphtheme1")->getValue();
            if (!empty($para) && isset($para[0]['target_id'])) {
                $paragraph = \Drupal\paragraphs\Entity\Paragraph::load($para[0]['target_id']);
                if ($paragraph instanceof \Drupal\paragraphs\Entity\Paragraph) {
                    $user_full_name = $paragraph->get('field_name')->value;
                }
            }

            
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
        
        $response['user_full_name'] = $user_full_name;
        $response['creator'] = $username;
        $filtered_node_count_article = count($response['article']);
        $response['node_count'] = $filtered_node_count_article;
        $response['total_pages'] = $total_pages;
        $response['current_page'] = $page;
        $response['username'] = $username;
    
        return [
            '#theme' => 'profile_all_blog_template',
            '#blog_data' => $response,
        ];
    }
    

}