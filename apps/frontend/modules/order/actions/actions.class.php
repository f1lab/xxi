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
      $query = Doctrine_Core::getTable('Order')->createQuery('a, a.Client, a.Creator')
        ->orderBy('a.created_at asc')
      ;

      if ($this->_state == 'active') {
        $query->andWhereNotIn('a.state', array('archived', 'debt'));
      } else {
        $query->andWhere('a.state = ?', $this->_state);
      }

      if ($this->_my == 'all') {
        //
      } else {
        $query->andWhere('a.created_by = ?', $this->getUser()->getGuardUser()->getId());
      }

    } else if ($this->getUser()->hasGroup('monitor')) {
      $query = Doctrine_Core::getTable('Order')->createQuery('a, a.Client, a.Creator')
        ->orderBy('a.created_at asc')
        ->whereNotIn('a.state', array('calculating', 'archived', 'debt'))
      ;

    } else if ($this->getUser()->hasGroup('worker')) {
      $query = Doctrine_Core::getTable('Order')->createQuery('a, a.Creator')
        ->orderBy('a.created_at asc')
      ;

      if ($this->_state == 'active') {
        $query->whereIn('a.state', array('work', 'working', 'done', 'calculating'));
      } else {
        $query->where('a.state = ?', $this->_state);
      }

    } else if ($this->getUser()->hasGroup('director') or $this->getUser()->hasGroup('buhgalter')) {
      $query = Doctrine_Core::getTable('Order')->createQuery('a, a.Client, a.Creator')
        ->orderBy('a.created_at asc')
      ;

      if ($this->_state == 'active') {
        $query->whereNotIn('a.state', array('archived', 'debt'));
      } else {
        $query->where('a.state = ?', $this->_state);
      }
    }

    $this->pager = new sfDoctrinePager(
      'Order',
      30
    );
    $this->pager->setQuery($query);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();

    $orders = $this->pager->getResults();
    foreach ($orders as &$order) {
      $commentReads = Doctrine_Query::create()
        ->select('*, (select count(*) from comment_reads where comment_id = c.id and user_id = ?) read')
        ->from('Comment c')
        ->andWhere('order_id = ?', $order->getId())
        ->execute(array($this->getUser()->getGuardUser()->getId()))
      ;
      $order->setComments($commentReads);
    }
    $this->pager->setResults($orders);
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->order = Doctrine_Core::getTable('Order')->createQuery('a, a.Client')
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
    $this->order->setComments(Doctrine_Core::getTable('Comment')->createQuery('a, a.Creator b')
        ->select('(select count(*) from comment_reads where comment_id = a.id and user_id = ?) read, a.*, b.*')
        ->andWhere('a.order_id = ?', $this->order->getId())
        ->execute(array($this->getUser()->getGuardUser()->getId())));

    $this->commentForm = new CommentForm();
    $this->commentForm->setDefault('order_id', $this->order->getId());

    $this->fields = array(
      'clientFullestName' => 'Клиент',
      'creator' => 'Менеджер',
      'description' => 'Описание заказа',
      'additional' => 'Доп. информация',
      'dueDate' => 'Срок исполнения',
      'approvedAt' => 'Дата согласования с заказчиком',
      'files' => 'Файлы и комментарии к ним',
      'installationCost' => 'Стоимость монтажа',
      'designCost' => 'Стоимость дизайна',
      'contractorsCost' => 'Стоимость работ подрядчиков',
      'deliveryCost' => 'Стоимость доставки',
      'cost' => 'Стоимость работ',
      'recoil' => 'Возврат денежных средств',
      'payMethodTranslated' => 'Способ оплаты',
      'payed' => 'Внесённые средства',
      'payedAt' => 'Дата полной оплаты',
      'expectedAt' => 'Планируемая дата выполнения',
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
        'expectedAt',
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
        'payed_at',
        'expected_at',
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
      )))
      ->offsetUnset(array(
        'payed',
        'started_at',
        'finished_at',
        'submited_at',
        'payed_at',
        'expected_at',
      ))
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
          'cost', 'pay_method',
          'recoil', 'payed', 'delivery_cost',
          'payed_at',
          'additional',
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
          'submited_at', 'state',
          'recoil', 'started_at', 'finished_at',
          'delivery_cost', 'expected_at',
        ))
        ->offsetSet('cost', new sfWidgetFormInputText(array(
          'label' => 'Общая стоимость работ',
        ), array(
          'readonly' => 'readonly',
          'disabled' => 'disabled',
        )))
      ;

    } elseif ($this->getUser()->hasGroup('director')) {
      $this->form->getWidgetSchema()
        ->offsetUnset(array(
          'expected_at',
        ))
        ->offsetSet('state', new sfWidgetFormChoice(array(
          'choices' => OrderTable::$statesForManager,
          'label' => 'Статус',
        )))
      ;
    } else { // manager
      $this->form->getWidgetSchema()
        ->offsetUnset(array(
          'started_at',
          'finished_at',
          'payed',
          'payed_at',
          'expected_at',
          'submited_at',
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

    if ($this->getUser()->hasCredential('can_set_all_states')) {
      $this->form->getWidgetSchema()
        ->offsetSet('state', new sfWidgetFormChoice(array(
          'choices' => OrderTable::$states,
          'label' => 'Статус',
        )))
      ;
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
          'pay_method', 'recoil',
          'payed', 'delivery_cost',
          'additional',
        ))
      ;

    } elseif ($this->getUser()->hasGroup('buhgalter')) {
      $this->form->getValidatorSchema()
        ->offsetUnset(array(
          'client_id', 'description', 'due_date',
          'approved_at', 'files', 'installation_cost',
          'design_cost', 'contractors_cost', 'cost',
          'submited_at', 'recoil', 'delivery_cost',
          'expected_at', 'state',
        ))
      ;

    } elseif ($this->getUser()->hasGroup('director')) {
      $this->form->getValidatorSchema()
        ->offsetUnset(array(
          'expected_at',
        ))
      ;
    } else { // manager
      $this->form->getValidatorSchema()
        ->offsetUnset(array(
          'started_at',
          'finished_at',
          'payed',
          'payed_at',
          'expected_at',
          'submited_at',
        ))
      ;

      if ($this->order->getState() == 'working' and !$this->getUser()->hasCredential('can_set_all_states')) {
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

  public function executePrint(sfWebRequest $request)
  {
    $order = Doctrine_Core::getTable('Order')
      ->find($request->getParameter('id'))
    ;

    $this->forward404Unless($order);

    header("Content-Type: application/msword");
    header("Content-Disposition: attachment; filename=Бланк заказа на №" . $order->getId() . ".doc");
    header("Pragma: no-cache");
    header("Expires: 0");

    $out = str_replace(
      array(
        '{manager}',
        '{printed_at}',
        '{order_id}',
        '{files}',
        '{description}',
        '{due_date}',
      ),
      array(
        $order->getCreator(),
        date('d.m.Y'),
        $order->getId(),
        $order->getFiles(),
        $order->getDescription(),
        $order->getDueDate() ? date('d.m.Y', strtotime($order->getDueDate())) : '',
      ),
      file_get_contents(sfConfig::get('sf_upload_dir') . '/' . 'order.xml')
    );

    die($out);
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
