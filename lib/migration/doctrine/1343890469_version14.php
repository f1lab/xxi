<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version14 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->changeColumn('order', 'pay_method', 'enum', '', array(
             'values' => 
             array(
              0 => '',
              1 => 'cash',
              2 => 'non-cash',
              3 => 'barter',
              4 => 'settlement',
             ),
             ));
        $this->changeColumn('order_auto_version', 'pay_method', 'enum', '', array(
             'values' => 
             array(
              0 => '',
              1 => 'cash',
              2 => 'non-cash',
              3 => 'barter',
              4 => 'settlement',
             ),
             ));
    }

    public function down()
    {

    }
}