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

	public function getProfile()
	{
		$uid = \Drupal::currentUser()->id();
		$user = \Drupal\user\Entity\User::load($uid);
		$para = $user->get("field_paragraphtheme1")->getValue();
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
		// echo "<pre>";
		// print_r($response);exit;
		return array(
			'#theme' => 'profile_template',
			'#arr_data' => $response,
		);
	}
}