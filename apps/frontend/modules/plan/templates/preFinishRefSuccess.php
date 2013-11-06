<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="?" method="post">
  <fieldset>
    <legend>Расход материалов</legend>
    <?php include_partial('global/relation', [
      'form' => $form,
      'relationName' => 'Utilizations',
      'columns' => [
        'material_id' => 'Наименование материала',
        'amount' => 'Кол-во (объём)',
      ],
      'noRelationsMessage' => 'Нет расходов',
    ]) ?>
  </fieldset>

  <div class="form-actions">
    <?php echo $form->renderHiddenFields() ?>
    <button type="submit" class="btn btn-primary">Сохранить</button>
  </div>
</form>