<?php

/**
 * Client
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    xxi
 * @subpackage model
 * @author     Anatoly Pashin
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Client extends BaseClient
{
    public function getOrdersByState($state, $viewOnlyMine = true)
    {
        $query = Doctrine_Core::getTable('Order')->createQuery('a')
            ->orderBy('created_at');

        if ($viewOnlyMine) {
            $query
                ->andWhere('a.created_by = ?', sfContext::getInstance()->getUser()->getGuardUser()->getId());
        }

        $query
            ->andWhere('a.client_id = ?', $this->getId());

        switch ($state) {
            case 'active':
                $query
                    ->andWhereNotIn('a.state', [
                        'archived',
                        'debt',
                        'deleted',
                    ]);
                break;

            default:
                $query
                    ->andWhere('a.state = ?', $state);
                break;
        }

        return $query
            ->execute();
    }

    public function getOwnershipTranslated()
    {
        return true == ($ownership = $this->_get('ownership'))
            ? ClientTable::$ownership[$ownership]
            : '';
    }

    public function getNameWithDiscount()
    {
        return $this->getName() . '|' . (int)$this->getDiscount();
    }

    public function getActiveOrdersSum()
    {
        $activeOrdersIds = $this->getOrderIdsOfStates(['submitted', 'archived', 'deleted', 'debt'], true);
        $active = Doctrine_Query::create()
            ->select('sum(o.cost)')
            ->from('Order o')
            ->andWhereIn('o.id', $activeOrdersIds)
            ->execute([], Doctrine_Core::HYDRATE_SINGLE_SCALAR);

        return (int)$active;
    }

    public function getDebtSum()
    {
        $debtOrdersIds = $this->getOrderIdsOfStates(['debt']);
        if ($debtOrdersIds === []) {
            return 0;
        }

        $debt = Doctrine_Query::create()
            ->select('sum(o.cost)')
            ->from('Order o')
            ->andWhereIn('o.id', $debtOrdersIds)
            ->execute([], Doctrine_Core::HYDRATE_SINGLE_SCALAR);
        $payed = Doctrine_Query::create()
            ->select('sum(p.amount)')
            ->from('Pay p')
            ->andWhereIn('p.order_id', $debtOrdersIds)
            ->execute([], Doctrine_Core::HYDRATE_SINGLE_SCALAR);

        return (int)($debt - $payed);
    }

    public function getOrderIdsOfStates(array $states, $notThisStates = false)
    {
        $query = Doctrine_Query::create()
            ->select('o.id')
            ->from('Order o')
            ->addWhere('o.client_id = ?', $this->getId());

        if ($notThisStates) {
            $query->andWhereNotIn('o.state', $states);
        } else {
            $query->andWhereIn('o.state', $states);
        }

        $result = $query->execute([], Doctrine_Core::HYDRATE_SINGLE_SCALAR);

        return $result === [] ? [-1] : $result;
    }
}
