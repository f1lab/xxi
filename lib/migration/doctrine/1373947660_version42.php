<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version42 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('utilization', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'order_id' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '8',
             ),
             'material_id' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '8',
             ),
             'amount' => 
             array(
              'type' => 'float',
              'notnull' => '1',
              'length' => '',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
             ),
             ));
    }

    public function down()
    {
        $this->dropTable('utilization');
    }
}