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
      $this['area'],
      $this['version']
    );

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

    $worksRelation = array('RefOrderWork' => array(
      'considerNewFormEmptyFields'    => array('work_id'),
      'noNewForm'                     => false,
      'newFormClassArgs'              => array(array('sf_user' => $this->getOption('sf_user'))),
      'displayEmptyRelations'         => true,
      'formClassArgs'                 => array(array('ah_add_delete_checkbox' => true)),
      'newFormAfterExistingRelations' => true,
      'formFormatter'                 => null,
      'multipleNewForms'              => true,
      'newFormsInitialCount'          => 1,
      'newFormsContainerForm'         => null, // pass BaseForm object here or we will create ahNewRelationsContainerForm
      'newRelationButtonLabel'        => '+',
      'newRelationAddByCloning'       => false,
      'newRelationUseJSFramework'     => 'jQuery',
    ));

    $utilizationPlansRelation = array('UtilizationPlans' => array(
      'considerNewFormEmptyFields'    => array('material_id', 'amount'),
      'noNewForm'                     => false,
      'newFormClassArgs'              => array(array('sf_user' => $this->getOption('sf_user'))),
      'displayEmptyRelations'         => true,
      'formClassArgs'                 => array(array('ah_add_delete_checkbox' => true)),
      'newFormAfterExistingRelations' => true,
      'formFormatter'                 => null,
      'multipleNewForms'              => true,
      'newFormsInitialCount'          => 1,
      'newFormsContainerForm'         => null, // pass BaseForm object here or we will create ahNewRelationsContainerForm
      'newRelationButtonLabel'        => '+',
      'newRelationAddByCloning'       => false,
      'newRelationUseJSFramework'     => 'jQuery',
    ));

    $user = sfContext::getInstance()->getUser();
    $this->embedRelations(array_merge(
      $user->hasCredential('can_set_order_works') && !$this->getObject()->isNew() ? $worksRelation : [],
      $user->hasCredential('can_set_order_works') && !$this->getObject()->isNew() ? $utilizationPlansRelation : [],
      $user->hasCredential("manager") || !($user->hasGroup('master') || $user->hasGroup('worker') || $user->hasGroup('design-master') || $user->hasGroup('design-worker')) ? $invoicesRelation : [],
      (!$this->getObject()->isNew() and $user->hasCredential('director') || $user->hasGroup('buhgalter')) ? $paysRelation : []
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
        'choices' => OrderTable::getSetableStatesWithNames(),
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
      'delivery_cost' => 'Доставка',
      'cost' => 'Общая стоимость работ',
      'started_at' => 'Дата поступления в работу',
      'finished_at' => 'Дата выполнения',
      'submited_at' => 'Дата сдачи заказа',
      'state' => 'Статус',
      'pay_method' => 'Способ оплаты',
      'recoil' => 'Гарантийная сумма',
      'payed' => 'Внесённые средства',
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

    $this->getWidgetSchema()->offsetGet('cost')
      ->setAttribute('class', 'span1')
      ->setAttribute('type', 'number')
      ->setAttribute('min', 0.00)
      ->setAttribute('step', 0.01)
    ;
    $this->getWidgetSchema()->offsetGet('design_cost')
      ->setAttribute('class', 'span1')
      ->setAttribute('type', 'number')
      ->setAttribute('min', 0.00)
      ->setAttribute('step', 0.01)
    ;
    $this->getWidgetSchema()->offsetGet('contractors_cost')
      ->setAttribute('class', 'span1')
      ->setAttribute('type', 'number')
      ->setAttribute('min', 0.00)
      ->setAttribute('step', 0.01)
    ;
    $this->getWidgetSchema()->offsetGet('installation_cost')
      ->setAttribute('class', 'span1')
      ->setAttribute('type', 'number')
      ->setAttribute('min', 0.00)
      ->setAttribute('step', 0.01)
    ;
    $this->getWidgetSchema()->offsetGet('delivery_cost')
      ->setAttribute('class', 'span1')
      ->setAttribute('type', 'number')
      ->setAttribute('min', 0.00)
      ->setAttribute('step', 0.01)
    ;

    $this
      ->getValidatorSchema()
      ->offsetSet('description', new sfValidatorString(array('required' => false), array('required' => 'Поле не должно быть пустым.')))
      ->offsetSet('expected_at', new sfValidatorBootstrapDateTime(array('required' => false)))
    ;

    $editableFields = array_keys(array_filter([
      "client_id" => $user->hasGroup("director") or $user->hasGroup("manager"),
      "description" => $user->hasGroup("director") or $user->hasGroup("manager"),
      "due_date" => $user->hasGroup("director") or $user->hasGroup("manager"),
      "approved_at" => $user->hasGroup("director") or $user->hasGroup("manager"),
      "files" => $user->hasGroup("director") or $user->hasGroup("manager") or $user->hasGroup("design-master"),

      "installation_cost" => $user->hasGroup("director") or $user->hasGroup("manager"),
      "design_cost" => $user->hasGroup("director") or $user->hasGroup("manager"),
      "contractors_cost" => $user->hasGroup("director") or $user->hasGroup("manager"),
      "delivery_cost" => $user->hasGroup("director") or $user->hasGroup("manager"),
      "cost" => $user->hasGroup("director") or $user->hasGroup("manager") or $user->hasGroup("buhgalter"),
      "pay_method" => $user->hasGroup("director") or $user->hasGroup("manager") or $user->hasGroup("buhgalter"),
      "recoil" => $user->hasGroup("director") or $user->hasGroup("manager"),

      "expected_at" => $user->hasGroup("worker"),
      "started_at" => $user->hasGroup("director") or $user->hasGroup("worker"),
      "finished_at" => $user->hasGroup("director"),
      "submited_at" => $user->hasGroup("director"),

      "bill_made" => $user->hasCredential("director") or $user->hasGroup("buhgalter"),
      "bill_given" => $user->hasCredential("director") or $user->hasGroup("buhgalter"),
      "docs_given" => $user->hasCredential("director") or $user->hasGroup("buhgalter"),
      "waybill_number" => $user->hasCredential("director") or $user->hasGroup("buhgalter"),

      "new_RefOrderWork" => !$this->getObject()->isNew() and $user->hasCredential("can_set_order_works"),
      "RefOrderWork" => !$this->getObject()->isNew() and $user->hasCredential("can_set_order_works"),

      "new_UtilizationPlans" => !$this->getObject()->isNew() and $user->hasCredential("can_set_order_works"),
      "UtilizationPlans" => !$this->getObject()->isNew() and $user->hasCredential("can_set_order_works"),

      "new_Invoices" => $user->hasCredential("manager") or (!$user->hasGroup("worker") and !$user->hasGroup("design-worker") and !$user->hasGroup("master") and !$user->hasGroup("design-master")),
      "Invoices" => $user->hasCredential("manager") or (!$user->hasGroup("worker") and !$user->hasGroup("design-worker") and !$user->hasGroup("master") and !$user->hasGroup("design-master")),

      "new_Pays" => !$this->getObject()->isNew() and $user->hasCredential("director") || $user->hasGroup("buhgalter"),
      "Pays" => !$this->getObject()->isNew() and $user->hasCredential("director") || $user->hasGroup("buhgalter"),

      "state" => $user->hasGroup("director") or $user->hasGroup("worker") or $user->hasGroup("manager") or $user->hasGroup("design-worker"),
    ])); // empty callback for array_filter removes false values

    $this->useFields($editableFields);
  }
}
