<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version23 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('order', 'bill_made', 'boolean', '25', array(
             'notnull' => '1',
             'default' => '0',
             ));
        $this->addColumn('order', 'bill_given', 'boolean', '25', array(
             'notnull' => '1',
             'default' => '0',
             ));
        $this->addColumn('order_auto_version', 'bill_made', 'boolean', '25', array(
             'notnull' => '1',
             'default' => '0',
             ));
        $this->addColumn('order_auto_version', 'bill_given', 'boolean', '25', array(
             'notnull' => '1',
             'default' => '0',
             ));
    }

    public function down()
    {
        $this->removeColumn('order', 'bill_made');
        $this->removeColumn('order', 'bill_given');
        $this->removeColumn('order_auto_version', 'bill_made');
        $this->removeColumn('order_auto_version', 'bill_given');
    }
}