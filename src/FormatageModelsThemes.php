<?php

namespace Drupal\formatage_models;

use Drupal\Core\Field\FieldItemList;
use Drupal\block\Entity\Block;
use Drupal\Core\Template\Attribute;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;
use Drupal\Core\Render\Element;

// use Stephane888\HtmlBootstrap\Traits\Portions;
class FormatageModelsThemes {
  
  // use Portions;
  
  /**
   * Returns the theme hook definition information.
   */
  public static function getThemeHooks() {
    // theme de base pour les menus. layoutmenu--fast-models-fn-first-menu
    $hooks['formatage_models_fieldgalleries'] = [
      'preprocess functions' => [
        'template_preprocess_formatage_models_fieldgalleries'
      ],
      'render element' => 'element',
      'file' => 'themes/formatage_models.theme.inc'
    ];
    //
    // theme de base Pour le rendu field swiper
    $hooks['formatage_models_swiperjsimage'] = [
      'preprocess functions' => [
        'template_preprocess_formatage_models_swiperjsimage'
      ],
      'variables' => [
        'items' => [],
        'swiperjs_options' => [],
        'wrappers_attributes' => null,
        'swipper_attributes_paginations' => null,
        'swipper_attributes_buttons_next' => null,
        'swipper_attributes_buttons_prev' => null
      ]
    ];
    // Template to edit quickly paragraphe.
    $hooks['formatage_models_quickly_edit'] = [
      'preprocess functions' => [
        'template_preprocess_formatage_models_quickly_edit'
      ],
      'render element' => 'element',
      'file' => 'themes/formatage_models.theme.inc'
    ];
    $hooks['formatage_models_search_with_icon'] = [
      'variables' => [
        'content' => NULL
      ]
    ];
    $hooks['formatage_models_search_input_submit'] = [
      'render element' => 'element',
      'preprocess functions' => [
        'template_preprocess_formatage_models_search_input_submit'
      ],
      'file' => 'themes/formatage_models.theme.inc'
    ];
    $hooks['formatage_models_block_admin'] = [
      'render element' => 'element'
    ];
    return $hooks;
  }
  
  public static function ViewsGetValues(array &$vars) {
    /**
     *
     * @var \Drupal\views\ViewExecutable $view
     */
    $view = $vars['view'];
    
    $options = $view->style_plugin->options;
    $regions = $options['view_layouts_options'];
    if (!empty($options['view_layouts_options']) & $view->style_plugin->usesFields()) {
      foreach ($vars['rows'] as $row_index => $row) {
        if (!empty($row['#view'])) {
          $viewRow = $row['#view'];
          if (!empty($viewRow->row_index))
            $viewRow->row_index = $row_index;
          $row['view'] = $viewRow;
          $row['row'] = $row['#row'];
          $row['options'] = $row['#options'];
          template_preprocess_views_view_fields($row);
          if (!empty($row['fields'])) {
            $vars['rows'][$row_index] = $row;
            foreach ($row['fields'] as $fieldname => $field) {
              /**
               *
               * @var \Drupal\views\Plugin\views\field\EntityField $fieldHanler
               */
              $fieldHanler = $field->handler;
              $vars['rows'][$row_index][$fieldname]['#markup'] = $fieldHanler->advancedRender($row['row']);
              // $vars['rows'][$row_index][$fieldname] = $field;
              // $fieldHanler->ren
            }
            /**
             * On selectionne une region et on y charge tous les champs qui sont
             * rattaché.
             */
            foreach ($regions as $region => $fieldnames) {
              // $vars['rows'][$row_index][$region] = [];
              foreach ($fieldnames as $fieldnameR) {
                if (!empty($vars['rows'][$row_index][$fieldnameR])) {
                  $vars['rows'][$row_index][$region][] = $vars['rows'][$row_index][$fieldnameR];
                }
              }
            }
          }
        }
        else {
          \Drupal::messenger()->addWarning('Error with display views');
        }
      }
    }
  }
  
  /**
   * Permet de deplacer les layouts dans une autre region.
   */
  public static function ReInjectLayoutInAnotherRegion(Block $Block, $variables) {
    //
  }
  
  /**
   * Ajoute les attributs sur les balises.
   *
   * @param array $variables
   */
  public static function ApplyAttributes(array &$variables) {
    $attributes = new Attribute();
    // Ajout de la class space_bottom si necessaire
    /**
     *
     * @var \Drupal\Core\Layout\LayoutDefinition $layout
     */
    $layout = $variables['layout'];
    if (!empty($layout)) {
      if (str_contains($layout->getTemplatePath(), "layouts/sections")) {
        $attributes->addClass('space_bottom');
        $variables['attributes'] = $attributes;
      }
      
      if (!empty($variables['settings']['css'])) {
        $attributes->addClass(explode(" ", $variables['settings']['css']));
        $variables['attributes'] = $attributes;
      }
      
      foreach ($layout->getRegionNames() as $region) {
        $v = new Attribute();
        $v->addClass('layout-region');
        $variables['region_attributes'][$region] = $v;
        if (isset($variables['settings']['region_css_' . $region])) {
          $v->addClass($variables['settings']['region_css_' . $region]);
          $variables['region_attributes'][$region] = $v;
        }
      }
    }
  }
  
  /**
   * Permet de recuperer la valeur des champs dynamique et de les inserres dans
   * la region adéquate.
   *
   * @param array $settings
   * @throws \Exception
   */
  public static function formatSettingValues(array &$build) {
    $settings = $build['#settings'];
    
    /**
     *
     * @var \Drupal\Core\Layout\LayoutDefinition $layout
     */
    $layout = $build['#layout'];
    $regions = $layout->getRegionLabels();
    // dump($settings);
    // on parcourt les elements de settings.
    foreach ($settings as $vals) {
      if (!empty($vals["builder-form"]) && !empty($vals["fields"]) && !empty($vals["info"]['loader']) && $vals["info"]['loader'] == "static") {
        
        // on parcourt les groupes de champs.
        foreach ($vals["fields"] as $regionName => $fields) {
          if (isset($regions[$regionName])) {
            foreach ($fields as $key => $field) {
              // dump($field);
              if (!is_array($field)) {
                throw new \Exception(" Le champs " . $key . " doit avoir un rendu en array value and label, \n ( region : " . $regionName . " )");
              }
              
              if (isset($field['value']) && ($field['value'] !== null && $field['value'] !== ""))
                switch ($key) {
                  case 'text':
                    $build[$regionName][] = [
                      '#type' => 'inline_template',
                      '#template' => $field['value']
                      // '#context' => []
                    ];
                    break;
                  case 'text_html':
                    $build[$regionName][] = [
                      '#type' => 'inline_template',
                      '#template' => $field['value']
                    ];
                    break;
                  case 'text_html_nx':
                    foreach ($field['value'] as $val) {
                      if (!empty($val['value']))
                        $build[$regionName][] = [
                          '#type' => 'inline_template',
                          '#template' => $val['value']
                        ];
                    }
                    break;
                  case 'icon-f':
                    $build[$regionName][] = [
                      '#type' => 'html_tag',
                      '#tag' => 'a',
                      '#attributes' => [
                        'class' => [
                          $field['class']
                        ],
                        'href' => $field['link']
                      ],
                      '#value' => $field['show_text'] ? $field['text'] : null,
                      [
                        '#type' => 'html_tag',
                        '#tag' => 'i',
                        '#attributes' => [
                          'class' => [
                            $field['value']
                          ]
                        ]
                      ]
                    ];
                    break;
                  case 'url':
                    if (!empty($field['value']['text'])) {
                      $options = [];
                      $typeLink = 'internal:';
                      if (!(strpos($field['value']['link'], 'http') === false)) {
                        $typeLink = '';
                        $options['absolute'] = true;
                        $options['external'] = true;
                        $options['attributes']['target'] = 'blank';
                      }
                      $build[$regionName][] = [
                        '#type' => 'link',
                        '#title' => [
                          '#type' => 'inline_template',
                          '#template' => $field['value']['text']
                        ],
                        '#url' => \Drupal\Core\Url::fromUri($typeLink . $field['value']['link'], $options),
                        '#attributes' => [
                          'class' => explode(" ", $field['value']['class'])
                        ]
                      ];
                    }
                    break;
                  default:
                    throw new \Exception("Le champs " . $key . " n'a pas de rendu ");
                    break;
                }
              elseif (!empty($field['fids'])) {
                // le tableau filds peut avoir des doublons.
                $file = File::load($field['fids'][0]);
                $image_style = $field['style'];
                if ($file) {
                  $uri = $file->getFileUri();
                  $renderImg = [
                    '#theme' => 'image_style',
                    '#attributes' => [
                      'class' => [
                        !empty($field['class']) ? $field['class'] : ''
                      ]
                    ],
                    '#uri' => $uri
                  ];
                  if (!empty($image_style) && ImageStyle::load($image_style)) {
                    $renderImg['#style_name'] = $image_style;
                  }
                  else {
                    $renderImg['#theme'] = 'image';
                  }
                  $build[$regionName][] = $renderImg;
                }
              }
            }
            //
          }
        }
      }
    }
  }
  
  public static function addLayoutEditBlock(array &$variables) {
    $route_name = \Drupal::routeMatch()->getRouteName();
    if (\strripos($route_name, "layout_builder.") !== false) {
      $variables['show_region_edit'] = true;
    }
  }
  
  /**
   * Cette fonction permet de supprime le rendu du block;
   *
   * @param array $param
   */
  public static function removeBlock(array $param) {
    // on verifie que le theme est block
    if (!empty($param['#theme']) && $param['#theme'] == 'block') {
      return $param['content'];
    }
    return $param;
  }
  
  /**
   * permet de recuper l'url d'une image ou de tout autre fichier.
   */
  public static function getDatafieldsURL(FieldItemList $items) {
    $files = [];
    foreach ($items->getValue() as $value) {
      if (isset($value['target_id'])) {
        $files[] = self::getImageUrlByFid($value['target_id']);
      }
    }
    return $files;
  }
  
  public static function getImageUrlByFid($fid, $image_style = null) {
    if (!empty($fid)) {
      $file = \Drupal\file\Entity\File::load($fid);
      if ($file) {
        if (!empty($image_style) && \Drupal\image\Entity\ImageStyle::load($image_style)) {
          $img_url = \Drupal\image\Entity\ImageStyle::load($image_style)->buildUrl($file->getFileUri());
        }
        else {
          $img_url = \Drupal::service('file_url_generator')->generateAbsoluteString($file->getFileUri());
        }
        return [
          'img_url' => $img_url
        ];
      }
    }
    return [];
  }
  
  /**
   * permet de recuper les données dans un preprocess Field.
   */
  public static function getDatafields(FieldItemList $items) {
    return $items->getValue();
  }
  
}
