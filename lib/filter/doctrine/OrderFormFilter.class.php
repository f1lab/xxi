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
    static public $attributesWithTimestamps = [
        'created',
        'approved',
        'submited',
        'finished',
        "payed",
    ];

    public function configure()
    {
        $fileds = array_keys($this->getFields());
        foreach ($fileds as $field) {
            unset ($this[$field]);
        }
        $this->disableCSRFProtection();

        $this->getWidgetSchema()
            ->offsetSet('client_id', new sfWidgetFormDoctrineChoice([
                'model' => $this->getRelatedModelName('Client'),
                'add_empty' => false,
                'order_by' => [
                    'name',
                    'asc',
                ],
                'multiple' => true,
            ], [
                'class' => 'chzn-select',
                'data-placeholder' => 'Выберите…',
            ]))
            ->offsetSet('created_by', new sfWidgetFormDoctrineChoice([
                'model' => 'sfGuardUser',
                'table_method' => 'getManagers',
                'multiple' => true,
            ], [
                'class' => 'chzn-select',
                'data-placeholder' => 'Выберите…',
            ]))
            ->offsetSet('state', new sfWidgetFormChoice([
                'choices' => OrderTable::$states,
                'multiple' => true,
            ], [
                'class' => 'chzn-select',
                'data-placeholder' => 'Выберите…',
            ]))
            ->offsetSet('area', new sfWidgetFormChoice([
                'choices' => OrderTable::$area,
                'multiple' => true,
            ], [
                'class' => 'chzn-select',
                'data-placeholder' => 'Выберите…',
            ]))
            ->offsetSet('pay_method', new sfWidgetFormChoice([
                'choices' => OrderTable::$payMethods,
                'multiple' => true,
            ], [
                'class' => 'chzn-select',
                'data-placeholder' => 'Выберите…',
            ]))
            ->offsetSet('bill_made', new sfWidgetFormChoice(['choices' => ['' => 'да или нет', 1 => 'да', 0 => 'нет']]))
            ->offsetSet('bill_given',
                new sfWidgetFormChoice(['choices' => ['' => 'да или нет', 1 => 'да', 0 => 'нет']]))
            ->offsetSet('docs_given',
                new sfWidgetFormChoice(['choices' => ['' => 'да или нет', 1 => 'да', 0 => 'нет']]))
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
            ->offsetSet('has_payments_from', new sfWidgetFormBootstrapDate())
            ->offsetSet('has_payments_to', new sfWidgetFormBootstrapDate())
            ->offsetSet('works_list', new sfWidgetFormChoice([
                'choices' => [
                    '' => 'без разницы', 'without' => 'не заполнен', 'completed' => 'выполнен',
                ],
            ]))
            ->setLabels([
                'client_id' => 'Клиент',
                'created_by' => 'Менеджер',
                'created_at_from' => 'Дата создания',
                'approved_at_from' => 'Дата согласования',
                'finished_at_from' => 'Дата выполнения',
                'submited_at_from' => 'Дата сдачи',
                'has_payments_from' => 'Дата внесения средств',
                'payed_at_from' => 'Дата полной оплаты',
                'state' => 'Статус',
                'area' => 'Участок',
                'bill_made' => 'Счёт сформирован',
                'bill_given' => 'Счёт доставлен',
                'docs_given' => 'Документы выданы',
                'works_list' => 'Список работ',
                'pay_method' => 'Способ оплаты',
            ])
            ->setNameFormat('order_filters[%s]');

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
            ->offsetSet('has_payments_from', new sfValidatorPass())
            ->offsetSet('has_payments_to', new sfValidatorPass())
            ->offsetSet('payed_at_to', new sfValidatorPass())
            ->offsetSet('works_list', new sfValidatorPass())
            ->offsetSet('pay_method', new sfValidatorPass());

        $this->setDefaults([
            'client_id' => [],
            'created_by' => [],
            'state' => [],
            'area' => [],
            'created_at_from' => ['day' => '01', 'month' => '01', 'year' => '2015'],
            'created_at_to' => ['day' => '', 'month' => '', 'year' => ''],
            'approved_at_from' => ['day' => '', 'month' => '', 'year' => ''],
            'approved_at_to' => ['day' => '', 'month' => '', 'year' => ''],
            'submited_at_from' => ['day' => '', 'month' => '', 'year' => ''],
            'submited_at_to' => ['day' => '', 'month' => '', 'year' => ''],
            'finished_at_from' => ['day' => '', 'month' => '', 'year' => ''],
            'finished_at_to' => ['day' => '', 'month' => '', 'year' => ''],
            'payed_at_from' => ['day' => '', 'month' => '', 'year' => ''],
            'payed_at_to' => ['day' => '', 'month' => '', 'year' => ''],
            'has_payments_from' => ['day' => '', 'month' => '', 'year' => ''],
            'has_payments_to' => ['day' => '', 'month' => '', 'year' => ''],
            'pay_method' => [],
        ]);
    }

    public function getFilterQuery($filter, $user)
    {
        $query = Doctrine_Core::getTable('Order')->createQuery('a, a.Client, a.Creator');

        if ($user->hasGroup('worker') or $user->hasGroup('monitor')) {
            $this->setDefault('state', [
                'work',
                'working',
                'done',
            ]);
        } elseif ($user->hasGroup('master')) {
            $this->setDefault('state', [
                'working',
            ]);
        } elseif ($user->hasGroup("design-worker")) {
            $this->setDefault("state", [
                "prepress",
                "prepress-working",
                "prepress-done",
            ]);
        }

        if ($user->hasCredential('manager')) {
            $this->setDefault('created_by', [
                $user->getGuardUser()->getId(),
            ]);

            $this->setDefault('state', [
                'calculating',
                'work',
                'working',
                'done',
                'submited',
                'prepress',
                'prepress-working',
                'prepress-done',
            ]);
        }

        if ($filter !== null) {
            $this->bind($filter);
        }

        if (true == ($values = array_merge($this->getDefaults(), $this->getValues()))) {
            if (count($values['client_id'])) {
                $query->andWhereIn('client_id', $values['client_id']);
            }

            if (count($values['created_by'])) {
                $query->andWhereIn('created_by', $values['created_by']);
            }

            array_walk(self::$attributesWithTimestamps, function ($attribute, $key) use ($values, &$query) {
                if (
                    $values[$attribute . "_at_from"]["day"]
                    and $values[$attribute . "_at_from"]["month"]
                    and $values[$attribute . "_at_from"]["year"]
                ) {
                    $query->andWhere($attribute . "_at >= ?", date(
                        "Y-m-d 00:00:00",
                        mktime(0, 0, 0, $values[$attribute . "_at_from"]["month"],
                            $values[$attribute . "_at_from"]["day"], $values[$attribute . "_at_from"]["year"])
                    ));
                }

                if (
                    $values[$attribute . "_at_to"]["day"]
                    and $values[$attribute . "_at_to"]["month"]
                    and $values[$attribute . "_at_to"]["year"]
                ) {
                    $query->andWhere($attribute . "_at <= ?", date(
                        "Y-m-d 23:59:59",
                        mktime(0, 0, 0, $values[$attribute . "_at_to"]["month"], $values[$attribute . "_at_to"]["day"],
                            $values[$attribute . "_at_to"]["year"])
                    ));
                }
            });

            $attr = 'has_payments';
            $from = false;
            $to = false;
            if (
                $values[$attr . "_from"]['day']
                && $values[$attr . "_from"]['month']
                && $values[$attr . "_from"]['year']
            ) {
                $from = date(
                    "Y-m-d 00:00:00",
                    mktime(0, 0, 0, $values[$attr . "_from"]["month"], $values[$attr . "_from"]["day"],
                        $values[$attr . "_from"]["year"])
                );
            }
            if (
                $values[$attr . "_to"]['day']
                && $values[$attr . "_to"]['month']
                && $values[$attr . "_to"]['year']
            ) {
                $to = date(
                    "Y-m-d 23:59:59",
                    mktime(0, 0, 0, $values[$attr . "_to"]["month"], $values[$attr . "_to"]["day"],
                        $values[$attr . "_to"]["year"])
                );
            }
            if ($from || $to) {
                $query->innerJoin('a.Pays pays');
                if ($from) {
                    $query->addWhere('pays.payed_at >= ?', $from);
                }
                if ($to) {
                    $query->addWhere('pays.payed_at <= ?', $to);
                }
            }

            if (count($values['state']) and $values['state'][0]) {
                $query->andWhereIn('state', $values['state']);
            }

            if (count($values['area']) and $values['area'][0]) {
                $query->andWhereIn('area', $values['area']);
            }

            if (count($values['pay_method']) and $values['pay_method'][0]) {
                $query->andWhereIn('pay_method', $values['pay_method']);
            }

            if (isset($values['bill_made']) and in_array($values['bill_made'], ["0", "1"], true)) {
                $query->andWhere('bill_made = ?', (bool)$values['bill_made']);
            }

            if (isset($values['bill_given']) and in_array($values['bill_given'], ["0", "1"], true)) {
                $query->andWhere('bill_given = ?', (bool)$values['bill_given']);
            }

            if (isset($values['docs_given']) and in_array($values['docs_given'], ["0", "1"], true)) {
                $query->andWhere('docs_given = ?', (bool)$values['docs_given']);
            }

            if (isset($values['works_list'])) {
                if ($values['works_list'] === 'without') {
                    $query
                        ->leftJoin('a.RefOrderWork rof')
                        ->addWhere('rof.id is null');
                } elseif ($values['works_list'] === 'completed') {
                    $query
                        ->leftJoin('a.RefOrderWork rof1')
                        ->addWhere('a.id NOT IN (SELECT a1.id from Order a1 LEFT JOIN a1.RefOrderWork rof2 WHERE rof2.is_completed = false)')
                        ->addWhere('rof1.id IS NOT NULL');
                }
            }
        }

        return $query->orderBy('a.created_at asc');
    }
}
