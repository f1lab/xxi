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
    $this->material_movements = Doctrine_Query::create()
      ->from('MaterialMovement m')
      ->execute()
    ;
  }

  public function executeNewTransfer(sfWebRequest $request)
  {
    $this->warehouse = Doctrine_Core::getTable("Warehouse")->find($request->getParameter("from"));
    $this->forward404Unless($this->warehouse);
    $this->balance = $this->warehouse->getBalance();

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

      $this->redirect("warehouse/index");
    } else {
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
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MaterialMovementForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MaterialMovementForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($material_movement = Doctrine_Core::getTable('MaterialMovement')->find(array($request->getParameter('id'))), sprintf('Object material_movement does not exist (%s).', $request->getParameter('id')));
    $this->form = new MaterialMovementForm($material_movement);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($material_movement = Doctrine_Core::getTable('MaterialMovement')->find(array($request->getParameter('id'))), sprintf('Object material_movement does not exist (%s).', $request->getParameter('id')));
    $this->form = new MaterialMovementForm($material_movement);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($material_movement = Doctrine_Core::getTable('MaterialMovement')->find(array($request->getParameter('id'))), sprintf('Object material_movement does not exist (%s).', $request->getParameter('id')));
    $material_movement->delete();

    $this->redirect('MaterialMovement/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $material_movement = $form->save();

      $this->redirect('MaterialMovement/edit?id='.$material_movement->getId());
    }
  }
}
