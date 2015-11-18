<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('OrdersTableSettings/'
  . ($form->getObject()->isNew() ? 'create' : 'update')
  . (!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : ''))
  ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

  <?php echo $form->renderGlobalErrors() ?>

  <label class="checkbox">
    <?php echo $form['id_enabled']->render() ?>
    <?php echo $form['id_enabled']->renderLabelName() ?>
  </label>

  <label class="checkbox">
    <?php echo $form['client_id_enabled']->render() ?>
    <?php echo $form['client_id_enabled']->renderLabelName() ?>
  </label>

  <label class="checkbox">
    <?php echo $form['approved_at_enabled']->render() ?>
    <?php echo $form['approved_at_enabled']->renderLabelName() ?>
  </label>

  <label class="checkbox">
    <?php echo $form['due_date_enabled']->render() ?>
    <?php echo $form['due_date_enabled']->renderLabelName() ?>
  </label>

  <label class="checkbox">
    <?php echo $form['submited_at_enabled']->render() ?>
    <?php echo $form['submited_at_enabled']->renderLabelName() ?>
  </label>

  <label class="checkbox">
    <?php echo $form['state_enabled']->render() ?>
    <?php echo $form['state_enabled']->renderLabelName() ?>
  </label>

  <label class="checkbox">
    <?php echo $form['cost_enabled']->render() ?>
    <?php echo $form['cost_enabled']->renderLabelName() ?>
  </label>

  <label class="checkbox">
    <?php echo $form['payed_enabled']->render() ?>
    <?php echo $form['payed_enabled']->renderLabelName() ?>
  </label>

  <label class="checkbox">
    <?php echo $form['pay_method_enabled']->render() ?>
    <?php echo $form['pay_method_enabled']->renderLabelName() ?>
  </label>

  <label class="checkbox">
    <?php echo $form['payed_at_enabled']->render() ?>
    <?php echo $form['payed_at_enabled']->renderLabelName() ?>
  </label>

  <label class="checkbox">
    <?php echo $form['manager_enabled']->render() ?>
    <?php echo $form['manager_enabled']->renderLabelName() ?>
  </label>

  <label class="checkbox">
    <?php echo $form['bill_made_enabled']->render() ?>
    <?php echo $form['bill_made_enabled']->renderLabelName() ?>
  </label>

  <label class="checkbox">
    <?php echo $form['bill_given_enabled']->render() ?>
    <?php echo $form['bill_given_enabled']->renderLabelName() ?>
  </label>

  <label class="checkbox">
    <?php echo $form['docs_given_enabled']->render() ?>
    <?php echo $form['docs_given_enabled']->renderLabelName() ?>
  </label>

  <label class="checkbox">
    <?php echo $form['comments_enabled']->render() ?>
    <?php echo $form['comments_enabled']->renderLabelName() ?>
  </label>

  <?php echo $form->renderHiddenFields(false) ?>
  <?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
  <?php endif ?>

  <div class="form-actions">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="<?php echo url_for('OrdersTableSettings/index') ?>" class="btn">Back to list</a>

    <?php if (!$form->getObject()->isNew()): ?>
      <?php echo link_to('Delete', 'OrdersTableSettings/delete?id='.$form->getObject()->getId(), array(
        'method' => 'delete',
        'confirm' => 'Are you sure?',
        'class' => 'btn btn-warning pull-right',
      )) ?>
    <?php endif ?>
  </div>
</form>
