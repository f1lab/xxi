<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version105 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->changeColumn('invoice', 'number', 'decimal', '18', array(
             ));
        $this->changeColumn('invoice', 'price', 'decimal', '18', array(
             ));
        $this->changeColumn('invoice', 'sum', 'decimal', '18', array(
             ));
        $this->changeColumn('pay', 'amount', 'decimal', '18', array(
             ));
    }

    public function down()
    {

    }
}