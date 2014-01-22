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
  static public $attributesWithTimestamps = ["created", "approved", "submited", "finished", "payed"];

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
        'choices' => OrderTable::getSetableStatesWithNames(),
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
      ->offsetSet('docs_given', new sfWidgetFormChoice(array('choices' => array('' => 'да или нет', 1 => 'да', 0 => 'нет'))))
      ->offsetSet('created_at_from', new sfWidgetFormBootstrapDate())
      ->offsetSet('created_at_to', new sfWidgetFormBootstrapDate())
      ->offsetSet('approved_at_from', new sfWidgetFormBootstrapDate())
      ->offsetSet('approved_at_to', new sfWidgetFormBootstrapDate())
      ->offsetSet('finished_at_from', new sfWidgetFormBootstrapDate())
      ->offsetSet('finished_at_to', new sfWidgetFormBootstrapDate())
      ->offsetSet('submited_at_from', new sfWidgetFormBootstrapDate())
      ->offsetSet('submited_at_to', new sfWidgetFormBootstrapDate())
      ->offsetSet('payed_at_from', new sfWidgetFormBootstrapDate())
      ->offsetSet('payed_at_to', new sfWidgetFormBootstrapDate())
      ->setLabels(array(
        'client_id' => 'Клиент',
        'created_by' => 'Менеджер',
        'created_at_from' => 'Дата создания',
        'approved_at_from' => 'Дата согласования',
        'finished_at_from' => 'Дата выполнения',
        'submited_at_from' => 'Дата сдачи',
        'payed_at_from' => 'Дата полной оплаты',
        'state' => 'Статус',
        'area' => 'Участок',
        'bill_made' => 'Счёт сформирован',
        'bill_given' => 'Счёт доставлен',
        'docs_given' => 'Документы выданы',
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
      ->offsetSet('docs_given', new sfValidatorPass())
      ->offsetSet('created_at_from', new sfValidatorPass())
      ->offsetSet('created_at_to', new sfValidatorPass())
      ->offsetSet('approved_at_from', new sfValidatorPass())
      ->offsetSet('approved_at_to', new sfValidatorPass())
      ->offsetSet('finished_at_from', new sfValidatorPass())
      ->offsetSet('finished_at_to', new sfValidatorPass())
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
        'prepress',
        'prepress-working',
        'prepress-done',
      ),
      'area' => array(),
      'created_at_from' => array('day' => '01', 'month' => '01', 'year' => date('Y')),
      'created_at_to' => array('day' => '', 'month' => '', 'year' => ''),
      'approved_at_from' => array('day' => '', 'month' => '', 'year' => ''),
      'approved_at_to' => array('day' => '', 'month' => '', 'year' => ''),
      'submited_at_from' => array('day' => '', 'month' => '', 'year' => ''),
      'submited_at_to' => array('day' => '', 'month' => '', 'year' => ''),
      'finished_at_from' => array('day' => '', 'month' => '', 'year' => ''),
      'finished_at_to' => array('day' => '', 'month' => '', 'year' => ''),
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
    } elseif ($user->hasGroup('master')) {
      $this->setDefault('state', array(
        'working',
      ));
    } elseif ($user->hasGroup("design-worker")) {
      $this->setDefault("state", array(
        "prepress",
        "prepress-working",
        "prepress-done",
      ));
    }

    if ($user->hasCredential('manager')) {
      $this->setDefault('created_by', array(
        $user->getGuardUser()->getId(),
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

      array_walk(self::$attributesWithTimestamps, function($attribute, $key) use ($values, &$query) {
        if (
          $values[$attribute . "_at_from"]["day"]
          and $values[$attribute . "_at_from"]["month"]
          and $values[$attribute . "_at_from"]["year"]
        ) {
          $query->andWhere($attribute . "_at >= ?", date(
            "Y-m-d 00:00:00",
            mktime(0, 0, 0, $values[$attribute . "_at_from"]["month"], $values[$attribute . "_at_from"]["day"], $values[$attribute . "_at_from"]["year"])
          ));
        }

        if (
          $values[$attribute . "_at_to"]["day"]
          and $values[$attribute . "_at_to"]["month"]
          and $values[$attribute . "_at_to"]["year"]
        ) {
          $query->andWhere($attribute . "_at <= ?", date(
            "Y-m-d 23:59:59",
            mktime(0, 0, 0, $values[$attribute . "_at_to"]["month"], $values[$attribute . "_at_to"]["day"], $values[$attribute . "_at_to"]["year"])
          ));
        }
      });

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

      if (isset($values['docs_given']) and in_array($values['docs_given'], array("0", "1"), true)) {
        $query->andWhere('docs_given = ?', (bool)$values['docs_given']);
      }
    }

    return $query->orderBy('a.created_at asc');
  }
}
