<?php

/**
 * WarehouseTable
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class WarehouseTable extends Doctrine_Table
{
  /**
   * Returns an instance of this class.
   *
   * @return object WarehouseTable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('Warehouse');
  }

  public static function getOwnWarehousesQuery()
  {
    $user = sfContext::getInstance()->getUser();

    return Doctrine_Query::create()
      ->from("Warehouse w")
      ->leftJoin("w.Users u")
      ->andWhereIn("u.id", $user->hasCredential("can edit warehouses") ? [] : [$user->getGuardUser()->getId()])
      ->addOrderBy("w.name")
    ;
  }
}