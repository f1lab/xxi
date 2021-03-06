<?php

/**
 * Utilization
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    xxi
 * @subpackage model
 * @author     Saritskiy Roman
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Utilization extends BaseUtilization
{
    public function getPriceForOne()
    {
        $price = 0;
        foreach ($this->getRefUtilizationArrival() as $part) {
            $price += $part->getArrival()->getPrice() * $part->getAmount() / $this->getAmount();
        }

        return $price;
    }

    public function getPrice()
    {
        $price = 0;
        foreach ($this->getRefUtilizationArrival() as $part) {
            $price += $part->getArrival()->getPrice() * $part->getAmount();
        }

        return $price;
    }

    public function preSave($event)
    {
        $utilization = $event->getInvoker();
        $utilizationOld = $utilization->getModified(true);
        if ($utilization->isNew()) {
            $utilizationOld['amount'] = 0;
        }

        if (isset($utilizationOld['amount']) or $utilization->isNew()) {
            $arrivalSpendCollection = new Doctrine_Collection('RefUtilizationArrival');

            if ($utilizationOld['amount'] < $utilization->getAmount()) { // utilized more than saved
                $toUtilize = $utilization->getAmount() - $utilizationOld['amount'];

                $arrivals = Doctrine_Query::create()
                    ->from('Arrival a')
                    ->select('a.*, coalesce(sum(spent.amount), 0) spend')
                    ->leftJoin('a.RefUtilizationArrival spent')
                    ->addWhere('a.material_id = ?', $utilization->getMaterialId())
                    ->addOrderBy('a.arrived_at desc')
                    ->having('spend < a.amount')
                    ->groupBy('a.id')
                    ->execute();

                if ($arrivals and count($arrivals) and true
                    == ($arrivals = $arrivals->getData())
                ) { // get array of Doctrine_Records insteadof Doctrine_Collection
                    while ($toUtilize) {
                        $arrival = array_pop($arrivals);
                        $utilized = ($arrival->getAmount() - $arrival->getSpend()) >= $toUtilize
                            ? $toUtilize
                            : $arrival->getAmount();
                        $arrivalSpend = (new RefUtilizationArrival())
                            ->setUtilization($utilization)
                            ->setArrivalId($arrival->getId())
                            ->setAmount($utilized);

                        $arrivalSpendCollection->add($arrivalSpend);
                        $toUtilize -= $utilized;
                    }
                } else {
                    throw new Exception('No arrivals to spend');
                }
            } else { // less utilized than saved
                $toReturn = $utilizationOld['amount'] - $utilization->getAmount();

                $arrivalSpents = Doctrine_Query::create()
                    ->from('RefUtilizationArrival spent')
                    ->leftJoin('spent.Arrival a')
                    ->addWhere('spent.utilization_id = ?', $utilization->getId())
                    ->addOrderBy('a.arrived_at asc')
                    ->execute();

                if ($arrivalSpents and count($arrivalSpents) and true
                    == ($arrivalSpents = $arrivalSpents->getData())
                ) { // get array of Doctrine_Records insteadof Doctrine_Collection
                    while ($toReturn) {
                        $arrivalSpent = array_pop($arrivalSpents);

                        if ($arrivalSpent->getAmount() >= $toReturn) {
                            $returned = $toReturn;
                            $arrivalSpent->setAmount($arrivalSpent->getAmount() - $toReturn);
                            $arrivalSpendCollection->add($arrivalSpent);
                        } else {
                            $returned = $arrivalSpent->getAmount();
                            $arrivalSpent->delete();
                        }
                        $toReturn -= $returned;
                    }
                } else {
                    throw new Exception('No arrivals to return'); // absurd
                }
            }

            $utilization->setRefUtilizationArrival($arrivalSpendCollection);
        }
    }

    public function preDelete($event)
    {
        $event->getInvoker()->getRefUtilizationArrival()->delete();
    }
}
