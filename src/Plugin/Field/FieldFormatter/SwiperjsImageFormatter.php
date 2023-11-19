
<?php

namespace Drupal\formatage_models\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
// use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\image\Plugin\Field\FieldFormatter\ImageFormatter;

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
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = parent::viewElements($items, $langcode);
    
    return $elements;
  }
  
}
