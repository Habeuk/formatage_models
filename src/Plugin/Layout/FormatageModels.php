<?php

namespace Drupal\formatage_models\Plugin\Layout;

use Drupal\Core\Layout\LayoutDefault;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\bootstrap_styles\StylesGroup\StylesGroupManager;
use Drupal\Component\Utility\NestedArray;

/**
 * default class for module layout module
 *
 * @author stephane
 *        
 */
class FormatageModels extends LayoutDefault {
  
  /**
   * The layouts services from formatage_models.
   *
   * @var \Drupal\formatage_models\Services\Layouts
   */
  protected $Layouts;
  
  /**
   * The styles group plugin manager.
   *
   * @var \Drupal\bootstrap_styles\StylesGroup\StylesGroupManager
   */
  protected $stylesGroupManager;
  
  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;
  
  /**
   * Contient la configuration globale, avec les configuration par domaine.
   *
   * @var array
   */
  protected $globalConfiguration = [];
  
  /**
   * permet de recuperation la config en function du domaine, si elle existe.
   * Si ce paramettre est definie alors les données sont enregistrées en
   * function du domaine.
   *
   * @var array
   */
  protected $subConfiguration = null;
  
  /**
   * Le fait que le domaine existe, n'entrainne pas que les données vont etre
   * enregistrer en function de ce dernier.
   *
   * @var String
   */
  protected $currentDomain = null;
  
  /**
   *
   * @var \Drupal\Core\Extension\ExtensionPathResolver
   */
  protected $pathResolver;
  
  /**
   *
   * @var \Drupal\layout_custom_style\StyleScssPluginManager
   */
  protected $StyleScssPluginManager;
  
  /**
   *
   * @var string
   */
  protected $moduleLayoutstyleExistExit = NULL;
  
  /**
   * Contient l'url relative de l'image.
   * (begin with le slash, example : "/icones/card-model.png" ).
   *
   * @var string
   */
  protected $image_icon_url = NULL;
  
  /**
   *
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    // $this->Layouts = $Layouts;
    $this->Layouts = \Drupal::service('formatage_models.layouts');
    /**
     *
     * @var \Drupal\Core\Extension\ExtensionPathResolver $pathResolver
     */
    $this->pathResolver = \Drupal::service('extension.path.resolver');
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    // on ne modifie pas la configuration à ce stade, car cela pourra avoir des
    // comportements imprevisible.
    // on va le modifier lors de la constrction du layout et lors de la
    // construction du formulaire.
    $this->globalConfiguration = $this->configuration;
    if (\Drupal::moduleHandler()->moduleExists('wbumenudomain')) {
      $this->currentDomain = \Drupal\wbumenudomain\Wbumenudomain::getCurrentdomain();
      // On doit avoir une sauvegarde de la config en function du domaine, //et
      // cette sauvegarde doit bien specier de l'utiliser via([save_by_domain])
      // cette approche ne permet pas de revenir en arriere. ( ce qui n'est pas
      // forcement mauvais ).// à revoir plus tard.
      if (!empty($this->configuration[$this->currentDomain]) && $this->configuration['save_by_domain']) {
        // $this->messenger()->addStatus($plugin_id . ' chargé à partir du sous
        // domaine ' . $this->currentDomain);
        $this->subConfiguration = $this->configuration[$this->currentDomain];
        $this->Layouts->setConfig($this->subConfiguration);
      }
      else
        $this->Layouts->setConfig($this->configuration);
    }
    else
      $this->Layouts->setConfig($this->configuration);
    $this->Layouts->setRegions($this->getPluginDefinition()->getRegions());
    //
    if ($this->checkModuleLayoutstyleExist()) {
      /**
       * Il ya beaucoup de service qui implemente cette class( Pour mettre à
       * jour
       * l'icone), donc injecte un nouveau service cela va exigé qu'on modifie
       * beaucoup de session.
       * il faut une fonction dans la class parente qui permet de mettre à jour
       * l'image et qui appelle le construct parent. cette fonction devrait
       * avoir un alert pour les layouts ne disposant pas d'image.
       * for branch 4x.
       *
       * @var \Drupal\formatage_models\Plugin\Layout\Sections\FormatageModelsSection $StyleScssPluginManager
       */
      $this->StyleScssPluginManager = \Drupal::service('plugin.manager.style_scss');
      //
      $this->setImageUrlLayout();
    }
  }
  
  /**
   * Permet de definir l'image de l'url.
   * Elle evite qu'on soit obliger de redefinir la __construct ailleur , car
   * cela rend complique l'utilisation de l'injection des dependances.
   * Nb: vous devez definir: protected $image_icon_url = NULL;
   *
   * @param string $url
   *        begin with /
   */
  protected function setImageUrlLayout() {
    if ($this->image_icon_url)
      $this->pluginDefinition->set('icon', $this->pathResolver->getPath('module', 'layoutscommerce') . $this->image_icon_url);
  }
  
  protected function checkModuleLayoutstyleExist() {
    if ($this->moduleLayoutstyleExistExit === NULL) {
      $this->moduleLayoutstyleExistExit = \Drupal::moduleHandler()->moduleExists('layout_custom_style');
    }
    return $this->moduleLayoutstyleExistExit;
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    $regions = $this->getPluginDefinition()->getRegions();
    $regions_css = [];
    foreach ($regions as $region => $label) {
      $regions_css['region_css_' . $region] = '';
    }
    
    return $regions_css + parent::defaultConfiguration() + $this->Layouts->defaultConfiguration();
  }
  
  /**
   * Renvoit la configuration Globale.
   * NB: Cette function peut etre utiliser par d'autres modules afin de
   * recuperer la configuration.
   *
   * @return array
   */
  public function getConfiguration() {
    return parent::getConfiguration();
  }
  
  /**
   * Si le contenu est MAJ par l'utilisateur, on doit mettre egalment celui
   * present dans l'objet Layouts.
   * ( seul les données present dans le formulaire seront enregistrées en BD,
   * donc si on charge le plugin à partir de la BD uniquement, on aurra pas
   * toutes les données,
   * pareil si on initialise le plugin ).
   * Cette function a été testé pour le cas ou on initialise la plugin, puis on
   * charge les donnnées et on merge.
   *
   * {@inheritdoc}
   */
  public function setConfiguration(array $configuration) {
    parent::setConfiguration($configuration);
    //
    $this->Layouts->setConfig($configuration);
  }
  
  /**
   *
   * @return array
   */
  public function getSubConfiguration() {
    return $this->subConfiguration;
  }
  
  /**
   *
   * @return array
   */
  public function setSubConfiguration($configuration) {
    $this->subConfiguration = $configuration;
    $this->Layouts->setConfig($configuration);
  }
  
  /**
   * On ne doit pas importer les librairies de maniere brute.
   * ( de ce fait on masque parent::build($regions)).
   *
   * {@inheritdoc}
   */
  public function build(array $regions) {
    // Ensure $build only contains defined regions and in the order defined.
    // $build = parent::build($regions);
    $build = [];
    foreach ($this->getPluginDefinition()->getRegionNames() as $region_name) {
      if (array_key_exists($region_name, $regions)) {
        $build[$region_name] = $regions[$region_name];
      }
    }
    $build['#settings'] = $this->getConfiguration();
    $build['#layout'] = $this->pluginDefinition;
    $build['#theme'] = $this->pluginDefinition->getThemeHook();
    // classes and attributes.
    if (!isset($build['#attributes']['class'])) {
      $build['#attributes']['class'] = [];
    }
    $build['#attributes']['class'][] = 'layout';
    
    if ($this->checkModuleLayoutstyleExist()) {
      $this->StyleScssPluginManager->build($build, $this->configuration);
    }
    return $build;
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    // NB : on change la valeur de configuration à ce stade, pour que le ou les
    // formuailes parent puissent avoir les bonnes valeurs.
    if ($this->subConfiguration) {
      $this->configuration = $this->subConfiguration;
    }
    
    $form = parent::buildConfigurationForm($form, $form_state);
    $label = $this->getPluginDefinition()->getLabel() . ' ( ' . $this->getBaseId() . ' ) ';
    if (empty($this->configuration['label']) || $this->configuration['label'] == $this->getBaseId()) {
      $form['label']['#default_value'] = $label;
    }
    else {
      $form['label']['#default_value'] = $this->configuration['label'];
    }
    
    $this->Layouts->buildConfigurationForm($form);
    
    if ($this->checkModuleLayoutstyleExist()) {
      $this->StyleScssPluginManager->buildConfiguration($form, $form_state, $this->configuration);
    }
    return $form;
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function validateConfigurationForm(array &$form, FormStateInterface $form_state) {
    //
  }
  
  /**
   *
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    // $db = [
    // '$globalConfiguration' => $this->globalConfiguration,
    // '$configuration' => $this->configuration
    // ];
    if ($this->subConfiguration) {
      $this->configuration = $this->subConfiguration;
    }
    parent::submitConfigurationForm($form, $form_state);
    $this->Layouts->submitConfigurationForm($this->configuration, $form_state);
    // $db['Layouts $configuration'] = $this->configuration;
    // On applique la configuration actuele ( $this->configuration) à la
    // configuration globale ($this->configuration).
    // puis on retourne la configuration;
    if ($this->subConfiguration) {
      if (!empty($this->globalConfiguration[$this->currentDomain])) {
        $this->globalConfiguration[$this->currentDomain] = $this->configuration;
        $this->configuration = $this->globalConfiguration;
      }
    }
    // Cas ou on ajoute une configuration pour un domaine.
    elseif (!empty($this->configuration['save_by_domain']) && $this->currentDomain) {
      // $this->messenger()->addStatus($this->currentDomain . ': ajout de la
      // config ', true);
      $this->configuration[$this->currentDomain] = $this->removeAnotherDomainId($this->configuration);
      // $this->configuration[$this->currentDomain] = $this->configuration;
    }
    // $db['end $globalConfiguration'] = $this->globalConfiguration;
    // $db['end $configuration'] = $this->configuration;
    // dump($db);
    //
    // On sauvegarde la valeur du style.
    if ($this->checkModuleLayoutstyleExist()) {
      $this->StyleScssPluginManager->submitConfigurationForm($form, $form_state, $this->configuration);
    }
  }
  
  /**
   * Permet de supprimer les enregistrement de domaine dans un sous
   * enregistrement.
   *
   * @param array $Conf
   */
  protected function removeAnotherDomainId(array $Conf) {
    $hostNames = \Drupal\wbumenudomain\Wbumenudomain::getAlldomaines();
    foreach ($hostNames as $k => $value) {
      if (isset($Conf[$k])) {
        // $this->messenger()->addStatus($k . ' config delete ', true);
        unset($Conf[$k]);
      }
    }
    return $Conf;
  }
}