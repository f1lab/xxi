<?php

/**
 * MaterialMovement actions.
 *
 * @package    xxi
 * @subpackage MaterialMovement
 * @author     Saritskiy Roman
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MaterialMovementActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $query = Doctrine_Query::create()
      ->from('MaterialMovement move')
      ->leftJoin("move.Materials list")
      ->leftJoin("list.Material m")
      ->leftJoin("m.Dimension d")
      ->leftJoin("move.Creator")
      ->leftJoin("move.From")
      ->leftJoin("move.To")
      ->addOrderBy("move.created_at")
    ;

    if ($request->getParameter("id")) {
      $this->id = $request->getParameter("id");
      $query
        ->addWhere("move.from_id = ? or move.to_id = ?", [$this->id, $this->id])
      ;
    }

    $this->material_movements = $query->execute();

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

  public function preExecute()
  {
    $request = $this->getRequest();

    if ($request->getParameter("action") !== "index") {
      $this->warehouse = Doctrine_Core::getTable("Warehouse")->find($request->getParameter("from"));
      $this->forward404Unless($this->warehouse);
      $this->balance = $this->warehouse->getBalance();
    }
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new sfForm();
    $this->form->getWidgetSchema()
      ->offsetSet("to", new sfWidgetFormDoctrineChoice([
        "model" => "Warehouse",
        "add_empty" => false,
        "query" => Doctrine_Query::create()
          ->from("Warehouse w")
          ->addWhere("w.id != ?", $request->getParameter("from"))
          ->addOrderby("w.name"),
      ]))
      ->offsetSet("from", new sfWidgetFormInputHidden())
    ;

    $this->form->embedForm("Transfer", new MaterialMovementTransferForm());
    $this->form->getWidgetSchema()
      ->setLabels([
        "to" => "Склад-получатель",
        "Transfer" => "Комментарий к перемещению",
      ])
      ->setDefaults([
        "from" => $request->getParameter("from"),
      ])
    ;
  }

  public function executeCreate(sfWebRequest $request)
  {
    if ($request->isMethod("post")) {
      $transfer = MaterialMovementTransfer::createFromArray($request->getParameter("Transfer"));
      $transfer->save();

      $movement = MaterialMovement::createFromArray([
        "from_id" => $request->getParameter("from"),
        "to_id" => $request->getParameter("to"),
        "type" => "transfer",
        "transfer_id" => $transfer->getId(),
      ]);
      $movement->save();

      $list = new Doctrine_Collection("MaterialMovementMaterials");
      foreach ($request->getParameter("materials") as $id => $amount) {
        if ($amount > 0) {
          $material = &$this->balance[$id];
          while ($amount) {
            arsort($material["amounts"]);
            array_filter($material["amounts"]);

            list($price, $availableToMove) = [array_keys($material["amounts"])[0], current($material["amounts"])];

            $moved = $availableToMove >= $amount
              ? $amount
              : $availableToMove
            ;

            $materialsMovement = MaterialMovementMaterials::createFromArray([
              "movement_id" => $movement->getId(),
              "material_id" => $id,
              "amount" => $moved,
              "price" => $price,
            ]);
            $list->add($materialsMovement);

            $amount -= $moved;
            $material["amount"] -= $moved;
            $material["amounts"][$price] -= $moved;
          }
        }
      }
      $list->save();
    }

    $this->redirect("warehouse/index");
  }
}
