<?php

/**
 * plan actions.
 *
 * @package    xxi
 * @subpackage plan
 * @author     Saritskiy Roman
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class planActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->refs = Doctrine_Query::create()
      ->from("RefOrderWork row")
      ->leftJoin("row.Order o")
      ->leftJoin("row.Work w")
      ->leftJoin("w.Area a")
      ->leftJoin("a.Workers ww")
      ->leftJoin("ww.Groups g")
      ->addWhere("row.is_completed = ? and (row.planned_start is null and row.planned_finish is null)", false)
      ->andWhereIn("o.state", [
        "working",
        "prepress-working",
      ])
      ->andWhereIn("g.name", array_merge(
        $this->getUser()->hasCredential("worker") ? ["worker"] : []
        , $this->getUser()->hasCredential("design-worker") ? ["design-worker"] : []
      ) ?: [])
      ->addOrderBy("row.created_at")
      ->execute()
    ;

    $this->filter = new sfForm();
    $this->filter->getWidgetSchema()
      ->offsetSet("area", new sfWidgetFormDoctrineChoice([
        "model" => "Area",
        "multiple" => true,
        "query" => Doctrine_Query::create()
          ->from("Area a")
          ->leftJoin("a.Workers ww")
          ->leftJoin("ww.Groups g")
          ->andWhereIn("g.name", array_merge(
            $this->getUser()->hasCredential("worker") ? ["worker"] : []
            , $this->getUser()->hasCredential("design-worker") ? ["design-worker"] : []
          ) ?: [])
          ->addOrderBy("a.name")
      ], ["class" => "chzn-select"]))

      ->offsetSet("master", new sfWidgetFormDoctrineChoice([
        "model" => "sfGuardUser",
        "multiple" => true,
        "query" => Doctrine_Query::create()
          ->from("sfGuardUser u")
          ->leftJoin("u.Groups g")
          ->andWhereIn("g.name", array_merge(
            $this->getUser()->hasCredential("worker") ? ["master"] : []
            , $this->getUser()->hasCredential("design-worker") ? ["design-master"] : []
          ) ?: [])
          ->orderBy("u.last_name, u.first_name")
      ], ["class" => "chzn-select"]))

      ->setLabels([
        "area" => "Участок",
        "master" => "Мастер",
      ])
      ->setNameFormat("works-filter-%s")
    ;

    unset ($this->filter["_csrf_token"]);
  }

  public function executeEventsource($request)
  {
    $query = Doctrine_Query::create()
      ->from("RefOrderWork row")
      ->leftJoin("row.Order o")
      ->leftJoin("row.Work w")
      ->leftJoin("w.Area a")
      ->leftJoin("a.Workers ww")
      ->leftJoin("ww.Groups g")
      ->addWhere("row.planned_start is not null and row.planned_finish is not null")
      ->andWhereIn("o.state", [
        "working",
        "prepress-working",
      ])
      ->andWhereIn("g.name", array_merge(
        $this->getUser()->hasCredential("worker") ? ["worker"] : []
        , $this->getUser()->hasCredential("design-worker") ? ["design-worker"] : []
      ) ?: [])
      ->addOrderBy("row.created_at")
    ;

    parse_str($request->getParameter("filter"), $filter);
    if (isset($filter["works-filter-area"])) {
      $query->andWhereIn("row.work_id", $filter["works-filter-area"]);
    }

    if (isset($filter["works-filter-master"])) {
      $query->andWhereIn("row.master_id", $filter["works-filter-master"]);
    }

    $refs = $query->execute([], Doctrine_Core::HYDRATE_ARRAY);
    die(json_encode(array_map(function($ref) {
      return [
        "id" => $ref["id"],
        "title" => $ref["Order"]["id"] . ": " . $ref["Work"]["Area"]["name"] . " / " . $ref["Work"]["name"],
        "start" => $ref["planned_start"],
        "end" => $ref["planned_finish"],
        "className" => join(" ", [
          "event-of-area-" . $ref["Work"]["Area"]["slug"]
          , "event-completed-" . ($ref["is_completed"] ? "yes" : "not")
        ]),
        "allDay" => false,
        "editable" => !$ref["is_completed"] or $this->getUser()->hasCredential("сan_edit_planning-finished"),
        "isCompleted" => $ref["is_completed"],
        "orderId" => $ref["Order"]["id"],
      ];
    }, (array)$refs), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
  }

  public function executePlanEvent($request)
  {
    $event = $request->getParameter("event");
    $ref = Doctrine_Core::getTable("RefOrderWork")->find($event["id"]);

    $this->forward404Unless($this->getUser()->hasCredential("сan_edit_planning") and !$ref->isNew());

    $ref
      ->setPlannedStart(date("Y-m-d H:i:s", $event["start"]))
      ->setPlannedFinish(date("Y-m-d H:i:s", $event["end"] ?: strtotime("+2 hour", $event["start"])))
      ->save()
    ;

    return sfView::NONE;
  }

  public function executeModal($request)
  {
    $this->ref = Doctrine_Query::create()
      ->from("RefOrderWork ref")
      ->leftJoin("ref.Order o")
      ->leftJoin("ref.Work w")
      ->leftJoin("w.Area a")
      ->addWhere("ref.id = ?", $request->getParameter("id"))
      ->limit(1)
      ->fetchOne()
    ;

    $this->forward404Unless($this->ref);

    return $this->renderPartial("modal", ["ref" => $this->ref]);
  }

  public function executePreFinishRef($request)
  {
    $ref = Doctrine_Core::getTable("RefOrderWork")->find($request->getParameter("id"));
    $order = $ref->getOrder();
    $this->form = new OrderForm($order);

    $fields = ["id"];

    if ($this->getUser()->hasCredential("master")) {
      $utilizationsRelation = array("Utilizations" => array(
        "considerNewFormEmptyFields"    => array("material_id", "amount"),
        "noNewForm"                     => false,
        // "noNewForm"                     => true,
        "newFormLabel"                  => "Новый выпрос",
        "newFormClass"                  => "UtilizationForm",
        "newFormClassArgs"              => array(array("sf_user" => $this->getUser())),
        "displayEmptyRelations"         => true,
        "formClass"                     => "UtilizationForm",
        "formClassArgs"                 => array(array("ah_add_delete_checkbox" => true)),
        "newFormAfterExistingRelations" => true,
        "formFormatter"                 => null,
        "multipleNewForms"              => true,
        "newFormsInitialCount"          => 1,
        "newFormsContainerForm"         => null, // pass BaseForm object here or we will create ahNewRelationsContainerForm
        "newRelationButtonLabel"        => "+",
        "newRelationAddByCloning"       => true,
        "newRelationUseJSFramework"     => "jQuery",
        // "customEmbeddedFormLabelMethod" => "getLabelTitle"
      ));

      $this->form->embedRelations($utilizationsRelation);
      $fields[] = "new_Utilizations";
    }

    if ($this->getUser()->hasCredential("design-master")) {
      $fields[] = "files";
    }

    $this->form->useFields($fields);

    if ($request->isMethod("post") and ($this->form->bind($request->getParameter($this->form->getName()))||1) and $this->form->isValid()) {
      if ($this->getUser()->hasCredential("master")) {
        $utilizations = $request->getParameter($this->form->getName())["new_Utilizations"];
        $utilizationsToSave = new Doctrine_Collection("Utilization");
        foreach ($utilizations as $utilization) {
          if ($utilization["material_id"] and $utilization["amount"]) {
            $newUtilization = Utilization::createFromArray(array_merge($utilization, [
              "order_id" => $order->getId(),
              "work_id" => $ref->getId(),
            ]));

            $utilizationsToSave->add($newUtilization);
          }
        }
        $utilizationsToSave->save();
      }

      if ($this->getUser()->hasCredential("design-master")) {
        $order
          ->setFiles($request->getParameter($this->form->getName())["files"])
          ->save()
        ;
      }

      $this->forward("plan", "finishRef");
    }
  }

  public function executeFinishRef($request)
  {
    $ref = Doctrine_Core::getTable("RefOrderWork")->find($request->getParameter("id"));
    if ($ref and !$ref->isNew() and !$ref->getIsCompleted()) {
      $ref
        ->setIsCompleted(true)
        ->setFinishedAt(date("Y-m-d H:i:s"))
        ->save()
      ;
    }

    $this->redirect("plan/index");
  }
}
