<?php

/**
 * sfGuardFormSignin for sfGuardAuth signin action
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardFormSignin.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardFormSignin extends BasesfGuardFormSignin
{
  /**
   * @see sfForm
   */
  public function configure()
  {
    //unset ($this['remember']);

    $this->getWidgetSchema()
      ->offsetSet('username', new sfWidgetFormInputText(array(), array('tabindex' => 1)))
      ->offsetSet('password', new sfWidgetFormInputPassword(array('type' => 'password'), array('tabindex' => 2)))
      ->offsetSet('remember', new sfWidgetFormInputCheckbox(array(), array('tabindex' => 3)))
    ;

    $this->getWidgetSchema()->setLabels(array(
      'username' => 'Пользователь',
      'password' => 'Пароль',
      'remember' => 'Запомнить',
    ));
  }
}