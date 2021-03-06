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
        $this->filters = Doctrine_Query::create()
            ->from('OrdersTableFilter f INDEXBY f.id')
            ->addWhere('f.user_id = ?', $this->getUser()->getGuardUser()->getId())
            ->addOrderBy('f.is_default desc')
            ->addOrderBy('f.updated_at desc')
            ->execute();

        $this->filter = new OrderFormFilter();

        if ($request->hasParameter($this->filter->getName())) { // filled filter form
            $this->currentFilter = null;
            $filterQueryFilterParameter = $request->getParameter($this->filter->getName());
        } elseif ($request->hasParameter('filter_id')) { // selected saved filter
            $this->currentFilter = $this->filters->contains($request->getParameter('filter_id', -1))
                ? $this->filters->get($request->getParameter('filter_id', -1)) : null;
            $filterQueryFilterParameter = $this->currentFilter ? $this->currentFilter->getFilter() : null;
        } elseif (count($this->filters) > 0 and $this->filters->getFirst()->getIsDefault()) { // default saved filter
            $this->currentFilter = $this->filters->getFirst();
            $filterQueryFilterParameter = $this->currentFilter->getFilter();
        } else { // default filter form values
            $this->currentFilter = null;
            $filterQueryFilterParameter = null;
        }
        $filterQuery = $this->filter->getFilterQuery($filterQueryFilterParameter, $this->getUser());

        $this->pager = new sfDoctrinePager(
            'Order',
            1000
        );
        $this->pager->setQuery($filterQuery);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();

        $this->settings = $this->getUser()->getGuardUser()->getOrdersTableSettings();

        if ($this->settings->getCommentsEnabled() === true) {
            $orders = $this->pager->getResults();
            foreach ($orders as &$order) {
                $commentReads = Doctrine_Query::create()
                    ->select('*, (select count(*) from comment_reads where comment_id = c.id and user_id = ?) read')
                    ->from('Comment c')
                    ->andWhere('order_id = ?', $order->getId())
                    ->execute([$this->getUser()->getGuardUser()->getId()]);
                $order->setComments($commentReads);
            }
            $this->pager->setResults($orders);
        }
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->order = Doctrine_Query::create()
            ->from('Order o')
            ->leftJoin('o.Client c')
            ->leftJoin('o.Comments oc')
            ->leftJoin('oc.Creator')
            ->leftJoin('o.Creator')
            ->leftJoin('o.UtilizationPlans up')
            ->leftJoin('up.Material m')
            ->leftJoin('m.Dimension')
            ->leftJoin('o.RefOrderWork row')
            ->leftJoin('row.Work w')
            ->leftJoin('w.Area')
            ->leftJoin('row.Master')
            ->where('o.id = ?', $request->getParameter('id'))
            ->fetchOne();

        if (
            $request->hasParameter('version')
            and true == ($version = (int)$request->getParameter('version'))
            and $version >= 1
        ) {
            $this->order->revert($version);
        }

        $this->forward404Unless($this->order);
        $this->order->setComments(Doctrine_Core::getTable('Comment')->createQuery('a, a.Creator b')
            ->select('(select count(*) from comment_reads where comment_id = a.id and user_id = ?) read, a.*, b.*')
            ->andWhere('a.order_id = ?', $this->order->getId())
            ->execute([$this->getUser()->getGuardUser()->getId()]));

        $this->commentForm = new CommentForm();
        $this->commentForm->setDefault('order_id', $this->order->getId());

        $this->fields = [
            'clientFullestName' => 'Клиент',
            'creator' => 'Менеджер',
            'description' => 'Описание заказа',
            'dueDate' => 'Срок исполнения',
            'approvedAt' => 'Дата согласования с заказчиком',
            'files' => 'Файлы и комментарии к ним',
            'installationCost' => 'Стоимость монтажа',
            'designCost' => 'Стоимость дизайна (препресс)',
            'contractorsCost' => 'Стоимость производства',
            'deliveryCost' => 'Стоимость доставки',
            'cost' => 'Стоимость работ',
            'recoil' => 'Гарантийная сумма',
            'payMethodTranslated' => 'Способ оплаты',
            'payed' => 'Внесённые средства',
            'payedAt' => 'Дата полной оплаты',
            'expectedAt' => 'Планируемая дата выполнения',
            'startedAt' => 'Дата поступления в работу',
            'finishedAt' => 'Дата выполнения',
            'submitedAt' => 'Дата сдачи заказа',
            'stateTranslated' => 'Статус',
            //'areaTranslated' => 'Участок',
            'billMade' => 'Счёт сформирован ',
            'billGiven' => 'Счёт получен заказчиком',
            'docsGiven' => 'Документы выданы',
        ];

        $selectedFields = [];
        if ($this->getUser()->hasGroup('monitor') or $this->getUser()->hasGroup('master')) {
            $selectedFields = [
                'creator',
                'description',
                'dueDate',
                'files',
                'expectedAt',
                'executionTime',
                'startedAt',
                'finishedAt',
                'stateTranslated',
                //'areaTranslated',
                'submitedAt',
            ];
        } elseif ($this->getUser()->hasGroup('design-worker') or $this->getUser()->hasGroup('design-master')) {
            $selectedFields = [
                'clientFullestName',
                'creator',
                'description',
                'dueDate',
                'approvedAt',
                'files',
                'designCost',
            ];
        } elseif ($this->getUser()->hasGroup('worker')) {
            $selectedFields = [
                'creator',
                'description',
                'dueDate',
                'files',
                'installationCost',
                'designCost',
                'contractorsCost',
                'deliveryCost',
                'cost',
                'recoil',
                'expectedAt',
                'executionTime',
                'startedAt',
                'finishedAt',
                'stateTranslated',
                //'areaTranslated',
                'submitedAt',
            ];
        }

        if (count($selectedFields)) {
            // bidlo-magic: we need just part of fields, so bidlocode now
            $selectedFields = array_fill_keys($selectedFields,
                ''); // => array('creator' => '', 'description' => '', etc…)
            $this->fields = array_intersect_key($this->fields,
                $selectedFields); // => array('creator' => 'Клиент', etc…)
        }

        $this->utilizationMovements = Doctrine_Query::create()
            ->select('mm.id')
            ->from('MaterialMovement mm')
            ->innerJoin('mm.Utilization u')
            ->addWhere('u.order_id = ?', $this->order->getId())
            ->execute([], Doctrine_Core::HYDRATE_SINGLE_SCALAR);

        $this->utilizations = Doctrine_Query::create()
            ->from('MaterialMovementMaterials mm')
            ->leftJoin('mm.Material m')
            ->andWhereIn('mm.movement_id', $this->utilizationMovements ?: [-1])
            ->execute();
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new OrderForm();
        $this->form->useFields([
            "new_Invoices",
            "Invoices",
            "client_id",
            "description",
            "approved_at",
            "files",
            "due_date",
            "installation_cost",
            "design_cost",
            "contractors_cost",
            "delivery_cost",
            "cost",
            "pay_method",
            "recoil",
            "state",
        ]);

        if ($request->getParameter('client')) {
            $this->form->setDefault('client_id', $request->getParameter('client'));
        }
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->form = new OrderForm();

        $this->form->useFields([
            "new_Invoices",
            "Invoices",
            "client_id",
            "description",
            "approved_at",
            "files",
            "due_date",
            "installation_cost",
            "design_cost",
            "contractors_cost",
            "delivery_cost",
            "cost",
            "pay_method",
            "recoil",
            "state",
        ]);

        $this->processForm($request, $this->form, ['success', 'Отлично!', 'Заказ добавлен.'], '@orders');
        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $orderQuery = Doctrine_Query::create()
            ->from("Order o")
            ->leftJoin("o.Invoices i")
            ->addWhere("o.id = ?", $request->getParameter('id'));

        if ($this->getUser()->hasGroup("worker") or $this->getUser()->hasGroup("design-worker")) {
            $mineAreas = Doctrine_Query::create()
                ->from("Area a")
                ->select("a.id")
                ->leftJoin("a.Workers u")
                ->addWhere("u.id = ?", $this->getUser()->getGuardUser()->getId())
                ->execute([], Doctrine_Core::HYDRATE_SINGLE_SCALAR);

            $mineWorkRefs = Doctrine_Query::create()
                ->from("RefOrderWork row")
                ->addWhere("row.order_id = ?", $request->getParameter('id'))
                ->andWhereIn("row.area_id", $mineAreas ?: [-1])
                ->execute([], Doctrine_Core::HYDRATE_SINGLE_SCALAR);

            if (count($mineWorkRefs)) {
                $orderQuery->leftJoin("o.RefOrderWork row")->andWhereIn("row.id", $mineWorkRefs);
            } else {
                $orderQuery->leftJoin("o.RefOrderWork row WITH row.id is null");
            }
        }

        $this->order = $orderQuery->fetchOne();

        if ($this->order->getState() === "deleted" and !$this->getUser()->hasCredential("can-delete-orders")) {
            $this->getUser()->setFlash("message", [
                "error",
                "Внимание!",
                "Вы не можете редактировать удалённые заказы.",
            ]);
            $this->redirect("order/show?id=" . $this->order->getId());
        }

        $this->form = new OrderForm($this->order);

        if ($this->getUser()->hasGroup('master')) {
            $this->forward404(); // master can't edit Orders
        }
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $orderQuery = Doctrine_Query::create()
            ->from("Order o")
            ->leftJoin("o.Invoices i")
            ->addWhere("o.id = ?", $request->getParameter('id'));

        if ($this->getUser()->hasGroup("worker") or $this->getUser()->hasGroup("design-worker")) {
            $mineAreas = Doctrine_Query::create()
                ->from("Area a")
                ->select("a.id")
                ->leftJoin("a.Workers u")
                ->addWhere("u.id = ?", $this->getUser()->getGuardUser()->getId())
                ->execute([], Doctrine_Core::HYDRATE_SINGLE_SCALAR);

            $mineWorkRefs = Doctrine_Query::create()
                ->from("RefOrderWork row")
                ->addWhere("row.order_id = ?", $request->getParameter('id'))
                ->andWhereIn("row.area_id", $mineAreas ?: [-1])
                ->execute([], Doctrine_Core::HYDRATE_SINGLE_SCALAR);

            if (count($mineWorkRefs)) {
                $orderQuery->leftJoin("o.RefOrderWork row")->andWhereIn("row.id", $mineWorkRefs);
            } else {
                $orderQuery->leftJoin("o.RefOrderWork row WITH row.id is null");
            }
        }

        $this->order = $orderQuery->fetchOne();
        $this->form = new OrderForm($this->order);

        $this->processForm(
            $request,
            $this->form,
            ['success', 'Отлично!', 'Изменения сохранены.'],
            '@order?id=' . $this->order->getId()
        );
        $this->setTemplate('edit');
    }

    public function executePrint(sfWebRequest $request)
    {
        $order = Doctrine_Core::getTable('Order')
            ->find($request->getParameter('id'));
        $this->forward404Unless($order);

        $this->printTemplate("order", [
            "from" => [
                "{manager}",
                "{printed_at}",
                "{order_id}",
                "{files}",
                "{description}",
                "{due_date}",
                "{execution_time}",
                "{started_at}",
            ],

            "to" => [
                $order->getCreator(),
                date('d.m.Y'),
                $order->getId(),
                $order->getFiles(),
                $order->getDescription(),
                $order->getDueDate() ? date("d.m.Y H:i", strtotime($order->getDueDate())) : '',
                $order->getExecutionTime(),
                $order->getStartedAt() ? date("d.m.Y H:i", strtotime($order->getStartedAt())) : '',
            ],
        ], "Бланк заказа на №" . $order->getId());
    }

    public function executePrintDesign(sfWebRequest $request)
    {
        $order = Doctrine_Query::create()
            ->from("Order o")
            ->leftJoin("o.RefOrderWork row")
            ->leftJoin("row.Master m")
            ->leftJoin("row.Area a")
            ->leftJoin("a.Workers ww")
            ->leftJoin("ww.Groups g")
            ->addWhere("o.id = ?", $request->getParameter('id'))
            ->addWhere("row.planned_start is not null and row.planned_finish is not null")
            ->andWhereIn("g.name", ["design-worker"])
            ->limit(1)
            ->fetchOne();
        $this->forward404Unless($order and count($order["RefOrderWork"]) and true == ($ref = $order->getRefOrderWork()
                ->getFirst()));

        $this->printTemplate("order-template", [
            "from" => [
                "{order-id}",
                "{who-title}",
                "{who-real}",
                "{started-at}",
                "{files}",
                "{description}",
                "{due-date}",
            ],

            "to" => [
                $order->getId(),
                "Дизайнер",
                $ref->getMaster(),
                date("d.m.Y H:i", strtotime($ref->getPlannedStart())),
                $order->getFiles(),
                $order->getDescription(),
                date("d.m.Y H:i", strtotime($ref->getPlannedFinish())),
            ],
        ], "Бланк заказа дизайн (препресс) №" . $order->getId());
    }

    protected function printTemplate($templateName, $replacePairs, $attachmentFilename)
    {
        $template = sfConfig::get("sf_upload_dir") . "/" . $templateName . ".xml";

        header("Content-Type: application/msword");
        header("Content-Disposition: attachment; filename=" . $attachmentFilename . ".doc");
        header("Pragma: no-cache");
        header("Expires: 0");

        $out = str_replace(
            $replacePairs["from"],
            $replacePairs["to"],
            file_get_contents($template)
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
                ->setWaybillNumber($this->settings->getWaybillCounter() + 1)
                ->save();
            $this->settings
                ->setWaybillCounter($this->settings->getWaybillCounter() + 1)
                ->save();
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
                ->setWaybillNumber($this->settings->getWaybillCounter() + 1)
                ->save();
            $this->settings
                ->setWaybillCounter($this->settings->getWaybillCounter() + 1)
                ->save();
        }

        $this->setLayout(false);
    }

    public function executeComment(sfWebRequest $request)
    {
        $form = new CommentForm();
        $this->processForm($request, $form, ['success', 'Отлично!', 'Комментарий добавлен.']);
        $this->redirect('@order?id=' . $request->getParameter('id'));
    }

    public function processForm(sfWebRequest $request, sfForm $form, $flash = false, $redirect = false)
    {
        $form->bind(
            $request->getParameter($form->getName()),
            $request->getFiles($form->getName())
        );

        if ($form->isValid()) {
            $form->save();

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

        if ($this->getUser()->hasGroup('manager')) {
            $query = "SELECT DISTINCT o.id, c.`id`, cr.`id` FROM
                `order` o
                left join `comment` c ON o.id = c.order_id
                left join `comment_reads` cr on cr.`comment_id` = c.`id` AND cr.`user_id` =" . $user . "
                WHERE o.created_by =" . $user . " AND c.id IS NOT NULL
                AND cr.id IS NULL
                AND o.deleted_at IS NULL
                AND ( o.`state`='work'
                OR o.`state`='working'
                OR o.`state`='done'
                OR o.`state`='calculating'
                OR o.`state`='submited'
                OR o.`state`='prepress')";
        }

        if ($this->getUser()->hasGroup('worker')) {
            $query = "SELECT DISTINCT o.id, c.`id`, cr.`id` FROM
                `order` o
                left join `comment` c ON o.id = c.order_id
                left join `comment_reads` cr on cr.`comment_id` = c.`id` AND cr.`user_id` =" . $user . "
                WHERE o.created_by =" . $user . " AND c.id IS NOT NULL
                AND cr.id IS NULL
                AND o.deleted_at IS NULL
                AND ( o.`state`='work'
                OR o.`state`='working'
                OR o.`state`='done'
                OR o.`state`='prepress')";
        }

        $executedQuery = Doctrine_Manager::connection()
            ->execute($query)
            ->fetchAll(PDO::FETCH_COLUMN);
        $countUnreadedTickets = count($executedQuery);

        return $this->renderText(json_encode([
            'countUnreadedTickets' => $countUnreadedTickets,
        ]));
    }

    public function executeInvoice(sfWebRequest $request)
    {
        $this->form = new InvoiceForm();
    }

    public function executeDelete($request)
    {
        $order = Doctrine_Core::getTable("Order")->find($request->getParameter("id"));
        $this->forward404Unless($order);

        if ($this->getUser()->hasCredential("can-delete-orders")) {
            $order->setState("deleted")->save();
        }

        $this->redirect("order/show?id=" . $order->getId());
    }
}
