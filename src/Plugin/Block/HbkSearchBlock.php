<?php

namespace Drupal\formatage_models\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\search\Form\SearchBlockForm;
use Drupal\search\SearchPageRepositoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\search\Plugin\Block\SearchBlock;

/**
 * Provides a 'Search form' block.
 *
 * @Block(
 *   id = "formatage_models_search_form_block",
 *   admin_label = @Translation("Hbk Search form"),
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
      'class_form' => 'mb-4 bg-light justify-content-center align-items-center'
    ] + parent::defaultConfiguration();
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function build() {
    $form = parent::build();
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
      return [
        "#theme" => $template,
        "#content" => $form
      ];
    }
    else
      return $form;
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
    return $form;
  }
  
}
