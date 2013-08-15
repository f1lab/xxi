<?php

/**
 * Pay form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Saritskiy Roman
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PayForm extends BasePayForm
{
  public function configure()
  {
    unset (
      $this['created_at'],
      $this['updated_at'],
      $this['created_by'],
      $this['updated_by']
    );

    $this->getWidgetSchema()
      ->offsetSet('order_id', new sfWidgetFormInputHidden())
      ->offsetSet('payed_at', new sfWidgetFormBootstrapDateTime([
        'format' => 'yyyy-mm-dd',
        'minView' => '2',
      ]))
    ;

    $this->getValidatorSchema()
      ->offsetSet('payed_at', new sfValidatorBootstrapDateTime())
    ;
  }
}
