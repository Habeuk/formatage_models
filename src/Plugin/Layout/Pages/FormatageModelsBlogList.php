<?php

namespace Drupal\formatage_models\Plugin\Layout\Pages;

use Drupal\Core\Form\FormStateInterface;

/**
 * A very advanced custom layout.
 *
 * @Layout(
 *   id = "formatage_models_blog_list",
 *   label = @Translation(" 2 colonnes dynamique bootstrap "),
 *   category = @Translation("Formatage Models"),
 *   path = "layouts/pages",
 *   template = "formatage-models-blog-list",
 *   library = "formatage_models/formatage-models-blog-list",
 *   default_region = "left",
 *   regions = {
 *     "top" = {
 *       "label" = @Translation("Top"),
 *     },
 *     "lefttile" = {
 *       "label" = @Translation(" Left tile "),
 *     },
 *     "left" = {
 *       "label" = @Translation("Content Left 1"),
 *     },
 *     "left2" = {
 *       "label" = @Translation("Content Left 2"),
 *     },
 *     "left3" = {
 *       "label" = @Translation("Content Left 3"),
 *     },
 *     "left4" = {
 *       "label" = @Translation("Content Left 4"),
 *     },
 *     "left5" = {
 *       "label" = @Translation("Content Left 5"),
 *     },
 *     "left6" = {
 *       "label" = @Translation("Content Left 6"),
 *     },
 *     "left7" = {
 *       "label" = @Translation("Content Left 7"),
 *     },
 *     "left8" = {
 *       "label" = @Translation("Content Left 8"),
 *     },
 *     "righttile" = {
 *       "label" = @Translation("Right tile "),
 *     },
 *     "right" = {
 *       "label" = @Translation("Content Right 1"),
 *     },
 *     "right2" = {
 *       "label" = @Translation("Content Right 2"),
 *     },
 *     "right3" = {
 *       "label" = @Translation("Content Right 3"),
 *     },
 *     "right4" = {
 *       "label" = @Translation("Content Right 4"),
 *     },
 *     "right5" = {
 *       "label" = @Translation("Content Right 5"),
 *     },
 *     "right6" = {
 *       "label" = @Translation("Content Right 6"),
 *     },
 *     "right7" = {
 *       "label" = @Translation("Content Right 7"),
 *     },
 *     "right8" = {
 *       "label" = @Translation("Content Right 8"),
 *     },
 *   }
 * )
 */
class FormatageModelsBlogList extends FormatageModelsPages {
  
  /**
   *
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'css_left' => 'col-lg-8',
      'css_right' => 'col-lg-4',
      'css_top' => 'col-lg-12',
      'css_row' => 'container mx-auto',
      'region_tag_lefttile' => 'h2',
      'region_tag_righttile' => 'h2'
    ] + parent::defaultConfiguration();
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);
    $form['css_row'] = [
      '#type' => 'textfield',
      '#title' => $this->t('css row'),
      '#default_value' => $this->configuration['css_row']
    ];
    $form['css_top'] = [
      '#type' => 'textfield',
      '#title' => $this->t('css_top'),
      '#default_value' => $this->configuration['css_top']
    ];
    $form['css_left'] = [
      '#type' => 'textfield',
      '#title' => $this->t('css_left'),
      '#default_value' => $this->configuration['css_left']
    ];
    $form['css_right'] = [
      '#type' => 'textfield',
      '#title' => $this->t('css_right'),
      '#default_value' => $this->configuration['css_right']
    ];
    return $form;
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $this->configuration['css_left'] = $form_state->getValue('css_left');
    $this->configuration['css_right'] = $form_state->getValue('css_right');
    $this->configuration['css_top'] = $form_state->getValue('css_top');
    $this->configuration['css_row'] = $form_state->getValue('css_row');
  }
  
}
