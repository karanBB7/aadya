<?php

namespace Drupal\userprofile\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\userprofile\LoadFields;

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
