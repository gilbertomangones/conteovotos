<?php

namespace Drupal\field_group_bootstrap\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\RenderElement;

/**
 * Provides a render element for bootstrap modal.
 *
 * Formats all child details and all non-child details whose #group is
 * assigned this element's name as modal.
 *
 * @FormElement("field_group_bootstrap_modal")
 */
class FieldGroupBootstrapModal extends RenderElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);

    return [
      '#process' => [
        [$class, 'processFieldGroupBootstrapModal'],
      ],
      '#theme_wrappers' => ['field_group_bootstrap_modal'],
    ];
  }

  /**
   * Creates a group formatted as modal.
   *
   * @param array $element
   *   An associative array containing the properties and children of the
   *   details element.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   * @param bool $on_form
   *   Are the tabs rendered on a form or not.
   *
   * @return array
   *   The processed element.
   */
  public static function processFieldGroupBootstrapModal(array &$element, FormStateInterface $form_state, $on_form = TRUE) {

    // Inject a new details as child, so that form_process_details() processes
    // this details element like any other details.
    $element['group'] = [
      '#type' => 'details',
      '#theme_wrappers' => [],
      '#parents' => $element['#parents'],
    ];

    // Add an invisible label for accessibility.
    if (empty($element['#title'])) {
      $element['#title_label'] = t('Bootstrap Modal');
      $element['#title_display'] = 'invisible';
    }
    return $element;
  }

}
