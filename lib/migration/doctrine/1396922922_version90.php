<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version90 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('material_movement', 'mumi', array(
             'name' => 'mumi',
             'local' => 'utilization_id',
             'foreign' => 'id',
             'foreignTable' => 'material_movement_utilization',
             ));
        $this->createForeignKey('material_movement_utilization', 'material_movement_utilization_order_id_order_id', array(
             'name' => 'material_movement_utilization_order_id_order_id',
             'local' => 'order_id',
             'foreign' => 'id',
             'foreignTable' => 'order',
             ));
        $this->createForeignKey('material_movement_utilization', 'material_movement_utilization_work_id_work_id', array(
             'name' => 'material_movement_utilization_work_id_work_id',
             'local' => 'work_id',
             'foreign' => 'id',
             'foreignTable' => 'work',
             ));
        $this->createForeignKey('material_movement_utilization', 'material_movement_utilization_created_by_sf_guard_user_id', array(
             'name' => 'material_movement_utilization_created_by_sf_guard_user_id',
             'local' => 'created_by',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => 'CASCADE',
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('material_movement_utilization', 'material_movement_utilization_updated_by_sf_guard_user_id', array(
             'name' => 'material_movement_utilization_updated_by_sf_guard_user_id',
             'local' => 'updated_by',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => 'CASCADE',
             'onDelete' => 'CASCADE',
             ));
        $this->addIndex('material_movement', 'material_movement_utilization_id', array(
             'fields' =>
             array(
              0 => 'utilization_id',
             ),
             ));
        $this->addIndex('material_movement_utilization', 'material_movement_utilization_order_id', array(
             'fields' =>
             array(
              0 => 'order_id',
             ),
             ));
        $this->addIndex('material_movement_utilization', 'material_movement_utilization_work_id', array(
             'fields' =>
             array(
              0 => 'work_id',
             ),
             ));
        $this->addIndex('material_movement_utilization', 'material_movement_utilization_created_by', array(
             'fields' =>
             array(
              0 => 'created_by',
             ),
             ));
        $this->addIndex('material_movement_utilization', 'material_movement_utilization_updated_by', array(
             'fields' =>
             array(
              0 => 'updated_by',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('material_movement', 'mumi');
        $this->dropForeignKey('material_movement_utilization', 'material_movement_utilization_order_id_order_id');
        $this->dropForeignKey('material_movement_utilization', 'material_movement_utilization_work_id_work_id');
        $this->dropForeignKey('material_movement_utilization', 'material_movement_utilization_created_by_sf_guard_user_id');
        $this->dropForeignKey('material_movement_utilization', 'material_movement_utilization_updated_by_sf_guard_user_id');
        $this->removeIndex('material_movement', 'material_movement_utilization_id', array(
             'fields' =>
             array(
              0 => 'utilization_id',
             ),
             ));
        $this->removeIndex('material_movement_utilization', 'material_movement_utilization_order_id', array(
             'fields' =>
             array(
              0 => 'order_id',
             ),
             ));
        $this->removeIndex('material_movement_utilization', 'material_movement_utilization_work_id', array(
             'fields' =>
             array(
              0 => 'work_id',
             ),
             ));
        $this->removeIndex('material_movement_utilization', 'material_movement_utilization_created_by', array(
             'fields' =>
             array(
              0 => 'created_by',
             ),
             ));
        $this->removeIndex('material_movement_utilization', 'material_movement_utilization_updated_by', array(
             'fields' =>
             array(
              0 => 'updated_by',
             ),
             ));
    }
}