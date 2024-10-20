<?php

namespace Drupal\formatage_models\Plugin\Layout\Teasers;

use Drupal\formatage_models\Plugin\Layout\FormatageModels;
use Drupal\Core\Form\FormStateInterface;
use Drupal\bootstrap_styles\StylesGroup\StylesGroupManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

class FormatageModelsTeasers extends FormatageModels implements ContainerFactoryPluginInterface {
  
  /**
   * The styles group plugin manager.
   *
   * @var \Drupal\bootstrap_styles\StylesGroup\StylesGroupManager
   */
  protected $stylesGroupManager;
  
  /**
   *
   * {@inheritdoc}
   * @see \Drupal\formatage_models\Plugin\Layout\FormatageModels::__construct()
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, StylesGroupManager $styles_group_manager) {
    // TODO Auto-generated method stub
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->stylesGroupManager = $styles_group_manager;
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static($configuration, $plugin_id, $plugin_definition, $container->get('plugin.manager.bootstrap_styles_group'));
  }
  
  public function build(array $regions) {
    $build = parent::build($regions);
    $build['#attributes']['class'][] = 'layout--teaser';
    $build['#attributes']['class'][] = $this->configuration['css'];
    if (!empty($this->configuration['derivate']['value'])) {
      $build['#attributes']['class'][] = $this->configuration['derivate']['value'];
    }
    
    // Regions classes and attributes.
    foreach ($this->getPluginDefinition()->getRegionNames() as $region_name) {
      $build[$region_name]['#attributes']['class'] = [
        'layout-region'
      ];
      if (isset($this->configuration['region_css_' . $region_name])) {
        $build[$region_name]['#attributes']['class'][] = $this->configuration['region_css_' . $region_name];
      }
    }
    // cover ::before
    if (!empty($build['#settings']['cover_section']['active'])) {
      $build['#attributes']['class'][] = $build['#settings']['cover_section']['active'];
      $build['#attributes']['class'][] = $build['#settings']['cover_section']['model'];
      $build['#attributes']['class'][] = $build['#settings']['cover_section']['opacity'];
      $build['#attributes']['class'][] = $build['#settings']['cover_section']['zindex'];
    }
    
    /**
     * On utilise ces regions, car " $regions" peut contenis des regions non
     * valide, i.e qui a été suppprimer du modele.
     *
     * @var array $current_regions
     */
    $current_regions = $this->getPluginDefinition()->getRegionNames();
    // Regions Aos attributes
    // on n'affiche pas en mode edition
    if (!str_contains(\Drupal::routeMatch()->getRouteName(), 'layout_builder.')) {
      // Load AOS attributes.
      foreach ($current_regions as $region) {
        if (isset($this->configuration['aos_attributes'][$region]) && !empty($this->configuration['aos_attributes'][$region]['data_aos'])) {
          $build[$region]['#attributes']['data-aos'] = $this->configuration['aos_attributes'][$region]['data_aos'];
          if (!empty($this->configuration['aos_attributes'][$region]['data_aos_anchor_placement']))
            $build[$region]['#attributes']['data-aos-anchor-placement'] = $this->configuration['aos_attributes'][$region]['data_aos_anchor_placement'];
          if (!empty($this->configuration['aos_attributes'][$region]['data_aos_duration']))
            $build[$region]['#attributes']['data-aos-duration'] = $this->configuration['aos_attributes'][$region]['data_aos_duration'];
          if (!empty($this->configuration['aos_attributes'][$region]['data_aos_ease']))
            $build[$region]['#attributes']['data-aos-easing'] = $this->configuration['aos_attributes'][$region]['data_aos_ease'];
          if (!empty($this->configuration['aos_attributes'][$region]['data_aos_delay']))
            $build[$region]['#attributes']['data-aos-delay'] = $this->configuration['aos_attributes'][$region]['data_aos_delay'];
        }
      }
      // Load Default class.
      if (!empty($this->configuration['default_class'])) {
        // if ($this->pluginId == 'hot_models_sublime_right_teaser')
        // dump($this->configuration['default_class']);
        foreach ($this->configuration['default_class'] as $key => $groups) {
          if ($key == 'regions') {
            foreach ($current_regions as $region) {
              if (!empty($groups[$region]))
                foreach ($groups[$region] as $groups_regions) {
                  $build[$region]['#attributes']['class'][] = $this->getClassNameOnGroup($groups_regions);
                }
            }
          }
          else {
            $class = $this->getClassNameOnGroup($groups);
            if (!empty($class))
              $build['#attributes']['class'][] = $class;
          }
        }
      }
    }
    //
    $build = $this->stylesGroupManager->buildStyles($build, $this->configuration['container_wrapper']['bootstrap_styles']);
    //
    
    return $build;
  }
  
  protected function getClassNameOnGroup(array $groups) {
    $className = '';
    foreach ($groups as $values) {
      if (is_array($values)) {
        foreach ($values as $key => $value) {
          if ($value)
            $className .= ' ' . $key;
        }
      }
      elseif (!empty($values)) {
        $className .= ' ' . $values;
      }
    }
    return $className;
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return parent::defaultConfiguration() + [
      'load_libray' => false,
      'container_wrapper' => [
        // The dynamic bootstrap styles storage.
        'bootstrap_styles' => []
      ],
      'cover_section' => [
        'active' => '',
        'model' => '',
        'opacity' => '',
        'zindex' => ''
      ]
    ];
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);
    $form['blb_style'] = [
      '#type' => 'details',
      '#title' => 'Style',
      '#open' => false
    ];
    $this->stylesGroupManager->buildStylesFormElements($form['blb_style'], $form_state, $this->configuration['container_wrapper']['bootstrap_styles'], 'bootstrap_layout_builder.styles');
    return $form;
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $style_tab = [
      'blb_style'
    ];
    $this->configuration['container_wrapper']['bootstrap_styles'] = $this->stylesGroupManager->submitStylesFormElements($form['blb_style'], $form_state, $style_tab,
      $this->configuration['container_wrapper']['bootstrap_styles'], 'bootstrap_layout_builder.styles');
  }
}