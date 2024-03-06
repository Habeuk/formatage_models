<?php

namespace Drupal\formatage_models\Plugin\Block;

use Drupal\Core\Form\FormStateInterface;
use Drupal\search\Plugin\Block\SearchBlock;

/**
 * Provides a 'Search form' block.
 *
 * @Block(
 *   id = "formatage_models_search_form_block",
 *   admin_label = @Translation("Search form (formatage_models)"),
 *   category = @Translation("Forms")
 * )
 */
class HbkSearchBlock extends SearchBlock {
  
  /**
   *
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'template_render' => 'formatage_models_search_with_icon',
      'class_key' => 'h3',
      'class_actions' => '',
      'class_form' => 'mb-4 bg-light justify-content-center align-items-center',
      'form_override' => [
        'enable' => false,
        'action' => '/search/node',
        'keys' => 'keys'
      ]
    ] + parent::defaultConfiguration();
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function build() {
    $form = parent::build();
    $build = $form;
    $template = $this->configuration['template_render'];
    $config = $this->getConfiguration();
    if ($template) {
      $form['#attributes']['class'][] = 'formatage_models-search-block-form';
      $form['#attributes']['class'][] = $config['class_form'];
      if (!empty($form['actions']['submit'])) {
        $form['actions']['submit']['#theme_wrappers'][] = 'formatage_models_search_input_submit';
        $form['actions']['submit']['#attributes']['class'][] = $config['class_actions'];
      }
      if (!empty($form['keys'])) {
        $form['keys']['#attributes']['placeholder'] = $form['keys']['#attributes']['title'];
        $form['keys']['#wrapper_attributes']['class'][] = 'flex-grow-1';
        if (!empty($form['keys']['#attributes']['class'])) {
          $form['keys']['#attributes']['class'][] = 'blm-key-search';
          $form['keys']['#attributes']['class'][] = $config['class_key'];
        }
        else {
          $form['keys']['#attributes']['class'] = [
            'blm-key-search',
            $config['class_key']
          ];
        }
      }
      // applique la surcharge
      if ($config['form_override']['enable']) {
        //
        $form['#action'] = $config['form_override']['action'];
        $form['keys']['#name'] = $config['form_override']['keys'];
      }
      $build = [
        "#theme" => $template,
        "#content" => $form
      ];
    }
    return $build;
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $this->configuration['template_render'] = $form_state->getValue('template_render');
    $this->configuration['class_key'] = $form_state->getValue('class_key');
    $this->configuration['class_actions'] = $form_state->getValue('class_actions');
    $this->configuration['class_form'] = $form_state->getValue('class_form');
    $this->configuration['form_override'] = $form_state->getValue('form_override');
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    $options = [
      "" => $this->t("Default Template"),
      "formatage_models_search_with_icon" => $this->t("Search form with icon")
    ];
    $form["template_render"] = [
      "#type" => "select",
      "#title" => $this->t("Search Block Template"),
      "#description" => $this->t("Template that will render the search form"),
      "#default_value" => $this->configuration["template_render"],
      "#options" => $options
    ];
    $form['class_key'] = [
      '#type' => 'textfield',
      '#title' => 'Class key',
      "#default_value" => $this->configuration["class_key"]
    ];
    $form['class_actions'] = [
      '#type' => 'textfield',
      '#title' => 'Class button',
      "#default_value" => $this->configuration["class_actions"]
    ];
    $form['class_form'] = [
      '#type' => 'textfield',
      '#title' => 'Class button',
      "#default_value" => $this->configuration["class_form"]
    ];
    $form['form_override'] = [
      '#type' => 'details',
      '#title' => "Surchage le formulaire",
      "#tree" => true
    ];
    $form['form_override']['enable'] = [
      '#type' => 'checkbox',
      '#title' => 'Activer la surcharger',
      "#default_value" => $this->configuration['form_override']["enable"] ?? false
    ];
    $form['form_override']['action'] = [
      '#type' => 'textfield',
      '#title' => 'Action',
      "#default_value" => $this->configuration['form_override']["action"]
    ];
    $form['form_override']['keys'] = [
      '#type' => 'textfield',
      '#title' => 'Definit la clée de recherche',
      '#description' => "Par defaut c'est key, vous devez definir la valeur permettant d'executer la recherche au niveau de la vue",
      "#default_value" => $this->configuration['form_override']["keys"]
    ];
    return $form;
  }
  
}