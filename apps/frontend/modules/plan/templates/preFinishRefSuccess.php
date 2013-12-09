<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="?" method="post">
  <?php if ($sf_user->hasCredential("master")): ?>
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
  <?php endif ?>

  <?php if ($sf_user->hasCredential("design-master")): ?>
    <?php echo $form["files"]->renderRowUsing("bootstrap") ?>
  <?php endif ?>

  <div class="form-actions">
    <?php echo $form->renderHiddenFields() ?>
    <button type="submit" class="btn btn-primary">Сохранить</button>
  </div>
</form>