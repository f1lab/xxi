<?php

/**
 * order actions.
 *
 * @package    xxi
 * @subpackage order
 * @author     Anatoly Pashin
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orderActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->orders = Doctrine_Core::getTable('Order')->createQuery('a, a.Client')
      ->orderBy('created_at')
      ->execute()
    ;
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->order = Doctrine_Core::getTable('Order')
      ->find($request->getParameter('id'))
    ;
    $this->forward404Unless($this->order);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new OrderForm();
    if ($request->getParameter('client')) {
      $this->form->setDefault('client_id', $request->getParameter('client'));
    }
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new OrderForm();
    $this->processForm($request, $this->form, array('success', 'Отлично!', 'Заказ добавлен.'), '@orders');
    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->order = Doctrine_Core::getTable('Order')
      ->find($request->getParameter('id'))
    ;
    $this->form = new OrderForm($this->order);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->order = Doctrine_Core::getTable('Order')
      ->find($request->getParameter('id'))
    ;
    $this->form = new OrderForm($this->order);
    $this->processForm($request, $this->form, array('success', 'Отлично!', 'Изменения сохранены.'), '@order?id=' . $this->order->getId());
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
