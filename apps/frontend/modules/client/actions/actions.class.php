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
            ->execute();
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new ClientForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->form = new ClientForm();
        $this->processForm($request, $this->form, ['success', 'Отлично!', 'Клиент добавлен.'], '@clients');
        $this->setTemplate('new');
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->_state = $request->getParameter('state');
        $this->client = Doctrine_Query::create()
            ->from('Client c')
            ->leftJoin('c.Orders o')
            ->leftJoin('o.Creator')
            ->where('c.id = ?', $request->getParameter('id'))
            ->fetchOne();
        $this->forward404Unless($this->client);
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->client = Doctrine_Core::getTable('Client')
            ->find($request->getParameter('id'));
        $this->form = new ClientForm($this->client);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->client = Doctrine_Core::getTable('Client')
            ->find($request->getParameter('id'));
        $this->form = new ClientForm($this->client);
        $this->processForm($request, $this->form, ['success', 'Отлично!', 'Изменения сохранены.'],
            '@client?id=' . $this->client->getId());
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

    public function executeAdd($request)
    {
        $form = new ClientForm();
        $form->disableCSRFprotection();
        unset($form["_csrf_token"]);

        $form->bind([
            "name" => $request->getParameter("name"),
            "contact" => $request->getParameter("contact"),
            "phone" => $request->getParameter("phone"),
        ]);

        try {
            $form->save();
            $this->getResponse()->setStatusCode(200);
        } catch (\Exception $e) {
            $this->getResponse()->setStatusCode(400);
        }

        $this->getResponse()->setHeaderOnly(true);

        return sfView::NONE;
    }

    public function executeDump($request)
    {
        $clients = Doctrine_Query::create()
            ->from("Client c")
            ->select("c.id, c.name")
            ->addOrderBy("c.name asc")
            ->execute([], Doctrine_Core::HYDRATE_SCALAR);

        die (json_encode(array_map(function ($client) {
            return [$client["c_id"], $client["c_name"]];
        }, $clients), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function executeGetCreditInfo($request)
    {
        $client = Doctrine_Query::create()
            ->from('Client c')
            ->addWhere('c.id = ?', $request->getParameter('id', -1))
            ->fetchOne();

        $this->forward404Unless($client);

        die (json_encode([
            'credit-line' => +$client->getCreditLine()
            , 'is-blacklisted' => $client->getIsBlacklisted()
            , 'orders-count' => Doctrine_Query::create()
                ->from('Order o')
                ->addWhere('o.client_id = ?', $client->getId())
                ->count()
            , 'debt' => $client->getDebtSum(),
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
