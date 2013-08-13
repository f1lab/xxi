<?php

/**
 * arrival actions.
 *
 * @package    xxi
 * @subpackage arrival
 * @author     Saritskiy Roman
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class arrivalActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->arrivals = Doctrine_Query::create()
      ->from('Arrival a')
      ->execute()
    ;
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ArrivalForm();

    if ($request->hasParameter('supplier_id')) {
      $this->form
        ->setDefaults([
          'supplier_id' => $request->getParameter('supplier_id'),
        ])
        ->getWidgetSchema()
          ->offsetSet('supplier_id', new sfWidgetFormInputHidden())
      ;
    }
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ArrivalForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($arrival = Doctrine_Core::getTable('Arrival')->find(array($request->getParameter('id'))), sprintf('Object arrival does not exist (%s).', $request->getParameter('id')));
    $this->form = new ArrivalForm($arrival);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($arrival = Doctrine_Core::getTable('Arrival')->find(array($request->getParameter('id'))), sprintf('Object arrival does not exist (%s).', $request->getParameter('id')));
    $this->form = new ArrivalForm($arrival);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($arrival = Doctrine_Core::getTable('Arrival')->find(array($request->getParameter('id'))), sprintf('Object arrival does not exist (%s).', $request->getParameter('id')));
    $arrival->delete();

    $this->redirect('arrival/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $arrival = $form->save();

      $this->redirect('arrival/edit?id='.$arrival->getId());
    }
  }
}
