<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version98 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('utilization_plan', 'utilization_plan_order_id_order_id', array(
             'name' => 'utilization_plan_order_id_order_id',
             'local' => 'order_id',
             'foreign' => 'id',
             'foreignTable' => 'order',
             ));
        $this->createForeignKey('utilization_plan', 'utilization_plan_created_by_sf_guard_user_id', array(
             'name' => 'utilization_plan_created_by_sf_guard_user_id',
             'local' => 'created_by',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => 'CASCADE',
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('utilization_plan', 'utilization_plan_updated_by_sf_guard_user_id', array(
             'name' => 'utilization_plan_updated_by_sf_guard_user_id',
             'local' => 'updated_by',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => 'CASCADE',
             'onDelete' => 'CASCADE',
             ));
        $this->addIndex('utilization_plan', 'utilization_plan_order_id', array(
             'fields' =>
             array(
              0 => 'order_id',
             ),
             ));
        $this->addIndex('utilization_plan', 'utilization_plan_created_by', array(
             'fields' =>
             array(
              0 => 'created_by',
             ),
             ));
        $this->addIndex('utilization_plan', 'utilization_plan_updated_by', array(
             'fields' =>
             array(
              0 => 'updated_by',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('utilization_plan', 'utilization_plan_order_id_order_id');
        $this->dropForeignKey('utilization_plan', 'utilization_plan_created_by_sf_guard_user_id');
        $this->dropForeignKey('utilization_plan', 'utilization_plan_updated_by_sf_guard_user_id');
        $this->removeIndex('utilization_plan', 'utilization_plan_order_id', array(
             'fields' =>
             array(
              0 => 'order_id',
             ),
             ));
        $this->removeIndex('utilization_plan', 'utilization_plan_created_by', array(
             'fields' =>
             array(
              0 => 'created_by',
             ),
             ));
        $this->removeIndex('utilization_plan', 'utilization_plan_updated_by', array(
             'fields' =>
             array(
              0 => 'updated_by',
             ),
             ));
    }
}
