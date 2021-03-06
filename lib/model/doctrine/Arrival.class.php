<?php

/**
 * Arrival
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    xxi
 * @subpackage model
 * @author     Saritskiy Roman
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Arrival extends BaseArrival
{
    public function getRemained()
    {
        return $this->getAmount() - (double)Doctrine_Query::create()
                ->from('RefUtilizationArrival a')
                ->select('sum(a.amount)')
                ->addWhere('a.arrival_id = ?', $this->getId())
                ->execute([], Doctrine_Core::HYDRATE_SINGLE_SCALAR);
    }
}
