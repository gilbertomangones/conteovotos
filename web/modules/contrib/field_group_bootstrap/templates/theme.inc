<?php

/**
 * @file
 * Preprocessors for fieldgroup bootstrap elements.
 */

use Drupal\Core\Template\Attribute;

/**
 * Prepares variables for horizontal tabs templates.
 *
 * Default template: field-group-bootstrap-tabs.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties and children of
 *     the details element. Properties used: #children.
 */
function template_preprocess_field_group_bootstrap_tabs(array &$variables) {
  $element = $variables['element'];
  $variables['navigation'] = $element['#navigation'] ?? '';
  $variables['children'] = $element['#children'] ?? '';
  $variables['direction'] = $element['#direction'] ?? '';
  $variables['mode'] = $element['#mode'] ?? '';
  $variables['title'] = $element['#title'] ?? '';
  if (!empty($variables["element"]["widget"])) {
    $variables["attributes"]["class"][] = 'js-form-item form-item';
  }
}

/**
 * Prepares variables for horizontal scrollby templates.
 *
 * Default template: field-group-bootstrap-scrollby.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties and children of
 *     the details element. Properties used: #children.
 */
function template_preprocess_field_group_bootstrap_scrollby(array &$variables) {
  $element = $variables['element'];
  $variables['navigation'] = $element['#navigation'] ?? '';
  $variables['children'] = $element['#children'] ?? '';
  $variables['id'] = $element['#id'] ?? '';
  $variables['label_width'] = $element['#label_width'] ?? '';
  $variables['direction'] = $element['#direction'] ?? '';
  if (!empty($variables["element"]["widget"])) {
    $variables["attributes"]["class"][] = 'js-form-item form-item';
  }
}

/**
 * Prepares variables for fieldgroup bootstrap accordion templates.
 *
 * Default template: field-group-bootstrap-accordion.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties and children of
 *     the accordion element. Properties used: #children.
 */
function template_preprocess_field_group_bootstrap_accordion(array &$variables) {
  $element = $variables['element'];
  if (!empty($element["widget"]["#field_name"])) {
    $field_name = $element["widget"]["#field_name"];
  }
  elseif (!empty($element["#group_name"])) {
    $field_name = $element["#group_name"];
  }
  elseif (!empty($element["#field_name"])) {
    $field_name = $element["#field_name"];
  }
  if (!empty($element["widget"]) && !empty($element["widget"]['#title'])) {
    $title = $element["widget"]['#title'];
  }
  elseif (!empty($element['#title'])) {
    $title = $element['#title'];
  }
  $variables['children'] = $element['#children'] ?? '';
  $variables['id'] = $element['#id'] ?? '';
  $variables['title'] = $title ?? '';
  $variables['field_name'] = $field_name ?? '';
  $variables['parent_id'] = $element["#parent_id"] ?? '';
  $variables['collapse'] = $element["#collapse"] ?? '';
  $variables['button_attributes'] = $element["#button_attributes"] ?? '';
  if (!empty($variables["element"]["widget"])) {
    $variables["attributes"]["class"][] = 'js-form-item form-item';
  }
}

/**
 * Prepares variables for fieldgroup bootstrap modal templates.
 *
 * Default template: field-group-bootstrap-modal.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties and children of
 *     the items element. Properties used: #children.
 */
function template_preprocess_field_group_bootstrap_modal(array &$variables) {
  $element = $variables['element'];
  $variables['id'] = $element['#id'] ?? '';
  $variables['children'] = $element['#children'] ?? '';
  $variables['dialog_width'] = $element['#dialog_width'] ?? '';
  $variables['title'] = $element['#modal_title'] ?? '';
  $variables['footer'] = $element['#footer'] ?? '';
  $variables['button'] = !empty($element['#button']) ? new Attribute($element['#button']['#attributes']) : '';
  if (!empty($variables["element"]["widget"])) {
    $variables["attributes"]["class"][] = 'js-form-item form-item';
  }
}

/**
 * Prepares variables for fieldgroup bootstrap toggle templates.
 *
 * Default template: field-group-bootstrap-toggle.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties and children of
 *     the items element. Properties used: #children.
 */
function template_preprocess_field_group_bootstrap_toggle(array &$variables) {
  $element = $variables['element'];
  $variables['id'] = $element['#id'] ?? '';
  $variables['children'] = $element['#children'] ?? '';
  $variables['collapse'] = $element['#collapse'] ?? '';
  $variables['title'] = $element['#toggle_title'] ?? '';
  $variables['button'] = !empty($element['#button']) ? new Attribute($element['#button']['#attributes']) : '';
  if (!empty($variables["element"]["widget"])) {
    $variables["attributes"]["class"][] = 'js-form-item form-item';
  }
}

/**
 * Prepares variables for fieldgroup bootstrap Popover templates.
 *
 * Default template: field-group-bootstrap-popover.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties and children of
 *     the items element. Properties used: #children.
 */
function template_preprocess_field_group_bootstrap_popover(array &$variables) {
  $element = $variables['element'];
  $variables['id'] = $element['#id'] ?? '';
  $variables['children'] = $element['#children'] ?? '';
  $variables['title'] = $element['#popover_title'] ?? '';
  $variables['placement'] = $element['#placement'] ?? 'right';
  $variables['custom_class'] = $element['#custom_class'] ?? '';
  $variables['button'] = !empty($element['#button']) ? new Attribute($element['#button']['#attributes']) : '';
}

/**
 * Prepares variables for fieldgroup bootstrap offcanvas templates.
 *
 * Default template: field-group-bootstrap-offcanvas.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties and children of
 *     the items element. Properties used: #children.
 */
function template_preprocess_field_group_bootstrap_offcanvas(array &$variables) {
  $element = $variables['element'];
  $variables['id'] = $element['#id'] ?? '';
  $variables['children'] = $element['#children'] ?? '';
  $variables['title'] = $element['#offcanvas_title'] ?? '';
  $variables['placement'] = $element['#placement'] ?? 'start';
  $variables['button'] = !empty($element['#button']) ? new Attribute($element['#button']['#attributes']) : '';
}

/**
 * Prepares variables for fieldgroup bootstrap Card templates.
 *
 * Default template: field-group-bootstrap-card.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties and children of
 *     the items element. Properties used: #children.
 */
function template_preprocess_field_group_bootstrap_card(array &$variables) {
  $element = $variables['element'];
  $variables['id'] = $element['#id'] ?? '';
  $variables['children'] = $element['#children'] ?? '';
  $variables['title'] = $element['#card_title'] ?? '';
  $variables['footer'] = $element['#footer'] ?? '';
}

/**
 * Prepares variables for fieldgroup bootstrap toast templates.
 *
 * Default template: field-group-bootstrap-toast.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties and children of
 *     the items element. Properties used: #children.
 */
function template_preprocess_field_group_bootstrap_toast(array &$variables) {
  $element = $variables['element'];
  $variables['id'] = $element['#id'] ?? '';
  $variables['children'] = $element['#children'] ?? '';
  $variables['small'] = $element['#small'] ?? '';
  $variables['title'] = $element['#toast_title'] ?? '';
  $variables['delay'] = $element['#delay'] ?? '';
  $variables['placement'] = $element['#placement'] ?? 'bottom-0 end-0';
  if (!empty($variables["element"]["widget"])) {
    $variables["attributes"]["class"][] = 'js-form-item form-item';
  }
  if (!empty($element['#placement'])) {
    $variables["attributes"]["class"][] = $element['#placement'];
  }
}

/**
 * Prepares variables for fieldgroup bootstrap horizontal form templates.
 *
 * Default template: field-group-bootstrap-horizontal-form.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties and children of
 *     the items element. Properties used: #children.
 */
function template_preprocess_field_group_bootstrap_horizontal_form(array &$variables) {
  $element = $variables['element'];
  $variables['children'] = $element['#children'] ?? '';
  $variables['id_for'] = $element['#id_for'] ?? '';
  $variables['label'] = $element['#label'] ?? '';
  $variables['label_width'] = $element['#label_width'] ?? FALSE;
  $variables['required'] = !empty($element['#required']) ? 'form-required' : '';
  $variables['term_description'] = $element['#term_description'] ?? FALSE;
  if (!empty($variables["element"]["widget"])) {
    $variables["attributes"]["class"][] = 'js-form-item form-item';
  }
}

/**
 * Prepares variables for fieldgroup bootstrap grid templates.
 *
 * Default template: field-group-bootstrap-grid.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties and children of
 *     the items element. Properties used: #children.
 */
function template_preprocess_field_group_bootstrap_grid(array &$variables) {
  $element = $variables['element'];
  $variables['children'] = $element['#children'] ?? '';
  $variables['label'] = $element['#label'] ?? '';
  if (!empty($variables["element"]["widget"])) {
    $variables["attributes"]["class"][] = 'js-form-item form-item';
  }
}

/**
 * Prepares variables for fieldgroup bootstrap multistep templates.
 *
 * Default template: field-group-bootstrap-multistep.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties and children of
 *     the items element. Properties used: #children.
 */
function template_preprocess_field_group_bootstrap_multistep(array &$variables) {
  $element = $variables['element'];
  $variables['children'] = $element['#children'] ?? '';
  $variables['label'] = $element['#label'] ?? '';
  $variables['show_step_title'] = $element['#show_step_title'] ?? '';
  $variables['show_step_progress'] = $element['#show_step_progress'] ?? '';
  $variables['back_button_text'] = $element['#back_button_text'] ?? '';
  $variables['next_button_text'] = $element['#next_button_text'] ?? '';
  if (!empty($variables["element"]["widget"])) {
    $variables["attributes"]["class"][] = 'js-form-item form-item';
  }
}
