<?php

/**
 * MaterialMovementArrival form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Saritskiy Roman
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MaterialMovementArrivalForm extends BaseMaterialMovementArrivalForm
{
  public function configure()
  {
    unset (
      $this["deleted_at"]
      , $this["created_at"]
      , $this["updated_at"]
      , $this["created_by"]
      , $this["updated_by"]
    );

    $this->getWidgetSchema()
      ->offsetSet("arrived_at", new sfWidgetFormBootstrapDateTime([
        "minView" => "2",
        "format" => "yyyy-mm-dd",
      ]))
      ->setLabels([
        "arrived_at" => "Дата поступления",
        "bill" => "Накладная",
        "supplier_id" => "Поставщик",
      ])
      ->offsetGet("supplier_id")
        ->setAttribute("class", "chzn-select")
        ->setOption("add_empty", true)
        ->setOption("query", Doctrine_Query::create()
          ->from("Supplier s")
          ->addOrderBy("s.name")
        )
    ;

    $this->getValidatorSchema()->offsetSet("arrived_at", new sfValidatorBootstrapDateTime());
  }
}
