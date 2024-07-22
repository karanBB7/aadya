<?php

namespace Drupal\userprofile\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class EmailCapture extends ControllerBase {

  public function captureEmail(Request $request) {
    $email = $request->request->get('emailid');

    if (empty($email)) {
      return new JsonResponse(['success' => false, 'message' => 'No email provided']);
    }

    try {
      $connection = \Drupal::database();
      $connection->insert('email_captures')
        ->fields(['email' => $email])
        ->execute();

      return new JsonResponse(['success' => true, 'message' => 'Email stored successfully']);
    } 
    catch (\Exception $e) {
      \Drupal::logger('userprofile')->error('Error storing email: ' . $e->getMessage());
      return new JsonResponse(['success' => false, 'message' => 'Error storing email']);
    }
  }
}