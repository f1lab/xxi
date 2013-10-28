<?php

/**
 * plan actions.
 *
 * @package    xxi
 * @subpackage plan
 * @author     Saritskiy Roman
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class planActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->refs = Doctrine_Query::create()
      ->from('RefOrderWork row')
      ->leftJoin('row.Order o')
      ->leftJoin('row.Work w')
      ->leftJoin('w.Area a')
      ->addWhere('row.is_completed = ? and (row.planned_start is null and row.planned_finish is null)', false)
      ->addOrderBy('row.created_at')
      ->execute()
    ;
  }

  public function executeEventsourceWorker($request)
  {
    $refs = Doctrine_Query::create()
      ->from('RefOrderWork row')
      ->leftJoin('row.Order o')
      ->leftJoin('row.Work w')
      ->leftJoin('w.Area a')
      ->addWhere('row.is_completed = ? and (row.planned_start is not null and row.planned_finish is not null)', false)
      ->addOrderBy('row.created_at')
      ->execute([], Doctrine_Core::HYDRATE_ARRAY)
    ;

    die(json_encode(array_map(function($ref) {
      return [
        'id' => $ref['id'],
        'title' => $ref['Work']['Area']['name'] . ' / ' . $ref['Work']['name'],
        'start' => $ref['planned_start'],
        'end' => $ref['planned_finish'],
        'className' => 'event-of-area-' . $ref['Work']['Area']['slug'],
        'allDay' => false,
      ];
    }, (array)$refs), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
  }

  public function executePlanEvent($request)
  {
    $event = $request->getParameter('event');
    $ref = Doctrine_Core::getTable('RefOrderWork')->find($event['id']);

    $this->forward404Unless($this->getUser()->hasCredential('сan_edit_planning') and !$ref->isNew());

    $ref
      ->setPlannedStart(date('Y-m-d H:i:s', $event['start']))
      ->setPlannedFinish(date('Y-m-d H:i:s', $event['end'] ?: strtotime('+2 hour', $event['start'])))
      ->save()
    ;

    return sfView::NONE;
  }
}
