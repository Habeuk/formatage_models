<?php

namespace Drupal\formatage_models\Plugin\Layout\Sections;

use Drupal\bootstrap_styles\StylesGroup\StylesGroupManager;
use Drupal\formatage_models\FormatageModelsThemes;

/**
 * A very advanced custom layout.
 *
 * @Layout(
 *   id = "formatage_models_footer_gp",
 *   label = @Translation(" Footer Gp. "),
 *   category = @Translation(" Formatage Models "),
 *   path = "layouts/sections",
 *   template = "formatage-models-footer-gp",
 *   library = "formatage_models/formatage-models-footer-gp",
 *   default_region = "title",
 *   regions = {
 *     "logo" = {
 *       "label" = @Translation("logo"),
 *     },
 *     "compagny_info" = {
 *       "label" = @Translation("compagny_info"),
 *     },
 *     "social_links" = {
 *       "label" = @Translation("social_links"),
 *     },
 *     "link_1" = {
 *       "label" = @Translation("link_1"),
 *     },
 *     "links_1" = {
 *       "label" = @Translation("links_1"),
 *     },
 *     "link_2" = {
 *       "label" = @Translation(" link_2 "),
 *     },
 *     "links_2" = {
 *       "label" = @Translation("links_2"),
 *     },
 *     "link_3" = {
 *       "label" = @Translation("link_3"),
 *     },
 *     "newletter_text" = {
 *       "label" = @Translation("Newletter text"),
 *     },
 *     "newletter_form" = {
 *       "label" = @Translation("Newletter form"),
 *     },
 *     "copyright" = {
 *       "label" = @Translation("Copyright"),
 *     },
 *     "credits" = {
 *       "label" = @Translation(" Credits "),
 *     },
 *   }
 * )
 */
class FormatageModelsFooterGp extends FormatageModelsSection {
  
  /**
   *
   * {@inheritdoc}
   * @see \Drupal\formatage_models\Plugin\Layout\FormatageModels::__construct()
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, StylesGroupManager $styles_group_manager) {
    // TODO Auto-generated method stub
    parent::__construct($configuration, $plugin_id, $plugin_definition, $styles_group_manager);
    $this->pluginDefinition->set('icon', $this->pathResolver->getPath('module', 'formatage_models') . "/icones/sections/formatage-models-footer-gp.png");
  }
  
  /**
   *
   * {@inheritdoc}
   * @see \Drupal\formatage_models\Plugin\Layout\FormatageModels::build()
   */
  public function build(array $regions) {
    // TODO Auto-generated method stub
    $build = parent::build($regions);
    FormatageModelsThemes::formatSettingValues($build);
    
    return $build;
  }
  
  public function defaultConfiguration() {
    return [
      'css' => 'mb-0',
      'region_css_entete' => "col-md-6 me-auto",
      'region_css_entete2' => "col-md-6",
      'sf' => [
        'builder-form' => true,
        'info' => [
          'title' => 'Contenu',
          'loader' => 'static'
        ],
        'fields' => [
          'copyright' => [
            'text_html' => [
              'label' => 'Copyright',
              'value' => "Copyright SITENAME. All Rights Reserved"
            ]
          ],
          'credits' => [
            'text_html' => [
              'label' => 'Credits',
              'value' => "Provide by <a href='https://habeuk.com/' class='btn text-wbu-thirdly px-1 '> Habeuk.com </a>"
            ]
          ]
        ]
      ]
    ] + parent::defaultConfiguration();
  }
  
}
