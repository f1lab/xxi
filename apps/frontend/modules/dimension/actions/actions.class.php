<?php

/**
 * dimension actions.
 *
 * @package    xxi
 * @subpackage dimension
 * @author     Saritskiy Roman
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dimensionActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->dimensions = Doctrine_Core::getTable('Dimension')
            ->createQuery('a')
            ->execute();
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new DimensionForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new DimensionForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($dimension = Doctrine_Core::getTable('Dimension')->find([$request->getParameter('id')]),
            sprintf('Object dimension does not exist (%s).', $request->getParameter('id')));
        $this->form = new DimensionForm($dimension);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($dimension = Doctrine_Core::getTable('Dimension')->find([$request->getParameter('id')]),
            sprintf('Object dimension does not exist (%s).', $request->getParameter('id')));
        $this->form = new DimensionForm($dimension);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($dimension = Doctrine_Core::getTable('Dimension')->find([$request->getParameter('id')]),
            sprintf('Object dimension does not exist (%s).', $request->getParameter('id')));
        $dimension->delete();

        $this->redirect('dimension/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $dimension = $form->save();

            $this->redirect('dimension/edit?id=' . $dimension->getId());
        }
    }
}
