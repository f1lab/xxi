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
    $this->groups = $this->getUser()->getGroups();
    count($this->groups) and $this->redirect('@orders');
  }
}
