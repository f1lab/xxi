<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version2 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('order', 'order_client_id_client_id', array(
             'name' => 'order_client_id_client_id',
             'local' => 'client_id',
             'foreign' => 'id',
             'foreignTable' => 'client',
             ));
        $this->createForeignKey('order', 'order_created_by_sf_guard_user_id', array(
             'name' => 'order_created_by_sf_guard_user_id',
             'local' => 'created_by',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('order', 'order_updated_by_sf_guard_user_id', array(
             'name' => 'order_updated_by_sf_guard_user_id',
             'local' => 'updated_by',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
        $this->addIndex('order', 'order_client_id', array(
             'fields' => 
             array(
              0 => 'client_id',
             ),
             ));
        $this->addIndex('order', 'order_created_by', array(
             'fields' => 
             array(
              0 => 'created_by',
             ),
             ));
        $this->addIndex('order', 'order_updated_by', array(
             'fields' => 
             array(
              0 => 'updated_by',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('order', 'order_client_id_client_id');
        $this->dropForeignKey('order', 'order_created_by_sf_guard_user_id');
        $this->dropForeignKey('order', 'order_updated_by_sf_guard_user_id');
        $this->removeIndex('order', 'order_client_id', array(
             'fields' => 
             array(
              0 => 'client_id',
             ),
             ));
        $this->removeIndex('order', 'order_created_by', array(
             'fields' => 
             array(
              0 => 'created_by',
             ),
             ));
        $this->removeIndex('order', 'order_updated_by', array(
             'fields' => 
             array(
              0 => 'updated_by',
             ),
             ));
    }
}