<?php

/**
 * nomenclature actions.
 *
 * @package    xxi
 * @subpackage nomenclature
 * @author     Saritskiy Roman
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class nomenclatureActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->nomenclatures = Doctrine_Query::create()
            ->from('Nomenclature n')
            ->execute();
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new NomenclatureForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new NomenclatureForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($nomenclature = Doctrine_Core::getTable('Nomenclature')
            ->find([$request->getParameter('id')]),
            sprintf('Object nomenclature does not exist (%s).', $request->getParameter('id')));
        $this->form = new NomenclatureForm($nomenclature);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($nomenclature = Doctrine_Core::getTable('Nomenclature')
            ->find([$request->getParameter('id')]),
            sprintf('Object nomenclature does not exist (%s).', $request->getParameter('id')));
        $this->form = new NomenclatureForm($nomenclature);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($nomenclature = Doctrine_Core::getTable('Nomenclature')
            ->find([$request->getParameter('id')]),
            sprintf('Object nomenclature does not exist (%s).', $request->getParameter('id')));
        $nomenclature->delete();

        $this->redirect('nomenclature/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $nomenclature = $form->save();

            $this->redirect('nomenclature/edit?id=' . $nomenclature->getId());
        }
    }
}
