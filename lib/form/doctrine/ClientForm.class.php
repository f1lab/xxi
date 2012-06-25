<?php

/**
 * Client form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Anatoly Pashin
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ClientForm extends BaseClientForm
{
  public function configure()
  {
    unset( $this['created_by'], $this['updated_by'], $this['deleted_at'] );

    $this->getWidgetSchema()->setLabels(array(
      'name' => 'Наименование организации',
      'contact' => 'Контактное лицо',
      'phone' => 'Телефон',
      'email' => 'Email',
    ));
  }
}
