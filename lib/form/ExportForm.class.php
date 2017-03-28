<?php

/**
 * Export form.
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
        $this->setWidgets([
            'from' => new sfWidgetFormBootstrapDate([], [
                'placeholder' => '-',
                'class' => '',
                'type' => 'date',
            ]),
            'to' => new sfWidgetFormBootstrapDate([], [
                'placeholder' => 'Сегодня',
                'class' => '',
                'type' => 'date',
            ]),

        ]);

        $this->setValidators([
            'from' => new sfValidatorDate(['required' => true]),
            'to' => new sfValidatorDate(['required' => true]),

        ]);
        $this->getWidgetSchema()->setLabels([
            'from' => 'C',
            'to' => 'По',
        ]);
        //$this->widgetSchema->setNameFormat('export[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        //$this->setupInheritance();

        //parent::setup();
    }
}
