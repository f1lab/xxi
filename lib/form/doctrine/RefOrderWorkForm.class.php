<?php

/**
 * RefOrderWork form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Saritskiy Roman
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RefOrderWorkForm extends BaseRefOrderWorkForm
{
  public function configure()
  {
    unset (
      $this['created_at'],
      $this['created_by'],
      $this['updated_at'],
      $this['updated_by']
    );

    $this->getWidgetSchema()
      ->offsetSet('order_id', new sfWidgetFormInputHidden())
      ->offsetSet('work_id', new sfWidgetFormDoctrineChoice([
        'model' => $this->getRelatedModelName('Work'),
        'add_empty' => true,
        'method' => 'getNameWithArea',
        'query' => Doctrine_Query::create()
          ->from('Work w')
          ->leftJoin('w.Area a')
          ->addOrderBy('a.name, w.name')
      ], [
        'class' => 'chzn-select',
      ]))
    ;
  }
}
