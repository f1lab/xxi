<?php

/**
 * sfWidgetFormBootstrapDateTime represents a datetime widget using bootstrap framework.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Anatoly Pashin <anatoly.pashin@gmail.com>
 */
class sfWidgetFormBootstrapDateTime extends sfWidgetForm
{
  public function configure($options = array(), $attributes = array())
  {
    $this->addOption('format', 'yyyy-mm-dd hh:ii');
    $this->addOption('minView', '0');
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $_ = function($value) {
      return $value;
    };

    if ($value !== null) {
      $value = date('Y-m-d H:i', strtotime($value));
    }

    return <<<HTML
      <div class="input-append date datetimepickable" id="{$_($this->generateId($name))}" data-date="{$value}" data-date-format="{$_($this->getOption('format'))}" data-min-view="{$_($this->getOption('minView'))}">
        <input type="text" name="{$name}" class="span2" value="{$value}" readonly>
        <span class="add-on"><i class="icon-calendar"></i></span>
    </div>
HTML;
  }
}
