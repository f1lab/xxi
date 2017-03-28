<?php

/**
 * Order form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Anatoly Pashin
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OrderForm extends BaseOrderForm
{
    public function configure()
    {
        unset (
            $this['created_at'],
            $this['updated_at'],
            $this['created_by'],
            $this['updated_by'],
            $this['deleted_at'],
            $this['payed_at'],
            $this['area'],
            $this['version']
        );

        $invoicesRelation = [
            'Invoices' => [
                'considerNewFormEmptyFields' => ['description', 'number', 'price', 'sum'],
                'noNewForm' => false,
                // 'noNewForm'                     => true,
                'newFormLabel' => 'Новый выпрос',
                'newFormClass' => 'InvoiceForm',
                'newFormClassArgs' => [['sf_user' => $this->getOption('sf_user')]],
                'displayEmptyRelations' => true,
                'formClass' => 'InvoiceForm',
                'formClassArgs' => [['ah_add_delete_checkbox' => true]],
                'newFormAfterExistingRelations' => true,
                'formFormatter' => null,
                'multipleNewForms' => true,
                'newFormsInitialCount' => 1,
                'newFormsContainerForm' => null,
                // pass BaseForm object here or we will create ahNewRelationsContainerForm
                'newRelationButtonLabel' => '+',
                'newRelationAddByCloning' => true,
                'newRelationUseJSFramework' => 'jQuery',
                // 'customEmbeddedFormLabelMethod' => 'getLabelTitle'
            ],
        ];

        $paysRelation = [
            'Pays' => [
                'considerNewFormEmptyFields' => ['payed_at', 'amount'],
                'noNewForm' => false,
                // 'noNewForm'                     => true,
                'newFormLabel' => 'Новый выпрос',
                'newFormClass' => 'PayForm',
                'newFormClassArgs' => [['sf_user' => $this->getOption('sf_user')]],
                'displayEmptyRelations' => true,
                'formClass' => 'PayForm',
                'formClassArgs' => [['ah_add_delete_checkbox' => true]],
                'newFormAfterExistingRelations' => true,
                'formFormatter' => null,
                'multipleNewForms' => true,
                'newFormsInitialCount' => 1,
                'newFormsContainerForm' => null,
                // pass BaseForm object here or we will create ahNewRelationsContainerForm
                'newRelationButtonLabel' => '+',
                'newRelationAddByCloning' => false,
                'newRelationUseJSFramework' => 'jQuery',
                // 'customEmbeddedFormLabelMethod' => 'getLabelTitle'
            ],
        ];

        $worksRelation = [
            'RefOrderWork' => [
                'considerNewFormEmptyFields' => ['work_id'],
                'noNewForm' => false,
                'newFormClassArgs' => [['sf_user' => $this->getOption('sf_user')]],
                'displayEmptyRelations' => true,
                'formClassArgs' => [['ah_add_delete_checkbox' => true]],
                'newFormAfterExistingRelations' => true,
                'formFormatter' => null,
                'multipleNewForms' => true,
                'newFormsInitialCount' => 1,
                'newFormsContainerForm' => null,
                // pass BaseForm object here or we will create ahNewRelationsContainerForm
                'newRelationButtonLabel' => '+',
                'newRelationAddByCloning' => false,
                'newRelationUseJSFramework' => 'jQuery',
            ],
        ];

        $utilizationPlansRelation = [
            'UtilizationPlans' => [
                'considerNewFormEmptyFields' => ['material_id', 'amount'],
                'noNewForm' => false,
                'newFormClassArgs' => [['sf_user' => $this->getOption('sf_user')]],
                'displayEmptyRelations' => true,
                'formClassArgs' => [['ah_add_delete_checkbox' => true]],
                'newFormAfterExistingRelations' => true,
                'formFormatter' => null,
                'multipleNewForms' => true,
                'newFormsInitialCount' => 1,
                'newFormsContainerForm' => null,
                // pass BaseForm object here or we will create ahNewRelationsContainerForm
                'newRelationButtonLabel' => '+',
                'newRelationAddByCloning' => false,
                'newRelationUseJSFramework' => 'jQuery',
            ],
        ];

        $user = sfContext::getInstance()->getUser();
        $this->embedRelations(array_merge(
            $user->hasCredential('can_set_order_works') && !$this->getObject()->isNew() ? $worksRelation : [],
            $user->hasCredential('can_set_order_works') && !$this->getObject()->isNew() ? $utilizationPlansRelation
                : [],
            $user->hasCredential("manager")
            || !($user->hasGroup('master') || $user->hasGroup('worker')
                || $user->hasGroup('design-master')
                || $user->hasGroup('design-worker')) ? $invoicesRelation : [],
            (!$this->getObject()->isNew() and $user->hasCredential('director') || $user->hasGroup('buhgalter'))
                ? $paysRelation : []
        ));

        $this->getWidgetSchema()
            ->offsetSet('client_id', new sfWidgetFormDoctrineChoice([
                'model' => $this->getRelatedModelName('Client'),
                'add_empty' => false,
                'order_by' => [
                    'name',
                    'asc',
                ],
                'method' => 'getNameWithDiscount',
            ], [
                'class' => 'chzn-select makePizdatoWithDiscount',
            ]))
            ->offsetSet('state', new sfWidgetFormChoice([
                'choices' => OrderTable::getSetableStatesWithNames(),
            ]))
            ->offsetSet('due_date', new sfWidgetFormBootstrapDateTime())
            ->offsetSet('approved_at', new sfWidgetFormBootstrapDate())
            ->offsetSet('expected_at', new sfWidgetFormBootstrapDateTime())
            ->offsetSet('started_at', new sfWidgetFormBootstrapDate())
            ->offsetSet('finished_at', new sfWidgetFormBootstrapDate())
            ->offsetSet('submited_at', new sfWidgetFormBootstrapDate())
            ->offsetSet('execution_time', new sfWidgetFormInputHidden())
            ->offsetSet('pay_method', new sfWidgetFormChoice([
                'choices' => OrderTable::$payMethods,
            ]));

        $this->getWidgetSchema()->setLabels([
            'client_id' => 'Клиент',
            'description' => 'Подробное описание заказа',
            'additional' => 'Доп. информация',
            'due_date' => 'Дата / время',
            'approved_at' => 'Дата согласования с заказчиком',
            'files' => 'Файлы',
            'installation_cost' => 'Монтаж',
            'design_cost' => 'Дизайн (препресс)',
            'contractors_cost' => 'Стоимость производства',
            'delivery_cost' => 'Доставка',
            'cost' => 'Общая стоимость работ',
            'started_at' => 'Дата поступления в работу',
            'finished_at' => 'Дата выполнения',
            'submited_at' => 'Дата сдачи заказа',
            'state' => ' ',
            'pay_method' => 'Способ оплаты',
            'recoil' => 'Гарантийная сумма',
            'payed' => 'Внесённые средства',
            'payed_at' => 'Дата полной оплаты',
            'expected_at' => 'Планируемая дата выполнения',
            'area' => 'Участок',
            'bill_made' => 'Счёт сформирован',
            'bill_given' => 'Счёт получен заказчиком',
            'docs_given' => 'Документы выданы',
            'execution_time' => 'Время',
            'waybill_number' => 'Номер ТТН',
        ]);

        $this->getWidgetSchema()->offsetGet('description')->setAttribute('class', 'input-block-level');
        $this->getWidgetSchema()->offsetGet('additional')->setAttribute('class', 'input-block-level');
        $this->getWidgetSchema()->offsetGet('files')->setAttribute('class', 'input-block-level');

        $this->getWidgetSchema()->offsetGet('cost')
            ->setAttribute('class', 'span2')
            ->setAttribute('type', 'number')
            ->setAttribute('min', 0.00)
            ->setAttribute('step', 0.01);
        $this->getWidgetSchema()->offsetGet('design_cost')
            ->setAttribute('class', 'span2')
            ->setAttribute('type', 'number')
            ->setAttribute('min', 0.00)
            ->setAttribute('step', 0.01);
        $this->getWidgetSchema()->offsetGet('contractors_cost')
            ->setAttribute('class', 'span2')
            ->setAttribute('type', 'number')
            ->setAttribute('min', 0.00)
            ->setAttribute('step', 0.01);
        $this->getWidgetSchema()->offsetGet('installation_cost')
            ->setAttribute('class', 'span2')
            ->setAttribute('type', 'number')
            ->setAttribute('min', 0.00)
            ->setAttribute('step', 0.01);
        $this->getWidgetSchema()->offsetGet('delivery_cost')
            ->setAttribute('class', 'span2')
            ->setAttribute('type', 'number')
            ->setAttribute('min', 0.00)
            ->setAttribute('step', 0.01);

        $postValidators = new sfValidatorAnd([
            new sfValidatorCallback(['callback' => [$this, 'checkDatesRequiredOnAllStatusesExceptCalculating']]),
            new sfValidatorCallback(['callback' => [$this, 'checkAllWorksMustBeFinishedBeforeStateSubmitted']]),
        ]);

        $this
            ->getValidatorSchema()
            ->offsetSet('description',
                new sfValidatorString(['required' => false], ['required' => 'Поле не должно быть пустым.']))
            ->offsetSet('expected_at', new sfValidatorBootstrapDateTime(['required' => false]))
            ->offsetSet('cost', new sfValidatorNumber(['required' => true, 'min' => 0.01],
                ['min' => 'Стоимость не может быть нулевой']))
            ->setPostValidator($postValidators);

        $editableFields = array_keys(array_filter([
            "client_id" => $user->hasGroup("director") or $user->hasGroup("manager"),
            "description" => $user->hasGroup("director") or $user->hasGroup("manager"),
            "due_date" => $user->hasGroup("director") or $user->hasGroup("manager"),
            "approved_at" => $user->hasGroup("director") or $user->hasGroup("manager"),
            "files" => $user->hasGroup("director") or $user->hasGroup("manager") or $user->hasGroup("design-master"),

            "installation_cost" => $user->hasCredential(\sfGuardPermissionTable::CAN_EDIT_COSTS),
            "design_cost" => $user->hasCredential(\sfGuardPermissionTable::CAN_EDIT_COSTS),
            "contractors_cost" => $user->hasCredential(\sfGuardPermissionTable::CAN_EDIT_COSTS),
            "delivery_cost" => $user->hasCredential(\sfGuardPermissionTable::CAN_EDIT_COSTS),
            "cost" => $user->hasCredential(\sfGuardPermissionTable::CAN_EDIT_COSTS),
            "pay_method" => $user->hasCredential(\sfGuardPermissionTable::CAN_EDIT_COSTS),
            "recoil" => $user->hasCredential(\sfGuardPermissionTable::CAN_EDIT_COSTS),

            "expected_at" => $user->hasGroup("worker"),
            "started_at" => $user->hasGroup("director") or $user->hasGroup("worker"),
            "finished_at" => $user->hasGroup("director"),
            "submited_at" => $user->hasGroup("director"),

            "bill_made" => $user->hasCredential("director") or $user->hasGroup("buhgalter"),
            "bill_given" => $user->hasCredential("director") or $user->hasGroup("buhgalter"),
            "docs_given" => $user->hasCredential("director") or $user->hasGroup("buhgalter"),
            "waybill_number" => $user->hasCredential("director") or $user->hasGroup("buhgalter"),

            "new_RefOrderWork" => !$this->getObject()->isNew() and $user->hasCredential("can_set_order_works"),
            "RefOrderWork" => !$this->getObject()->isNew() and $user->hasCredential("can_set_order_works"),

            "new_UtilizationPlans" => !$this->getObject()->isNew() and $user->hasCredential("can_set_order_works"),
            "UtilizationPlans" => !$this->getObject()->isNew() and $user->hasCredential("can_set_order_works"),

            "new_Invoices" => $user->hasCredential("manager") or (!$user->hasGroup("worker")
                    and !$user->hasGroup("design-worker") and !$user->hasGroup("master")
                    and !$user->hasGroup("design-master")),
            "Invoices" => $user->hasCredential("manager") or (!$user->hasGroup("worker")
                    and !$user->hasGroup("design-worker") and !$user->hasGroup("master")
                    and !$user->hasGroup("design-master")),

            "new_Pays" => !$this->getObject()->isNew() and $user->hasCredential("director")
                || $user->hasGroup("buhgalter"),
            "Pays" => !$this->getObject()->isNew() and $user->hasCredential("director") || $user->hasGroup("buhgalter"),

            "state" => $user->hasGroup("director") or $user->hasGroup("worker") or $user->hasGroup("manager")
                or $user->hasGroup("design-worker"),
        ])); // empty callback for array_filter removes false values

        $this->useFields($editableFields);
    }

    public function checkDatesRequiredOnAllStatusesExceptCalculating($validator, $values)
    {
        $errors = [];
        $errorRequired = new sfValidatorError($validator, 'Обязательно для заполнения');

        // allow `costs` edit in states listed below only for credential holders
        if (
            !in_array($values['state'], ["calculating", "prepress", "prepress-working", "prepress-done", "work"])
            && !sfContext::getInstance()->getUser()->hasCredential('allow costs edit in all states')
        ) {
            $order = $this->getObject();
            $errorString = 'Стоимость можно редактировать в статусах «На просчёте», «Необходим дизайн», «Дизайн в работе», «Дизайн готов» и «В цех». Предыдущее значение «%value%».';
            foreach (['installation_cost', 'design_cost', 'contractors_cost', 'delivery_cost', 'cost'] as $field) {
                if (isset($values[$field]) and $order[$field] != str_replace(',', '.', $values[$field])) {
                    $errors[$field] = new sfValidatorError($validator, $errorString, ['value' => $order[$field]]);
                }
            }
        }

        // `approved_at` and `due_date` must be set for all states except `calculating`
        if ($values['state'] !== 'calculating') {
            if (isset($this['approved_at']) && empty($values['approved_at'])) {
                $errors['approved_at'] = $errorRequired;
            }

            if (isset($this['due_date']) && empty($values['due_date'])) {
                $errors['due_date'] = $errorRequired;
            }
        }

        if (count($errors)) {
            throw new sfValidatorErrorSchema($validator, $errors);
        }

        return $values;
    }

    public function checkAllWorksMustBeFinishedBeforeStateSubmitted($validator, $values)
    {
        if ($values['state'] === \OrderTable::STATE_SUBMITTED) {
            /** @var \Order $order */
            $order = $this->getObject();
            /** @var \RefOrderWork $work */
            foreach ($order->getRefOrderWork() as $work) {
                if (!$work->getIsCompleted()) {
                    $error = new sfValidatorError($validator,
                        'Невозможно перевести в статус «Сдан», так как есть незакрытые работы');
                    throw new sfValidatorErrorSchema($validator, ['state' => $error]);
                }
            }
        }

        return $values;
    }
}
