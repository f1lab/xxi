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
      ->offsetSet('description', new sfWidgetFormInputText(array(),array('style' => 'width:500px;')))
      ->offsetSet('number', new sfWidgetFormInputText(array(),array('style' => 'width:40px;')))
      ->offsetSet('price', new sfWidgetFormInputText(array(),array('style' => 'width:60px;')))
      ->offsetSet('sum', new sfWidgetFormInputText(array(),array('style' => 'width:60px;', 'disabled' => true, 'title' => 'Вычисляется автоматически при сохранении')));

    $this->getWidgetSchema()->setLabels(array(
      'description' => 'Описание заказа',
      'number' => 'количество',
      'price' => 'Цена',
      'sum' => 'Сумма',
    ));

    $this->setValidator('description', new sfValidatorString(
                                    array('required' => true),
                                    array('required' => 'Описание не должно быть пустым.')));
    $this->setValidator('number', new sfValidatorNumber(
                                    array('required' => true),
                                    array('required' => 'Количество - неверное значение')));
    $this->setValidator('price', new sfValidatorNumber(
                                    array('required' => true),
                                    array('required' => 'Цена - неверное значение')));

    $this->setValidator('sum', new sfValidatorPass());
  }
}
