<div class="page-header">
  <h1>Добавить заказ</h1>
</div>

<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="alerts">
  <div class="alert alert-block alert-danger hide first-order">Внимание, это первый заказ клиента. Заказ принимается только при полной предоплате.</div>
  <div class="alert alert-block alert-danger hide credit-bad">Внимание, кредитная линия клиента (<span></span> руб.) превышена (дебет <span></span> руб.). Заказ принимается только при полной или частичной предоплате.</div>
  <div class="alert alert-block alert-success hide credit-ok">Кредитная линия (<span></span> руб.) не превышена.</div>
  <div class="alert alert-block alert-invert hide blacklisted">Внимание, клиент в черном списке. Заказ принимается только после согласования с руководством.</div>
</div>

<form action="<?php echo url_for('@order-create') ?>" method="post">
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form->renderHiddenFields()?>

  <fieldset>
    <legend>Позиции заказа</legend>
    <?php include_partial('global/relation', [
      'form' => $form,
      'relationName' => 'Invoices',
      'columns' => [
        'description' => 'Описание заказа',
        'number' => 'Кол-во',
        'price' => 'Цена',
        'sum' => 'Сумма',
      ],
      'noRelationsMessage' => 'Нет описания',
    ]) ?>
  </fieldset>

  <fieldset>
    <legend>Основная информация</legend>

    <div class="control-group">
      <?php echo $form["client_id"]->renderLabel() ?>
      <div class="controls">
        <?php echo $form["client_id"]->render() ?>

        <a class="btn" href="#add-new-client" id="add-new-client-from-order-form">Добавить нового клиента</a>
      </div>
    </div>

    <?php echo $form['description']->renderRowUsing('bootstrap')?>
    <?php echo $form['approved_at']->renderRowUsing('bootstrap')?>
    <?php echo $form['files']->renderRowUsing('bootstrap')?>
  </fieldset>

  <fieldset>
    <legend>Сроки исполнения</legend>
    <?php echo $form['due_date']->renderRowUsing('bootstrap')?>
  </fieldset>

  <fieldset>
    <legend>Стоимости</legend>
    <?php echo $form['installation_cost']->renderRowUsing('bootstrap')?>
      <?php echo $form['design_cost']->renderRowUsing('bootstrap')?>
      <?php echo $form['contractors_cost']->renderRowUsing('bootstrap')?>
      <?php echo $form['delivery_cost']->renderRowUsing('bootstrap')?>
      <?php echo $form['cost']->renderRowUsing('bootstrap')?>
  </fieldset>

  <fieldset>
    <legend>Оплата</legend>
    <?php echo $form['pay_method']->renderRowUsing('bootstrap')?>
      <?php echo $form['recoil']->renderRowUsing('bootstrap')?>
  </fieldset>

  <fieldset>
    <legend>Статусы</legend>
    <?php echo $form['state']->renderRowUsing('bootstrap')?>
  </fieldset>

  <div class="form-actions">
    <button type="submit" class="btn btn-primary">Добавить</button>
    <a href="<?php echo url_for('@orders') ?>" class="btn">Назад</a>
  </div>
</form>
