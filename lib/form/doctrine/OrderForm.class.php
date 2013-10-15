<?php

/**
 * Order form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Anatoly Pashin
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OrderForm extends BaseOrderForm
{
  public function configure()
  {
    unset (
      $this['created_at'],
      $this['updated_at'],
      $this['created_by'],
      $this['updated_by'],
      $this['deleted_at'],
      $this['payed_at'],
      $this['version']
    );

    $utilizationsRelation = array('Utilizations' => array(
      'considerNewFormEmptyFields'    => array('material_id', 'amount'),
      'noNewForm'                     => false,
      // 'noNewForm'                     => true,
      'newFormLabel'                  => 'Новый выпрос',
      'newFormClass'                  => 'UtilizationForm',
      'newFormClassArgs'              => array(array('sf_user' => $this->getOption('sf_user'))),
      'displayEmptyRelations'         => true,
      'formClass'                     => 'UtilizationForm',
      'formClassArgs'                 => array(array('ah_add_delete_checkbox' => true)),
      'newFormAfterExistingRelations' => true,
      'formFormatter'                 => null,
      'multipleNewForms'              => true,
      'newFormsInitialCount'          => 1,
      'newFormsContainerForm'         => null, // pass BaseForm object here or we will create ahNewRelationsContainerForm
      'newRelationButtonLabel'        => '+',
      'newRelationAddByCloning'       => true,
      'newRelationUseJSFramework'     => 'jQuery',
      // 'customEmbeddedFormLabelMethod' => 'getLabelTitle'
    ));

    $invoicesRelation = array('Invoices' => array(
      'considerNewFormEmptyFields'    => array('description', 'number', 'price', 'sum'),
      'noNewForm'                     => false,
      // 'noNewForm'                     => true,
      'newFormLabel'                  => 'Новый выпрос',
      'newFormClass'                  => 'InvoiceForm',
      'newFormClassArgs'              => array(array('sf_user' => $this->getOption('sf_user'))),
      'displayEmptyRelations'         => true,
      'formClass'                     => 'InvoiceForm',
      'formClassArgs'                 => array(array('ah_add_delete_checkbox' => true)),
      'newFormAfterExistingRelations' => true,
      'formFormatter'                 => null,
      'multipleNewForms'              => true,
      'newFormsInitialCount'          => 1,
      'newFormsContainerForm'         => null, // pass BaseForm object here or we will create ahNewRelationsContainerForm
      'newRelationButtonLabel'        => '+',
      'newRelationAddByCloning'       => true,
      'newRelationUseJSFramework'     => 'jQuery',
      // 'customEmbeddedFormLabelMethod' => 'getLabelTitle'
    ));

    $paysRelation = array('Pays' => array(
      'considerNewFormEmptyFields'    => array('payed_at', 'amount'),
      'noNewForm'                     => false,
      // 'noNewForm'                     => true,
      'newFormLabel'                  => 'Новый выпрос',
      'newFormClass'                  => 'PayForm',
      'newFormClassArgs'              => array(array('sf_user' => $this->getOption('sf_user'))),
      'displayEmptyRelations'         => true,
      'formClass'                     => 'PayForm',
      'formClassArgs'                 => array(array('ah_add_delete_checkbox' => true)),
      'newFormAfterExistingRelations' => true,
      'formFormatter'                 => null,
      'multipleNewForms'              => true,
      'newFormsInitialCount'          => 1,
      'newFormsContainerForm'         => null, // pass BaseForm object here or we will create ahNewRelationsContainerForm
      'newRelationButtonLabel'        => '+',
      'newRelationAddByCloning'       => false,
      'newRelationUseJSFramework'     => 'jQuery',
      // 'customEmbeddedFormLabelMethod' => 'getLabelTitle'
    ));

    $user = sfContext::getInstance()->getUser();
    $this->embedRelations(array_merge(
      $user->hasCredential('can_spend_materials') ? $utilizationsRelation : [],
      $user->hasGroup('master') ? [] : $invoicesRelation,
      $user->hasCredential('director') || $user->hasCredential('buhgalter') ? $paysRelation : []
    ));

    $this->getWidgetSchema()
      ->offsetSet('client_id', new sfWidgetFormDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Client'),
        'add_empty' => false,
        'order_by' => array(
          'name',
          'asc',
        ),
        'method' => 'getNameWithDiscount',
      ), array(
        'class' => 'chzn-select makePizdatoWithDiscount',
      )))
      ->offsetSet('state', new sfWidgetFormChoice(array(
        'choices' => OrderTable::$states,
      )))
      ->offsetSet('area', new sfWidgetFormChoice(array(
        'choices' => OrderTable::$area,
      )))
      ->offsetSet('due_date', new sfWidgetFormBootstrapDateTime())
      ->offsetSet('approved_at', new sfWidgetFormBootstrapDate())
      ->offsetSet('expected_at', new sfWidgetFormBootstrapDateTime())
      ->offsetSet('started_at', new sfWidgetFormBootstrapDate())
      ->offsetSet('finished_at', new sfWidgetFormBootstrapDate())
      ->offsetSet('submited_at', new sfWidgetFormBootstrapDate())
      ->offsetSet('execution_time', new sfWidgetFormInputHidden())
      ->offsetSet('pay_method', new sfWidgetFormChoice(array(
        'choices' => OrderTable::$payMethods
      )))
      //->offsetSet('payed_at', new sfWidgetFormBootstrapDate())
    ;

    $this->getWidgetSchema()->setLabels(array(
      'client_id' => 'Клиент',
      'description' => 'Подробное описание заказа',
      'additional' => 'Доп. информация',
      'due_date' => 'Дата / время',
      'approved_at' => 'Дата согласования с заказчиком',
      'files' => 'Файлы',
      'installation_cost' => 'Монтаж',
      'design_cost' => 'Дизайн (препресс)',
      'contractors_cost' => 'Стоимость работ подрядчиков',
      'cost' => 'Общая стоимость работ',
      'started_at' => 'Дата поступления в работу',
      'finished_at' => 'Дата выполнения',
      'submited_at' => 'Дата сдачи заказа',
      'state' => 'Статус',
      'pay_method' => 'Способ оплаты',
      'recoil' => 'Гарантийная сумма',
      'payed' => 'Внесённые средства',
      'delivery_cost' => 'Доставка',
      'payed_at' => 'Дата полной оплаты',
      'state' => 'Статус',
      'expected_at' => 'Планируемая дата выполнения',
      'area' => 'Участок',
      'bill_made' => 'Счёт сформирован',
      'bill_given' => 'Счёт получен заказчиком',
      'docs_given' => 'Документы выданы',
      'execution_time' => 'Время',
      'waybill_number' => 'Номер ТТН',
    ));

    $this->getWidgetSchema()->offsetGet('description')->setAttribute('class', 'input-block-level');
    $this->getWidgetSchema()->offsetGet('additional')->setAttribute('class', 'input-block-level');
    $this->getWidgetSchema()->offsetGet('files')->setAttribute('class', 'input-block-level');

    $this
      ->getValidatorSchema()
      ->offsetSet('description', new sfValidatorString(array('required' => false), array('required' => 'Поле не должно быть пустым.')))
      ->offsetSet('expected_at', new sfValidatorBootstrapDateTime(array('required' => false)))
    ;
  }
}
