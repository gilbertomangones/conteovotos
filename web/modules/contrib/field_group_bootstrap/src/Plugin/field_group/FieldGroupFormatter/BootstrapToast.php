<?php

namespace Drupal\field_group_bootstrap\Plugin\field_group\FieldGroupFormatter;

use Drupal\Component\Utility\Html;
use Drupal\field_group\FieldGroupFormatterBase;

/**
 * Plugin implementation of the Bootstrap toast formatter.
 *
 * @FieldGroupFormatter(
 *   id = "bootstrap_toast",
 *   label = @Translation("Bootstrap toast"),
 *   description = @Translation("This fieldgroup renders child groups in its own toast wrapper."),
 *   supported_contexts = {
 *     "form",
 *     "view",
 *   }
 * )
 */
class BootstrapToast extends FieldGroupFormatterBase {

  /**
   * {@inheritdoc}
   */
  public function process(&$element, $processed_object) {
    $id = Html::getUniqueId($this->getSetting('id'));
    if (empty($id)) {
      $id = 'toast-' . $this->group->group_name;
    }
    $element += [
      '#id' => $id,
      '#type' => 'field_group_bootstrap_toast',
      '#title' => $this->getLabel(),
      '#attributes' => [
        'class' => $this->getClasses(),
      ],
      '#toast_title' => str_replace('"', "'", $this->getSetting('title')),
      '#delay' => $this->getSetting('delay'),
      '#placement' => $this->getSetting('placement'),
      '#small' => $this->getSetting('small'),
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
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->getSetting('title'),
    ];
    $form['placement'] = [
      '#title' => $this->t('Toast placement'),
      '#type' => 'select',
      '#options' => [
        "top-0 start-0" => $this->t("Top left"),
        "top-0 start-50 translate-middle-x" => $this->t("Top center"),
        "top-0 end-0" => $this->t("Top right"),
        "top-50 start-0 translate-middle-y" => $this->t("Middle left"),
        "top-50 start-50 translate-middle" => $this->t("Middle center"),
        "top-50 end-0 translate-middle-y" => $this->t("Middle right"),
        "bottom-0 start-0" => $this->t("Bottom left"),
        "bottom-0 start-50 translate-middle-x" => $this->t("Bottom center"),
        "bottom-0 end-0" => $this->t("Bottom right"),
      ],
      '#empty_option' => $this->t('Default'),
      '#default_value' => $this->getSetting('placement'),
    ];
    $form['delay'] = [
      '#title' => $this->t('Delay'),
      '#type' => 'select',
      '#options' => [
        '10000' => $this->t('1s'),
        '20000' => $this->t('2s'),
        '30000' => $this->t('3s'),
        '40000' => $this->t('4s'),
      ],
      '#empty_option' => $this->t('Default'),
      '#default_value' => $this->getSetting('delay'),
    ];
    $form['small'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Small right text'),
      '#default_value' => $this->getSetting('small'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = parent::settingsSummary();
    if (!empty($this->getSetting('delay'))) {
      $summary[] = $this->t('Delay: @delay',
        ['@delay' => $this->getSetting('delay')]
      );
    }
    if (!empty($this->getSetting('small'))) {
      $summary[] = $this->t('Small text: @small',
        ['@small' => $this->getSetting('small')]
      );
    }
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultContextSettings($context) {
    return [
      'title' => '',
      'delay' => '',
      'placement' => '',
      'small' => FALSE,
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
