<?php

/**
 * Warehouse form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Saritskiy Roman
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class WarehouseForm extends BaseWarehouseForm
{
  public function configure()
  {
    unset (
      $this["created_at"]
      , $this["created_by"]
      , $this["updated_at"]
      , $this["updated_by"]
      , $this["deleted_at"]
      , $this["version"]
    );

    $this->getWidgetSchema()
      ->offsetGet("users_list")
        ->setAttribute("class", "chzn-select")
        ->getParent()
      ->setLabels([
        "name" => "Наименование",
        "users_list" => "Ответственные",
      ])
    ;
  }
}
