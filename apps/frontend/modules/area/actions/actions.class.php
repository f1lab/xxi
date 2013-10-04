<?php

/**
 * area actions.
 *
 * @package    xxi
 * @subpackage area
 * @author     Saritskiy Roman
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class areaActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->areas = Doctrine_Query::create()
      ->from('Area a')
      ->execute()
    ;
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AreaForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AreaForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($area = Doctrine_Core::getTable('Area')->find(array($request->getParameter('id'))), sprintf('Object area does not exist (%s).', $request->getParameter('id')));
    $this->form = new AreaForm($area);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($area = Doctrine_Core::getTable('Area')->find(array($request->getParameter('id'))), sprintf('Object area does not exist (%s).', $request->getParameter('id')));
    $this->form = new AreaForm($area);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($area = Doctrine_Core::getTable('Area')->find(array($request->getParameter('id'))), sprintf('Object area does not exist (%s).', $request->getParameter('id')));
    $area->delete();

    $this->redirect('area/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $area = $form->save();

      $this->redirect('area/edit?id='.$area->getId());
    }
  }
}
