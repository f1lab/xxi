<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version26 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addIndex('order', 'deleted_at', array(
             'fields' => 
             array(
              0 => 'deleted_at',
             ),
             ));
    }

    public function down()
    {
        $this->removeIndex('order', 'deleted_at', array(
             'fields' => 
             array(
              0 => 'deleted_at',
             ),
             ));
    }
}