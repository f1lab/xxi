<?php

/**
 * users actions.
 *
 * @package    xxi
 * @subpackage users
 * @author     Saritckyi Roman
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usersActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->sf_guard_users = Doctrine_Core::getTable('sfGuardUser')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new sfGuardUserForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new sfGuardUserForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardUserForm($sf_guard_user);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardUserForm($sf_guard_user);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $sf_guard_user->delete();

    $this->redirect('users/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $sf_guard_user = $form->save();

      $this->redirect('users/edit?id='.$sf_guard_user->getId());
    }
  }
  public function executeSettings(sfWebRequest $request)
  {
    $form = new sfGuardUserAdminForm(sfContext::getInstance()->getUser()->getGuardUser());
    unset($form['is_active']);
    unset($form['is_super_admin']);
    unset($form['groups_list']);
    unset($form['permissions_list']);
    unset($form['password']);
    unset($form['username']);
    unset($form['password_again']);
    $this->form = $form;
    if($request->isMethod('put'))
    {
      $this->form->bind(
        $request->getParameter($this->form->getName()),
        $request->getFiles($this->form->getName())
      );

      if ($this->form->isValid())
      {
        $object = $this->form->save();
        $flash = array('success','','настройки сохранены');
        if ($flash and is_array($flash)) {
          $this->getUser()->setFlash('message', $flash);
        }
      }
      else {
        $flash = array('error','','настройки не сохранены');
        if ($flash and is_array($flash)) {
          $this->getUser()->setFlash('message', $flash);
        }
      }
    }
    
  }
}
