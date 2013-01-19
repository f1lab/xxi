<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUserAdminForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardUserAdminForm extends BasesfGuardUserAdminForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
    unset (
      $this['updated_at'],
      $this['created_at'],
      $this['salt'],
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
      'password_again' => 'Повторите пароль',
      'is_super_admin' => 'Права администратора',
      'is_active' => 'Включен',
      
    ));  
   
  }
}
