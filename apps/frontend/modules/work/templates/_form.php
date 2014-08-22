<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('work/'
  . ($form->getObject()->isNew() ? 'create' : 'update')
  . (!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : ''))
  ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

  <?php echo $form->renderUsing('bootstrap') ?>

  <?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
  <?php endif ?>

  <div class="form-actions">
    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="<?php echo url_for('work/index') ?>" class="btn">Назад к списку</a>

    <?php if (!$form->getObject()->isNew()): ?>
      <?php echo link_to('Удалить', 'work/delete?id='.$form->getObject()->getId(), array(
        'method' => 'delete',
        'confirm' => 'Are you sure?',
        'class' => 'btn btn-warning pull-right',
      )) ?>
    <?php endif ?>
  </div>
</form>
