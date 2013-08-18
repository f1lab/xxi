<?php

/**
 * Material form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Saritskiy Roman
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MaterialForm extends BaseMaterialForm
{
  public function configure()
  {
    unset (
      $this['deleted_at']
    );

    $this->getWidgetSchema()
      ->setLabels(array(
        'name' => 'Наименование',
        'dimension_id' => 'Единица измерения',
      ))
      ->offsetGet('name')->setAttribute('class', 'input-block-level')
    ;
  }
}
