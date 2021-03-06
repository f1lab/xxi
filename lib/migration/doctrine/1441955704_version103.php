<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version103 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->changeColumn('area', 'rate', 'decimal', '18', array(
             'notnull' => '1',
             'default' => '1',
             'scale' => '2',
             ));
        $this->changeColumn('order', 'installation_cost', 'decimal', '18', array(
             'notnull' => '1',
             'default' => '0',
             'scale' => '2',
             ));
        $this->changeColumn('order', 'design_cost', 'decimal', '18', array(
             'notnull' => '1',
             'default' => '0',
             'scale' => '2',
             ));
        $this->changeColumn('order', 'contractors_cost', 'decimal', '18', array(
             'notnull' => '1',
             'default' => '0',
             'scale' => '2',
             ));
        $this->changeColumn('order', 'delivery_cost', 'decimal', '18', array(
             'notnull' => '1',
             'default' => '0',
             'scale' => '2',
             ));
        $this->changeColumn('order', 'cost', 'decimal', '18', array(
             'notnull' => '1',
             'default' => '0',
             'scale' => '2',
             ));
        $this->changeColumn('order', 'recoil', 'decimal', '18', array(
             'notnull' => '1',
             'default' => '0',
             'scale' => '2',
             ));
        $this->changeColumn('order', 'payed', 'decimal', '18', array(
             'notnull' => '1',
             'default' => '0',
             'scale' => '2',
             ));
        $this->changeColumn('order_auto_version', 'installation_cost', 'decimal', '18', array(
             'notnull' => '1',
             'default' => '0',
             'scale' => '2',
             ));
        $this->changeColumn('order_auto_version', 'design_cost', 'decimal', '18', array(
             'notnull' => '1',
             'default' => '0',
             'scale' => '2',
             ));
        $this->changeColumn('order_auto_version', 'contractors_cost', 'decimal', '18', array(
             'notnull' => '1',
             'default' => '0',
             'scale' => '2',
             ));
        $this->changeColumn('order_auto_version', 'delivery_cost', 'decimal', '18', array(
             'notnull' => '1',
             'default' => '0',
             'scale' => '2',
             ));
        $this->changeColumn('order_auto_version', 'cost', 'decimal', '18', array(
             'notnull' => '1',
             'default' => '0',
             'scale' => '2',
             ));
        $this->changeColumn('order_auto_version', 'recoil', 'decimal', '18', array(
             'notnull' => '1',
             'default' => '0',
             'scale' => '2',
             ));
        $this->changeColumn('order_auto_version', 'payed', 'decimal', '18', array(
             'notnull' => '1',
             'default' => '0',
             'scale' => '2',
             ));
    }

    public function down()
    {

    }
}
