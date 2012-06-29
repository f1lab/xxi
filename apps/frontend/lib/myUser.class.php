<?php

class myUser extends sfGuardSecurityUser
{
  public function getOrders($state)
  {
    return Doctrine_Core::getTable('Order')->createQuery('a, a.Client')
      ->orderBy('created_at')
      ->where('a.created_by = ?', $this->getGuardUser()->getId())
      ->andWhere('a.state '
        . ($state == 'active' ? '!=' : '=') . ' ?',
        ($state == 'active' ? 'archived' : $state)
      )
      ->execute()
    ;
  }
}
