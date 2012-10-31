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

  <div class="control-group<?php if ($form['created_at_from']->hasError()): ?> error<?php endif ?>">
    <?php echo $form['created_at_from']->renderLabel(null, array('class' => 'control-label')) ?>
    <div class="controls form-horizontal">
      <?php echo $form['created_at_from']->render(array('placeholder' => 'from')) ?>
      <?php echo $form['created_at_to']->render(array('placeholder' => 'to')) ?>
      <?php if ($form['created_at_from']->hasError()): ?><div class="help-inline"><?php echo $form['created_at_from']->getError() ?></div><?php endif ?>
    </div>
  </div>

  <div class="control-group<?php if ($form['approved_at_from']->hasError()): ?> error<?php endif ?>">
    <?php echo $form['approved_at_from']->renderLabel(null, array('class' => 'control-label')) ?>
    <div class="controls form-horizontal">
      <?php echo $form['approved_at_from']->render(array('placeholder' => 'from')) ?>
      <?php echo $form['approved_at_to']->render(array('placeholder' => 'to')) ?>
      <?php if ($form['approved_at_from']->hasError()): ?><div class="help-inline"><?php echo $form['approved_at_from']->getError() ?></div><?php endif ?>
    </div>
  </div>

  <div class="control-group<?php if ($form['submited_at_from']->hasError()): ?> error<?php endif ?>">
    <?php echo $form['submited_at_from']->renderLabel(null, array('class' => 'control-label')) ?>
    <div class="controls form-horizontal">
      <?php echo $form['submited_at_from']->render(array('placeholder' => 'from')) ?>
      <?php echo $form['submited_at_to']->render(array('placeholder' => 'to')) ?>
      <?php if ($form['submited_at_from']->hasError()): ?><div class="help-inline"><?php echo $form['submited_at_from']->getError() ?></div><?php endif ?>
    </div>
  </div>

  <div class="control-group<?php if ($form['payed_at_from']->hasError()): ?> error<?php endif ?>">
    <?php echo $form['payed_at_from']->renderLabel(null, array('class' => 'control-label')) ?>
    <div class="controls form-horizontal">
      <?php echo $form['payed_at_from']->render(array('placeholder' => 'from')) ?>
      <?php echo $form['payed_at_to']->render(array('placeholder' => 'to')) ?>
      <?php if ($form['payed_at_from']->hasError()): ?><div class="help-inline"><?php echo $form['payed_at_from']->getError() ?></div><?php endif ?>
    </div>
  </div>

  <div class="control-group<?php if ($form['state']->hasError()): ?> error<?php endif ?>">
    <?php echo $form['state']->renderLabel(null, array('class' => 'control-label')) ?>
    <div class="controls">
      <?php echo $form['state']->render() ?>
      <?php if ($form['state']->hasError()): ?><div class="help-inline"><?php echo $form['state']->getError() ?></div><?php endif ?>
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

  <?php $form->renderHiddenFields() ?>
  <button type="submit" class="btn btn-primary">Отфильтровать</button>
  <a href="<?php echo url_for('@orders') ?>" class="btn">Отменить</a>
</form>
