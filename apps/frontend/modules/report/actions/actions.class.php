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
    ;

    $this->period = array(
      'from' => date('Y') . '-01-01',
      'to' => date('Y-m-d'),
    );
    $this->manager = false;

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
      ->where('a.state = ?', 'archived')
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
      ->leftJoin('b.Orders c with (c.payed_at >= ? and c.payed_at <= ?) and c.state = ?', array($this->period['from'], $this->period['to'], 'archived'))
      ->execute()
      ->getFirst()
      ->getUsers()
    ;
  }
}
