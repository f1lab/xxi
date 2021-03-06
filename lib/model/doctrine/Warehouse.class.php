<?php

/**
 * Warehouse
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    xxi
 * @subpackage model
 * @author     Saritskiy Roman
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Warehouse extends BaseWarehouse
{
    public function getBalance()
    {
        $materials = Doctrine_Query::create()
            ->from("Material m")
            ->leftJoin("m.Dimension d")
            ->innerJoin("m.MaterialMovementMaterials lists")
            ->innerJoin("lists.Movement move")
            ->addWhere("move.to_id = ? or move.from_id = ?", [$this->getId(), $this->getId()])
            ->addOrderBy("m.name")
            ->execute();

        $balance = [];
        foreach ($materials as $material) {
            if (!isset($balance[$material->getId()])) {
                $balance[$material->getId()] = [
                    "id" => $material->getId(),
                    "name" => $material->getNameWithDimension(),
                    "amount" => 0,
                    "amounts" => [],
                ];
            }

            foreach ($material->getMaterialMovementMaterials() as $row) {
                if (!isset($balance[$material->getId()]["amounts"][$row->getPrice()])) {
                    $balance[$material->getId()]["amounts"][$row->getPrice()] = 0;
                }

                if ($row->getMovement()->getToId() === $this->getId()) { // in
                    $balance[$material->getId()]["amount"] += $row["amount"];
                    $balance[$material->getId()]["amounts"][$row->getPrice()] += $row["amount"];
                } else { // out
                    $balance[$material->getId()]["amount"] -= $row["amount"];
                    $balance[$material->getId()]["amounts"][$row->getPrice()] -= $row["amount"];
                }
            }
        }

        return array_filter($balance, function ($material) {
            return $material["amount"] > 0;
        });
    }
}
