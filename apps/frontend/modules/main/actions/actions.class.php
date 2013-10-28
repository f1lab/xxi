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
}
