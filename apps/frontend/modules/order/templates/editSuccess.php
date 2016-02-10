<?php
function conditionalFieldset($title, $entries, &$form) {
  if (array_search(true, $entries) !== false) {
    $rows = [];
    foreach ($entries as $row => $condition) {
      if ($condition) {
        $rows[] = $form[$row]->renderRowUsing("bootstrap");
      }
    }
    $rows = implode("\n", $rows);

    return <<<HTML
      <fieldset>
        <legend>$title</legend>
        $rows
      </fieldset>
HTML;
  }

  return "";
}
?>

<div class="page-header">
  <h1>Редактировать заказ №<?php echo $order->getId() ?></h1>
</div>

<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for("@order-update?id=" . $order->getId()) ?>" method="post">
  <?php echo $form->renderGlobalErrors() ?>
  <?php echo $form->renderHiddenFields()?>

  <?php if (!$sf_user->hasGroup("worker") and !$sf_user->hasGroup("design-worker")): ?>
    <?php if (!$sf_user->hasGroup("master")): ?>
      <fieldset>
        <legend>Позиции заказа</legend>
        <?php include_partial("global/relation", [
          "form" => $form,
          "relationName" => "Invoices",
          "columns" => [
            "description" => "Описание заказа",
            "number" => "Кол-во",
            "price" => "Цена",
            "sum" => "Сумма",
          ],
          "noRelationsMessage" => "Нет описания",
          'addLabel' => 'Добавить позицию',
          'addCalculateButton' => true,
        ]) ?>
      </fieldset>
    <?php endif ?>
  <?php else: ?>
    <div class="well">
      <h4>Подробное описание заказа</h4>
      <pre><?php echo $form->getObject()->getDescription() ?></pre>

      <h4>Файлы</h4>
      <pre><?php echo $form->getObject()->getFiles() ?></pre>

      <h4>Позиции заказа</h4>
      <ul><?php foreach ($form->getObject()->getInvoices() as $invoice): ?>
        <li><?php echo $invoice->getDescription() ?> × <?php echo $invoice->getNumber() ?></li>
      <?php endforeach ?></ul>
    </div>
  <?php endif ?>

  <?php if ($sf_user->hasCredential("can_set_order_works")): ?>
    <fieldset>
      <legend>Работы</legend>
      <?php include_partial("global/relation", [
        "form" => $form,
        "relationName" => "RefOrderWork",
        "columns" => [
          "area_id" => "Участок",
          "work_id" => "Работа",
          "master_id" => "Мастер",
          "labor" => [
            "name" => "Трудозатраты",
            "title" => "Сумма, которая будет включена в заработную плату Мастера",
          ],
          "comment" => "Комментарий",
        ],
        "noRelationsMessage" => "Нет работ",
        'addLabel' => 'Добавить работу',
      ]) ?>
    </fieldset>

    <fieldset class="hide">
      <legend>Планируемые затраты материала</legend>
      <?php include_partial("global/relation", [
        "form" => $form,
        "relationName" => "UtilizationPlans",
        "columns" => [
          "material_id" => "Материал",
          "amount" => "Количество",
        ],
        "noRelationsMessage" => "Нет запланированных затрат",
      ]) ?>
    </fieldset>
  <?php endif ?>

  <?php if ($sf_user->hasGroup("director") or $sf_user->hasGroup("manager")): ?>
    <fieldset>
      <legend>Основная информация</legend>
      <?php echo $form["client_id"]->renderRowUsing("bootstrap")?>
      <?php echo $form["description"]->renderRowUsing("bootstrap")?>
      <?php echo $form["approved_at"]->renderRowUsing("bootstrap")?>
      <?php echo $form["files"]->renderRowUsing("bootstrap")?>
    </fieldset>

    <fieldset>
      <legend>Сроки исполнения</legend>
      <?php echo $form["due_date"]->renderRowUsing("bootstrap")?>
    </fieldset>
  <?php endif ?>

  <?php echo conditionalFieldset("Стоимости", [
    "installation_cost" => $sf_user->hasGroup("director") or $sf_user->hasGroup("manager"),
    "design_cost" => $sf_user->hasGroup("director") or $sf_user->hasGroup("manager"),
    "contractors_cost" => $sf_user->hasGroup("director") or $sf_user->hasGroup("manager"),
    "delivery_cost" => $sf_user->hasGroup("director") or $sf_user->hasGroup("manager"),
    "cost" => $sf_user->hasGroup("director") or $sf_user->hasGroup("manager") or $sf_user->hasGroup("buhgalter"),
  ], $form) ?>

  <?php if ($sf_user->hasGroup("director") or $sf_user->hasGroup("manager") or $sf_user->hasGroup("buhgalter")): ?>
    <fieldset>
      <legend>Оплата</legend>
      <?php echo $form["pay_method"]->renderRowUsing("bootstrap")?>
      <?php if (!$sf_user->hasGroup("buhgalter")) echo $form["recoil"]->renderRowUsing("bootstrap")?>
      <?php include_partial("global/relation", [
        "form" => $form,
        "relationName" => "Pays",
        "columns" => [
          "payed_at" => "Дата оплаты",
          "amount" => "Сумма",
        ],
        "noRelationsMessage" => "Нет оплат",
        'addLabel' => 'Добавить оплату',
      ]) ?>
    </fieldset>
  <?php endif ?>

  <?php echo conditionalFieldset("Выполнение заказа", [
    "started_at" => $sf_user->hasGroup("director") or $sf_user->hasGroup("worker"),
    "finished_at" => $sf_user->hasGroup("director"),
    "submited_at" => $sf_user->hasGroup("director"),
    "expected_at" => $sf_user->hasGroup("worker"),
  ], $form) ?>

  <?php if ($sf_user->hasCredential("director") or $sf_user->hasGroup("buhgalter")): ?>
    <fieldset>
      <legend>Бухгалтерия</legend>
      <div class="control-group<?php if ($form["bill_made"]->hasError()): ?> error<?php endif ?>">
        <div class="controls">
          <label class="checkbox">
            <?php echo $form["bill_made"]->render() ?> <?php echo $form["bill_made"]->renderLabelName() ?>
          </label>
          <?php if ($form["bill_made"]->hasError()): ?><div class="help-inline"><?php echo $form["bill_made"]->getError() ?></div><?php endif ?>
        </div>
      </div>
      <div class="control-group<?php if ($form["bill_given"]->hasError()): ?> error<?php endif ?>">
        <div class="controls">
          <label class="checkbox">
            <?php echo $form["bill_given"]->render() ?> <?php echo $form["bill_given"]->renderLabelName() ?>
          </label>
          <?php if ($form["bill_given"]->hasError()): ?><div class="help-inline"><?php echo $form["bill_given"]->getError() ?></div><?php endif ?>
        </div>
      </div>
      <div class="control-group<?php if ($form["docs_given"]->hasError()): ?> error<?php endif ?>">
        <div class="controls">
          <label class="checkbox">
          <?php echo $form["docs_given"]->render() ?> <?php echo $form["docs_given"]->renderLabelName() ?>
          </label>
          <?php if ($form["docs_given"]->hasError()): ?><div class="help-inline"><?php echo $form["docs_given"]->getError() ?></div><?php endif ?>
        </div>
      </div>
      <?php echo $form["waybill_number"]->renderRowUsing("bootstrap")?>
    </fieldset>
  <?php endif ?>

  <?php if ($sf_user->hasGroup("director") or $sf_user->hasGroup("worker") or $sf_user->hasGroup("manager") or $sf_user->hasGroup("design-worker")): ?>
    <fieldset>
      <legend>Статус</legend>
      <?php echo $form["state"]->renderRowUsing("bootstrap")?>
    </fieldset>
  <?php endif ?>

  <div class="form-actions">
    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="<?php echo url_for('@order?id=' . $order->getId()) ?>" class="btn">Назад</a>
  </div>
</form>
