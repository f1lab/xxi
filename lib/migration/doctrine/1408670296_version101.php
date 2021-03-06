<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version101 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('ref_order_work', 'labor', 'decimal', '18', array(
             'scale' => '1',
             'notnull' => '1',
             'default' => '0',
             ));
        $this->addColumn('work', 'rate', 'decimal', '18', array(
             'scale' => '1',
             'notnull' => '1',
             'default' => '0',
             ));
    }

    public function down()
    {
        $this->removeColumn('ref_order_work', 'labor');
        $this->removeColumn('work', 'rate');
    }
}
