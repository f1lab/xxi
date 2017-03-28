<?php

/**
 * comsettings actions.
 *
 * @package    xxi
 * @subpackage comsettings
 * @author     Saritskiy Roman
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class comsettingsActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->company_settingss = Doctrine_Core::getTable('CompanySettings')
            ->createQuery('a')
            ->execute();
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->company_settings = Doctrine_Core::getTable('CompanySettings')->find([$request->getParameter('id')]);
        $this->forward404Unless($this->company_settings);
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new CompanySettingsForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new CompanySettingsForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($company_settings = Doctrine_Core::getTable('CompanySettings')
            ->find([$request->getParameter('id')]),
            sprintf('Object company_settings does not exist (%s).', $request->getParameter('id')));
        $this->form = new CompanySettingsForm($company_settings);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($company_settings = Doctrine_Core::getTable('CompanySettings')
            ->find([$request->getParameter('id')]),
            sprintf('Object company_settings does not exist (%s).', $request->getParameter('id')));
        $this->form = new CompanySettingsForm($company_settings);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($company_settings = Doctrine_Core::getTable('CompanySettings')
            ->find([$request->getParameter('id')]),
            sprintf('Object company_settings does not exist (%s).', $request->getParameter('id')));
        $company_settings->delete();

        $this->redirect('comsettings/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $flash = [
            'success',
            '�������!',
            '������ ���������.',
        ];
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $company_settings = $form->save();
            $this->getUser()->setFlash('message', $flash);
            $this->redirect('comsettings/show?id=' . $company_settings->getId());
        }
    }
}
