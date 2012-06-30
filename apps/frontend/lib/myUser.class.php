<?php

class myUser extends sfGuardSecurityUser
{
  public function getOrders($state)
  {
    $query = Doctrine_Core::getTable('Order')->createQuery('a, a.Client')
      ->orderBy('created_at')
      ->where('a.created_by = ?', $this->getGuardUser()->getId())
    ;

    switch ($state) {
      case 'active':
        $query
          ->andWhereNotIn('a.state', array(
            'archived',
            'debt',
          ))
        ;
      break;

      default:
        $query
          ->andWhere('a.state = ?', $state)
        ;
      break;
    }

    return $query
      ->execute()
    ;
  }
}
