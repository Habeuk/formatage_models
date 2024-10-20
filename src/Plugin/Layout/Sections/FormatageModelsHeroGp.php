<?php

namespace Drupal\formatage_models\Plugin\Layout\Sections;

use Drupal\bootstrap_styles\StylesGroup\StylesGroupManager;
use Drupal\formatage_models\FormatageModelsThemes;

/**
 * A very advanced custom layout.
 *
 * @Layout(
 *   id = "formatage_models_hero_gp",
 *   label = @Translation(" Hero modele GP. "),
 *   category = @Translation("Formatage Models"),
 *   path = "layouts/sections",
 *   template = "formatage-models-hero-gp",
 *   library = "formatage_models/formatage-models-hero-gp",
 *   default_region = "title",
 *   regions = {
 *     "title" = {
 *       "label" = @Translation("title"),
 *     },
 *     "description" = {
 *       "label" = @Translation(" Description "),
 *     },
 *     "blocks" = {
 *       "label" = @Translation(" Block "),
 *     }
 *   }
 * )
 */
class FormatageModelsHeroGp extends FormatageModelsSection {

  /**
   *
   * {@inheritdoc}
   * @see \Drupal\formatage_models\Plugin\Layout\FormatageModels::__construct()
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, StylesGroupManager $styles_group_manager) {
    // TODO Auto-generated method stub
    parent::__construct($configuration, $plugin_id, $plugin_definition, $styles_group_manager);
    $this->pluginDefinition->set('icon', $this->pathResolver->getPath('module', 'formatage_models') . "/icones/sections/formatage-models-hero-gp.png");
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
    return parent::defaultConfiguration() + [
      'css' => '',
      'region_css_entete' => "col-md-6 me-auto",
      'region_css_entete2' => "col-md-6",
      'sf' => [
        'builder-form' => true,
        'info' => [
          'title' => ' Contenu 1 ',
          'loader' => 'static'
        ],
        'fields' => [
          'title' => [
            'text_html' => [
              'label' => 'titre',
              'value' => " Powerful Digital Solutions With Gp "
            ]
          ],
          'description' => [
            'text_html' => [
              'label' => 'Description',
              'value' => " We are team of talented digital marketers "
            ]
          ]
        ]
      ],
      'sf2' => [
        'builder-form' => true,
        'info' => [
          'title' => 'Social network',
          'loader' => 'static'
        ],
        'fields' => [
          'blocks' => [
            'text_html_nx' => [
              'label' => 'block',
              'value' => [
                'block0' => [
                  'value' => '<svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24">
    								<g>
    									<path fill="none" d="M0 0h24v24H0z"/>
    									<path d="M21 11.646V21a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-9.354A3.985 3.985 0 0 1 2 9V3a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v6c0 1.014-.378 1.94-1 2.646zm-2 1.228a4.007 4.007 0 0 1-4-1.228A3.99 3.99 0 0 1 12 13a3.99 3.99 0 0 1-3-1.354 3.99 3.99 0 0 1-4 1.228V20h14v-7.126zM14 9a1 1 0 0 1 2 0 2 2 0 1 0 4 0V4H4v5a2 2 0 1 0 4 0 1 1 0 1 1 2 0 2 2 0 1 0 4 0z"/>
    								</g>
    							</svg>
    							<h3>
    								<a href="">
    									Lorem Ipsum
    								</a>
    							</h3>'
                ],
                'block1' => [
                  'value' => '<svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24">
      							<g>
      								<path fill="none" d="M0 0h24v24H0z"/>
      								<path d="M3 3h18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm1 2v14h16V5H4zm3 8h2v4H7v-4zm4-6h2v10h-2V7zm4 3h2v7h-2v-7z"/>
      							</g>
      						</svg>
      						<h3>
      							<a href="">
      								Dolor Sitema
      							</a>
      						</h3>'
                ],
                'block2' => [
                  'value' => '<svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24">
      							<g>
      								<path fill="none" d="M0 0h24v24H0z"/>
      								<path d="M17 3h4a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4V1h2v2h6V1h2v2zm-2 2H9v2H7V5H4v4h16V5h-3v2h-2V5zm5 6H4v8h16v-8zM6 14h2v2H6v-2zm4 0h8v2h-8v-2z"/>
      							</g>
      						</svg>
      						<h3>
      							<a href="">
      								Sedare Perspiciatis
      							</a>
      						</h3>'
                ],
                'block3' => [
                  'value' => '<svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24">
      							<g>
      								<path fill="none" d="M0 0h24v24H0z"/>
      								<path d="M5 5v3h14V5H5zM4 3h16a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm2 9h6a1 1 0 0 1 1 1v3h1v6h-4v-6h1v-2H5a1 1 0 0 1-1-1v-2h2v1zm11.732 1.732l1.768-1.768 1.768 1.768a2.5 2.5 0 1 1-3.536 0z"/>
      							</g>
      						</svg>
      						<h3>
      							<a href="">
      								Magni Dolores
      							</a>
      						</h3>'
                ],
                'block4' => [
                  'value' => '<svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24">
      							<g>
      								<path fill="none" d="M0 0h24v24H0z"/>
      								<path fill-rule="nonzero" d="M5 12.5c0 .313.461.858 1.53 1.393C7.914 14.585 9.877 15 12 15c2.123 0 4.086-.415 5.47-1.107 1.069-.535 1.53-1.08 1.53-1.393v-2.171C17.35 11.349 14.827 12 12 12s-5.35-.652-7-1.671V12.5zm14 2.829C17.35 16.349 14.827 17 12 17s-5.35-.652-7-1.671V17.5c0 .313.461.858 1.53 1.393C7.914 19.585 9.877 20 12 20c2.123 0 4.086-.415 5.47-1.107 1.069-.535 1.53-1.08 1.53-1.393v-2.171zM3 17.5v-10C3 5.015 7.03 3 12 3s9 2.015 9 4.5v10c0 2.485-4.03 4.5-9 4.5s-9-2.015-9-4.5zm9-7.5c2.123 0 4.086-.415 5.47-1.107C18.539 8.358 19 7.813 19 7.5c0-.313-.461-.858-1.53-1.393C16.086 5.415 14.123 5 12 5c-2.123 0-4.086.415-5.47 1.107C5.461 6.642 5 7.187 5 7.5c0 .313.461.858 1.53 1.393C7.914 9.585 9.877 10 12 10z"/>
      							</g>
      						</svg>
      						<h3>
      							<a href="">
      								Nemos Enimade
      							</a>
      						</h3>'
                ]
              ]
            ]
          ]
        ]
      ]
    ];
  }
}
