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

class Homepage extends ControllerBase {

  protected $loadfields;

  public function __construct(LoadFields $loadfields) {
    $this->loadfields = $loadfields;
  }

  public static function create(ContainerInterface $container) {
    return new static($container->get('userprofile.field_details'));
  }

  public function homepage() {
    return [
      '#theme' => 'home_page',
      '#home' => [
        'message' => 'The requested doctor profile was not found.',
      ],
    ];
  }

}
