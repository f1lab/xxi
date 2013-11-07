<?php

class MaterialImportForm extends BaseForm {
  public function configure() {
    $this->getWidgetSchema()
      ->setNameFormat('import[%s]')
      ->offsetSet('materials', new sfWidgetFormTextarea([], [
        'rows' => 20,
        'class' => "input-block-level"
      ]))
      ->setLabels(array(
        'materials' => 'Номеклатура',
      ))
    ;

    $this->getValidatorSchema()
      ->offsetSet('materials', new sfValidatorString())
    ;
  }
}
