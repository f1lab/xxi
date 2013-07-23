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
    $this->filter = new OrderFormFilter();

    $this->pager = new sfDoctrinePager(
      'Order',
      100
    );
    $this->pager->setQuery($this->filter->getFilterQuery($request, $this->getUser()));
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
      'areaTranslated' => 'Участок',
      'billMade' => 'Счёт сформирован ',
      'billGiven' => 'Счёт получен заказчиком',
      'docsGiven' => 'Документы выданы',
    );

    if ($this->getUser()->hasGroup('worker') or $this->getUser()->hasGroup('monitor')) {
      // bidlo-magic: we need just part of fields, so bidlocode now
      $workerFields = array_fill_keys(array(
        'creator',
        'description',
        'dueDate',
        'files',
        'expectedAt',
        'executionTime',
        'startedAt',
        'finishedAt',
        'stateTranslated',
        'areaTranslated',
        'submitedAt'
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
    ;

    unset (
      $this->form['payed'],
      $this->form['started_at'],
      $this->form['finished_at'],
      $this->form['submited_at'],
      $this->form['payed_at'],
      $this->form['expected_at'],
      $this->form['area'],
      $this->form['bill_made'],
      $this->form['bill_given'],
      $this->form['docs_given']
    );

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
    ;

    unset (
      $this->form['payed'],
      $this->form['started_at'],
      $this->form['finished_at'],
      $this->form['submited_at'],
      $this->form['payed_at'],
      $this->form['expected_at'],
      $this->form['area'],
      $this->form['bill_made'],
      $this->form['bill_given'],
      $this->form['docs_given']
    );

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
          'finished_at',
          'submited_at',
          'client_id',
          'description',
          'due_date',
          'execution_time',
          'approved_at',
          'files',
          'installation_cost',
          'design_cost',
          'contractors_cost',
          'cost',
          'pay_method',
          'recoil',
          'payed',
          'delivery_cost',
          'payed_at',
          'additional',
          'bill_made',
          'bill_given',
          'docs_given',
          'waybill',
        ))
        ->offsetSet('state', new sfWidgetFormChoice(array(
          'choices' => OrderTable::$statesForWorker,
          'label' => 'Статус',
        )))
      ;

    } elseif ($this->getUser()->hasGroup('buhgalter')) {
      $this->form->getWidgetSchema()
        ->offsetUnset(array(
          'client_id',
          'description',
          'due_date',
          'execution_time',
          'approved_at',
          'files',
          'installation_cost',
          'design_cost',
          'contractors_cost',
          'submited_at',
          'state',
          'recoil',
          'started_at',
          'finished_at',
          'delivery_cost',
          'expected_at',
          'area'
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

    } elseif ($this->getUser()->hasGroup('master')) {
      $this->form->useFields(array(
        'id',
        'Utilizations',
        'new_Utilizations',
        'state',
      ));
      $this->form->getWidgetSchema()->offsetSet('state', new sfWidgetFormChoice(array(
        'choices' => OrderTable::$statesForMaster,
        'label' => 'Статус',
      )));

    } else { // manager
      $this->form->getWidgetSchema()
        ->offsetUnset(array(
          'started_at',
          'finished_at',
          'payed',
          'payed_at',
          'expected_at',
          'submited_at',
          'area',
          'bill_made',
        ))
        ->offsetSet('state', new sfWidgetFormChoice(array(
          'choices' => OrderTable::$statesForManager,
          'label' => 'Статус',
        )))
      ;
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
          'finished_at',
          'submited_at',
          'client_id',
          'description',
          'due_date',
          'execution_time',
          'approved_at',
          'files',
          'installation_cost',
          'design_cost',
          'contractors_cost',
          'cost',
          'pay_method',
          'recoil',
          'payed',
          'delivery_cost',
          'additional',
          'payed_at',
          'bill_made',
          'bill_given',
          'docs_given',
        ))
      ;

    } elseif ($this->getUser()->hasGroup('buhgalter')) {
      $this->form->getValidatorSchema()
        ->offsetUnset(array(
          'client_id', 'description', 'due_date','execution_time',
          'approved_at', 'files', 'installation_cost',
          'design_cost', 'contractors_cost', 'cost',
          'submited_at', 'recoil', 'delivery_cost',
          'expected_at', 'state',
          'area'
        ))
      ;

    } elseif ($this->getUser()->hasGroup('director')) {
      $this->form->getValidatorSchema()
        ->offsetUnset(array(
          'expected_at',
        ))
      ;

    } elseif ($this->getUser()->hasGroup('master')) {
      $this->form->useFields(array(
        'id',
        'Utilizations',
        'new_Utilizations',
        'state',
      ));

    } else { // manager
      $this->form->getValidatorSchema()
        ->offsetUnset(array(
          'started_at',
          'finished_at',
          'payed',
          'payed_at',
          'expected_at',
          'submited_at',
          'area',
          'bill_made',
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
        '{execution_time}',
        '{started_at}',
      ),
      array(
        $order->getCreator(),
        date('d.m.Y'),
        $order->getId(),
        $order->getFiles(),
        $order->getDescription(),
        $order->getDueDate() ? date('d.m.Y', strtotime($order->getDueDate())) : '',
        $order->getExecutionTime(),
        $order->getStartedAt() ? date('d.m.Y', strtotime($order->getStartedAt())) : ''
      ),
      file_get_contents(sfConfig::get('sf_upload_dir') . '/' . 'order.xml')
    );

    die($out);
  }

  public function executePrintAccount(sfWebRequest $request)
  {
    $this->order = Doctrine_Core::getTable('Order')->find($request->getParameter('id'));
    $this->company = Doctrine_Core::getTable('CompanySettings')->find(1);

    $this->setLayout(false);
  }

  public function executePrintInvoice(sfWebRequest $request)
  {
    $this->order = Doctrine_Core::getTable('Order')->find($request->getParameter('id'));
    $this->company = Doctrine_Core::getTable('CompanySettings')->find(1);
    $this->settings = Doctrine_Core::getTable('ShareSettings')->find(1);

    if ($this->order->getWaybillNumber() == null) {
      $this->order
        ->setWaybillNumber($this->settings->getWaybillCounter()+1)
        ->save()
      ;
      $this->settings
        ->setWaybillCounter($this->settings->getWaybillCounter()+1)
        ->save()
      ;
    }

    $this->setLayout(false);
  }
  public function executePrintWaybill(sfWebRequest $request)
  {
    $this->order = Doctrine_Core::getTable('Order')->find($request->getParameter('id'));
    $this->company = Doctrine_Core::getTable('CompanySettings')->find(1);
    $this->settings = Doctrine_Core::getTable('ShareSettings')->find(1);

    if ($this->order->getWaybillNumber() == null) {
      $this->order
        ->setWaybillNumber($this->settings->getWaybillCounter()+1)
        ->save()
      ;
      $this->settings
        ->setWaybillCounter($this->settings->getWaybillCounter()+1)
        ->save()
      ;
    }

    $this->setLayout(false);
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
      if (0 and $form instanceof OrderForm and $form->getObject()->isNew()) { // bug in relations saving
        if ($form->getValues()['state'] !== $form->getObject()->getState()) {
          $objectSaver = $form->updateObject();
          if ($form->getValues()['state'] == 'done') {
            $objectSaver->setFinishedAt(date('Y-m-d H:i:s'));
          } elseif ($form->getValues()['state'] == 'submited') {
            $objectSaver->setSubmitedAt(date('Y-m-d H:i:s'));
          }
        } else {
          $objectSaver = $form;
        }

        $object = $objectSaver->save();
      } else {
        $form->save();
      }

      if ($flash and is_array($flash)) {
        $this->getUser()->setFlash('message', $flash);
      }

      if ($redirect) {
        $this->redirect($redirect);
      }
    }
  }

  public function executeUnread(sfWebRequest $request)
  {
    $user = $this->getUser()->getGuardUser()->getId();
    $countUnreadedTickets = 0;

    if($this->getUser()->hasGroup('manager')) {
      $query = "SELECT DISTINCT o.id, c.`id`, cr.`id` FROM
                `order` o
                left join `comment` c ON o.id = c.order_id
                left join `comment_reads` cr on cr.`comment_id` = c.`id` AND cr.`user_id` =".$user."
                WHERE o.created_by =".$user." AND c.id IS NOT NULL
                AND cr.id IS NULL
                AND o.deleted_at IS NULL
                AND ( o.`state`='work'
                OR o.`state`='working'
                OR o.`state`='done'
                OR o.`state`='calculating'
                OR o.`state`='submited'
                OR o.`state`='prepress')";
    }

    if($this->getUser()->hasGroup('worker')) {
      $query = "SELECT DISTINCT o.id, c.`id`, cr.`id` FROM
                `order` o
                left join `comment` c ON o.id = c.order_id
                left join `comment_reads` cr on cr.`comment_id` = c.`id` AND cr.`user_id` =".$user."
                WHERE o.created_by =".$user." AND c.id IS NOT NULL
                AND cr.id IS NULL
                AND o.deleted_at IS NULL
                AND ( o.`state`='work'
                OR o.`state`='working'
                OR o.`state`='done'
                OR o.`state`='prepress')";
    }

	  $executedQuery = Doctrine_Manager::connection()
      ->execute($query)
      ->fetchAll(PDO::FETCH_COLUMN)
    ;
    $countUnreadedTickets = count($executedQuery);

    return $this->renderText(json_encode(array(
      'countUnreadedTickets' => $countUnreadedTickets,
    )));
  }

  public function executeInvoice(sfWebRequest $request)
  {
    $this->form = new InvoiceForm();
  }
}
