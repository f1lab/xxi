<div class="page-header">
  <h1>Редактировать заказ №<?php echo $order->getId() ?></h1>
</div>

<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('@order-update?id=' . $order->getId()) ?>" method="post">
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form->renderHiddenFields()?>

  <?php if ($sf_user->hasCredential('can_spend_materials')): ?>
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

  <?php if (!$sf_user->hasGroup('master')): ?>
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
  <?php else: ?>
    <fieldset>
    <legend>Статусы</legend>
      <?php echo $form['state']->renderRowUsing('bootstrap')?>
    </fieldset>
  <?php endif ?>

  <!--Director-->
  <?php if ($sf_user->hasGroup('director')): ?>
    <fieldset>
      <legend>Основная информация</legend>
      <?php echo $form['client_id']->renderRowUsing('bootstrap')?>
      <?php echo $form['description']->renderRowUsing('bootstrap')?>
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
      <?php include_partial('global/relation', [
        'form' => $form,
        'relationName' => 'Pays',
        'columns' => [
          'payed_at' => 'Дата оплаты',
          'amount' => 'Сумма',
        ],
        'noRelationsMessage' => 'Нет оплат',
      ]) ?>
      <?php //echo $form['payed_at']->renderRowUsing('bootstrap')?>
    </fieldset>

    <fieldset>
      <legend>Статусы</legend>
      <?php echo $form['state']->renderRowUsing('bootstrap')?>
    </fieldset>

    <fieldset>
      <legend>Выполнение заказа</legend>
      <?php echo $form['started_at']->renderRowUsing('bootstrap')?>
      <?php echo $form['area']->renderRowUsing('bootstrap')?>
      <?php echo $form['finished_at']->renderRowUsing('bootstrap')?>
      <?php echo $form['submited_at']->renderRowUsing('bootstrap')?>
    </fieldset>

    <fieldset>
      <legend>Бухгалтерия</legend>
      <div class="control-group<?php if ($form['bill_made']->hasError()): ?> error<?php endif ?>">
        <div class="controls">
          <label class="checkbox">
            <?php echo $form['bill_made']->render() ?> <?php echo $form['bill_made']->renderLabelName() ?>
          </label>
          <?php if ($form['bill_made']->hasError()): ?><div class="help-inline"><?php echo $form['bill_made']->getError() ?></div><?php endif ?>
        </div>
      </div>
      <div class="control-group<?php if ($form['bill_given']->hasError()): ?> error<?php endif ?>">
        <div class="controls">
          <label class="checkbox">
            <?php echo $form['bill_given']->render() ?> <?php echo $form['bill_given']->renderLabelName() ?>
          </label>
          <?php if ($form['bill_given']->hasError()): ?><div class="help-inline"><?php echo $form['bill_given']->getError() ?></div><?php endif ?>
        </div>
      </div>
      <div class="control-group<?php if ($form['docs_given']->hasError()): ?> error<?php endif ?>">
        <div class="controls">
          <label class="checkbox">
          <?php echo $form['docs_given']->render() ?> <?php echo $form['docs_given']->renderLabelName() ?>
          </label>
          <?php if ($form['docs_given']->hasError()): ?><div class="help-inline"><?php echo $form['docs_given']->getError() ?></div><?php endif ?>
        </div>
      </div>
      <?php echo $form['waybill_number']->renderRowUsing('bootstrap')?>
    </fieldset>
  <?php endif?>

  <!--Worker-->
  <?php if ($sf_user->hasGroup('worker')): ?>
    <fieldset>
      <legend>Выполнение заказа</legend>
      <?php echo $form['started_at']->renderRowUsing('bootstrap')?>
      <?php echo $form['expected_at']->renderRowUsing('bootstrap')?>
      <?php echo $form['area']->renderRowUsing('bootstrap')?>
      <?php echo $form['state']->renderRowUsing('bootstrap')?>
    </fieldset>
  <?php endif?>

  <!--Buhgalter-->
  <?php if ($sf_user->hasGroup('buhgalter')): ?>
    <fieldset>
      <legend>Стоимости</legend>
      <?php echo $form['cost']->renderRowUsing('bootstrap')?>
    </fieldset>

    <fieldset>
      <legend>Оплата</legend>
      <?php echo $form['pay_method']->renderRowUsing('bootstrap')?>
      <?php include_partial('global/relation', [
        'form' => $form,
        'relationName' => 'Pays',
        'columns' => [
          'payed_at' => 'Дата оплаты',
          'amount' => 'Сумма',
        ],
        'noRelationsMessage' => 'Нет оплат',
      ]) ?>
      <?php //echo $form['payed_at']->renderRowUsing('bootstrap')?>
    </fieldset>

    <fieldset>
      <legend>Бухгалтерия</legend>
      <div class="control-group<?php if ($form['bill_made']->hasError()): ?> error<?php endif ?>">
        <div class="controls">
          <label class="checkbox">
            <?php echo $form['bill_made']->render() ?> <?php echo $form['bill_made']->renderLabelName() ?>
          </label>
          <?php if ($form['bill_made']->hasError()): ?><div class="help-inline"><?php echo $form['bill_made']->getError() ?></div><?php endif ?>
        </div>
      </div>
      <div class="control-group<?php if ($form['bill_given']->hasError()): ?> error<?php endif ?>">
        <div class="controls">
          <label class="checkbox">
            <?php echo $form['bill_given']->render() ?> <?php echo $form['bill_given']->renderLabelName() ?>
          </label>
          <?php if ($form['bill_given']->hasError()): ?><div class="help-inline"><?php echo $form['bill_given']->getError() ?></div><?php endif ?>
        </div>
      </div>
      <div class="control-group<?php if ($form['docs_given']->hasError()): ?> error<?php endif ?>">
        <div class="controls">
          <label class="checkbox">
          <?php echo $form['docs_given']->render() ?> <?php echo $form['docs_given']->renderLabelName() ?>
          </label>
          <?php if ($form['docs_given']->hasError()): ?><div class="help-inline"><?php echo $form['docs_given']->getError() ?></div><?php endif ?>
        </div>
      </div>
      <?php echo $form['waybill_number']->renderRowUsing('bootstrap')?>
    </fieldset>
  <?php endif?>

  <!--Manager-->
  <?php if ($sf_user->hasGroup('manager')): ?>
    <fieldset>
      <legend>Основная информация</legend>
      <?php echo $form['client_id']->renderRowUsing('bootstrap')?>
      <?php echo $form['description']->renderRowUsing('bootstrap')?>
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
  <?php endif?>

  <div class="form-actions">
    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="<?php echo url_for('@order?id=' . $order->getId()) ?>" class="btn">Назад</a>
  </div>
</form>
