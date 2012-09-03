<?php

class magicStatesTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
    ));

    $this->namespace        = 'magic';
    $this->name             = 'states';
    $this->briefDescription = 'Switches orders states from/to archived and debt';
    $this->detailedDescription = <<<EOF
The [magic:states|INFO] task does things.
Call it with:

  [php symfony magic:states|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $archived = Doctrine_Query::create()
      ->update('Order')
      ->set('state', '?', 'archived')
      ->andWhereIn('state', array('submited', 'debt'))
      ->andWhere('COALESCE(payed, 0) >= COALESCE(cost, 0)')
      ->execute()
    ;

    $debted = Doctrine_Query::create()
      ->update('Order')
      ->set('state', '?', 'debt')
      ->andWhereIn('state', array('submited', 'archived'))
      ->andWhere('COALESCE(payed,0) < COALESCE(cost, 0)')
      ->execute()
    ;

    echo print_r( array('archived' => $archived, 'debted' => $debted), 1 );
  }
}
