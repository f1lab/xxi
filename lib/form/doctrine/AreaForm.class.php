<?php

/**
 * Area form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Saritskiy Roman
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AreaForm extends BaseAreaForm
{
  public function configure()
  {
    unset (
      $this["deleted_at"],
      $this["created_at"],
      $this["updated_at"],
      $this["created_by"],
      $this["updated_by"]
    );

    $this->getWidgetSchema()
      ->offsetSet("masters_list", new sfWidgetFormDoctrineChoice([
        "multiple" => true,
        "model" => "sfGuardUser",
        "query" => Doctrine_Query::create()
          ->from("sfGuardUser u")
          ->leftJoin("u.Groups g")
          ->andWhereIn("g.name", [
            "master",
            "design-master"
          ])
          ->addOrderBy("u.first_name, u.last_name")
      ]))
      ->offsetSet("workers_list", new sfWidgetFormDoctrineChoice([
        "multiple" => true,
        "model" => "sfGuardUser",
        "query" => Doctrine_Query::create()
          ->from("sfGuardUser u")
          ->leftJoin("u.Groups g")
          ->andWhereIn("g.name", [
            "worker",
            "design-worker",
          ])
          ->addOrderBy("u.first_name, u.last_name")
      ]))
      ->setLabels([
        "name" => "Наименование",
        "slug" => "Транслит наименования",
        "masters_list" => "Работники участка",
        "workers_list" => "Руководители участка",
      ])
    ;

    if (!sfContext::getInstance()->getUser()->hasCredential("can_edit_styles_of_areas")) {
      unset ($this["style"]);
    }
  }
}
