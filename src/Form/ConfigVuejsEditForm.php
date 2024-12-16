<?php

namespace Drupal\formatage_models\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConfigVuejsEditForm.
 */
class ConfigVuejsEditForm extends ConfigFormBase {
  
  /**
   *
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'formatage_models.configvuejsedit'
    ];
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'config_vuejs_edit_form';
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('formatage_models.configvuejsedit');
    $form['active_edit_config'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('active edit config'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('active_edit_config')
    ];
    
    $form['entities_use_vuejs_edit'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('active edit config'),
      '#size' => 64,
      '#default_value' => $config->get('entities_use_vuejs_edit'),
      '#options' => $this->getEntitiesTypes()
    ];
    
    return parent::buildForm($form, $form_state);
  }
  
  protected function getEntitiesTypes() {
    $entities = [];
    $definitions = \Drupal::entityTypeManager()->getDefinitions();
    foreach ($definitions as $entity_type_id => $definition) {
      if ($definition->getBaseTable()) {
        $entities[$entity_type_id] = $definition->getLabel() . " (" . $entity_type_id . ")";
      }
    }
    return $entities;
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $config = $this->config('formatage_models.configvuejsedit');
    $config->set('active_edit_config', $form_state->getValue('active_edit_config'));
    $config->set('entities_use_vuejs_edit', $form_state->getValue('entities_use_vuejs_edit'));
    $config->save();
  }
}
