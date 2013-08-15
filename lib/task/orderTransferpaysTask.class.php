<?php

class orderTransferpaysTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'order';
    $this->name             = 'transfer-pays';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [order:transfer-pays|INFO] task does things.
Call it with:

  [php symfony order:transfer-pays|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $ordersWithPays = Doctrine_Query::create()
      ->from('Order o')
      ->addWhere('o.payed > 0')
      ->execute()
    ;

    if ($ordersWithPays) {
      $transferedPays = new Doctrine_Collection('Pay');

      foreach ($ordersWithPays as $order) {
        $pay = (new Pay())->fromArray([
          'order_id' => $order->getId(),
          'payed_at' => $order->getPayedAt() ?: $order->getUpdatedAt(),
          'amount' => $order->getPayed(),
        ]);
        $transferedPays->add($pay);
      }

      $transferedPays->save();
    }
  }
}
