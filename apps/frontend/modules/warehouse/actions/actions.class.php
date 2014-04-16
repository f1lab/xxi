<?php

/**
 * warehouse actions.
 *
 * @package    xxi
 * @subpackage warehouse
 * @author     Saritskiy Roman
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class warehouseActions extends sfActions
{
  public function preExecute()
  {
    $this->id = $this->getRequest()->getParameter("id");
  }

  public function postExecute()
  {
    if (!$this->id and isset($this->form)) {
      $this->id = $this->form->getObject()->getId();
    }
  }

  public function executeIndex(sfWebRequest $request)
  {
    $this->warehouses = WarehouseTable::getOwnWarehousesQuery()
      ->andWhereIn("w.id", $this->id ? [$this->id] : [])
      ->execute()
    ;

    $this->filter = new sfForm();
    $this->filter->getWidgetSchema()
      ->offsetSet("id", new sfWidgetFormDoctrineChoice([
        "model" => "Warehouse",
        "add_empty" => true,
        "query" => WarehouseTable::getOwnWarehousesQuery(),
      ], [
        "class" => "chzn-select",
        "data-placeholder" => "Выберите склад",
      ]))
    ;
    $this->filter->setDefaults([
      "id" => $this->id,
    ]);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new WarehouseForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new WarehouseForm();

    $this->processForm($request, $this->form);

    $this->setTemplate("new");
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($warehouse = Doctrine_Core::getTable("Warehouse")->find(array($request->getParameter("id"))), sprintf("Object warehouse does not exist (%s).", $request->getParameter("id")));
    $this->form = new WarehouseForm($warehouse);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($warehouse = Doctrine_Core::getTable("Warehouse")->find(array($request->getParameter("id"))), sprintf("Object warehouse does not exist (%s).", $request->getParameter("id")));
    $this->form = new WarehouseForm($warehouse);

    $this->processForm($request, $this->form);

    $this->setTemplate("edit");
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($warehouse = Doctrine_Core::getTable("Warehouse")->find(array($request->getParameter("id"))), sprintf("Object warehouse does not exist (%s).", $request->getParameter("id")));
    $warehouse->delete();

    $this->redirect("warehouse/index");
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $warehouse = $form->save();

      $this->redirect("warehouse/edit?id=".$warehouse->getId());
    }
  }
}
