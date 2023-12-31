<?php

namespace Drupal\formatage_models\Twig\Extension;

use Drupal\Core\Render\Element;
use Drupal\Core\TypedData\TypedDataInterface;
use Drupal\formatage_models\FormatageModelsTwigImg;
use Drupal\formatage_models\FormatageModelsTwigBgImage;
use Drupal\formatage_models\ManageStyleCss;
use Drupal\formatage_models\ArrayElements;
use Twig\Extension\AbstractExtension;

/**
 * Creation d'une extention pour twig.
 * https://twig.symfony.com/doc/2.x/advanced.html#creating-an-extension
 *
 * @author stephane
 *        
 */
class LayoutValueExtension extends AbstractExtension {
  
  use FormatageModelsTwigImg;
  use FormatageModelsTwigBgImage;
  use ManageStyleCss;
  use ArrayElements;
  
  /**
   *
   * {@inheritdoc}
   * @see \Twig\Extension\AbstractExtension::getFunctions()
   */
  public function getFunctions() {
    return [
      new \Twig\TwigFunction('load_block_content', [
        $this,
        'LoadBlockContent'
      ])
    ];
  }
  
  /**
   *
   * @param integer $block_id
   * @return NULL
   */
  public function LoadBlockContent($block_id) {
    $block_content = null;
    $block = \Drupal\block_content\Entity\BlockContent::load($block_id);
    if (!empty($block))
      $block_content = \Drupal::entityTypeManager()->getViewBuilder('block_content')->view($block);
    return $block_content;
  }
  
  /**
   * On charge les filtres.
   * on peut utiliser \Twig\TwigFilter ou \Twig_SimpleFilter
   *
   * {@inheritdoc}
   */
  public function getFilters() {
    return [
      new \Twig\TwigFilter('field_raw', [
        $this,
        'getFieldRawValues'
      ]),
      new \Twig\TwigFilter('field_value', [
        $this,
        'getFieldValue'
      ]),
      new \Twig\TwigFilter('layout_raw', [
        $this,
        'getLayoutRawValues'
      ]),
      new \Twig\TwigFilter('layout_value', [
        $this,
        'getLayoutValues'
      ]),
      new \Twig\TwigFilter('has_value', [
        $this,
        'hasLayoutValues'
      ]),
      /**
       * Permet de recuperer un ou un enssemble d'image;
       *
       * @see Drupal\formatage_models\FormatageModelsTwigImg
       */
      new \Twig\TwigFilter('layout_value_img', [
        $this,
        'getLayoutValuesImg'
      ]),
      /**
       * Permet de recuperer un ou un enssemble d'image;
       *
       * @see Drupal\formatage_models\FormatageModelsTwigBgImage
       */
      new \Twig\TwigFilter('layout_bg_img', [
        $this,
        'getLayoutBgImage'
      ]),
      // Le layout permet deja de rendre l'elment et l'element parent, il faut
      // voir au niveau du rendu du terme.
      new \Twig\TwigFilter('layout_terms_value', [
        $this,
        'getLayoutTermsValues'
      ]),
      // add style css
      new \Twig\TwigFilter('add_style_css', [
        $this,
        'addStyleCss'
      ]),
      new \Twig\TwigFilter('array_elements', [
        $this,
        'getElements'
      ])
    ];
  }
  
  public function getLayoutTermsValues(array $build, $keySearch = null) {
    $vals = [];
    $key = 0;
    foreach ($build as $value) {
      if (is_array($value) && !empty($value)) {
        if (!empty($value['#theme']) && $value['#theme'] == 'block' && !empty($value['content'])) {
          if ($keySearch !== null) {
            if ($key === $keySearch) {
              return $this->getFieldValueTerms($value['content'], $keySearch);
            }
          }
          else {
            $vals[] = $this->getFieldValueTerms($value['content']);
          }
        }
      }
      $key++;
    }
    return $vals;
  }
  
  /**
   * Renvoit une valeur qui a été formaté ou null au cas contraire.
   *
   * @param array $build
   * @param string $keySearch
   * @return array
   */
  public function getLayoutValues($build, $keySearch = null) {
    $vals = [];
    // La condifition sur layout_builder_add_block permet un affichage par
    // defaut si on est en administration.
    if (is_array($build) && !isset($build['layout_builder_add_block'])) {
      foreach ($build as $key => $value) {
        
        if (is_array($value) && !empty($value)) {
          if (!empty($value['#theme']) && $value['#theme'] == 'block' && !empty($value['content'])) {
            if ($keySearch !== null) {
              if ($key === $keySearch) {
                return $this->getFieldValue($value['content'], $keySearch);
              }
            }
            // si on a un rendu retarder, on l'ignore.
            elseif (isset($value['content']['#lazy_builder'])) {
              $vals[$key] = $value;
            }
            else {
              $vals[] = $this->getFieldValue($value['content']);
            }
          }
          else {
            // la clee est important, car certains elments comme #attributes ne
            // doivent pas etre rendu.
            $vals[$key] = $value;
          }
        }
      }
    }
    else
      return $build;
    return $vals;
  }
  
  /**
   * verifie si le contenus dispose d'une valeur.
   * Retoune true si l'element n'est pas vide et false sinon.
   */
  public function hasLayoutValues($build) {
    $hasValue = false;
    if (is_array($build)) {
      if ($kyes = Element::children($build)) {
        foreach ($kyes as $key) {
          // on doit ignorer si le contenu est juste #cache ( mais reste à
          // verifier pour les sites en mode prod).
          if (!empty($build[$key])) {
            $data = $build[$key];
            if (count($data) == 1 && isset($data['#cache'])) {
              $hasValue = false;
            }
            else {
              $hasValue = true;
              break;
            }
          }
        }
      }
    }
    return $hasValue;
  }
  
  public function getLayoutRawValues($build, $keySearch = null) {
    $vals = [];
    $key = 0;
    if (!is_array($build))
      return null;
    foreach ($build as $value) {
      if (is_array($value) && !empty($value)) {
        if (!empty($value['#theme']) && $value['#theme'] == 'block' && !empty($value['content'])) {
          if ($keySearch !== null) {
            if ($key === $keySearch) {
              return $this->getFieldRawValues($value['content'], $keySearch);
            }
          }
          else {
            $vals[] = $this->getFieldRawValues($value['content']);
          }
        }
      }
      $key++;
    }
    return $vals;
  }
  
  /**
   * Twig filter callback: Return specific field item(s) value.
   *
   * @param array|null $build
   *        Render array of a field.
   * @param string $key
   *        The name of the field value to retrieve.
   *        
   * @return array|null Single field value or array of field values. If the
   *         field value is not
   *         found, null is returned.
   */
  public function getFieldRawValues($build, $key = '') {
    if (!$this->isFieldRenderArray($build)) {
      return NULL;
    }
    if (!isset($build['#items']) || !($build['#items'] instanceof TypedDataInterface)) {
      return NULL;
    }
    
    $item_values = $build['#items']->getValue();
    if (empty($item_values)) {
      return NULL;
    }
    
    $raw_values = [];
    foreach ($item_values as $delta => $values) {
      if ($key === $delta) {
        return $values;
      }
      else {
        $raw_values[$delta] = $values;
      }
    }
    return $raw_values;
  }
  
  /**
   * Twig filter callback: Only return a field's value(s).
   *
   * @param array|null $build
   *        Render array of a field.
   *        
   * @return array Array of render array(s) of field value(s). If $build is not
   *         the render
   *         array of a field, NULL is returned.
   */
  public function getFieldValue($build) {
    if (!$this->isFieldRenderArray($build)) {
      if (!empty($build)) {
        // On commente pour le moment, car je ne vois pas l'interer de tester ce
        // qui y est, puisque on retourne $build.
        // // si c'est un rendu avec #type
        // $test = reset($build);
        // if (is_array($test)) {
        // if (!empty($test['#type'])) {
        // return $build;
        // }
        // elseif (isset($build['#theme']) || isset($build['#type'])) {
        // return $build;
        // }
        // }
        // /**
        // * Les elements de types blockContent renvoit un object.
        // * Une raison supplemenataire d'eviter d'utiliser blockContent.
        // */
        // else {
        // return $build;
        // }
        return $build;
      }
      return NULL;
    }
    
    $elements = Element::children($build);
    if (empty($elements)) {
      return NULL;
    }
    
    $items = [];
    foreach ($elements as $delta) {
      $items[$delta] = $build[$delta];
    }
    return $items;
  }
  
  public function getFieldValueTerms($build) {
    if (!$this->isFieldRenderArray($build)) {
      return NULL;
    }
    
    $elements = Element::children($build);
    if (empty($elements)) {
      return NULL;
    }
    if ($build['#items'] instanceof \Drupal\Core\Field\EntityReferenceFieldItemList) {
      $target_ids = $this->getParentTerms($build['#items']);
      $parents = [];
      foreach ($target_ids as $key => $value) {
        $parent = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadParents($value['target_id']);
        foreach ($parent as $value) {
          $parents[$key][] = \Drupal::entityTypeManager()->getViewBuilder('taxonomy_term')->view($value, 'full');
        }
      }
    }
    $items = [];
    foreach ($elements as $delta) {
      $items[$delta]['term'] = $build[$delta];
      if (!empty($parents[$delta]))
        $items[$delta]['parent'] = $parents[$delta];
    }
    return $items;
  }
  
  function getParentTerms(\Drupal\Core\Field\EntityReferenceFieldItemList $items) {
    return $items->getValue();
  }
  
  /**
   * Checks whether the render array is a field's render array.
   *
   * @param array|null $build
   *        The render array.
   *        
   * @return bool True if $build is a field render array.
   */
  protected function isFieldRenderArray($build) {
    // Drupal 10.
    if (isset($build[0]['#theme']) && $build[0]['#theme'] == 'field') {
      return 'field';
    }
    // Drupal 9
    if (isset($build['#theme']) && $build['#theme'] == 'field') {
      return 'field';
    }
  }
  
}
