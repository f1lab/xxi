<?php use_helper('Number') ?>

<div class="page-header">
  <h1>Отчётность</h1>
</div>

<div class="tabbable tabs-left">
  <?php include_partial('tabs', array('currentRoute' => $sf_context->getRouting()->getCurrentRouteName())) ?>

  <div class="tab-content">
    <h2>Параметры отчёта</h2>
    <form action="?report" method="post" class="well">
      <div class="control-group<?php if ($form['from']->hasError()): ?> error<?php endif ?>">
        <?php echo $form['from']->renderLabel(null, array('class' => 'control-label')) ?>

        <div class="controls form-horizontal">
          <?php echo $form['from']->render(array('placeholder' => 'from')) ?>

          <?php echo $form['to']->render(array('placeholder' => 'to')) ?>
          <?php if ($form['from']->hasError()): ?><div class="help-inline"><?php echo $form['from']->getError() ?></div><?php endif ?>
        </div>
      </div>

      <?php echo $form['_csrf_token'] ?>
      <button type="submit" class="btn btn-primary">Получить отчёт</button>
    </form>

    <h2>Отчёт</h2>
    <div class="alert alert-info">
      За период <strong><?php echo date('d.m.Y', strtotime($period['from'])) . '—' . date('d.m.Y', strtotime($period['to'])) ?></strong>
    </div>
    <table class="table table-striped table-condensed">
      <thead>
        <tr>
          <th>Заказчик</th>
          <th>Количество заказов</th>
          <th>Общая стоимость работ, руб.</th>
          <th>Внесённые средства, руб.</th>
          <th>Долг, руб.</th>
        </tr>
      </thead>
      <tbody><?php
      $sumOrders = $sumPayed = $sumCost = $sumDebt = 0;
      foreach ($report as $row):
        $ordersCost = 0;
        $payedSum = 0;
        foreach ($row->getOrders() as $order) {
          $ordersCost += $order->getCost();
          foreach ($order->getPays() as $pay) {
            $payedSum += $pay->getAmount();
          }
        }
      ?>
        <tr>
          <td><a href="<?php echo url_for('@client?id=' . $row->getId() . '&state=debt') ?>"><?php echo $row->getName() ?></a></td>
          <td><?php $sumOrders += $row->getOrders()->count(); echo $row->getOrders()->count() ?></td>
          <td><?php $sumCost += $ordersCost; echo $ordersCost ?></td>
          <td><?php $sumPayed += $payedSum; echo $payedSum ?></td>
          <td><?php $sumDebt += ($ordersCost - $payedSum); echo ($ordersCost - $payedSum) ?></td>
        </tr>
      <?php endforeach ?></tbody>
    </table>

    <div class="alert alert-info">
      <strong>Итого:</strong>
      заказов — <?php echo $sumOrders ?>,
      стоимость — <?php echo format_currency($sumCost) ?>,
      оплачено — <?php echo format_currency($sumPayed) ?>,
      долг — <?php echo format_currency($sumDebt) ?>.
    </div>
  </div>
</div>
