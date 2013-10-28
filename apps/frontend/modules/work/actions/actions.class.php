<?php

/**
 * work actions.
 *
 * @package    xxi
 * @subpackage work
 * @author     Saritskiy Roman
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class workActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->works = Doctrine_Query::create()
      ->from('Work w')
      ->execute()
    ;
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new WorkForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new WorkForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($work = Doctrine_Core::getTable('Work')->find(array($request->getParameter('id'))), sprintf('Object work does not exist (%s).', $request->getParameter('id')));
    $this->form = new WorkForm($work);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($work = Doctrine_Core::getTable('Work')->find(array($request->getParameter('id'))), sprintf('Object work does not exist (%s).', $request->getParameter('id')));
    $this->form = new WorkForm($work);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($work = Doctrine_Core::getTable('Work')->find(array($request->getParameter('id'))), sprintf('Object work does not exist (%s).', $request->getParameter('id')));
    $work->delete();

    $this->redirect('work/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $work = $form->save();

      $this->redirect('work/edit?id='.$work->getId());
    }
  }
}
