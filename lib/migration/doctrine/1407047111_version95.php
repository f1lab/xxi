<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version95 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('client', 'credit_line', 'integer', '8', array(
             ));
    }

    public function down()
    {
        $this->removeColumn('client', 'credit_line');
    }
}
