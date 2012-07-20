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
    unset( $this['created_at'], $this['updated_at'], $this['created_by'], $this['updated_by'], $this['deleted_at'] );

    $this->getWidgetSchema()
      ->offsetSet('state', new sfWidgetFormChoice(array(
        'choices' => OrderTable::$states,
      )))
      ->offsetSet('due_date', new sfWidgetFormBootstrapDate())
      ->offsetSet('approved_at', new sfWidgetFormBootstrapDate())
      ->offsetSet('started_at', new sfWidgetFormBootstrapDate())
      ->offsetSet('finished_at', new sfWidgetFormBootstrapDate())
      ->offsetSet('submited_at', new sfWidgetFormBootstrapDate())
      ->offsetSet('pay_method', new sfWidgetFormChoice(array(
        'choices' => OrderTable::$payMethods
      )))
    ;

    $this->getWidgetSchema()->setLabels(array(
      'client_id' => 'Клиент',
      'description' => 'Описание заказа',
      'due_date' => 'Срок исполнения',
      'approved_at' => 'Дата согласования с заказчиком',
      'files' => 'Файлы',
      'installation_cost' => 'Монтаж',
      'design_cost' => 'Дизайн',
      'contractors_cost' => 'Стоимость работ подрядчиков',
      'cost' => 'Общая стоимость работ',
      'started_at' => 'Дата поступления в работу',
      'finished_at' => 'Дата выполнения',
      'submited_at' => 'Дата сдачи заказа',
      'state' => 'Статус',
      'pay_method' => 'Способ оплаты',
      'recoil' => 'Возврат денежных средств',
    ));
  }
}
