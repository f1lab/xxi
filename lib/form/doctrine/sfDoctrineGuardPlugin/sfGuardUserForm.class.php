<?php

/**
 * sfGuardUser form.
 *
 * @package    xxi
 * @subpackage form
 * @author     Anatoly Pashin
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends PluginsfGuardUserForm
{
  public function configure()
  {
    
    unset (
      $this['updated_at'],
      $this['created_at'],
      $this['salt'],
      $this['is_active'],
      $this['is_super_admin'],
      $this['algorithm'],
      $this['last_login']
    );
    
    $this->widgetSchema->setLabels(array(
      'first_name' => 'Имя',
      'last_name' => 'Фамилия',
      'email_address' => 'Электронный адрес',
      'permissions_list' => 'Права',
      'password' => 'Пароль',
      'salt'=>'соль',
      'groups_list'=>'Группа',
      'username'=>'Имя пользователя',
      
    ));
  }
}
