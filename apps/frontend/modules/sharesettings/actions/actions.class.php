<?php

/**
 * sharesettings actions.
 *
 * @package    xxi
 * @subpackage sharesettings
 * @author     Saritskiy Roman
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sharesettingsActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->share_settingss = Doctrine_Core::getTable('ShareSettings')
            ->createQuery('a')
            ->execute();
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->share_settings = Doctrine_Core::getTable('ShareSettings')->find([$request->getParameter('id')]);
        $this->forward404Unless($this->share_settings);
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new ShareSettingsForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new ShareSettingsForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($share_settings = Doctrine_Core::getTable('ShareSettings')
            ->find([$request->getParameter('id')]),
            sprintf('Object share_settings does not exist (%s).', $request->getParameter('id')));
        $this->form = new ShareSettingsForm($share_settings);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($share_settings = Doctrine_Core::getTable('ShareSettings')
            ->find([$request->getParameter('id')]),
            sprintf('Object share_settings does not exist (%s).', $request->getParameter('id')));
        $this->form = new ShareSettingsForm($share_settings);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($share_settings = Doctrine_Core::getTable('ShareSettings')
            ->find([$request->getParameter('id')]),
            sprintf('Object share_settings does not exist (%s).', $request->getParameter('id')));
        $share_settings->delete();

        $this->redirect('sharesettings/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $flash = [
                'success',
                'Отлично!',
                'Данные сохранены.',
            ];
            $share_settings = $form->save();
            $this->getUser()->setFlash('message', $flash);
            $this->redirect('sharesettings/show?id=' . $share_settings->getId());
        }
    }
}
