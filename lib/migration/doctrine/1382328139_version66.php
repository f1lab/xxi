<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version66 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('ref_order_work', 'is_completed', 'boolean', '25', array(
             'default' => '0',
             'notnull' => '1',
             ));
        $this->addColumn('ref_order_work', 'planned_start', 'timestamp', '25', array(
             ));
        $this->addColumn('ref_order_work', 'planned_finish', 'timestamp', '25', array(
             ));
    }

    public function down()
    {
        $this->removeColumn('ref_order_work', 'is_completed');
        $this->removeColumn('ref_order_work', 'planned_start');
        $this->removeColumn('ref_order_work', 'planned_finish');
    }
}