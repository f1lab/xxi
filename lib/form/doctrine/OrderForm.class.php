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
      $this['version']
    );

    $this->getWidgetSchema()
      ->offsetSet('client_id', new sfWidgetFormDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Client'),
        'add_empty' => false,
        'order_by' => array(
          'name',
          'asc',
        ),
      ), array(
        'class' => 'chzn-select',
      )))
      ->offsetSet('state', new sfWidgetFormChoice(array(
        'choices' => OrderTable::$states,
      )))
      ->offsetSet('area', new sfWidgetFormChoice(array(
        'choices' => OrderTable::$area,
      )))
      ->offsetSet('due_date', new sfWidgetFormBootstrapDate())
      /* ->offsetSet('due_date', new sfWidgetFormDateTime(array(
        'format' => '%date%   %time%',
        'date' => array(
          'format' => '%day% %month% %year%',
          'years' => array(
            date('Y') => date('Y'),
            date('Y')+1 => date('Y')+1,
          ),
          'empty_values' => array(
            'year' => 'год',
            'month' => 'месяц',
            'day' => 'день',
          ),
        ),
        'time' => array(
          'format_without_seconds' => '%hour% %minute%',
          'minutes' => array(
            0 => '00',
            15 => 15,
            30 => 30,
            45 => 45,
          ),
          'empty_values' => array(
            'hour' => 'час',
            'minute' => 'минуты',
          ),
        ),
      ), array(
        'date' => array(
          'class' => 'span2',
        ),
        'time' => array(
          'class' => 'span1',
        ),
      ))) */
      ->offsetSet('approved_at', new sfWidgetFormBootstrapDate())
      ->offsetSet('expected_at', new sfWidgetFormBootstrapDate())
      ->offsetSet('started_at', new sfWidgetFormBootstrapDate())
      ->offsetSet('finished_at', new sfWidgetFormBootstrapDate())
      ->offsetSet('submited_at', new sfWidgetFormBootstrapDate())
      ->offsetSet('pay_method', new sfWidgetFormChoice(array(
        'choices' => OrderTable::$payMethods
      )))
      ->offsetSet('payed_at', new sfWidgetFormBootstrapDate())
    ;

    $this->getWidgetSchema()->setLabels(array(
      'client_id' => 'Клиент',
      'description' => 'Описание заказа',
      'additional' => 'Доп. информация',
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
      'payed' => 'Внесённые средства',
      'delivery_cost' => 'Доставка',
      'payed_at' => 'Дата полной оплаты',
      'state' => 'Статус',
      'expected_at' => 'Планируемая дата выполнения',
      'area' => 'Участок',
      'bill_made' => 'Счёт сформирован',
      'bill_given' => 'Счёт получен заказчиком',
    ));
  }
}
