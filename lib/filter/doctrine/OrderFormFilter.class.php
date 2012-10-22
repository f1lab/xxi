<?php

/**
 * Order filter form.
 *
 * @package    xxi
 * @subpackage filter
 * @author     Anatoly Pashin
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OrderFormFilter extends BaseOrderFormFilter
{
  public function configure()
  {
    unset (
      $this['created_at'],
      $this['submited_at'],
      $this['payed_at']
    );

  	$this->getWidgetSchema()
      ->offsetSet('client_id', new sfWidgetFormDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Client'),
        'add_empty' => false,
        'order_by' => array(
          'name',
          'asc',
        ),
        'multiple' => true,
      ), array(
        'class' => 'chzn-select',
        'data-placeholder' => 'Выберите…',
      )))
      ->offsetSet('created_by', new sfWidgetFormDoctrineChoice(array(
        'model' => 'sfGuardUser',
        'table_method' => 'getManagers',
        'multiple' => true,
      ), array(
        'class' => 'chzn-select',
        'data-placeholder' => 'Выберите…',
      )))
       ->offsetSet('state', new sfWidgetFormChoice(array(
        'choices' => OrderTable::$states,
        'multiple' => true,
      ), array(
        'class' => 'chzn-select',
        'data-placeholder' => 'Выберите…',
      )))
       ->offsetSet('area', new sfWidgetFormChoice(array(
        'choices' => OrderTable::$area,
        'multiple' => true,
      ), array(
        'class' => 'chzn-select',
        'data-placeholder' => 'Выберите…',
      )))
      ->offsetSet('bill_made', new sfWidgetFormChoice(array('choices' => array('' => 'да или нет', 1 => 'да', 0 => 'нет'))))
      ->offsetSet('bill_given', new sfWidgetFormChoice(array('choices' => array('' => 'да или нет', 1 => 'да', 0 => 'нет'))))
      ->offsetSet('created_at_from', new sfWidgetFormBootstrapDate())
      ->offsetSet('created_at_to', new sfWidgetFormBootstrapDate())
      ->offsetSet('submited_at_from', new sfWidgetFormBootstrapDate())
      ->offsetSet('submited_at_to', new sfWidgetFormBootstrapDate())
      ->offsetSet('payed_at_from', new sfWidgetFormBootstrapDate())
      ->offsetSet('payed_at_to', new sfWidgetFormBootstrapDate())
      ->setLabels(array(
        'client_id' => 'Клиент',
        'created_by' => 'Менеджер',
        'created_at_from' => 'Дата создания',
        'submited_at_from' => 'Дата сдачи',
        'payed_at_from' => 'Дата полной оплаты',
        'state' => 'Статус',
        'area' => 'Участок',
        'bill_made' => 'Счёт сформирован',
        'bill_given' => 'Счёт доставлен',
      ))
    ;
  }
}
