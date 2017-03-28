<?php

/**
 * sfWidgetFormBootstrapTime represents a time widget using bootstrap framework.
 *
 * @package    symfony
 * @subpackage widget
 * @author     Saritskiy R.G. <antismok@mail.ru>
 * @version    SVN: $Id: sfWidgetFormBootstrapTime.class.php 2013-01-24 17:05:33Z  $
 */
class sfWidgetFormBootstrapTime extends sfWidgetForm
{
    public function configure($options = [], $attributes = [])
    {

    }

    public function render($name, $value = null, $attributes = [], $errors = [])
    {

        return
            '<div class="input-append bootstrap-timepicker-component">
      <input name="' . $name . '" type="text" class="timepicker-default input-small" value="' . $value . '">
      <span class="add-on">
        <i class="icon-time"></i>
      </span>
    </div>
    <script type="text/javascript">
        $(\'.timepicker-default\').timepicker({defaultTime:\'' . $value . '\', showMeridian:false});
      </script>';
    }
}

?>
