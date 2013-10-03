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
    ;

    $this->mergePostValidator(new UtilizationValidator());
  }
}

class UtilizationValidator extends sfValidatorBase {
  public function configure($options = [], $messages = [])
  {
    parent::configure();
    $this->addMessage('not_enough_material', 'Недостаточно материала для такого расхода');
  }

  public function doClean($values) {
    if ($values['amount'] > Doctrine_Core::getTable('Material')->find($values['material_id'])->getRemainedAmount()) {
      $error = new sfValidatorError($this, 'not_enough_material', ['value' => $values]);
      throw new sfValidatorErrorSchema($this, array('amount' => $error));
    }

    return $values;
  }
}
