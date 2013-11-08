<?php

class ImportForm extends BaseForm {
  public function configure() {
    $this->getWidgetSchema()
      ->setNameFormat('import[%s]')
      ->offsetSet('input', new sfWidgetFormTextarea([], [
        'rows' => 20,
        'class' => "input-block-level"
      ]))
      ->setLabels(array(
        'input' => 'Импортируемое',
      ))
    ;

    $this->getValidatorSchema()
      ->offsetSet('input', new sfValidatorString())
    ;
  }
}
