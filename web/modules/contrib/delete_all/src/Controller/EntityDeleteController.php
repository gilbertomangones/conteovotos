<?php

namespace Drupal\delete_all\Controller;

/**
 * Returns responses for devel module routes.
 */
class EntityDeleteController extends DeleteControllerBase {

  /**
   * Get ids of the entities to delete.
   *
   * @param string $entity_type
   *   Entity machine name.
   * @param string $bundle_type
   *   Entity machine name.
   * @param array $entity_info
   *   Entity definition information.
   *
   * @return array
   *   Array of ids of entities to delete.
   */
  public function getEntitiesToDelete($entity_type, $bundle_type = FALSE, array $entity_info = []) {
    $entities_to_delete = [];

    // Delete content by entity type.
    if ($entity_type !== FALSE) {

      $query = \Drupal::entityQuery($entity_type);

      if ($bundle_type && !empty($entity_info[$entity_type]['entity_bundle'])) {
        $query->condition($entity_info[$entity_type]['entity_bundle'], $bundle_type);
      }

      $entities_to_delete = $query->execute();
    }
    // Can't delete content of all entities.
    else {
      $entities_to_delete = [];
    }

    return $entities_to_delete;
  }

  /**
   * Returns the batch defintion.
   *
   * @param array $entities_to_delete
   *   Entities to delete.
   * @param string $entity_type
   *   Entity type.
   *
   * @return array
   *   Batch definition.
   */
  public function getEntitiesDeleteBatch(array $entities_to_delete = NULL, $entity_type) {
    // Define batch.
    $batch = [
      'operations' => [
        [
          'delete_all_entities_batch_delete',
          [
            $entities_to_delete,
            $entity_type,
          ],
        ],
      ],
      'finished' => 'delete_all_entities_batch_delete_finished',
      'title' => $this->t('Deleting entities'),
      'init_message' => $this->t('Entity deletion is starting.'),
      'progress_message' => $this->t('Deleting entities...'),
      'error_message' => $this->t('Entity deletion has encountered an error.'),
    ];

    return $batch;
  }

}
