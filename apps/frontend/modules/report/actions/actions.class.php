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
        $this->states = OrderTable::$states;

        $this->form = new sfForm();
        $this->form->getWidgetSchema()
            ->offsetSet('from', new sfWidgetFormBootstrapDate([
                'label' => 'Период',
            ]))
            ->offsetSet('to', new sfWidgetFormBootstrapDate([
                //
            ]))
            ->offsetSet('manager', new sfWidgetFormDoctrineChoice([
                'model' => 'sfGuardUser',
                'table_method' => 'getManagers',
                'add_empty' => 'Все',
                'label' => 'Менеджер',
            ]))
            ->offsetSet('state', new sfWidgetFormChoice([
                'choices' => $this->states,
                'label' => 'Статус',
                'multiple' => true,
            ], ['class' => 'chzn-select']))
            ->setNameFormat('filter[%s]');
        $this->form->addCSRFProtection('123456789');
        $this->form->getValidatorSchema()
            ->offsetSet('from', new sfValidatorDate([
                'required' => false,
            ]))
            ->offsetSet('to', new sfValidatorDate([
                'required' => false,
            ]))
            ->offsetSet('manager', new sfValidatorDoctrineChoice([
                'model' => 'sfGuardUser',
                'required' => false,
            ]))
            ->offsetSet('state', new sfValidatorChoice([
                'choices' => array_keys($this->states),
                'required' => false,
                'multiple' => true,
            ]));

        $this->period = [
            'from' => date('Y') . '-01-01',
            'to' => date('Y-m-d', strtotime('+1 day')),
        ];
        $this->manager = false;
        $this->state = ['archived'];

        $this->form->setDefault('state', $this->state);

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('filter'));

            if ($this->form->isValid()) {
                if ($this->form->getValue('from')) {
                    $this->period['from'] = $this->form->getValue('from');
                }

                if ($this->form->getValue('to')) {
                    $this->period['to'] = date('Y-m-d H:i:s',
                        strtotime('+1 day', strtotime($this->form->getValue('to'))));
                }

                if ($this->form->getValue('manager')) {
                    $this->manager = $this->form->getValue('manager');
                }

                if ($this->form->getValue('state')) {
                    $this->state = (array)$this->form->getValue('state');
                }
            }
        }

        $ids = Doctrine_Query::create()
            ->from('Order o')
            ->select('o.id')
            ->andWhereIn('o.state', $this->state);

        if (in_array('archived', $this->state) or in_array('debt', $this->state) or in_array('submited',
                $this->state)
        ) {
            $ids->andWhere('o.submited_at >= ? and o.submited_at <= ?', [$this->period['from'], $this->period['to']]);
        }

        if ($this->manager) {
            $ids->andWhere('o.created_by = ?', $this->manager);
        }
        $ids = $ids->execute([], Doctrine_Core::HYDRATE_SINGLE_SCALAR);
        $ids = count($ids) ? $ids : [-1];

        $this->report = Doctrine_Query::create()
            ->select('
        count(*) count,
        sum(a.installation_cost) installation_cost,
        sum(a.design_cost) design_cost,
        sum(a.contractors_cost) contractors_cost,
        sum(a.delivery_cost) delivery_cost,
        sum(a.cost) cost,
        sum(a.recoil) recoil
      ')
            ->from('Order a')
            ->andWhereIn('a.id', $ids)
            ->execute()
            ->getFirst();

        $this->payed = Doctrine_Query::create()
            ->from('Pay p')
            ->select('sum(p.amount)')
            ->andWhereIn('p.order_id', $ids)
            ->execute([], Doctrine_Core::HYDRATE_SINGLE_SCALAR);
    }

    public function executeCostsActive(sfWebRequest $request)
    {
        $this->form = new sfForm();
        $this->form->getWidgetSchema()
            ->offsetSet('manager', new sfWidgetFormDoctrineChoice([
                'model' => 'sfGuardUser',
                'table_method' => 'getManagers',
                'add_empty' => 'Все',
                'label' => 'Менеджер',
            ]))
            ->setNameFormat('filter[%s]');
        $this->form->addCSRFProtection('123456789');
        $this->form->getValidatorSchema()
            ->offsetSet('manager', new sfValidatorDoctrineChoice([
                'model' => 'sfGuardUser',
                'required' => false,
            ]));

        $this->period = [
            'from' => date('Y') . '-01-01',
            'to' => date('Y-m-d'),
        ];
        $this->manager = false;
        $this->state = 'archived';

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('filter'));

            if ($this->form->isValid()) {
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
        sum(p.amount) payed_sum
      ')
            ->from('Order a')
            ->leftJoin('a.Pays p')
            ->andWhereIn('a.state', [
                'work',
                'working',
                'done',
                //'submited',
            ]);

        if ($this->manager) {
            $query->andWhere('a.created_by = ?', $this->manager);
        }

        $this->report = $query
            ->execute()
            ->getFirst();
    }

    public function executeManagers(sfWebRequest $request)
    {
        $this->form = new sfForm();
        $this->form->getWidgetSchema()
            ->offsetSet('from', new sfWidgetFormBootstrapDate([
                'label' => 'Период',
            ]))
            ->offsetSet('to', new sfWidgetFormBootstrapDate([//
            ]))
            ->setNameFormat('filter[%s]');
        $this->form->addCSRFProtection('123456789');
        $this->form->getValidatorSchema()
            ->offsetSet('from', new sfValidatorDate())
            ->offsetSet('to', new sfValidatorDate([
                'required' => false,
            ]));

        $this->period = [
            'from' => date('Y') . '-01-01',
            'to' => date('Y-m-d 23:59:59'),
        ];

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

        $report = Doctrine_Query::create()
            ->from('sfGuardUser u')
            ->leftJoin('u.Orders o')
            ->innerJoin('o.Pays p with (p.payed_at >= ? and p.payed_at <= ?)',
                [$this->period['from'], $this->period['to']])
            ->groupBy('u.id, o.id, p.id')
            ->fetchArray();

        $result = [];
        foreach ($report as $manager) {
            $pays = [];
            foreach ($manager['Orders'] as $order) {
                foreach ($order['Pays'] as $pay) {
                    $pay['Order'] = $order;
                    $pays[] = $pay;
                }
            }
            $result[] = compact('manager', 'pays');
        }
        $this->report = $result;

        $this->salesManagerReport = Doctrine_Query::create()
            ->from('Order o')
            ->select('count(o.id) orderscount, count(p.id) payscount, sum(p.amount) payedsum')
            ->leftJoin('o.Pays p with (p.payed_at >= ? and p.payed_at <= ?)',
                [$this->period['from'], $this->period['to']])
            ->fetchOne();

        $this->workersChiefReport = Doctrine_Query::create()
            ->from('Order o')
            ->select('
        count(o.id) orderscount,
        sum(o.cost) costed,
        sum(o.design_cost) designed,
        sum(o.contractors_cost) contracted,
        sum(o.recoil) recoiled,
        (sum(o.cost) - sum(o.design_cost) - sum(o.contractors_cost) - sum(o.recoil)) report
      ')
            ->addWhere('o.submited_at >= ? and o.submited_at <= ?', [$this->period['from'], $this->period['to']])
            ->andWhereIn('o.state', [
                'submitted',
                'archived',
                'debt',
            ])
            ->fetchOne();
    }

    public function executeMasters(sfWebRequest $request)
    {
        $this->form = new sfForm();
        $this->form->getWidgetSchema()
            ->offsetSet('from', new sfWidgetFormBootstrapDate([
                'label' => 'Период',
            ]))
            ->offsetSet('to', new sfWidgetFormBootstrapDate([
                //
            ]))
            ->setNameFormat('filter[%s]');
        $this->form->addCSRFProtection('123456789');
        $this->form->getValidatorSchema()
            ->offsetSet('from', new sfValidatorDate())
            ->offsetSet('to', new sfValidatorDate([
                'required' => false,
            ]));

        $this->period = [
            'from' => date('Y') . '-01-01',
            'to' => date('Y-m-d 23:59:59'),
        ];

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

        $this->report = Doctrine_Query::create()
            ->from('sfGuardUser u')
            ->leftJoin("u.Groups g")
            ->leftJoin("u.Works w with (w.finished_at >= ? and w.finished_at <= ?)",
                [$this->period['from'], $this->period['to']])
            ->leftJoin("w.Order o")
            ->andWhereIn("g.name", ["master"])
            ->addWhere("w.is_completed = ?", true)
            ->execute();
    }

    public function executeWorkers(sfWebRequest $request)
    {
        $this->form = new sfForm();
        $this->form->getWidgetSchema()
            ->offsetSet('from', new sfWidgetFormBootstrapDate([
                'label' => 'Период',
            ]))
            ->offsetSet('to', new sfWidgetFormBootstrapDate([
                //
            ]))
            ->setNameFormat('filter[%s]');
        $this->form->addCSRFProtection('123456789');
        $this->form->getValidatorSchema()
            ->offsetSet('from', new sfValidatorDate())
            ->offsetSet('to', new sfValidatorDate([
                'required' => false,
            ]));

        $this->period = [
            'from' => date('Y') . '-01-01',
            'to' => date('Y-m-d'),
        ];

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
            ->andWhere('a.finished_at >= ? and a.finished_at <= ?', [$this->period['from'], $this->period['to']])
            ->execute()
            ->getFirst();
    }

    public function executeClients(sfWebRequest $request)
    {
        $this->form = new sfForm();
        $this->form->getWidgetSchema()
            ->offsetSet('from', new sfWidgetFormBootstrapDate([
                'label' => 'Период даты создания заказов',
            ]))
            ->offsetSet('to', new sfWidgetFormBootstrapDate([
                //
            ]))
            ->offsetSet('client', new sfWidgetFormDoctrineChoice([
                'model' => 'Client',
                'add_empty' => 'Все',
                'order_by' => [
                    'name',
                    'asc',
                ],
                'label' => 'Клиент',
            ]))
            ->setNameFormat('filter[%s]');
        $this->form->addCSRFProtection('123456789');
        $this->form->getValidatorSchema()
            ->offsetSet('from', new sfValidatorDate())
            ->offsetSet('to', new sfValidatorDate([
                'required' => false,
            ]))
            ->offsetSet('client', new sfValidatorDoctrineChoice([
                'model' => 'Client',
                'required' => false,
            ]));

        $this->client = false;
        $this->period = [
            'from' => date('Y') . '-01-01',
            'to' => date('Y-m-d'),
        ];

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

        $bounds = [
            'archived' => 'archived',
            'debt' => 'debt',
            'created_from' => $this->period['from'],
            'created_to' => $this->period['to'],
        ];
        if ($this->client) {
            $bounds['client'] = $this->client;
        }

        $this->report = Doctrine_Query::create()
            ->select('
        (select sum(cost) from `order` where
          state not in (:archived, :debt)
          and created_at >= :created_from and created_at <= :created_to
          and deleted_at is null
          ' . ($this->client ? ' and client_id = :client' : '') . '
        ) as cost_active,

        (select sum(cost) from `order` where
          state = :archived
          and created_at >= :created_from and created_at <= :created_to
          and deleted_at is null
          ' . ($this->client ? ' and client_id = :client' : '') . '
        ) as cost_archived,

        (select sum(cost) from `order` where
          state = :debt
          and created_at >= :created_from and created_at <= :created_to
          and deleted_at is null
          ' . ($this->client ? ' and client_id = :client' : '') . '
        ) as cost_debt
      ')
            ->from('Client')// bidlo-magic because Doctrine queries must have `from'
            ->limit(1)
            ->execute($bounds)
            ->getFirst();

        $query = Doctrine_Query::create()
            ->select('sum(p.amount) payed')
            ->from('Pay p')
            ->innerJoin('p.Order o with (
        o.state not in (:archived, :debt)
        and o.deleted_at is null
        and (o.created_at >= :created_from and o.created_at <= :created_to)
      )');

        if ($this->client) {
            $query->addWhere('o.client_id = :client');
        }

        $this->payedActive = $query->execute($bounds, Doctrine_Core::HYDRATE_SINGLE_SCALAR);
    }

    public function executeDebt(sfWebRequest $request)
    {
        $this->form = new sfForm();
        $this->form->getWidgetSchema()
            ->offsetSet('from', new sfWidgetFormBootstrapDate([
                'label' => 'Период',
            ]))
            ->offsetSet('to', new sfWidgetFormBootstrapDate([
                //
            ]))
            ->setNameFormat('filter[%s]');
        $this->form->addCSRFProtection('123456789');
        $this->form->getValidatorSchema()
            ->offsetSet('from', new sfValidatorDate())
            ->offsetSet('to', new sfValidatorDate([
                'required' => false,
            ]));

        $this->period = [
            'from' => '2009-01-01',
            'to' => date('Y-m-d', strtotime('+1 day')),
        ];

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('filter'));

            if ($this->form->isValid()) {
                if ($this->form->getValue('from')) {
                    $this->period['from'] = $this->form->getValue('from');
                }

                if ($this->form->getValue('to')) {
                    $this->period['to'] = date('Y-m-d H:i:s',
                        strtotime('+1 day', strtotime($this->form->getValue('to'))));
                }

                if ($this->form->getValue('client')) {
                    $this->client = $this->form->getValue('client');
                }
            }
        }

        $this->report = Doctrine_Query::create()
            ->from("Client c")
            ->innerJoin('c.Orders o')
            ->leftJoin('o.Pays p')
            ->andWhere('o.state = ?', 'debt')
            ->andWhere('o.submited_at >= ? and o.submited_at <= ?', [$this->period['from'], $this->period['to']])
            ->orderBy('c.name')
            ->execute();
    }

    public function executeMaterials(sfWebRequest $request)
    {
        $this->form = new sfForm();
        $this->form->getWidgetSchema()
            ->offsetSet('from', new sfWidgetFormBootstrapDate([
                'label' => 'Период',
            ]))
            ->offsetSet('to', new sfWidgetFormBootstrapDate([
                //
            ]))
            ->offsetSet('material_id', new sfWidgetFormDoctrineChoice([
                'model' => 'Material',
                'multiple' => true,
                'label' => 'Материал',
                'method' => 'getNameWithDimension',
                'query' => Doctrine_Query::create()
                    ->from('Material m')
                    ->leftJoin('m.Dimension')
                    ->addOrderBy('m.name'),
            ], ['class' => 'chzn-select input-block-level']))
            ->setNameFormat('filter[%s]');
        $this->form->addCSRFProtection('123456789');
        $this->form->getValidatorSchema()
            ->offsetSet('from', new sfValidatorDate([
                'required' => false,
            ]))
            ->offsetSet('to', new sfValidatorDate([
                'required' => false,
            ]))
            ->offsetSet('material_id',
                new sfValidatorDoctrineChoice(['model' => 'Material', 'multiple' => true, 'required' => false]));

        $this->period = [
            'from' => date('Y') . '-01-01',
            'to' => date('Y-m-d'),
        ];
        $this->materials = [];

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('filter'));

            if ($this->form->isValid()) {
                if ($this->form->getValue('from')) {
                    $this->period['from'] = $this->form->getValue('from');
                }

                if ($this->form->getValue('to')) {
                    $this->period['to'] = $this->form->getValue('to');
                }

                if ($this->form->getValue('material_id')) {
                    $this->materials = $this->form->getValue('material_id');
                }
            }
        }

        $this->report = Doctrine_Query::create()
            ->from('Material m')
            ->select('m.name, d.name')
            ->leftJoin('m.Dimension d')
            ->leftJoin('m.Utilizations u')
            ->leftJoin('m.Arrivals a')
            ->orderBy('m.name')
            ->addWhere('(u.created_at >= ? and u.created_at <= ?) or (a.arrived_at >= ? and a.arrived_at <= ?)', [
                $this->period['from'],
                $this->period['to'],
                $this->period['from'],
                $this->period['to'],
            ])
            ->andWhereIn('m.id', $this->materials)
            ->execute();
    }

    public function executeExportTo1C(sfWebRequest $request)
    {
        $this->form = new ExportForm();
    }

    public function executeDoExport(sfWebRequest $request)
    {
        $dateFrom = '' . $request->getParameter('from')['year'] . '-' . $request->getParameter('from')['month'] . '-'
            . $request->getParameter('from')['day'] . ' ' . '00:' . '00:' . '00';
        $dateF = date("Y-m-d H:i:s", strtotime($dateFrom));
        $dateTo = '' . $request->getParameter('to')['year'] . '-' . $request->getParameter('to')['month'] . '-'
            . $request->getParameter('to')['day'] . ' ' . '23:' . '00:' . '59';

        if ($request->getParameter('to')['year'] == null) {
            $dateTo = date("Y-m-d H:i:s", time());
        }

        $dateT = date("Y-m-d H:i:s", strtotime($dateTo));
        $orders = Doctrine_Core::getTable('Order')->createQuery('a')
            ->where('a.created_at >= ?', $dateF)
            ->andWhere('a.created_at <= ?', $dateT)
            ->execute();
        $fp = fopen(sfConfig::get('sf_upload_dir') . '/' . '1C.xml', "w");

        header('Content-Disposition: attachment; filename="1C.xml"');
        header("Content-Type:  text/xml");
        header("Content-Description: File Transfer");
        fputs($fp, "<?xml version=\"1.0\" encoding=\"utf-8\"?>" . "\n");
        fputs($fp, "<pma_xml_export version=\"1.0\">" . "\n");
        fputs($fp, "<database name=\"xxi\">" . "\n");
        foreach ($orders as $order) {
            if ($order->getPayMethod() == "non-cash") {
                fputs($fp, "<bill name=\"bill\">" . "\n");
                fputs($fp, "<column name=\"number\">" . $order->getId() . "</column>" . "\n");
                fputs($fp, "<column name=\"date_of_create\">" . $order->getCreatedAt() . "</column>" . "\n");
                fputs($fp, "<column name=\"date_of_submit\">" . $order->getSubmitedAt() . "</column>" . "\n");
                fputs($fp, "<table name=\"client\">" . "\n");
                fputs($fp, "<column name=\"name\">" . $order->getClient()->getName() . "</column>" . "\n");
                fputs($fp, "<column name=\"full_name\">" . $order->getClient()->getFullName() . "</column>" . "\n");
                fputs($fp, "<column name=\"contact\">" . $order->getClient()->getContact() . "</column>" . "\n");
                fputs($fp, "<column name=\"phone\">" . $order->getClient()->getPhone() . "</column>" . "\n");
                fputs($fp, "<column name=\"email\">" . $order->getClient()->getEmail() . "</column>" . "\n");
                fputs($fp,
                    "<column name=\"address_jure\">" . $order->getClient()->getAddressJure() . "</column>" . "\n");
                fputs($fp, "<column name=\"inn\">" . $order->getClient()->getInn() . "</column>" . "\n");
                fputs($fp, "<column name=\"kpp\">" . $order->getClient()->getKpp() . "</column>" . "\n");
                fputs($fp, "<column name=\"rs\">" . $order->getClient()->getRs() . "</column>" . "\n");
                fputs($fp, "<column name=\"bank\">" . $order->getClient()->getBank() . "</column>" . "\n");
                fputs($fp, "<column name=\"bik\">" . $order->getClient()->getBik() . "</column>" . "\n");
                fputs($fp, "<column name=\"ks\">" . $order->getClient()->getKs() . "</column>" . "\n");
                fputs($fp, "<column name=\"ogrn\">" . $order->getClient()->getOgrn() . "</column>" . "\n");
                fputs($fp, "<column name=\"okpo\">" . $order->getClient()->getOkpo() . "</column>" . "\n");
                fputs($fp, "</table> " . "\n");
                fputs($fp, "<table name=\"orders\">" . "\n");
                foreach ($order->getInvoices() as $invoice) {
                    fputs($fp, "<column name=\"description\">" . $invoice->getDescription() . "</column>" . "\n");
                    fputs($fp, "<column name=\"number\">" . $invoice->getNumber() . "</column>" . "\n");
                    fputs($fp, "<column name=\"price\">" . $invoice->getPrice() . "</column>" . "\n");
                    fputs($fp, "<column name=\"sum\">" . $invoice->getSum() . "</column>" . "\n");
                }
                fputs($fp, "</table> " . "\n");
                fputs($fp, "</bill> " . "\n");
            }
        }
        fputs($fp, "</database> " . "\n");
        fputs($fp, "</pma_xml_export>" . "\n");
        fputs($fp, "\n");
        fputs($fp, "\n");
        fclose($fp);
        echo file_get_contents(sfConfig::get('sf_upload_dir') . '/' . '1C.xml');

        exit();
    }

    public function executeDesigners(sfWebRequest $request)
    {
        $this->form = new sfForm();
        $this->form->getWidgetSchema()
            ->offsetSet('from', new sfWidgetFormBootstrapDate([
                'label' => 'Период',
            ]))
            ->offsetSet('to', new sfWidgetFormBootstrapDate([
                //
            ]))
            ->offsetSet('manager', new sfWidgetFormDoctrineChoice([
                'model' => 'sfGuardUser',
                'table_method' => 'getManagers',
                'add_empty' => 'Все',
                'label' => 'Менеджер',
            ]))
            ->setNameFormat('filter[%s]');
        $this->form->addCSRFProtection('123456789');
        $this->form->getValidatorSchema()
            ->offsetSet('from', new sfValidatorDate())
            ->offsetSet('to', new sfValidatorDate([
                'required' => false,
            ]))
            ->offsetSet('manager', new sfValidatorDoctrineChoice([
                'model' => 'sfGuardUser',
                'required' => false,
            ]));

        $this->period = [
            'from' => date('Y') . '-01-01',
            'to' => date('Y-m-d 23:59:59'),
        ];
        $this->manager = false;

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('filter'));

            if ($this->form->isValid()) {
                if ($this->form->getValue('from')) {
                    $this->period['from'] = $this->form->getValue('from');
                }

                if ($this->form->getValue('manager')) {
                    $this->manager = $this->form->getValue('manager');
                }

                if ($this->form->getValue('to')) {
                    $this->period['to'] = date('Y-m-d 23:59:59', strtotime($this->form->getValue('to')));
                }
            }
        }

        $this->report = Doctrine_Query::create()
            ->from('sfGuardUser u')
            ->leftJoin("u.Groups g")
            ->leftJoin("u.Works w with (w.finished_at >= ? and w.finished_at <= ?)",
                [$this->period['from'], $this->period['to']])
            ->leftJoin("w.Order o")
            ->andWhereIn("g.name", ["design-worker", "design-master"])
            ->addWhere("w.is_completed = ?", true)
            ->execute();
    }
}
