<?php

/**
 * contractor actions.
 *
 * @package    xxi
 * @subpackage client
 * @author     Anatoly Pashin
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contractorActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->clients = Doctrine_Core::getTable('contractor')->createQuery('a')
            ->orderBy('name asc')
            ->execute();
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new contractorForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->form = new contractorForm();
        $this->processForm($request, $this->form, ['success', 'Отлично!', 'Подрядчик добавлен.'], '@contractors');
        $this->setTemplate('new');
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->client = Doctrine_Query::create()
            ->from('contractor s')
            ->where('s.id = ?', $request->getParameter('id'))
            ->fetchOne();
        $this->forward404Unless($this->client);
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->client = Doctrine_Core::getTable('contractor')
            ->find($request->getParameter('id'));
        $this->form = new contractorForm($this->client);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->client = Doctrine_Core::getTable('contractor')
            ->find($request->getParameter('id'));
        $this->form = new contractorForm($this->client);
        $this->processForm($request, $this->form, ['success', 'Отлично!', 'Изменения сохранены.'],
            '@contractor?id=' . $this->client->getId());
        $this->setTemplate('edit');
    }

    public function processForm(sfWebRequest $request, sfForm $form, $flash = false, $redirect = false)
    {
        $form->bind(
            $request->getParameter($form->getName()),
            $request->getFiles($form->getName())
        );

        if ($form->isValid()) {
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
