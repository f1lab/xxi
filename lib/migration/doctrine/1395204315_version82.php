<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version82 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('ref_warehouse_user', 'ref_warehouse_user_warehouse_id_warehouse_id', array(
             'name' => 'ref_warehouse_user_warehouse_id_warehouse_id',
             'local' => 'warehouse_id',
             'foreign' => 'id',
             'foreignTable' => 'warehouse',
             ));
        $this->createForeignKey('ref_warehouse_user', 'ref_warehouse_user_user_id_sf_guard_user_id', array(
             'name' => 'ref_warehouse_user_user_id_sf_guard_user_id',
             'local' => 'user_id',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             ));
        $this->createForeignKey('warehouse', 'warehouse_created_by_sf_guard_user_id', array(
             'name' => 'warehouse_created_by_sf_guard_user_id',
             'local' => 'created_by',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => 'CASCADE',
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('warehouse', 'warehouse_updated_by_sf_guard_user_id', array(
             'name' => 'warehouse_updated_by_sf_guard_user_id',
             'local' => 'updated_by',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => 'CASCADE',
             'onDelete' => 'CASCADE',
             ));
        $this->addIndex('ref_warehouse_user', 'ref_warehouse_user_warehouse_id', array(
             'fields' =>
             array(
              0 => 'warehouse_id',
             ),
             ));
        $this->addIndex('ref_warehouse_user', 'ref_warehouse_user_user_id', array(
             'fields' =>
             array(
              0 => 'user_id',
             ),
             ));
        $this->addIndex('warehouse', 'warehouse_created_by', array(
             'fields' =>
             array(
              0 => 'created_by',
             ),
             ));
        $this->addIndex('warehouse', 'warehouse_updated_by', array(
             'fields' =>
             array(
              0 => 'updated_by',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('ref_warehouse_user', 'ref_warehouse_user_warehouse_id_warehouse_id');
        $this->dropForeignKey('ref_warehouse_user', 'ref_warehouse_user_user_id_sf_guard_user_id');
        $this->dropForeignKey('warehouse', 'warehouse_created_by_sf_guard_user_id');
        $this->dropForeignKey('warehouse', 'warehouse_updated_by_sf_guard_user_id');
        $this->removeIndex('ref_warehouse_user', 'ref_warehouse_user_warehouse_id', array(
             'fields' =>
             array(
              0 => 'warehouse_id',
             ),
             ));
        $this->removeIndex('ref_warehouse_user', 'ref_warehouse_user_user_id', array(
             'fields' =>
             array(
              0 => 'user_id',
             ),
             ));
        $this->removeIndex('warehouse', 'warehouse_created_by', array(
             'fields' =>
             array(
              0 => 'created_by',
             ),
             ));
        $this->removeIndex('warehouse', 'warehouse_updated_by', array(
             'fields' =>
             array(
              0 => 'updated_by',
             ),
             ));
    }
}