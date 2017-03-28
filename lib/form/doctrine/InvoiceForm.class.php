<?php

/**
 * Invoice form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Saritskiy Roman
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InvoiceForm extends BaseInvoiceForm
{
    public function configure()
    {
        $this->getWidgetSchema()
            ->offsetSet('order_id', new sfWidgetFormInputHidden())
            ->offsetSet('description', new sfWidgetFormInputText([], ['style' => 'width:500px;']))
            ->offsetSet('number', new sfWidgetFormInputText([],
                ['type' => 'number', 'step' => '0.01', 'min' => '0', 'class' => 'invoice-number']))
            ->offsetSet('price', new sfWidgetFormInputText([],
                ['type' => 'number', 'step' => '0.01', 'min' => '0', 'class' => 'invoice-price']))
            ->offsetSet('sum', new sfWidgetFormInputText([], [
                'type' => 'number', 'step' => '0.01', 'min' => '0', 'disabled' => true,
                'title' => 'Вычисляется автоматически при сохранении', 'class' => 'invoice-sum',
            ]));

        $this->getWidgetSchema()->setLabels([
            'description' => 'Описание заказа',
            'number' => 'количество',
            'price' => 'Цена',
            'sum' => 'Сумма',
        ]);

        $this->setValidator('description', new sfValidatorString(
            ['required' => true],
            ['required' => 'Описание не должно быть пустым.']));
        $this->setValidator('number', new sfValidatorNumber(
            ['required' => true],
            ['required' => 'Количество - неверное значение']));
        $this->setValidator('price', new sfValidatorNumber(
            ['required' => true],
            ['required' => 'Цена - неверное значение']));

        $this->setValidator('sum', new sfValidatorPass());
    }
}
