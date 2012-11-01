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
    $fileds = array_keys($this->getFields());
    foreach ($fileds as $field) {
      unset ($this[$field]);
    }
    $this->disableCSRFProtection();

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
      ->offsetSet('approved_at_from', new sfWidgetFormBootstrapDate())
      ->offsetSet('approved_at_to', new sfWidgetFormBootstrapDate())
      ->offsetSet('submited_at_from', new sfWidgetFormBootstrapDate())
      ->offsetSet('submited_at_to', new sfWidgetFormBootstrapDate())
      ->offsetSet('payed_at_from', new sfWidgetFormBootstrapDate())
      ->offsetSet('payed_at_to', new sfWidgetFormBootstrapDate())
      ->setLabels(array(
        'client_id' => 'Клиент',
        'created_by' => 'Менеджер',
        'created_at_from' => 'Дата создания',
        'approved_at_from' => 'Дата согласования',
        'submited_at_from' => 'Дата сдачи',
        'payed_at_from' => 'Дата полной оплаты',
        'state' => 'Статус',
        'area' => 'Участок',
        'bill_made' => 'Счёт сформирован',
        'bill_given' => 'Счёт доставлен',
      ))
      ->setNameFormat('order_filters[%s]')
    ;

    $this->getValidatorSchema()
      ->offsetSet('client_id', new sfValidatorPass())
      ->offsetSet('created_by', new sfValidatorPass())
      ->offsetSet('state', new sfValidatorPass())
      ->offsetSet('area', new sfValidatorPass())
      ->offsetSet('bill_made', new sfValidatorPass())
      ->offsetSet('bill_given', new sfValidatorPass())
      ->offsetSet('created_at_from', new sfValidatorPass())
      ->offsetSet('created_at_to', new sfValidatorPass())
      ->offsetSet('approved_at_from', new sfValidatorPass())
      ->offsetSet('approved_at_to', new sfValidatorPass())
      ->offsetSet('submited_at_from', new sfValidatorPass())
      ->offsetSet('submited_at_to', new sfValidatorPass())
      ->offsetSet('payed_at_from', new sfValidatorPass())
      ->offsetSet('payed_at_to', new sfValidatorPass())
    ;

    $this->setDefaults(array(
      'client_id' => array(),
      'created_by' => array(),
      'state' => array(
        'calculating',
        'work',
        'working',
        'done',
        'submited',
      ),
      'area' => array(),
      'created_at_from' => array('day' => '01', 'month' => '01', 'year' => date('Y')),
      'created_at_to' => array('day' => '', 'month' => '', 'year' => ''),
      'approved_at_from' => array('day' => '', 'month' => '', 'year' => ''),
      'approved_at_to' => array('day' => '', 'month' => '', 'year' => ''),
      'submited_at_from' => array('day' => '', 'month' => '', 'year' => ''),
      'submited_at_to' => array('day' => '', 'month' => '', 'year' => ''),
      'payed_at_from' => array('day' => '', 'month' => '', 'year' => ''),
      'payed_at_to' => array('day' => '', 'month' => '', 'year' => ''),
    ));
  }

  public function getFilterQuery($request, $user)
  {
    $query = Doctrine_Core::getTable('Order')->createQuery('a, a.Client, a.Creator');

    if ($user->hasGroup('worker') or $user->hasGroup('monitor')) {
      $this->setDefault('state', array(
        'work',
        'working',
        'done',
      ));
    }

    if ($request->hasParameter($this->getName())) {
      $this->bind($request->getParameter($this->getName()));
    }

    if (true == ($values = array_merge($this->getDefaults(), $this->getValues()))) {
      if (count($values['client_id'])) {
        $query->andWhereIn('client_id', $values['client_id']);
      }

      if (count($values['created_by'])) {
        $query->andWhereIn('created_by', $values['created_by']);
      }

      if (
        $values['created_at_from']['day']
        and $values['created_at_from']['month']
        and $values['created_at_from']['year']
      ) {
        $query->andWhere('created_at >= ?', date(
          'Y-m-d 00:00:00',
          mktime(0, 0, 0, $values['created_at_from']['month'], $values['created_at_from']['day'], $values['created_at_from']['year']))
        );
      }

      if (
        $values['created_at_to']['day']
        and $values['created_at_to']['month']
        and $values['created_at_to']['year']
      ) {
        $query->andWhere('created_at <= ?', date(
          'Y-m-d 23:59:59',
          mktime(0, 0, 0, $values['created_at_to']['month'], $values['created_at_to']['day'], $values['created_at_to']['year']))
        );
      }

      if (
        $values['approved_at_from']['day']
        and $values['approved_at_from']['month']
        and $values['approved_at_from']['year']
      ) {
        $query->andWhere('approved_at >= ?', date(
          'Y-m-d 00:00:00',
          mktime(0, 0, 0, $values['approved_at_from']['month'], $values['approved_at_from']['day'], $values['approved_at_from']['year']))
        );
      }

      if (
        $values['approved_at_to']['day']
        and $values['approved_at_to']['month']
        and $values['approved_at_to']['year']
      ) {
        $query->andWhere('approved_at <= ?', date(
          'Y-m-d 23:59:59',
          mktime(0, 0, 0, $values['approved_at_to']['month'], $values['approved_at_to']['day'], $values['approved_at_to']['year']))
        );
      }

      if (
        $values['submited_at_from']['day']
        and $values['submited_at_from']['month']
        and $values['submited_at_from']['year']
      ) {
        $query->andWhere('submited_at >= ?', date(
          'Y-m-d 00:00:00',
          mktime(0, 0, 0, $values['submited_at_from']['month'], $values['submited_at_from']['day'], $values['submited_at_from']['year']))
        );
      }

      if (
        $values['submited_at_to']['day']
        and $values['submited_at_to']['month']
        and $values['submited_at_to']['year']
      ) {
        $query->andWhere('submited_at <= ?', date(
          'Y-m-d 23:59:59',
          mktime(0, 0, 0, $values['submited_at_to']['month'], $values['submited_at_to']['day'], $values['submited_at_to']['year']))
        );
      }

      if (
        $values['payed_at_from']['day']
        and $values['payed_at_from']['month']
        and $values['payed_at_from']['year']
      ) {
        $query->andWhere('payed_at >= ?', date(
          'Y-m-d 00:00:00',
          mktime(0, 0, 0, $values['payed_at_from']['month'], $values['payed_at_from']['day'], $values['payed_at_from']['year']))
        );
      }

      if (
        $values['payed_at_to']['day']
        and $values['payed_at_to']['month']
        and $values['payed_at_to']['year']
      ) {
        $query->andWhere('payed_at <= ?', date(
          'Y-m-d 23:59:59',
          mktime(0, 0, 0, $values['payed_at_to']['month'], $values['payed_at_to']['day'], $values['payed_at_to']['year']))
        );
      }

      if (count($values['state']) and $values['state'][0]) {
        $query->andWhereIn('state', $values['state']);
      }

      if (count($values['area']) and $values['area'][0]) {
        $query->andWhereIn('area', $values['area']);
      }

      if (isset($values['bill_made']) and in_array($values['bill_made'], array("0", "1"), true)) {
        $query->andWhere('bill_made = ?', (bool)$values['bill_made']);
      }

      if (isset($values['bill_given']) and in_array($values['bill_given'], array("0", "1"), true)) {
        $query->andWhere('bill_given = ?', (bool)$values['bill_given']);
      }
    }

    return $query->orderBy('a.created_at asc');
  }
}
