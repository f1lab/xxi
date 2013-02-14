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
      ->offsetSet('execution_time', new sfWidgetFormBootstrapTime())
      ->offsetSet('pay_method', new sfWidgetFormChoice(array(
        'choices' => OrderTable::$payMethods
      )))
      ->offsetSet('payed_at', new sfWidgetFormBootstrapDate())
    ;
    $this->setValidator('description', new sfValidatorString(
                                    array('required' => true),
                                    array('required' => 'Поле не должно быть пустым.')));
    /* $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'client_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Client'))),
      'additional'        => new sfValidatorString(array('required' => false)),
      'description'       => new sfValidatorString(
                                    array('required' => false),
                                    array('required' => 'Поле не должно быть пустым.')),
      'due_date'          => new sfValidatorDateTime(array('required' => false)),
      'approved_at'       => new sfValidatorDateTime(array('required' => false)),
      'files'             => new sfValidatorString(array('required' => false)),
      'installation_cost' => new sfValidatorInteger(array('required' => false)),
      'design_cost'       => new sfValidatorInteger(array('required' => false)),
      'contractors_cost'  => new sfValidatorInteger(array('required' => false)),
      'delivery_cost'     => new sfValidatorInteger(array('required' => false)),
      'cost'              => new sfValidatorInteger(array('required' => false)),
      'pay_method'        => new sfValidatorChoice(array('choices' => array(0 => '', 1 => 'cash', 2 => 'non-cash', 3 => 'barter', 4 => 'settlement'), 'required' => false)),
      'recoil'            => new sfValidatorInteger(array('required' => false)),
      'payed'             => new sfValidatorInteger(array('required' => false)),
      'payed_at'          => new sfValidatorDateTime(array('required' => false)),
      'expected_at'       => new sfValidatorDateTime(array('required' => false)),
      'started_at'        => new sfValidatorDateTime(array('required' => false)),
      'finished_at'       => new sfValidatorDateTime(array('required' => false)),
      'submited_at'       => new sfValidatorDateTime(array('required' => false)),
      'state'             => new sfValidatorChoice(array('choices' => array(0 => 'calculating', 1 => 'work', 2 => 'working', 3 => 'done', 4 => 'submited', 5 => 'archived', 6 => 'debt',7 => 'prepress'), 'required' => false)),
      'area'              => new sfValidatorChoice(array('choices' => array(0 => 'pvc', 1 => 'laser', 2 => 'engraver', 3 => 'mymaka', 4 => 'outdoor', 5 => 'lfp', 6 => 'sublimation', 7 => 'cutter', 8 => 'serigraphy'), 'required' => false)),
      'bill_made'         => new sfValidatorBoolean(array('required' => false)),
      'bill_given'        => new sfValidatorBoolean(array('required' => false)),
      'docs_given'        => new sfValidatorBoolean(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
      'created_by'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'required' => false)),
      'updated_by'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'required' => false)),
      'deleted_at'        => new sfValidatorDateTime(array('required' => false)),
      'version'           => new sfValidatorInteger(array('required' => false))
    )); */
    
    $this->getWidgetSchema()->setLabels(array(
      'client_id' => 'Клиент',
      'description' => 'Описание заказа',
      'additional' => 'Доп. информация',
      'due_date' => 'Дата',
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
      'docs_given' => 'Документы выданы',
      'execution_time' => 'Время',
    ));
  }
}
