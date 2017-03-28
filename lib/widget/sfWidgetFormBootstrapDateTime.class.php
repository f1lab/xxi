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
    public function configure($options = [], $attributes = [])
    {
        $this->addOption('format', 'yyyy-mm-dd hh:ii');
        $this->addOption('minView', '0');
    }

    public static function javascriptDateFormat2Php($format)
    {
        return str_replace([
            'yyyy',
            'mm',
            'dd',
            'hh',
            'ii',
            'ss',
        ], [
            'Y',
            'm',
            'd',
            'H',
            'i',
            's',
        ], $format);
    }

    public function render($name, $value = null, $attributes = [], $errors = [])
    {
        $_ = function ($value) {
            return $value;
        };

        if ($value !== null && $value !== '') {
            $value = date(self::javascriptDateFormat2Php($this->getOption('format')), strtotime($value));
        }

        return <<<HTML
      <div class="input-append date datetimepickable" id="{$_($this->generateId($name))}" data-date="{$value}" data-date-format="{$_($this->getOption('format'))}" data-min-view="{$_($this->getOption('minView'))}">
        <input type="text" name="{$name}" class="span2" value="{$value}" readonly>
        <span class="add-on"><i class="icon-calendar"></i></span>
    </div>
HTML;
    }
}
