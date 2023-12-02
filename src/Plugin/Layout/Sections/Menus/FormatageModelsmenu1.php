<?php

namespace Drupal\formatage_models\Plugin\Layout\Sections\Menus;

use Drupal\bootstrap_styles\StylesGroup\StylesGroupManager;
use Drupal\formatage_models\Plugin\Layout\Sections\FormatageModelsSection;
use Drupal\formatage_models\FormatageModelsThemes;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;

/**
 * A very advanced custom layout.
 *
 * @Layout(
 *   id = "formatage_models_menu1",
 *   label = @Translation(" Menu 1 (modele) "),
 *   category = @Translation("Formatage Models"),
 *   path = "layouts/sections/menus",
 *   template = "formatage-models-menu1",
 *   library = "formatage_models/formatage-models-menu1",
 *   default_region = "site_main_menu",
 *   regions = {
 *     "site_main_menu" = {
 *       "label" = @Translation("menu principal site "),
 *     }
 *   }
 * )
 */
class FormatageModelsmenu1 extends FormatageModelsSection {

  /**
   *
   * {@inheritdoc}
   * @see \Drupal\formatage_models\Plugin\Layout\FormatageModels::__construct()
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, StylesGroupManager $styles_group_manager) {
    // TODO Auto-generated method stub
    parent::__construct($configuration, $plugin_id, $plugin_definition, $styles_group_manager);
    $this->pluginDefinition->set('icon', $this->pathResolver->getPath('module', 'formatage_models') . "/icones/menus/formatage-models-menu1.png");
  }

  public function build(array $regions) {
    $build = parent::build($regions);
    FormatageModelsThemes::formatSettingValues($build);
    /**
     * Ajouter une configuration pour desactiver le formatage.
     */
    // if (is_array($build['site_main_menu']))
    // $build['site_main_menu'] = $this->getMenus($build['site_main_menu']);
    return $build;
  }

  /**
   *
   * {@inheritdoc}
   * @see \Drupal\formatage_models\Plugin\Layout\Sections\FormatageModelsSection::buildConfigurationForm()
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);
    $form['containt_menu'] = [
      '#type' => 'textfield',
      '#title' => $this->t('containt_menu'),
      '#default_value' => $this->configuration['containt_menu']
    ];
    /**
     * Configuration du menu.
     */
    $form['menu_config'] = [
      '#type' => 'details',
      '#title' => 'Configuration du menu',
      '#open' => false
    ];
    return $form;
  }

  private function getMenus(array $region) {
    foreach ($region as $k => $m) {
      if (!empty($m['#in_preview']))
        return $region;
      if (isset($m['#base_plugin_id']) && $m['#base_plugin_id'] === 'system_menu_block') {
        // set new theme.
        $region[$k]['content']['#theme'] = 'layoutmenu_formatage_models_menu1';

        // add class
        $region[$k]['content']['#attributes'] = [
          'class' => [
            'menu'
          ]
        ];
        if (!empty($region[$k]['content']['#items']))
          $this->formatListMenus($region[$k]['content']['#items']);
      }
      elseif (isset($m['#base_plugin_id']) && $m['#base_plugin_id'] === 'field_block') {
        // set new theme.
        $region[$k]['content']['#theme'] = 'layoutmenu_formatage_models_menu1';

        // add class
        $region[$k]['content']['#attributes'] = [
          'class' => [
            'menu'
          ]
        ];
        if (!empty($region[$k]['content'][0]['#items']))
          $this->formatListMenus($region[$k]['content'][0]['#items']);
      }
      elseif (isset($m['#plugin_id']) && str_contains($m['#plugin_id'], ":menus")) {
        $elements = Element::children($region[$k]['content']);
        foreach ($elements as $delta) {
          $region[$k]['content'][$delta]['#theme'] = 'layoutmenu_formatage_models_menu1';
          // add class in ul
          $region[$k]['content'][$delta]['#attributes'] = [
            'class' => [
              'menu'
            ]
          ];
          if (!empty($region[$k]['content'][$delta]['#items'])) {
            $this->formatListMenus($region[$k]['content'][$delta]['#items']);
            // dump($region[$k]['content'][$delta]['#items']);
          }
        }
      }
    }

    return $region;
  }

  private function formatListMenus(array &$items, $menu_level = 0) {
    foreach ($items as $k => $item) {
      if (!empty($item['attributes'])) {
        /**
         *
         * @var \Drupal\Core\Template\Attribute $attribute
         */
        $attribute = $item['attributes'];
        $attribute->addClass([
          'menu-item'
        ]);
        // add sub menu
        if ($item['is_expanded']) {
          $attribute->addClass([
            'has-submenu0',
            'dropdown'
          ]);
        }
        // menu actif
        if ($item['in_active_trail']) {
          $attribute->addClass('nav-item--active');
        }
        $items[$k]['attributes'] = $attribute;
        $items[$k]['menu_level'] = $menu_level;
        //
        if (!empty($item['below'])) {
          $menu_level++;
          $this->formatListMenus($item['below'], $menu_level);
          $items[$k]['below'] = $item['below'];
        }
      }
    }
  }

  public function defaultConfiguration() {
    return [
      'css' => 'bg-light',
      'region_css_site_main_menu' => ''
    ] + parent::defaultConfiguration();
  }

}
