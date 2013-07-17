<?php

/**
 * Utilization form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Saritskiy Roman
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UtilizationForm extends BaseUtilizationForm
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
      ->offsetSet('material_id', new sfWidgetFormDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Material'),
        'add_empty' => false,
        'method' => 'getNameWithDimension',
        'add_empty' => true,
      ), array(
        'class' => 'chzn-select',
      )))
      ->offsetSet('order_id', new sfWidgetFormInputHidden())
    ;
  }
}
