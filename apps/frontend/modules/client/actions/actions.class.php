<?php

/**
 * client actions.
 *
 * @package    xxi
 * @subpackage client
 * @author     Anatoly Pashin
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class clientActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->clients = Doctrine_Core::getTable('Client')->createQuery('a')
      ->orderBy('name asc')
      ->execute()
    ;
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ClientForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new ClientForm();
    $this->processForm($request, $this->form, array('success', 'Отлично!', 'Клиент добавлен.'), '@clients');
    $this->setTemplate('new');
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->_state = $request->getParameter('state');
    $this->client = Doctrine_Core::getTable('Client')->createQuery('a')
      ->where('a.id = ?', $request->getParameter('id'))
      ->fetchOne()
    ;
    $this->forward404Unless($this->client);
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->client = Doctrine_Core::getTable('Client')
      ->find($request->getParameter('id'))
    ;
    $this->form = new ClientForm($this->client);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->client = Doctrine_Core::getTable('Client')
      ->find($request->getParameter('id'))
    ;
    $this->form = new ClientForm($this->client);
    $this->processForm($request, $this->form, array('success', 'Отлично!', 'Изменения сохранены.'), '@client?id=' . $this->client->getId());
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
