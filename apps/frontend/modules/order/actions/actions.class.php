<?php

/**
 * order actions.
 *
 * @package    xxi
 * @subpackage order
 * @author     Anatoly Pashin
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orderActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->orders = array();
    $this->_state = $request->getParameter('state');
    $this->_my = $request->getParameter('my');

    if ($this->getUser()->hasGroup('manager')) {
      $this->orders = Doctrine_Core::getTable('Order')->createQuery('a, a.Client, a.Creator')
        ->orderBy('a.created_at asc')
      ;

      if ($this->_state == 'active') {
        $this->orders->andWhereNotIn('a.state', array('archived', 'debt'));
      } else {
        $this->orders->andWhere('a.state = ?', $this->_state);
      }

      if ($this->_my == 'all') {
        //
      } else {
        $this->orders->andWhere('a.created_by = ?', $this->getUser()->getGuardUser()->getId());
      }

      $this->orders = $this->orders->execute();

    } else if ($this->getUser()->hasGroup('monitor')) {
      $this->orders = Doctrine_Core::getTable('Order')->createQuery('a, a.Client, a.Creator')
        ->orderBy('a.created_at asc')
        ->whereNotIn('a.state', array('calculating', 'archived', 'debt'))
        ->execute()
      ;

    } else if ($this->getUser()->hasGroup('worker')) {
      $this->orders = Doctrine_Core::getTable('Order')->createQuery('a, a.Creator')
        ->orderBy('a.created_at asc')
      ;

      if ($this->_state == 'active') {
        $this->orders->whereIn('a.state', array('work', 'working', 'done'));
      } else {
        $this->orders->where('a.state = ?', $this->_state);
      }

      $this->orders = $this->orders->execute();

    } else if ($this->getUser()->hasGroup('director') or $this->getUser()->hasGroup('buhgalter')) {
      $this->orders = Doctrine_Core::getTable('Order')->createQuery('a, a.Client, a.Creator')
        ->orderBy('a.created_at asc')
      ;

      if ($this->_state == 'active') {
        $this->orders->whereNotIn('a.state', array('archived', 'debt'));
      } else {
        $this->orders->where('a.state = ?', $this->_state);
      }

      $this->orders = $this->orders->execute();
    }
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->order = Doctrine_Core::getTable('Order')->createQuery('a, a.Comments b, b.Creator')
      ->where('a.id = ?', $request->getParameter('id'))
      ->fetchOne()
    ;

    if (
      $request->hasParameter('version')
      and true == ($version=(int)$request->getParameter('version'))
      and $version >= 1
    ) {
      $this->order->revert($version);
    }

    $this->forward404Unless($this->order);

    $this->commentForm = new CommentForm();
    $this->commentForm->setDefault('order_id', $this->order->getId());

    $this->fields = array(
      'client' => 'Клиент',
      'creator' => 'Менеджер',
      'description' => 'Описание заказа',
      'dueDate' => 'Срок исполнения',
      'approvedAt' => 'Дата согласования с заказчиком',
      'files' => 'Файлы и коментарии к ним',
      'installationCost' => 'Стоимость монтажа',
      'designCost' => 'Стоимость дизайна',
      'contractorsCost' => 'Стоимость работ подрядчиков',
      'cost' => 'Стоимость работ',
      'recoil' => 'Возврат денежных средств',
      'payMethodTranslated' => 'Способ оплаты',
      'payed' => 'Внесённые средства',
      'startedAt' => 'Дата поступления в работу',
      'finishedAt' => 'Дата выполнения',
      'submitedAt' => 'Дата сдачи заказа',
      'stateTranslated' => 'Статус',
    );

    if ($this->getUser()->hasGroup('worker')) { // bidlo-magic: we need just part of fields, so bidlocode now
      $workerFields = array_fill_keys(array(
        'creator',
        'description',
        'dueDate',
        'files',
        'startedAt',
        'finishedAt',
        'stateTranslated',
      ), ''); // => array('creator' => '', 'description' => '', etc…)
      $this->fields = array_intersect_key($this->fields, $workerFields); // => array('creator' => 'Клиент', etc…)
    }
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new OrderForm();
    $this->form->getWidgetSchema()
      ->offsetSet('state', new sfWidgetFormChoice(array(
        'choices' => OrderTable::$statesForManager,
        'label' => 'Статус',
      )))
      ->offsetUnset(array(
        'payed',
        'started_at',
        'finished_at',
        'submited_at',
      ))
    ;

    if ($request->getParameter('client')) {
      $this->form->setDefault('client_id', $request->getParameter('client'));
    }
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new OrderForm();
    $this->form->getWidgetSchema()
      ->offsetSet('state', new sfWidgetFormChoice(array(
        'choices' => OrderTable::$statesForManager,
        'label' => 'Статус',
      )))
    ;
    $this->form->getValidatorSchema()
      ->offsetUnset('payed')
    ;

    $this->processForm($request, $this->form, array('success', 'Отлично!', 'Заказ добавлен.'), '@orders');
    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->order = Doctrine_Core::getTable('Order')
      ->find($request->getParameter('id'))
    ;
    $this->form = new OrderForm($this->order);

    //FIXME: it's fucking mess below
    if ($this->getUser()->hasGroup('worker')) {
      $this->form->getWidgetSchema()
        ->offsetUnset(array(
          'client_id', 'description', 'due_date',
          'approved_at', 'files', 'installation_cost',
          'design_cost', 'contractors_cost',
          'cost', 'submited_at','pay_method',
          'recoil', 'payed',
        ))
        ->offsetSet('state', new sfWidgetFormChoice(array(
          'choices' => OrderTable::$statesForWorker,
          'label' => 'Статус',
        )))
      ;

    } elseif ($this->getUser()->hasGroup('buhgalter')) {
      $this->form->getWidgetSchema()
        ->offsetUnset(array(
          'client_id', 'description', 'due_date',
          'approved_at', 'files', 'installation_cost',
          'design_cost', 'contractors_cost',
          'cost', 'submited_at','pay_method',
          'recoil', 'started_at', 'finished_at',
        ))
        ->offsetSet('state', new sfWidgetFormChoice(array(
          'choices' => OrderTable::$statesForBuhgalter,
          'label' => 'Статус',
        )))
      ;

    } else { // manager
      $this->form->getWidgetSchema()
        ->offsetUnset(array(
          'started_at',
          'finished_at',
          'payed',
        ))
        ->offsetSet('state', new sfWidgetFormChoice(array(
          'choices' => OrderTable::$statesForManager,
          'label' => 'Статус',
        )))
      ;

      if ($this->order->getState() == 'working') {
        $this->form->getWidgetSchema()
          ->offsetUnset(array(
            'state',
          ))
        ;
      }
    }
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->order = Doctrine_Core::getTable('Order')
      ->find($request->getParameter('id'))
    ;
    $this->form = new OrderForm($this->order);

    //FIXME: it's fucking mess
    if ($this->getUser()->hasGroup('worker')) {
      $this->form->getValidatorSchema()
        ->offsetUnset(array(
          'client_id', 'description', 'due_date',
          'approved_at', 'files', 'installation_cost',
          'design_cost', 'contractors_cost', 'cost',
          'submited_at', 'pay_method', 'recoil',
          'payed',
        ))
      ;

    } elseif ($this->getUser()->hasGroup('buhgalter')) {
      $this->form->getValidatorSchema()
        ->offsetUnset(array(
          'client_id', 'description', 'due_date',
          'approved_at', 'files', 'installation_cost',
          'design_cost', 'contractors_cost', 'cost',
          'submited_at', 'pay_method', 'recoil',
        ))
      ;

    } else { // manager
      $this->form->getValidatorSchema()
        ->offsetUnset(array(
          'started_at',
          'finished_at',
          'payed',
        ))
      ;

      if ($this->order->getState() == 'working') {
        $this->form->getValidatorSchema()
          ->offsetUnset(array(
            'state',
          ))
        ;
      }
    }

    $this->processForm(
      $request,
      $this->form,
      array('success', 'Отлично!', 'Изменения сохранены.'),
      '@order?id=' . $this->order->getId()
    );
    $this->setTemplate('edit');
  }

  public function executeComment(sfWebRequest $request)
  {
    $form = new CommentForm();
    $this->processForm($request, $form, array('success', 'Отлично!', 'Комментарий добавлен.'));
    $this->redirect('@order?id=' . $request->getParameter('id'));
  }

  public function processForm(sfWebRequest $request, sfForm $form, $flash=false, $redirect=false)
  {
    $form->bind(
      $request->getParameter($form->getName()),
      $request->getFiles($form->getName())
    );

    if ($form->isValid()) {
      $object = $form->save();

      if ($flash and is_array($flash)) {
        $this->getUser()->setFlash('message', $flash);
      }

      if ($redirect) {
        $this->redirect($redirect);
      }
    }
  }
}
