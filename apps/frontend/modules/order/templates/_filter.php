<form action="<?php echo url_for('@orders') ?>" method="get" class="well form-horizontal">

  <div class="control-group<?php if ($form['client_id']->hasError()): ?> error<?php endif ?>">
    <?php echo $form['client_id']->renderLabel(null, array('class' => 'control-label')) ?>
    <div class="controls">
      <?php echo $form['client_id']->render() ?>
      <?php if ($form['client_id']->hasError()): ?><div class="help-inline"><?php echo $form['client_id']->getError() ?></div><?php endif ?>
    </div>
  </div>

  <div class="control-group<?php if ($form['created_by']->hasError()): ?> error<?php endif ?>">
    <?php echo $form['created_by']->renderLabel(null, array('class' => 'control-label')) ?>
    <div class="controls">
      <?php echo $form['created_by']->render() ?>
      <?php if ($form['created_by']->hasError()): ?><div class="help-inline"><?php echo $form['created_by']->getError() ?></div><?php endif ?>
    </div>
  </div>

<?php foreach (OrderFormFilter::$attributesWithTimestamps as $attribute): ?>
  <div class="control-group<?php if ($form[$attribute . "_at_from"]->hasError()): ?> error<?php endif ?>">
    <?php echo $form[$attribute . "_at_from"]->renderLabel(null, array('class' => 'control-label')) ?>
    <div class="controls form-horizontal">
      <?php echo $form[$attribute . "_at_from"]->render(array('placeholder' => 'from')) ?>
      <?php echo $form[$attribute . "_at_to"]->render(array('placeholder' => 'to')) ?>
      <?php if ($form[$attribute . "_at_from"]->hasError()): ?><div class="help-inline"><?php echo $form[$attribute . "_at_from"]->getError() ?></div><?php endif ?>
    </div>
  </div>
<?php endforeach ?>

  <div class="control-group<?php if ($form['state']->hasError()): ?> error<?php endif ?>">
    <?php echo $form['state']->renderLabel(null, array('class' => 'control-label')) ?>
    <div class="controls form-horizontal">
      <?php echo $form['state']->render() ?>
      <?php if ($form['state']->hasError()): ?><div class="help-inline"><?php echo $form['state']->getError() ?></div><?php endif ?>
       <a href="#" onclick="return resetNearestSelect(this)" class="muted">очистить</a>
    </div>
  </div>

  <div class="control-group<?php if ($form['area']->hasError()): ?> error<?php endif ?>">
    <?php echo $form['area']->renderLabel(null, array('class' => 'control-label')) ?>
    <div class="controls">
      <?php echo $form['area']->render() ?>
      <?php if ($form['area']->hasError()): ?><div class="help-inline"><?php echo $form['area']->getError() ?></div><?php endif ?>
    </div>
  </div>

  <div class="control-group<?php if ($form['bill_made']->hasError()): ?> error<?php endif ?>">
    <?php echo $form['bill_made']->renderLabel(null, array('class' => 'control-label')) ?>
    <div class="controls">
      <?php echo $form['bill_made']->render() ?>
      <?php if ($form['bill_made']->hasError()): ?><div class="help-inline"><?php echo $form['bill_made']->getError() ?></div><?php endif ?>
    </div>
  </div>

  <div class="control-group<?php if ($form['bill_given']->hasError()): ?> error<?php endif ?>">
    <?php echo $form['bill_given']->renderLabel(null, array('class' => 'control-label')) ?>
    <div class="controls">
      <?php echo $form['bill_given']->render() ?>
      <?php if ($form['bill_given']->hasError()): ?><div class="help-inline"><?php echo $form['bill_given']->getError() ?></div><?php endif ?>
    </div>
  </div>

  <div class="control-group<?php if ($form['docs_given']->hasError()): ?> error<?php endif ?>">
    <?php echo $form['docs_given']->renderLabel(null, array('class' => 'control-label')) ?>
    <div class="controls">
      <?php echo $form['docs_given']->render() ?>
      <?php if ($form['docs_given']->hasError()): ?><div class="help-inline"><?php echo $form['docs_given']->getError() ?></div><?php endif ?>
    </div>
  </div>

  <?php if (
      $sf_user->hasGroup("worker") || $sf_user->hasGroup("design-worker")
      or $sf_user->hasCredential(["orders-filter-works-without", "order-filter-works-completed"])
    ): ?>
    <div class="control-group<?php if ($form['works_list']->hasError()): ?> error<?php endif ?>">
      <?php echo $form['works_list']->renderLabel(null, array('class' => 'control-label')) ?>
      <div class="controls">
        <?php echo $form['works_list']->render() ?>
        <?php if ($form['works_list']->hasError()): ?><div class="help-inline"><?php echo $form['works_list']->getError() ?></div><?php endif ?>
      </div>
    </div>
  <?php endif ?>

  <?php $form->renderHiddenFields() ?>
  <button type="submit" class="btn btn-primary">Отфильтровать</button>
  <a href="<?php echo url_for('@orders') ?>" class="btn">Отменить</a>
</form>
