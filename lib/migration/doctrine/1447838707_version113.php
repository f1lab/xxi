<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version113 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('orders_table_filter', 'name', 'string', '255', array(
             'notnull' => '1',
             ));
    }

    public function down()
    {
        $this->removeColumn('orders_table_filter', 'name');
    }
}
