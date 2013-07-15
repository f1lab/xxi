<?php

/**
 * sfValidatorBootstrapDateTime not validates anything. It's just making strtotime.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Anatoly Pashin <anatoly.pashin@gmail.com>
 * @version    SVN: $Id: sfValidatorString.class.php 12641 2008-11-04 18:22:00Z fabien $
 */
class sfValidatorBootstrapDateTime extends sfValidatorString
{
  protected function configure($options = array(), $messages = array())
  {
  }

  protected function doClean($value)
  {
    return date('Y-m-d H:i:s', strtotime($value));
  }
}
