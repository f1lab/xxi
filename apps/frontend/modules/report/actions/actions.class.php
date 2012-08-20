<?php

/**
 * report actions.
 *
 * @package    xxi
 * @subpackage report
 * @author     Anatoly Pashin
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reportActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    //
  }

  public function executeCosts(sfWebRequest $request)
  {
    $this->states = array(
      'archived' => 'Архив',
      'active' => 'Текущие',
      'debt' => 'Дебиторка',
    );

    $this->form = new sfForm();
    $this->form->getWidgetSchema()
      ->offsetSet('from', new sfWidgetFormBootstrapDate(array(
        'label' => 'Период',
      )))
      ->offsetSet('to', new sfWidgetFormBootstrapDate(array(
        //
      )))
      ->offsetSet('manager', new sfWidgetFormDoctrineChoice(array(
        'model' => 'sfGuardUser',
        'table_method' => 'getManagers',
        'add_empty' => 'Все',
        'label' => 'Менеджер',
      )))
      ->offsetSet('state', new sfWidgetFormChoice(array(
        'choices' => $this->states,
        'label' => 'Статус',
      )))
      ->setNameFormat('filter[%s]')
    ;
    $this->form->addCSRFProtection('123456789');
    $this->form->getValidatorSchema()
      ->offsetSet('from', new sfValidatorDate())
      ->offsetSet('to', new sfValidatorDate(array(
        'required' => false,
      )))
      ->offsetSet('manager', new sfValidatorDoctrineChoice(array(
        'model' => 'sfGuardUser',
        'required' => false,
      )))
      ->offsetSet('state', new sfValidatorChoice(array(
        'choices' => array_keys($this->states),
        'required' => true,
      )))
    ;

    $this->period = array(
      'from' => date('Y') . '-01-01',
      'to' => date('Y-m-d'),
    );
    $this->manager = false;
    $this->state = 'archived';

    if ($request->isMethod('post')) {
      $this->form->bind($request->getParameter('filter'));

      if ($this->form->isValid()) {
        if ($this->form->getValue('from')) {
          $this->period['from'] = $this->form->getValue('from');
        }

        if ($this->form->getValue('to')) {
          $this->period['to'] = $this->form->getValue('to');
        }

        if ($this->form->getValue('manager')) {
          $this->manager = $this->form->getValue('manager');
        }

        if ($this->form->getValue('state')) {
          $this->state = $this->form->getValue('state');
        }
      }
    }

    $query = Doctrine_Query::create()
      ->select('
        count(*) count,
        sum(a.installation_cost) installation_cost,
        sum(a.design_cost) design_cost,
        sum(a.contractors_cost) contractors_cost,
        sum(a.delivery_cost) delivery_cost,
        sum(a.cost) cost,
        sum(a.recoil) recoil,
        sum(a.payed) payed
      ')
      ->from('Order a')
    ;

    if ($this->state == 'active') {
      $query
        ->andWhereIn('a.state', array(
          'work',
          'working',
          'done',
          'submited',
        ))
      ;
    } else {
      $query
        ->andWhere('a.state = ?', 'archived')
      ;
    }

    $query
      ->andWhere('a.submited_at >= ? and a.submited_at <= ?', array($this->period['from'], $this->period['to']))
    ;

    if ($this->manager) {
      $query->andWhere('a.created_by = ?', $this->manager);
    }

    $this->report = $query
      ->execute()
      ->getFirst()
    ;
  }

  public function executeManagers(sfWebRequest $request)
  {
    $this->form = new sfForm();
    $this->form->getWidgetSchema()
      ->offsetSet('from', new sfWidgetFormBootstrapDate(array(
        'label' => 'Период',
      )))
      ->offsetSet('to', new sfWidgetFormBootstrapDate(array(
        //
      )))
      ->setNameFormat('filter[%s]')
    ;
    $this->form->addCSRFProtection('123456789');
    $this->form->getValidatorSchema()
      ->offsetSet('from', new sfValidatorDate())
      ->offsetSet('to', new sfValidatorDate(array(
        'required' => false,
      )))
    ;

    $this->period = array(
      'from' => date('Y') . '-01-01',
      'to' => date('Y-m-d'),
    );

    if ($request->isMethod('post')) {
      $this->form->bind($request->getParameter('filter'));

      if ($this->form->isValid()) {
        if ($this->form->getValue('from')) {
          $this->period['from'] = $this->form->getValue('from');
        }

        if ($this->form->getValue('to')) {
          $this->period['to'] = $this->form->getValue('to');
        }
      }
    }

    $this->report = Doctrine_Core::getTable('sfGuardGroup')->createQuery('a, a.Users b')
      ->andWhere('a.name = ?', 'manager')
      ->select('a.*, b.*, c.*')
      ->leftJoin('b.Orders c with ((c.payed_at >= ? and c.payed_at <= ?) and c.state = ?)', array($this->period['from'], $this->period['to'], 'archived'))
      ->execute()
      ->getFirst()
      ->getUsers()
    ;
  }

  public function executeWorkers(sfWebRequest $request)
  {
    $this->form = new sfForm();
    $this->form->getWidgetSchema()
      ->offsetSet('from', new sfWidgetFormBootstrapDate(array(
        'label' => 'Период',
      )))
      ->offsetSet('to', new sfWidgetFormBootstrapDate(array(
        //
      )))
      ->setNameFormat('filter[%s]')
    ;
    $this->form->addCSRFProtection('123456789');
    $this->form->getValidatorSchema()
      ->offsetSet('from', new sfValidatorDate())
      ->offsetSet('to', new sfValidatorDate(array(
        'required' => false,
      )))
    ;

    $this->period = array(
      'from' => date('Y') . '-01-01',
      'to' => date('Y-m-d'),
    );

    if ($request->isMethod('post')) {
      $this->form->bind($request->getParameter('filter'));

      if ($this->form->isValid()) {
        if ($this->form->getValue('from')) {
          $this->period['from'] = $this->form->getValue('from');
        }

        if ($this->form->getValue('to')) {
          $this->period['to'] = $this->form->getValue('to');
        }
      }
    }

    $this->report = Doctrine_Core::getTable('Order')->createQuery('a')
      ->select('
        sum(a.cost) cost,
        sum(a.installation_cost) installation_cost,
        sum(a.design_cost) design_cost,
        sum(a.contractors_cost) contractors_cost,
        sum(a.recoil) recoil,
        sum(a.delivery_cost) delivery_cost,
        count(*) count
      ')
      ->andWhere('a.finished_at >= ? and a.finished_at <= ?', array($this->period['from'], $this->period['to']))
      ->execute()
      ->getFirst()
    ;
  }

  public function executeClients(sfWebRequest $request)
  {
    $this->form = new sfForm();
    $this->form->getWidgetSchema()
      ->offsetSet('from', new sfWidgetFormBootstrapDate(array(
        'label' => 'Период',
      )))
      ->offsetSet('to', new sfWidgetFormBootstrapDate(array(
        //
      )))
      ->offsetSet('client', new sfWidgetFormDoctrineChoice(array(
        'model' => 'Client',
        'add_empty' => 'Все',
        'label' => 'Клиент',
      )))
      ->setNameFormat('filter[%s]')
    ;
    $this->form->addCSRFProtection('123456789');
    $this->form->getValidatorSchema()
      ->offsetSet('from', new sfValidatorDate())
      ->offsetSet('to', new sfValidatorDate(array(
        'required' => false,
      )))
      ->offsetSet('client', new sfValidatorDoctrineChoice(array(
        'model' => 'Client',
        'required' => false,
      )))
    ;

    $this->client = false;
    $this->period = array(
      'from' => date('Y') . '-01-01',
      'to' => date('Y-m-d'),
    );

    if ($request->isMethod('post')) {
      $this->form->bind($request->getParameter('filter'));

      if ($this->form->isValid()) {
        if ($this->form->getValue('from')) {
          $this->period['from'] = $this->form->getValue('from');
        }

        if ($this->form->getValue('to')) {
          $this->period['to'] = $this->form->getValue('to');
        }

        if ($this->form->getValue('client')) {
          $this->client = $this->form->getValue('client');
        }
      }
    }

    $bounds = array(
      'archived' => 'archived',
      'debt' => 'debt',
    );
    if ($this->client) {
      $bounds['client'] = $this->client;
    }

    $this->report = Doctrine_Query::create()
      ->select('
        (select sum(cost) from `order` where state not in (:archived, :debt) and deleted_at is null' . ($this->client ? ' and client_id = :client' : '') . ') as cost_active,
        (select sum(payed) from `order` where state not in (:archived, :debt) and deleted_at is null' . ($this->client ? ' and client_id = :client' : '') . ') as payed_active,
        (select sum(cost) from `order` where state = :archived and deleted_at is null' . ($this->client ? ' and client_id = :client' : '') . ') as cost_archived,
        (select sum(cost) from `order` where state = :debt and deleted_at is null' . ($this->client ? ' and client_id = :client' : '') . ') as cost_debt
      ')
      ->from('Client') // bidlo-magic because Doctrine queries must have `from'
      ->limit(1)
      ->execute($bounds)
      ->getFirst()
    ;
  }
}
