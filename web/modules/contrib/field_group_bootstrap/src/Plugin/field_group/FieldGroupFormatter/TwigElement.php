<?php

namespace Drupal\field_group_bootstrap\Plugin\field_group\FieldGroupFormatter;

use Drupal\Core\Form\FormState;
use Drupal\Core\Render\Element;
use Drupal\field_group\Element\HtmlElement as HtmlElementRenderElement;
use Drupal\field_group\Plugin\field_group\FieldGroupFormatter\HtmlElement;

/**
 * Plugin implementation of the 'twig_element' formatter.
 *
 * @FieldGroupFormatter(
 *   id = "twig_element",
 *   label = @Translation("Twig element"),
 *   description = @Translation("This fieldgroup renders the inner content in a
 *   Twig element with classes and attributes."), supported_contexts = {
 *     "form",
 *     "view",
 *   }
 * )
 */
class TwigElement extends HtmlElement {

  /**
   * {@inheritdoc}
   */
  public function process(&$element, $processed_object) {

    // Keep using preRender parent for BC.
    parent::process($element, $processed_object);
    if (!empty($twig = $this->settings["twig"])) {
      $context = $element;
      if (!empty($processed_object)) {
        foreach ($processed_object as $key => $object) {
          $context[str_replace('#', '', $key)] = $object;
        }
      }
      $renderer = [
        'group__twig' => [
          '#type' => 'inline_template',
          '#template' => $this->settings["twig"],
          '#context' => $context,
        ],
      ];
      array_unshift($element, $renderer);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function preRender(&$element, $rendering_object) {
    $this->process($element, $rendering_object);

    $form_state = new FormState();
    HtmlElementRenderElement::processHtmlElement($element, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm() {

    $form = parent::settingsForm();

    $form['twig'] = [
      '#title' => $this->t('Twig text'),
      '#type' => 'textarea',
      '#default_value' => $this->getSetting('twig'),
      '#description' => $this->t('Custom text with twig support.'),
      '#rows' => 10,
      '#cols' => 60,
      '#resizable' => TRUE,
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {

    $summary = parent::settingsSummary();
    if (!empty($this->getSetting('twig'))) {
      $summary[] = $this->t('Custom text twig');
    }
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultContextSettings($context) {
    $defaults = ['twig' => ''] + parent::defaultContextSettings($context);
    return $defaults;
  }

}
