<?php

namespace Drupal\field_group_bootstrap\Plugin\field_group\FieldGroupFormatter;

use Drupal\Component\Utility\Html;
use Drupal\field_group\FieldGroupFormatterBase;

/**
 * Plugin implementation of the Bootstrap popovers formatter.
 *
 * @FieldGroupFormatter(
 *   id = "bootstrap_popovers",
 *   label = @Translation("Bootstrap popovers"),
 *   description = @Translation("This fieldgroup renders child groups in its own popovers wrapper."),
 *   supported_contexts = {
 *     "view",
 *   }
 * )
 */
class BootstrapPopovers extends FieldGroupFormatterBase {

  /**
   * {@inheritdoc}
   */
  public function process(&$element, $processed_object) {
    $id = Html::getUniqueId($this->getSetting('id'));
    if (empty($id)) {
      $id = 'popover-' . $this->group->group_name;
    }
    $element += [
      '#id' => $id,
      '#type' => 'field_group_bootstrap_popover',
      '#title' => $this->getLabel(),
      '#attributes' => [
        'class' => $this->getClasses(),
      ],
      '#button' => [
        '#type' => 'button',
        '#value' => $this->getLabel(),
        '#attributes' => [
          'class' => ['btn', $this->getSetting('btn_color')],
          'data-bs-toggle' => "popover",
          'data-bs-target' => "#$id",
          'title' => $this->getLabel(),
        ],
      ],
      '#popover_title' => str_replace('"', "'", $this->getSetting('title')),
      '#placement' => $this->getSetting('placement'),
      '#custom_class' => trim($this->getSetting('classes')),
    ];
    $element['#attached']['library'][] = 'field_group_bootstrap/popover';
  }

  /**
   * {@inheritdoc}
   */
  public function preRender(&$element, $rendering_object) {
    parent::preRender($element, $rendering_object);
    $this->process($element, $rendering_object);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm() {
    $form = parent::settingsForm();
    $form['btn_color'] = [
      '#type' => 'select',
      '#title' => $this->t('Button color'),
      '#default_value' => $this->getSetting('btn_color'),
      '#options' => [
        "btn-primary" => $this->t("Primary"),
        "btn-secondary" => $this->t("Secondary"),
        "btn-success" => $this->t("Success"),
        "btn-danger" => $this->t("Danger"),
        "btn-warning" => $this->t("Warning"),
        "btn-info" => $this->t("Info"),
        "btn-light" => $this->t("Light"),
        "btn-dark" => $this->t("Dark"),
        "btn-link" => $this->t("Link"),
      ],
      '#empty_option' => $this->t('Default'),
    ];
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->getSetting('title'),
    ];
    $form['placement'] = [
      '#title' => $this->t('Directions'),
      '#type' => 'select',
      '#options' => [
        'top' => $this->t('Top'),
        'right' => $this->t('Right'),
        'bottom' => $this->t('Bottom'),
        'left' => $this->t('Left'),
      ],
      '#empty_option' => $this->t('Default'),
      '#default_value' => $this->getSetting('placement'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = parent::settingsSummary();
    if (!empty($this->getSetting('width'))) {
      $summary[] = $this->t('Label width: @width',
        ['@width' => $this->getSetting('width')]
      );
    }
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultContextSettings($context) {
    return [
      'btn_color' => 'btn-primary',
      'placement' => 'right',
    ] + parent::defaultContextSettings($context);
  }

  /**
   * {@inheritdoc}
   */
  public function getClasses() {
    $classes = parent::getClasses();
    $classes[] = 'field-group-' . $this->group->format_type . '-wrapper';
    return $classes;
  }

}
