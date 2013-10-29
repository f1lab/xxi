<?php

/**
 * main actions.
 *
 * @package    xxi
 * @subpackage main
 * @author     Anatoly Pashin
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mainActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    if ($this->getUser()->hasGroup('master')) {
      $to = 'plan/index';
    } else {
      $to = 'order/index';
    }

    $this->redirect($to);
  }

  public function executeAreaStyles(sfWebRequest $request)
  {
    $areas = Doctrine_Query::create()
      ->from('Area a')
      ->select('a.slug, a.style')
      ->addOrderBy('a.slug')
      ->execute([], Doctrine_Core::HYDRATE_SCALAR)
    ;

    $this->getResponse()->setHttpHeader('Content-Type', 'text/css');

    print (join("\n\n", array_map(function($area) {
      return <<<CSS
        .event-of-area-{$area['a_slug']} {
          {$area['a_style']}
        }
CSS;
    }, $areas)));

    return sfView::NONE;
  }

  public function executeGetWorksAndMastersForArea($request)
  {
    $area = Doctrine_Query::create()
      ->from('Area a')
      ->leftJoin('a.Works w')
      ->leftJoin('a.Masters m')
      ->select('a.name, w.name, m.first_name, m.last_name, m.username')
      ->addWhere('a.id = ?', $request->getParameter('id'))
      ->limit(1)
      ->execute([], Doctrine_Core::HYDRATE_ARRAY)
    ;
    $this->forward404Unless($area and count($area));
    $area = array_pop($area);

    $works = array_map(function($work) {
      return sprintf('<option value="%s">%s</option>'
        , $work['id']
        , $work['name']
      );
    }, $area['Works']);
    $area['Works'] = join("\n", $works);

    $masters = array_map(function($master) {
      return sprintf('<option value="%s">%s(%s)</option>'
        , $master['id']
        , trim($master['first_name'] . ' ' . $master['last_name']), $master['username']
      );
    }, $area['Masters']);
    $area['Masters'] = join("\n", $masters);

    die (json_encode([
      'works' => $area['Works']
      , 'masters' => $area['Masters']
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
  }
}
