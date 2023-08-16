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
    return parent::buildForm($form, $form_state);
  }

  /**
   *
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('formatage_models.configvuejsedit')->set('active_edit_config', $form_state->getValue('active_edit_config'))->save();
  }

}
