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

    $this->getWidgetSchema()->offsetSet('state', new sfWidgetFormChoice(array(
      'choices' => OrderTable::$states,
    )));

    $this->getWidgetSchema()->offsetSet('due_date', new sfWidgetFormBootstrapDate());
    $this->getWidgetSchema()->offsetSet('approved_at', new sfWidgetFormBootstrapDate());
    $this->getWidgetSchema()->offsetSet('started_at', new sfWidgetFormBootstrapDate());
    $this->getWidgetSchema()->offsetSet('finished_at', new sfWidgetFormBootstrapDate());
    $this->getWidgetSchema()->offsetSet('submited_at', new sfWidgetFormBootstrapDate());

    $this->getWidgetSchema()->setLabels(array(
      'client_id' => 'Клиент',
      'description' => 'Описание заказа',
      'due_date' => 'Срок исполнения',
      'approved_at' => 'Дата согласования с заказчиком',
      'files' => 'Файлы и коментарии к ним',
      'installation_cost' => 'Стоимость монтажа',
      'design_cost' => 'Стоимость дизайна',
      'contractors_cost' => 'Стоимость работ подрядчиков',
      'cost' => 'Стоимость работ',
      'started_at' => 'Дата поступления в работу',
      'finished_at' => 'Дата выполнения',
      'submited_at' => 'Дата сдачи заказа',
      'state' => 'Статус',
    ));
  }
}
