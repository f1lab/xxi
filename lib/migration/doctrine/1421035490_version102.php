<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version102 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('company_settings', 'uses_vat', 'boolean', '25', array(
             'notnull' => '1',
             'default' => '0',
             ));
    }

    public function down()
    {
        $this->removeColumn('company_settings', 'uses_vat');
    }
}