<?php

/**
 * material actions.
 *
 * @package    xxi
 * @subpackage material
 * @author     Saritskiy Roman
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class materialActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->materials = Doctrine_Core::getTable('Material')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MaterialForm();
    if ($request->hasParameter('client')) {
      $this->form->setDefaults(array(
        'suppliers_list' => (array) $request->getParameter('client'),
      ));
    }
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MaterialForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($material = Doctrine_Core::getTable('Material')->find(array($request->getParameter('id'))), sprintf('Object material does not exist (%s).', $request->getParameter('id')));
    $this->form = new MaterialForm($material);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($material = Doctrine_Core::getTable('Material')->find(array($request->getParameter('id'))), sprintf('Object material does not exist (%s).', $request->getParameter('id')));
    $this->form = new MaterialForm($material);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($material = Doctrine_Core::getTable('Material')->find(array($request->getParameter('id'))), sprintf('Object material does not exist (%s).', $request->getParameter('id')));
    $material->delete();

    $this->redirect('material/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $material = $form->save();

      $this->redirect($request->hasParameter('client') ? '@supplier?id=' . $request->getParameter('client') : 'material/edit?id='.$material->getId());
    }
  }
}
