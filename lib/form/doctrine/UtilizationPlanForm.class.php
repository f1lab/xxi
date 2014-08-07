<?php

/**
 * UtilizationPlan form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Saritskiy Roman
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UtilizationPlanForm extends BaseUtilizationPlanForm
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
        'model' => 'Material',
        'method' => 'getNameWithDimension',
        'add_empty' => true,
        'query' => Doctrine_Query::create()
          ->from('Material m')
          ->leftJoin('m.Dimension')
          ->addOrderBy('m.name')
      ), array(
        'class' => 'chzn-select',
      )))
      ->offsetSet('order_id', new sfWidgetFormInputHidden())
      ->offsetSet("amount", new sfWidgetFormInputText([], [
        "type" => "number",
        "min" => 0,
        "step" => 0.0001,
        "placeholder" => "Количество",
      ]))
    ;
  }
}
