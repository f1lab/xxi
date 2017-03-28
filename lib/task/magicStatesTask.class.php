<?php

class magicStatesTask extends sfBaseTask
{
    protected function configure()
    {
        $this->addOptions([
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name',
                'doctrine'),
        ]);

        $this->namespace = 'magic';
        $this->name = 'states';
        $this->briefDescription = 'Switches orders states from/to archived and debt';
        $this->detailedDescription = <<<EOF
The [magic:states|INFO] task does things.
Call it with:

  [php symfony magic:states|INFO]
EOF;
    }

    protected function execute($arguments = [], $options = [])
    {
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        $archived = $debted = 0;

        $toArchive = (array)Doctrine_Query::create()
            ->from('Order o')
            ->select('o.id, o.cost')
            ->leftJoin('o.Pays p')
            ->andWhereIn('o.state', ['submited', 'debt'])
            ->having('COALESCE(sum(p.amount), 0) >= COALESCE(o.cost, 0)')
            ->groupBy('o.id')
            ->execute([], Doctrine_Core::HYDRATE_SINGLE_SCALAR);
        if (count($toArchive)) {
            $archived = Doctrine_Query::create()
                ->update('Order')
                ->set('state', '?', 'archived')
                ->andWhereIn('id', $toArchive)
                ->execute();
        }

        $toDebt = (array)Doctrine_Query::create()
            ->from('Order o')
            ->select('o.id, o.cost')
            ->leftJoin('o.Pays p')
            ->andWhereIn('o.state', ['submited', 'archived'])
            ->having('COALESCE(sum(p.amount), 0) < COALESCE(o.cost, 0)')
            ->groupBy('o.id')
            ->execute([], Doctrine_Core::HYDRATE_SINGLE_SCALAR);
        if (count($toDebt)) {
            $debted = Doctrine_Query::create()
                ->update('Order')
                ->set('state', '?', 'debt')
                ->andWhereIn('id', $toDebt)
                ->execute();
        }

        echo print_r(['archived' => $archived, 'debted' => $debted], 1);
    }
}
