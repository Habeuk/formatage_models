<?php

namespace Drupal\formatage_models\Controller;

use Drupal\Core\Controller\ControllerBase;
use Stephane888\DrupalUtility\HttpResponse;
use Stephane888\Debug\ExceptionDebug;
use Stephane888\Debug\ExceptionExtractMessage;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Url;

/**
 * Returns responses for formatage models routes.
 */
class FormatageModelsController extends ControllerBase {
  
  /**
   * Le clonnage dans un environnement complexe peut prendre assez de temps.
   * du coup, il faut le faire en plusieurs etape.
   *
   * @param string $entity_type_id
   * @param integer $id
   */
  public function CloneEntity($entity_type_id, $id, $etatpe = 'init', $clone_id = 'none') {
    /**
     *
     * @var \Drupal\Core\Config\Entity\ConfigEntityBase $entity
     */
    $entity = $this->entityTypeManager()->getStorage($entity_type_id)->load($id);
    $bundle = $entity->getEntityType()->getBundleOf();
    if (!$bundle) {
      $bundle = $entity_type_id;
    }
    /**
     * On clone l'entite de configuration de base.
     */
    if ($etatpe == 'init') {
      $rdKey = rand(1, 999);
      if (str_contains($id, 'cln_')) {
        $ar = explode("_", $id);
        $ar[1] = $rdKey;
        $cloneId = implode("_", $ar);
      }
      else
        $cloneId = 'cln_' . $rdKey . '_' . $id;
      $cloneEntity = $this->entityTypeManager()->getStorage($entity_type_id)->load($cloneId);
      if (!$cloneEntity) {
        $this->messenger()->addStatus("Duplication de la configuration de base");
        $cloneEntity = $entity->createDuplicate();
        $cloneEntity->label();
        $cloneEntity->set('label', $cloneEntity->label() . ' (Clone - ' . $rdKey . ')');
        $cloneEntity->set('id', $cloneId);
        $cloneEntity->save();
        /**
         * Creation du formualire.
         */
        $query = $this->entityTypeManager()->getStorage('entity_form_display')->getQuery();
        $query->condition('bundle', $id);
        $query->condition('targetEntityType', $bundle);
        $ids = $query->execute();
        if ($ids) {
          $entitiesForms = $this->entityTypeManager()->getStorage('entity_form_display')->loadMultiple($ids);
          foreach ($entitiesForms as $entityForm) {
            /**
             *
             * @var \Drupal\Core\Entity\Entity\EntityFormDisplay $CloneEntityForm
             */
            $CloneEntityForm = $entityForm->createDuplicate();
            $CloneEntityForm->set('bundle', $cloneId);
            $CloneEntityForm->save();
          }
        }
        return [
          '#type' => 'link',
          '#title' => t('Next 2/3'),
          '#url' => Url::fromRoute("formatage_models.clone_entity", [
            'entity_type_id' => $entity_type_id,
            'id' => $id,
            'etatpe' => 'fields',
            'clone_id' => $cloneId
          ], [
            'query' => \Drupal::destination()->getAsArray()
          ]),
          '#options' => [
            'attributes' => [
              'class' => []
            ]
          ]
        ];
      }
      $this->messenger()->addStatus("L'entite existe deja");
      return [];
    }
    /**
     * Cette etape doit pouvoir resprendre si une erreur se produit.
     */
    elseif ($etatpe == 'fields') {
      $this->messenger()->addStatus("Duplication des champs");
      /**
       * Creation des champs.
       */
      $query = $this->entityTypeManager()->getStorage('entity_form_display')->getQuery();
      $query->condition('bundle', $id);
      $query->condition('targetEntityType', $bundle);
      $ids = $query->execute();
      if ($ids) {
        $entitiesForms = $this->entityTypeManager()->getStorage('entity_form_display')->loadMultiple($ids);
        foreach ($entitiesForms as $entityForm) {
          /**
           * On cree les champs.
           */
          $fields = $entityForm->get('content');
          foreach ($fields as $fieldName => $value) {
            $cloneFieldConfig = $this->entityTypeManager()->getStorage('field_config')->load($bundle . '.' . $clone_id . '.' . $fieldName);
            if (!$cloneFieldConfig) {
              /**
               *
               * @var \Drupal\field\Entity\FieldConfig $FieldConfig
               */
              $FieldConfig = $this->entityTypeManager()->getStorage('field_config')->load($bundle . '.' . $id . '.' . $fieldName);
              if ($FieldConfig) {
                $cloneFieldConfig = $FieldConfig->createDuplicate();
                $cloneFieldConfig->set('bundle', $clone_id);
                $cloneFieldConfig->save();
              }
            }
          }
        }
      }
      return [
        '#type' => 'link',
        '#title' => t('Next 3/3'),
        '#url' => Url::fromRoute("formatage_models.clone_entity", [
          'entity_type_id' => $entity_type_id,
          'id' => $id,
          'etatpe' => 'display',
          'clone_id' => $clone_id
        ], [
          'query' => \Drupal::destination()->getAsArray()
        ]),
        '#options' => [
          'attributes' => [
            'class' => []
          ]
        ]
      ];
    }
    elseif ($etatpe == 'display') {
      $this->messenger()->addStatus("Duplication des affichages");
      /**
       * Creation de l'affichage.
       */
      $query = $this->entityTypeManager()->getStorage('entity_view_display')->getQuery();
      $query->condition('bundle', $id);
      $query->condition('targetEntityType', $bundle);
      $ids = $query->execute();
      // On cree les differents modes d'affichage.
      if ($ids) {
        $entitiesViews = $this->entityTypeManager()->getStorage('entity_view_display')->loadMultiple($ids);
        foreach ($entitiesViews as $entityView) {
          /**
           *
           * @var \Drupal\layout_builder\Entity\LayoutBuilderEntityViewDisplay $CloneEntityView
           */
          $CloneEntityView = $entityView->createDuplicate();
          $CloneEntityView->set('bundle', $clone_id);
          $CloneEntityView->save();
        }
      }
      /**
       *
       * @var \Drupal\Core\Config\Entity\ConfigEntityBase $cloneEntity
       */
      $cloneEntity = $this->entityTypeManager()->getStorage($entity_type_id)->load($clone_id);
      return [
        '#type' => 'link',
        '#title' => t('Edit new entity'),
        '#url' => $cloneEntity->toUrl('edit-form', [
          'query' => \Drupal::destination()->getAsArray()
        ]),
        '#options' => [
          'attributes' => [
            'class' => []
          ]
        ]
      ];
    }
    return [];
  }
  
  /**
   * Cree les nouveaux entitées et duplique les entites existant.
   *
   * @param Request $Request
   * @param string $entity_type_id
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   */
  public function SaveEntity(Request $Request, $entity_type_id) {
    $entity_type = $this->entityTypeManager()->getStorage($entity_type_id);
    $values = Json::decode($Request->getContent());
    //
    if ($entity_type && !empty($values)) {
      try {
        /**
         */
        $entity = $entity_type->create($values);
        if ($entity->id()) {
          $OldEntity = $this->entityTypeManager()->getStorage($entity_type_id)->load($entity->id());
          if (!empty($OldEntity)) {
            foreach ($values as $k => $value) {
              $OldEntity->set($k, $value);
            }
            $OldEntity->save();
            return HttpResponse::response($OldEntity->toArray());
          }
        }
        else {
          $entity->save();
          return HttpResponse::response($entity->toArray());
        }
        throw new \Exception("Erreur d'execution");
      }
      catch (\Exception $e) {
        $user = \Drupal::currentUser();
        $errors = ExceptionExtractMessage::errorAllToString($e);
        $errors .= '<br> error create : ' . $entity_type_id;
        $errors .= '<br> current user id : ' . $user->id();
        $this->getLogger('formatage_models')->critical($e->getMessage() . '<br>' . $errors);
        return HttpResponse::response(ExceptionExtractMessage::errorAll($e), 400, $e->getMessage());
      }
    }
    else {
      $this->getLogger('formatage_models')->critical(" impossible de creer l'entité : " . $entity_type_id);
      return HttpResponse::response([], 400, "erreur inconnu");
    }
  }
  
}
