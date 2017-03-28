<?php

/**
 * OrdersTableSettings form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Saritskiy Roman
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OrdersTableSettingsForm extends BaseOrdersTableSettingsForm
{
    public function configure()
    {
        $this->getWidgetSchema()
            ->offsetSet('user_id', new sfWidgetFormInputHidden())
            ->setLabels([
                'id_enabled' => '#',
                'client_id_enabled' => 'Заказчик',
                'approved_at_enabled' => 'Согласовано',
                'due_date_enabled' => 'Срок исполнения',
                'submited_at_enabled' => 'Дата сдачи',
                'state_enabled' => 'Статус',
                'cost_enabled' => 'Стоимость',
                'payed_enabled' => 'Внесено',
                'pay_method_enabled' => 'Способ оплаты',
                'payed_at_enabled' => 'Дата оплаты',
                'manager_enabled' => 'Менеджер',
                'bill_made_enabled' => 'Счёт сформирован',
                'bill_given_enabled' => 'Счёт получен',
                'docs_given_enabled' => 'Документы выданы',
                'comments_enabled' => 'Комментарии',
            ]);
    }
}
