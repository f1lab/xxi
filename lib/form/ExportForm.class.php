<?php

/**
 * Export form.
 *
 * @method SetOfRule getObject() Returns the current form's model object
 *
 * @package    emr2.f1lab.ru
 * @subpackage form
 * @author     Saritsky Roman
 */
class ExportForm extends BaseForm
{
  public function setup()
  {
    $this->setWidgets(array(
      'from'             => new sfWidgetFormBootstrapDate(array(), array(
          'placeholder' => '-',
          'class' => '',
          'type' => 'date',
        )),
      'to'      => new sfWidgetFormBootstrapDate(array(), array(
          'placeholder' => 'Сегодня',
          'class' => '',
          'type' => 'date',
        )),
      
    ));

    $this->setValidators(array(
      'from'             => new sfValidatorDate(array('required' => true)),
      'to'             => new sfValidatorDate(array('required' => true)),
      
    ));
    $this->getWidgetSchema()->setLabels(array(
      'from' => 'C',
      'to' => 'По'
      ));
    //$this->widgetSchema->setNameFormat('export[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    //$this->setupInheritance();

    //parent::setup();
  }
}
