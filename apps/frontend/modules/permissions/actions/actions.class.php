<?php

/**
 * permissions actions.
 *
 * @package    pm
 * @subpackage permissions
 * @author     slowpokes
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class permissionsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->sf_guard_permissions = Doctrine_Core::getTable('sfGuardPermission')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new sfGuardPermissionForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new sfGuardPermissionForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($sf_guard_permission = Doctrine_Core::getTable('sfGuardPermission')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_permission does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardPermissionForm($sf_guard_permission);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($sf_guard_permission = Doctrine_Core::getTable('sfGuardPermission')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_permission does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardPermissionForm($sf_guard_permission);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($sf_guard_permission = Doctrine_Core::getTable('sfGuardPermission')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_permission does not exist (%s).', $request->getParameter('id')));
    $sf_guard_permission->delete();

    $this->redirect('permissions/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $sf_guard_permission = $form->save();

      $this->redirect('permissions/edit?id='.$sf_guard_permission->getId());
    }
  }

  public function executeMake(sfWebRequest $request)
  {
    $credentials = 'can_create_actions
can_edit_actions
can_delete_actions
can_create_costs
can_edit_costs
can_delete_costs
can_create_cost_groups
can_edit_cost_groups
can_delete_cost_groups
can_create_groups
can_edit_groups
can_delete_groups
can_create_messages
can_edit_messages
can_delete_messages
can_create_permissions
can_edit_permissions
can_delete_permissions
can_create_projects
can_edit_projects
can_delete_projects
can_create_sections
can_edit_sections
can_delete_sections
can_create_tasks
can_edit_tasks
can_delete_tasks
can_create_users
can_edit_users
can_delete_users
can_create_values
can_edit_values
can_delete_values';
$credentials = explode("\n", $credentials);
foreach ($credentials as $credential) {
  $credentialObject = new sfGuardPermission();
  $credentialObject
    ->setName($credential)
    ->save()
  ;
}
  }
}
