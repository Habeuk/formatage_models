<?php

namespace Drupal\formatage_models\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "formatage_models_example",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("formatage models")
 * )
 */
class ExampleBlock extends BlockBase {
  
  /**
   *
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      '#markup' => $this->t('It works!')
    ];
    return $build;
  }
  
}
