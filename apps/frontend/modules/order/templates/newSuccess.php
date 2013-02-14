<div class="page-header">
  <h1>Добавить заказ</h1>
</div>

<form action="<?php echo url_for('@order-create') ?>" method="post">
  <?php //echo $form->renderUsing('bootstrap') ?>
  <fieldset>
    <legend>Основная информация</legend>
      <?php echo $form['client_id']->renderLabel()?>
      <?php echo $form['client_id']->render()?><br>
      <?php echo $form['client_id']->renderError()?><br>
      <?php echo $form['description']->renderLabel()?>
      <?php echo $form['description']->render()?><br>
      <span class="text-error">
        <?php echo $form['description']->renderError()?>
      </span><br>
      <?php echo $form['additional']->renderLabel()?>
      <?php echo $form['additional']->render()?><br>
      <?php echo $form['additional']->renderError()?><br>
      <?php echo $form['approved_at']->renderLabel()?>
      <?php echo $form['approved_at']->render()?><br>
      <?php echo $form['approved_at']->renderError()?>
      <?php echo $form['files']->renderLabel()?>
      <?php echo $form['files']->render()?><br>
      <?php echo $form['files']->renderError()?><br>
  </fieldset>
  <fieldset>
    <legend>Сроки исполнения</legend> 
      <?php echo $form['due_date']->renderLabel()?>
      <?php echo $form['due_date']->render()?><br>
      <?php echo $form['due_date']->renderError()?>
      <?php echo $form['execution_time']->renderLabel()?>
      <?php echo $form['execution_time']->render()?><br>
      <?php echo $form['execution_time']->renderError()?>
  </fieldset>
  <fieldset>
    <legend>Стоимости</legend> 
      <?php echo $form['installation_cost']->renderLabel()?>
      <?php echo $form['installation_cost']->render()?><br>
      <?php echo $form['installation_cost']->renderError()?>
      <?php echo $form['design_cost']->renderLabel()?>
      <?php echo $form['design_cost']->render()?><br>
      <?php echo $form['design_cost']->renderError()?>
      <?php echo $form['contractors_cost']->renderLabel()?>
      <?php echo $form['contractors_cost']->render()?><br>
      <?php echo $form['contractors_cost']->renderError()?>
      <?php echo $form['delivery_cost']->renderLabel()?>
      <?php echo $form['delivery_cost']->render()?><br>
      <?php echo $form['delivery_cost']->renderError()?>
      <?php echo $form['cost']->renderLabel()?>
      <?php echo $form['cost']->render()?><br>
      <?php echo $form['cost']->renderError()?>
  </fieldset>
  <fieldset>
    <legend>Оплата</legend> 
      <?php echo $form['pay_method']->renderLabel()?>
      <?php echo $form['pay_method']->render()?><br>
      <?php echo $form['pay_method']->renderError()?>
      <?php echo $form['recoil']->renderLabel()?>
      <?php echo $form['recoil']->render()?><br>
      <?php echo $form['recoil']->renderError()?>
  </fieldset>  
  <fieldset>
    <legend>Статусы</legend> 
      <?php echo $form['state']->renderLabel()?>
      <?php echo $form['state']->render()?><br>
      <?php echo $form['state']->renderError()?>
  </fieldset>
  <?php echo $form->renderHiddenFields()?>
  <div class="form-actions">
    <button type="submit" class="btn btn-primary">Добавить</button>
    <a href="<?php echo url_for('@orders') ?>" class="btn">Назад</a>
  </div>
</form>