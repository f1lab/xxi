<?php

/**
 * supplier actions.
 *
 * @package    xxi
 * @subpackage client
 * @author     Anatoly Pashin
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class supplierActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->clients = Doctrine_Core::getTable('Supplier')->createQuery('a')
      ->orderBy('name asc')
      ->execute()
    ;
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SupplierForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new SupplierForm();
    $this->processForm($request, $this->form, array('success', 'Отлично!', 'Поставщик добавлен.'), '@suppliers');
    $this->setTemplate('new');
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->client = Doctrine_Query::create()
      ->from('Supplier s')
      ->leftJoin('s.Materials m')
      ->innerJoin('m.Dimension d')
      ->where('s.id = ?', $request->getParameter('id'))
      ->fetchOne()
    ;
    $this->forward404Unless($this->client);
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->client = Doctrine_Core::getTable('Supplier')
      ->find($request->getParameter('id'))
    ;
    $this->form = new SupplierForm($this->client);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->client = Doctrine_Core::getTable('Supplier')
      ->find($request->getParameter('id'))
    ;
    $this->form = new SupplierForm($this->client);
    $this->processForm($request, $this->form, array('success', 'Отлично!', 'Изменения сохранены.'), '@supplier?id=' . $this->client->getId());
    $this->setTemplate('edit');
  }

  public function processForm(sfWebRequest $request, sfForm $form, $flash=false, $redirect=false)
  {
    $form->bind(
      $request->getParameter($form->getName()),
      $request->getFiles($form->getName())
    );

    if ($form->isValid())
    {
      $object = $form->save();
      if ($flash and is_array($flash)) {
        $this->getUser()->setFlash('message', $flash);
      }
      if ($redirect) {
        $this->redirect($redirect);
      }
    }
  }
}
