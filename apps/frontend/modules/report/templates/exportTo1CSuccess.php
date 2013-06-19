<div class="page-header">
  <h1>Отчётность</h1>
</div>
<div class="tabbable tabs-left">
  <?php include_partial('tabs', array('currentRoute' => $sf_context->getRouting()->getCurrentRouteName())) ?>
  <div class="tab-content">
    <h2>Выгрузка в 1С</h2>
    <form action="<?php echo url_for('@do-export') ?>" method="post">
    <?php echo $form->renderUsing('bootstrap')?>

    <?php //echo $form['from']->render()?>
    <?php //echo $form['from']->renderError()?>

    <?php //echo $form['to']->render()?>
    <?php //echo $form['to']->renderError()?>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Выгрузить</button>
      </div>
    </form>
  </div>
</div>