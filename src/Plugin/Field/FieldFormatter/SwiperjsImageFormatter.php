<?php

namespace Drupal\formatage_models\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
// use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\image\Plugin\Field\FieldFormatter\ImageFormatter;
use Drupal\fullswiperoptions\Fullswiperoptions;
use Drupal\Core\Template\Attribute;
use Drupal\Component\Serialization\Json;

/**
 * Plugin implementation of the 'FieldGalleries' formatter.
 *
 * @FieldFormatter(
 *   id = "formatage_models_swiperjsimage",
 *   label = @Translation("Slide by Swiperjs"),
 *   field_types = {
 *     "image"
 *   }
 * )
 */
class SwiperjsImageFormatter extends ImageFormatter {
  
  /**
   *
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'number_image' => '',
      'swiperjs_options' => Fullswiperoptions::options(),
      'pagination_color' => '',
      'pagination_postion' => '',
      'buttons_color' => '',
      'buttons_position' => '',
      'layoutgenentitystyles_view' => 'fullswiperoptions/fullswiperoptions'
    ] + parent::defaultSettings();
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function settingsForm($form, $form_state) {
    $element = parent::settingsForm($form, $form_state);
    $element['layoutgenentitystyles_view'] = [
      '#type' => 'hidden',
      '#value' => 'fullswiperoptions/fullswiperoptions'
    ];
    $element['number_image'] = [
      '#title' => $this->t('Number image'),
      '#type' => 'textfield',
      '#default_value' => $this->getSetting('number_image')
    ];
    Fullswiperoptions::buildGeneralOptionsForm($element, $this->getSettings());
    $swiperjs_options = $this->getSetting('swiperjs_options');
    Fullswiperoptions::buildSwiperjsOptions($element, $swiperjs_options);
    
    return $element;
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = parent::viewElements($items, $langcode);
    $numberImages = (int) $this->getSetting('number_image');
    $swiperjs_options = $this->getSetting('swiperjs_options');
    $swiperjs_options = Fullswiperoptions::formatOptions($swiperjs_options);
    if (!empty($elements)) {
      if (!empty($numberImages)) {
        if ($numberImages == 1)
          return $elements[0];
        $elements = array_slice($elements, 0, $numberImages);
      }
      // add class for each item.
      $item_attributes = new Attribute();
      $item_attributes->addClass('swiper-slide');
      foreach ($elements as &$element) {
        $element['#attributes'] = $item_attributes;
      }
      $wrappers_attributes = new Attribute();
      $wrappers_attributes->addClass('swiper', 'swiper-full-options', $items->getEntity()->getEntityTypeId(), $items->getName());
      $wrappers_attributes->setAttribute('data-swiper', Json::encode($swiperjs_options));
      //
      $swipper_attributes_paginations = new Attribute();
      $swipper_attributes_paginations->addClass('swiper-pagination', $this->getSetting('pagination_color'), $this->getSetting('pagination_postion'));
      //
      $swipper_attributes_buttons_prev = new Attribute();
      $swipper_attributes_buttons_prev->addClass('swiper-button', 'swiper-button-prev', $this->getSetting('buttons_color'), $this->getSetting('buttons_position'));
      //
      $swipper_attributes_buttons_next = new Attribute();
      $swipper_attributes_buttons_next->addClass('swiper-button', 'swiper-button-next', $this->getSetting('buttons_color'), $this->getSetting('buttons_position'));
      //
      return [
        '#theme' => 'formatage_models_swiperjsimage',
        '#items' => $elements,
        '#swiperjs_options' => $swiperjs_options,
        '#wrappers_attributes' => $wrappers_attributes,
        '#swipper_attributes_paginations' => $swipper_attributes_paginations,
        '#swipper_attributes_buttons_next' => $swipper_attributes_buttons_next,
        '#swipper_attributes_buttons_prev' => $swipper_attributes_buttons_prev
      ];
    }
    
    return $elements;
  }
  
}
