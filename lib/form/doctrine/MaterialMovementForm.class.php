<?php

/**
 * MaterialMovement form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Saritskiy Roman
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MaterialMovementForm extends BaseMaterialMovementForm
{
  public function configure()
  {
    unset (
      $this['deleted_at']
      , $this['created_at']
      , $this['updated_at']
      , $this['created_by']
      , $this['updated_by']
    );

    $this->embedRelations([
      "Materials" => [
        "considerNewFormEmptyFields" => ["amount", "price"],
        "multipleNewForms" => true,
        "newFormsInitialCount" => 1,
      ],
    ]);
  }
}
