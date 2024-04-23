<?php
/**
 * @file providing the service that load all field name and type.
 *
 */

namespace Drupal\userprofile;

use Drupal\Core\Entity\EntityFieldManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Url;
use Drupal\node\Entity\Node;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\Component\Utility\Unicode;
use Drupal\Core\DrupalKernel;
use Symfony\Component\HttpFoundation\Request;
use Drupal\media\Entity\Media;
use Drupal\file\Entity\File;
use Drupal\taxonomy\Entity\Term;
use Drupal\Core\File\FileSystemInterface;

class LoadFields
{
	/**
	 * The entity field manager.
	 *
	 * @var \Drupal\Core\Entity\EntityFieldManager
	 */
	protected $entityFieldManager;

	/**
	 * Constructor.
	 *
	 * @param \Drupal\Core\Entity\EntityFieldManager $entity_field_manager
	 *   The entity field manager.
	 */
	public function __construct(EntityFieldManager $entity_field_manager)
	{
		$this->entityFieldManager = $entity_field_manager;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function create(ContainerInterface $container)
	{
		return new static($container->get("entity_field.manager"));
	}

	/**
	 * Utility: find field list.
	 * @param $type
	 *  bundle type
	 * @param  $bundle
	 *  bundle name
	 * @return $responce
	 *  field type and lable.
	 */
	public function getFieldDetails($type, $bundle)
	{
		$responce = null;
		$entityFieldManager = \Drupal::service("entity_field.manager");
		$fields = $this->entityFieldManager->getFieldDefinitions(
			$type,
			$bundle
		);

		foreach ($fields as $field_name => $field_definition) {
			if (!empty($field_definition->getTargetBundle())) {
				$responce[$field_name]["type"] = $field_definition->getType();
				$responce[$field_name]["label"] = $field_definition->getLabel();
			}
		}
		return $responce;
	}

	/**
	 * Utility: find term by name and vid.
	 * @param null $name
	 *  Term name
	 * @return int
	 *  Term id or 0 if none.
	 */
	public function getTidByName($name = null)
	{
		$term = \Drupal::entityTypeManager()
			->getStorage("taxonomy_term")
			->loadByProperties(["name" => $name]);
		$termId = reset($term)->id();
		return $termId ?? null;
	}

	public function getCount($para)
	{
		$count = [];
		foreach ($para as $value) {
			$paragraph = Paragraph::load($value["target_id"]);
			// Paragraph type could be also useful.
			$prgTypeId = $paragraph->getType();
			if (array_key_exists($prgTypeId, $count)) {
				$count[$prgTypeId] = ["count" => 2];
			} else {
				$count[$prgTypeId] = ["count" => 1];
			}
		}

		return $count;
	}

	/**
	 * Utility: find term by name and vid.
	 * @param null $term_id
	 *  Term name
	 */
	public function loadTaxonomyByid($term_id)
	{
		$term = Term::load($term_id);
		return $term;
	}

	/**
	 * Utility: find field list.
	 * @param $name
	 *  bundle name
	 * @param  $type
	 *  bundle type
	 * @return $responce
	 *  field type and lable.
	 */
	public function getFieldValue($node, $name, $type, $pId)
	{
		$list = ["string", "string_long", "list_string","integer"];
		if (in_array($type, $list) && null !== $node->$name) {
			return $node->$name->getString();
		} elseif ($type == "text_with_summary") {
			$textsummary = $node->$name->getString();
			$textsummary = str_replace(", full_html", "", $textsummary);
			$textsummary = str_replace(", basic_html", "", $textsummary);
			return $textsummary;
		} elseif ($type == "text_long") {
			$textsummary = $node->$name->getString();
			$textsummary = str_replace(", full_html", "", $textsummary);
			$textsummary = str_replace(", basic_html", "", $textsummary);
			return $textsummary;
		} elseif ($type == "link") {
			$responce["url"] = str_replace("internal:","",$node->$name->getValue()[0]["uri"]) ?? $name;
			$responce["title"] = $node->$name->title;
			return $responce;
		} elseif ($type == "entity_reference") {
			$responce = null;
			if (null !== $node->$name) {
				if ($node->$name->entity) {
					if (null !== $node->$name->entity->field_media_image) {
						$image_uri = $node->$name->entity->field_media_image->entity->getFileUri();
						//$responce['url'] =  \Drupal::service('file_url_generator')->generateAbsoluteString($image_uri);
						$responce["url"] = $image_uri;
						$responce["alt"] = $node->$name->alt;
					}

					if (
						null !==
						$node->$name->entity->field_media_video_file
					) {
						$image_uri = $node->$name->entity->field_media_video_file->entity->getFileUri();
						//$responce['video_url'] =  \Drupal::service('file_url_generator')->generateAbsoluteString($image_uri);
						$responce["video_url"] = $image_uri;
					}
				}
			}
			return $responce;
		} elseif ($type == "image" && null !== $node->$name->entity) {
			$responce = null;
			if ($node->$name->entity->getFileUri()) {
				$img_uri = $node->$name->entity->getFileUri();
				$file_uri = \Drupal::service('file_url_generator')->generateAbsoluteString($img_uri);
				$responce["url"] = $file_uri;

				$responce["alt"] = $node->$name->getValue()[0]["alt"];
			}
			return $responce;
		} elseif ($type == "file" && null !== $node->$name->entity) {
			$responce = null;
			if ($node->$name->entity->getFileUri()) {
				$file_uri = $node->$name->entity->getFileUri();
				$responce["url"] = $file_uri;

				$responce["title"] = $node->$name->getValue()[0]["description"];
			}
			return $responce;
		}
	}

	/**
	 * Utility: find field list.
	 * @param $name
	 *  bundle name
	 * @param  $type
	 *  bundle type
	 * @return $responce
	 *  field type and lable.
	 */
	public function getFieldParaValue($name, $pId)
	{
		$paragraph = Paragraph::load($pId);
		// Paragraph type could be also useful.
		$prgTypeId = $paragraph->getType();
		//load Paragraph type & field
		$get_paragraph = $this->getFieldDetails("paragraph", $prgTypeId);
		$data = null;
		foreach ($get_paragraph as $name => $type) {
			if ($type["type"] == "entity_reference_revisions") {
				$childPara = $paragraph->get($name)->getValue();
				$getSubParaCount = $this->getCount($childPara);
				foreach ($childPara as $value) {
					$paragraphChild = Paragraph::load($value["target_id"]);
					// Paragraph type could be also useful.
					$prgTypeId = $paragraphChild->getType();
				}

				foreach ($childPara as $valuechild) {
					if ($getSubParaCount[$prgTypeId]["count"] != 1) {
						$data[$name][] = $this->getFieldParaValue(
							$name,
							$valuechild["target_id"]
						);
					} else {
						$inarray = [
							"carddata",
							"commonsliderdata",
							"slides",
							"tabcont",
							"overlayheadcar",
							"ourproductdata",
							"emailto",
							"tel",
							"socialicons",
							"tabnavlist",
						];
						if (in_array($name, $inarray)) {
							$data[$name][] = $this->getFieldParaValue(
								$name,
								$valuechild["target_id"]
							);
						} else {
							if ($name == "cta") {
								$data[$name][] = $this->getFieldParaValue(
									$name,
									$valuechild["target_id"]
								);
							} else {
								$data[$name] = $this->getFieldParaValue(
									$name,
									$valuechild["target_id"]
								);
							}
						}
					}
				}
			} else {
				if (
					$this->getFieldValue($paragraph, $name, $type["type"], "")
				) {
					if ($name == "image") {
						$data[$name][] = $this->getFieldValue(
							$paragraph,
							$name,
							$type["type"],
							""
						);
					} else {
						$data[$name] = $this->getFieldValue(
							$paragraph,
							$name,
							$type["type"],
							""
						);
					}
				}
			}
		}

		return $data;
	}

	public function getFieldBlogPageParaValue($name, $pId)
	{
		$paragraph = Paragraph::load($pId);
		// Paragraph type could be also useful.
		$prgTypeId = $paragraph->getType();
		//load Paragraph type & field
		$get_paragraph = $this->getFieldDetails("paragraph", $prgTypeId);
		$data = null;
		foreach ($get_paragraph as $name => $type) {
			if ($type["type"] == "entity_reference_revisions") {
				$childPara = $paragraph->get($name)->getValue();
				$getSubParaCount = $this->getCount($childPara);
				foreach ($childPara as $value) {
					$paragraphChild = Paragraph::load($value["target_id"]);
					// Paragraph type could be also useful.
					$prgTypeId = $paragraphChild->getType();
				}

				foreach ($childPara as $valuechild) {
					if ($getSubParaCount[$prgTypeId]["count"] != 1) {
						$data[$name][] = $this->getFieldParaValue(
							$name,
							$valuechild["target_id"]
						);
					} else {
						$data[$name] = $this->getFieldParaValue(
							$name,
							$valuechild["target_id"]
						);
					}
				}
			} else {
				if (
					$this->getFieldValue($paragraph, $name, $type["type"], "")
				) {
					if ($name == "image") {
						$data[$name][] = $this->getFieldValue(
							$paragraph,
							$name,
							$type["type"],
							""
						);
					} else {
						$data[$name] = $this->getFieldValue(
							$paragraph,
							$name,
							$type["type"],
							""
						);
					}
				}
			}
		}

		return $data;
	}

	public function loadNode($pageName, $category)
	{
		try {
			//get term id
			//page name is TermName
			$tId = $this->getTidByName(strtolower($pageName));
			//Get node id using term id
			$nodeId = \Drupal::entityTypeManager()
				->getStorage("node")
				->loadByProperties([$category => $tId]);
			foreach ($nodeId as $node => $value) {
				$response["component"]["id"] = $node;
				$nodes = Node::load($node);
				$para = $nodes->get("banner")->getValue();
				$getParaCount = $this->getCount($para);
				foreach ($para as $value) {
					$paragraph = Paragraph::load($value["target_id"]);
					// Paragraph type could be also useful.
					$prgTypeId = $paragraph->getType();
					//load Paragraph type & field
					$get_paragraph = $this->getFieldDetails(
						"paragraph",
						$prgTypeId
					);
					foreach ($get_paragraph as $name => $type) {
						//field type is paragraph
						if ($type["type"] == "entity_reference_revisions") {
							$childPara = $paragraph->get($name)->getValue();
							$getSubParaCount = $this->getCount($childPara);
							foreach ($childPara as $valuechild) {
								if ($getSubParaCount[$name]["count"] != 1) {
									$data[$name][] = $this->getFieldParaValue(
										$name,
										$valuechild["target_id"]
									);
								} else {
									$data[$name] = $this->getFieldParaValue(
										$name,
										$valuechild["target_id"]
									);
								}
							}
						} else {
							$data[$name] = $this->getFieldValue(
								$paragraph,
								$name,
								$type["type"],
								$value["target_id"]
							);
						}
					}
					if ($getParaCount[$prgTypeId]["count"] != 1) {
						$response["component"][$prgTypeId][] = $data;
					} else {
						$response["component"][$prgTypeId] = $data;
					}
					unset($data);
				}
			}
		} catch (\Exception $e) {
			$response["type"] = "pages";
			$response["method"] = "GET";
			$response["response"] = "400";
		}
		return $response;
	}

	function getTagByAlias($alias)
	{
		$path = \Drupal::service("path_alias.manager")->getPathByAlias($alias);
		if ($path == $alias) {
			return null;
		}
		$params = Url::fromUri("internal:" . $path)->getRouteParameters();
		$entity_type = key($params);
		return \Drupal::entityTypeManager()
			->getStorage($entity_type)
			->load($params[$entity_type]);
	}

	public function getChildren($term_id)
	{
		$Childterm = \Drupal::entityTypeManager()
			->getStorage("taxonomy_term")
			->getChildren($term_id);

		if (!empty($Childterm)) {
			foreach ($Childterm as $key => $val) {
				$child[] = $key;
			}
			return $child;
		} else {
			return [];
		}
		return $Childterm;
	}

	function getTIDByPathAlias($alias)
	{
		$current_path = "/" . $alias;
		$path = \Drupal::service("path_alias.manager")->getPathByAlias(
			$current_path
		);
		$nodeID = [];
		if (preg_match("/node\/(\d+)/", $path, $matches)) {
			$nodeID[] = $matches[1];
		}
		return $nodeID;
	}
}
