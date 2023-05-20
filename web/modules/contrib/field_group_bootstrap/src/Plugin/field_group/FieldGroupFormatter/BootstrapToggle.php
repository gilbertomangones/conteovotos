<?php

namespace Drupal\field_group_bootstrap\Plugin\field_group\FieldGroupFormatter;

use Drupal\Component\Utility\Html;
use Drupal\field_group\FieldGroupFormatterBase;

/**
 * Plugin implementation of the Toggle formatter.
 *
 * @FieldGroupFormatter(
 *   id = "bootstrap_toggle",
 *   label = @Translation("Bootstrap toggle"),
 *   description = @Translation("This fieldgroup renders child groups in its own toggle wrapper."),
 *   supported_contexts = {
 *     "form",
 *     "view",
 *   }
 * )
 */
class BootstrapToggle extends FieldGroupFormatterBase {

  /**
   * {@inheritdoc}
   */
  public function process(&$element, $processed_object) {
    $id = Html::getUniqueId($this->getSetting('id'));
    if (empty($id)) {
      $id = 'toggle-' . $this->group->group_name;
    }
    $element += [
      '#id' => $id,
      '#type' => 'field_group_bootstrap_toggle',
      '#title' => $this->getLabel(),
      '#attributes' => [
        'class' => $this->getClasses(),
      ],
      '#button' => [
        '#type' => 'button',
        '#value' => $this->getLabel(),
        '#attributes' => [
          'class' => ['btn', $this->getSetting('btn_color')],
          'data-bs-toggle' => "collapse",
          'data-bs-target' => "#$id",
          'title' => $this->getLabel(),
        ],
      ],
      '#toggle_title' => str_replace('"', "'", $this->getSetting('title')),
      '#collapse' => $this->getSetting('collapse'),
    ];
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
    $form['collapse'] = [
      '#title' => $this->t('Style'),
      '#type' => 'select',
      '#options' => [
        'collapse' => $this->t('Hides content'),
        'collapsing' => $this->t('Apply during transitions'),
        'collapse show' => $this->t('Shows content'),
        'collapse collapse-horizontal' => $this->t('Horizontal'),
      ],
      '#empty_option' => $this->t('Default'),
      '#default_value' => $this->getSetting('collapse'),
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
      'collapse' => 'collapse',
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
