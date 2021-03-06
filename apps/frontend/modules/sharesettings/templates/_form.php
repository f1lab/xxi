<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('sharesettings/' . ($form->getObject()->isNew() ? 'create' : 'update')
    . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>"
      method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put"/>
    <?php endif; ?>
    <?php echo $form->renderUsing('bootstrap') ?>
    <div class="form-actions">
        <?php echo $form->renderHiddenFields(false) ?>
        <button type="submit" class="btn btn-primary btn-large">Сохранить</button>
        <a href="<?php echo url_for('sharesettings/show?id=1') ?>" class="btn">Назад</a>

    </div>
</form>
