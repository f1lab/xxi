<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version61 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('nomenclature', 'nomenclature_created_by_sf_guard_user_id', array(
             'name' => 'nomenclature_created_by_sf_guard_user_id',
             'local' => 'created_by',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => 'CASCADE',
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('nomenclature', 'nomenclature_updated_by_sf_guard_user_id', array(
             'name' => 'nomenclature_updated_by_sf_guard_user_id',
             'local' => 'updated_by',
             'foreign' => 'id',
             'foreignTable' => 'sf_guard_user',
             'onUpdate' => 'CASCADE',
             'onDelete' => 'CASCADE',
             ));
        $this->addIndex('nomenclature', 'nomenclature_created_by', array(
             'fields' =>
             array(
              0 => 'created_by',
             ),
             ));
        $this->addIndex('nomenclature', 'nomenclature_updated_by', array(
             'fields' =>
             array(
              0 => 'updated_by',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('nomenclature', 'nomenclature_created_by_sf_guard_user_id');
        $this->dropForeignKey('nomenclature', 'nomenclature_updated_by_sf_guard_user_id');
        $this->removeIndex('nomenclature', 'nomenclature_created_by', array(
             'fields' =>
             array(
              0 => 'created_by',
             ),
             ));
        $this->removeIndex('nomenclature', 'nomenclature_updated_by', array(
             'fields' =>
             array(
              0 => 'updated_by',
             ),
             ));
    }
}