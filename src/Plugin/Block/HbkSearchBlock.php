<?php

namespace Drupal\formatage_models\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\search\Form\SearchBlockForm;
use Drupal\search\SearchPageRepositoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\search\Plugin\Block\SearchBlock;

/**
 * Provides a 'Search form' block.
 *
 * @Block(
 *   id = "hbk_search_form_block",
 *   admin_label = @Translation("Hbk Search form"),
 *   category = @Translation("Forms")
 * )
 */
class HbkSearchBlock extends SearchBlock {
    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration() {
        return [
            'page_id' => '',
            'template' => 'default_template'
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function build() {
        $page = $this->configuration['page_id'] ?? NULL;
        $form = $this->formBuilder->getForm(SearchBlockForm::class, $page);
        // $form["#theme"][0] = "hbk_search_block_form";
        dump($form);
        return [
            "#theme" => "my_custom_theme",
            "content" => $form,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state) {
        $this->configuration['page_id'] = $form_state->getValue('page_id');
        $this->configuration['template'] = $form_state->getValue('template');
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {
        $form = parent::blockForm($form, $form_state);
        $form["page_id"]["#default_value"] = $this->configuration["page_id"];

        $options = [
            "default_template" => $this->t("Default Template"),
            "submit_in_field" => $this->t("Submit in field")
        ];
        $form["template"] = [
            "#type" => "select",
            "#title" => $this->t("Search Block Template"),
            "#description" => $this->t("Template that will render the search form"),
            "#default_value" => $this->configuration["template"] ?? $options["default_template"],
            "#options" => $options
        ];
        return $form;
    }
}
