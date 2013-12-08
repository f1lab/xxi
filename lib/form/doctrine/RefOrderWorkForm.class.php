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
      $this['created_at']
      , $this['created_by']
      , $this['updated_at']
      , $this['is_completed']
      , $this['planned_start']
      , $this['planned_finish']
      , $this['finished_at']
      , $this['updated_by']
    );

    $user = sfContext::getInstance()->getUser();

    $this->getWidgetSchema()
      ->offsetSet('order_id', new sfWidgetFormInputHidden())

      ->offsetSet('area_id', new sfWidgetFormDoctrineChoice([
        'model' => $this->getRelatedModelName('Area'),
        'add_empty' => true,
        'query' => Doctrine_Query::create()
          ->from('Area a')
          ->orderBy('a.name')
          ->leftJoin("a.Workers ww")
          ->leftJoin("ww.Groups g")
          ->andWhereIn("g.name", array_merge(
            $user->hasCredential("worker") ? ["worker"] : []
            , $user->hasCredential("design-worker") ? ["design-worker"] : []
          ) ?: [])
      ], ['class' => 'chzn-select area-selector']))

      ->offsetSet('work_id', new sfWidgetFormDoctrineChoice([
        'model' => $this->getRelatedModelName('Work'),
        'add_empty' => true,
      ], ['class' => 'chzn-select work-selector']))

      ->offsetSet('master_id', new sfWidgetFormDoctrineChoice([
        'model' => $this->getRelatedModelName('Master'),
        'add_empty' => true,
        'query' => Doctrine_Query::create()
          ->from('sfGuardUser u')
          ->leftJoin('u.Groups g')
          ->andWhereIn("g.name", array_merge(
            $user->hasCredential("worker") ? ["master"] : []
            , $user->hasCredential("design-worker") ? ["design-master"] : []
          ) ?: [])
          ->orderBy('u.last_name, u.first_name')
      ], ['class' => 'chzn-select master-selector']))
    ;
  }
}
