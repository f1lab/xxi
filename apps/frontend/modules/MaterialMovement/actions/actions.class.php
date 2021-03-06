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
            ->addOrderBy("move.created_at");

        if ($request->getParameter("id")) {
            $this->id = $request->getParameter("id");
            $query
                ->addWhere("move.from_id = ? or move.to_id = ?", [$this->id, $this->id]);
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
            ]));
        $this->filter->setDefaults([
            "id" => $this->id,
        ]);
    }

    public function preExecute()
    {
        $request = $this->getRequest();

        if ($request->getParameter("action") !== "index") {
            if ((int)$request->getParameter("from") !== -1) {
                $this->warehouse = Doctrine_Core::getTable("Warehouse")->find($request->getParameter("from")
                    ?: $request->getParameter("to"));
                $this->forward404Unless($this->warehouse);
                $this->balance = $this->warehouse->getBalance();
            }

            $this->type = $request->getParameter("type");
        }
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new sfForm();
        $this->form->getWidgetSchema()
            ->offsetSet("from", new sfWidgetFormDoctrineChoice([
                "model" => "Warehouse",
                "add_empty" => false,
                "query" => WarehouseTable::getOwnWarehousesQuery()
                    ->andWhereNotIn("w.id", (array)$request->getParameter("to"))
                ,
            ]))
            ->offsetSet("to", new sfWidgetFormDoctrineChoice([
                "model" => "Warehouse",
                "add_empty" => false,
                "query" => Doctrine_Query::create()
                    ->from("Warehouse w")
                    ->andWhereNotIn("w.id", (array)$request->getParameter("from"))
                    ->addOrderby("w.name"),
            ]))
            ->offsetSet("type", new sfWidgetFormInputHidden());

        switch ($this->type) {
            case "transfer":
                $this->form->embedForm("Transfer", new MaterialMovementTransferForm());
                $this->movementTypeTitle = "Перемещение материалов";
                $this->movementTypeButton = "Переместить";
                break;

            case "writeoff":
                $this->form->getWidgetSchema()
                    ->offsetSet("to", new sfWidgetFormInputHidden());

                $this->form->embedForm("Writeoff", new MaterialMovementTransferForm());
                $this->movementTypeTitle = "Списание материалов";
                $this->movementTypeButton = "Списать";
                break;

            case "arrival":
                $this->form->getWidgetSchema()
                    ->offsetSet("from", new sfWidgetFormInputHidden())
                    ->offsetSet("to", new sfWidgetFormInputHidden());

                $this->form->embedForm("Arrival", new MaterialMovementArrivalForm());
                $this->movementTypeTitle = "Приход материалов в «" . $this->warehouse . "»";
                $this->movementTypeButton = "Принять";

                $this->materialForm = new sfForm();
                $this->materialForm->getWidgetSchema()
                    ->offsetSet("material_id", new sfWidgetFormDoctrineChoice([
                        "model" => "Material",
                        "query" => Doctrine_Query::create()
                            ->from("Material m")
                            ->leftJoin("m.Dimension d")
                            ->addOrderby("m.name"),
                        "method" => "getNameWithDimension",
                        "add_empty" => true,
                    ], [
                        "class" => "chzn-select",
                        "data-placeholder" => "Материал",
                    ]))
                    ->offsetSet("amount", new sfWidgetFormInputText([], [
                        "type" => "number",
                        "min" => 0,
                        "step" => 0.0001,
                        "placeholder" => "Количество",
                        "class" => "span2",
                    ]))
                    ->offsetSet("price", new sfWidgetFormInputText([], [
                        "type" => "number",
                        "min" => 0,
                        "step" => 0.01,
                        "placeholder" => "Цена",
                        "class" => "span2",
                    ]))
                    ->setNameFormat("Materials[0][%s]");
                break;

            case "utilization":
                $ref = Doctrine_Core::getTable("RefOrderWork")->find($request->getParameter("id"));
                $this->forward404Unless($ref and $ref->getOrder() and !$ref->getIsCompleted());

                $utilizatioForm = new MaterialMovementUtilizationForm();
                $utilizatioForm->setDefaults([
                    "work_id" => $ref->getId(),
                    "order_id" => $ref->getOrder()->getId(),
                ]);

                $this->form->embedForm("Utilization", $utilizatioForm);

                if ($this->getUser()->hasCredential("design-master")) {
                    $this->form->getWidgetSchema()
                        ->offsetSet("files", new sfWidgetFormTextarea([], ["class" => "input-block-level"]));

                    if (!$this->getUser()->isSuperAdmin()) {
                        $this->form->getWidgetSchema()
                            ->offsetSet("from", new sfWidgetFormInputHidden());
                    }
                }

                $this->form->getWidgetSchema()
                    ->offsetSet("to", new sfWidgetFormInputHidden())
                    ->moveField("from", sfWidgetFormSchema::LAST);

                $this->movementTypeTitle = "Завершение работы";
                $this->movementTypeButton = "Завершить";

                $materialsPlan = [];
                $utilizationPlans = $ref->getOrder()->getUtilizationPlans();
                foreach ($utilizationPlans as $utilizationPlan) {
                    if (!isset($materialsPlan[$utilizationPlan['material_id']])) {
                        $materialsPlan[$utilizationPlan['material_id']] = 0;
                    }

                    $materialsPlan[$utilizationPlan['material_id']] += $utilizationPlan['amount'];
                }
                $this->materialsPlan = json_encode($materialsPlan, JSON_PRETTY_PRINT);
                break;

            default:
                throw new InvalidArgumentException(sprintf("Unknown type of materials movement (%s)", $this->type));
                break;
        }

        $this->form->getWidgetSchema()
            ->setLabels([
                "to" => "Склад-получатель",
                "from" => "Склад-отправитель",
                "Transfer" => "Комментарий к перемещению",
                "Writeoff" => "Комментарий к списанию",
                "Arrival" => " ",
                "Utilization" => " ",
                "files" => "Файлы",
            ])
            ->setDefaults([
                "from" => $request->getParameter("from"),
                "to" => $request->getParameter("to"),
                "type" => $this->type,
                "files" => isset($ref) and $ref ? $ref->getOrder()->getFiles() : "",
            ]);
    }

    public function executeCreate(sfWebRequest $request)
    {
        if ($request->isMethod("post")) {
            switch ($this->type) {
                case "transfer":
                    $transfer = MaterialMovementTransfer::createFromArray($request->getParameter("Transfer"));
                    $transfer->save();

                    $materialMovementPatch = [
                        "from_id" => $request->getParameter("from"),
                        "to_id" => $request->getParameter("to"),
                        "type" => "transfer",
                        "transfer_id" => $transfer->getId(),
                    ];
                    break;

                case "writeoff":
                    $writeoff = MaterialMovementWriteoff::createFromArray($request->getParameter("Writeoff"));
                    $writeoff->save();

                    $materialMovementPatch = [
                        "from_id" => $request->getParameter("from"),
                        "type" => "writeoff",
                        "writeoff_id" => $writeoff->getId(),
                    ];
                    break;

                case "arrival":
                    $arrival = MaterialMovementArrival::createFromArray($request->getParameter("Arrival"));
                    $arrival->save();

                    $materialMovementPatch = [
                        "to_id" => $request->getParameter("to"),
                        "type" => "arrival",
                        "arrival_id" => $arrival->getId(),
                    ];
                    break;

                case "utilization":
                    if ($this->getUser()->hasCredential("design-master")) {
                        Doctrine_Core::getTable("Order")->find($request->getParameter("Utilization")["order_id"])
                            ->setFiles($request->getParameter("files"))
                            ->save();
                    }

                    $ref = Doctrine_Core::getTable("RefOrderWork")
                        ->find($request->getParameter("Utilization")["work_id"])
                        ->setIsCompleted(true)
                        ->setFinishedAt(date("Y-m-d H:i:s"))
                        ->save();

                    if ($this->getUser()->hasCredential("master")) {
                        $utilization = MaterialMovementUtilization::createFromArray($request->getParameter("Utilization"));
                        $utilization->save();
                    } else {
                        $this->redirect("plan/index");
                    }

                    $materialMovementPatch = [
                        "from_id" => $request->getParameter("from"),
                        "type" => "utilization",
                        "utilization_id" => $utilization->getId(),
                    ];
                    break;

                default:
                    throw new InvalidArgumentException(sprintf("Unknown type of materials movement (%s)", $this->type));
                    break;
            }

            $movement = MaterialMovement::createFromArray(array_merge([
            ], $materialMovementPatch));
            $movement->save();

            $list = new Doctrine_Collection("MaterialMovementMaterials");

            if ($this->type === "arrival") {
                foreach ($request->getParameter("Materials") as $material) {
                    list ($amount, $price, $material_id) = [
                        $material["amount"], $material["price"], $material["material_id"],
                    ];

                    if ($amount > 0 and $price > 0 and $material_id) {
                        $materialsMovement = MaterialMovementMaterials::createFromArray([
                            "movement_id" => $movement->getId(),
                            "material_id" => $material_id,
                            "amount" => $amount,
                            "price" => $price,
                        ]);
                        $list->add($materialsMovement);
                    }
                }

            } else {
                foreach ($request->getParameter("materials") as $id => $amount) {
                    if ($amount > 0) {
                        $material = &$this->balance[$id];
                        while ($amount) {
                            arsort($material["amounts"]);
                            array_filter($material["amounts"]);

                            list($price, $availableToMove) = [
                                array_keys($material["amounts"])[0], current($material["amounts"]),
                            ];

                            $moved = $availableToMove >= $amount
                                ? $amount
                                : $availableToMove;

                            $materialsMovement = MaterialMovementMaterials::createFromArray([
                                "movement_id" => $movement->getId(),
                                "material_id" => $id,
                                "amount" => $moved,
                                "price" => $price,
                                'description' => $request->getParameter('materials_descriptions')[$id],
                            ]);
                            $list->add($materialsMovement);

                            $amount -= $moved;
                            $material["amount"] -= $moved;
                            $material["amounts"][$price] -= $moved;
                        }
                    }
                }
            }

            $list->save();
        }

        $this->redirect($this->type === "utilization" ? "plan/index" : "warehouse/index");
    }
}
