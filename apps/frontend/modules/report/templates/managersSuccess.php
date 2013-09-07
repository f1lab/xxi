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

    <h2>
      Отчёт
      <small>за период <?php echo date('d.m.Y', strtotime($period['from'])) . '—' . date('d.m.Y', strtotime($period['to'])) ?></small>
    </h2>

    <h3>Менеджеры</h3>
    <table class="table table-striped table-condensed">
      <colgroup>
        <col class="span4" />
        <col class="span" />
        <col class="span2" />
        <col class="span2" />
      </colgroup>
      <thead>
        <tr>
          <th>Менеджер</th>
          <th>Количество проплат</th>
          <th>Σ</th>
          <th>Σ * 0,03</th>
        </tr>
      </thead>
      <tbody><?php
      $allCounter = $allCounterPays = $allSumm = $allSummPercented = 0;
      foreach ($report as $manager): if (!$manager->getPayscount()) continue; ?>
        <tr>
          <td><?php echo $manager ?></td>
          <td><?php $allCounterPays += $manager->getPayscount(); echo format_number($manager->getPayscount()) ?></td>
          <td>
            <abbr title="<?php echo $manager->getPayed() ?> — <?php echo (double)$manager->getRecoiled() ?>">
              <?php $allSumm += ($payed = (double)$manager->getPayed() - $manager->getRecoiled()); echo format_currency($payed) ?>
            </abbr>
          </td>
          <td><?php $allSummPercented += ($payed * 0.03); echo format_currency($payed * 0.03) ?></td>
        </tr>
      <?php endforeach ?>
        <tr>
          <td><strong>Итого</strong></td>
          <td><strong><?php echo format_number($allCounterPays) ?></strong></td>
          <td><strong><?php echo format_currency($allSumm) ?></strong></td>
          <td><strong><?php echo format_currency($allSummPercented) ?></strong></td>
        </tr>
      </tbody>
    </table>
    <div class="alert alert-info"><small class="muted">Менеджер = (все оплаты по своим заказам за период – возвраты)*3%</small></div>

    <h3>Начальник отдела продаж</h3>
    <div class="alert alert-info">
      <?php
        function computeResultMultiplier($result) {
          /*
            >3 2.5
            >=2 2
            >=1 1.5
            1
          */
          return ($result > 3000000 ? 2.5 : ($result >= 2000000 ? 2 : ($result >= 1000000 ? 1.5 : 1))) / 100;
        }
        $salesManagerResult = $salesManagerReport->getPayedsum() - $salesManagerReport->getRecoiled();
        $salesManagerMultiplier = computeResultMultiplier($salesManagerResult);
        $salesManagerResultMultiplied = $salesManagerResult * $salesManagerMultiplier;
      ?>
      <abbr title="(<?php echo $salesManagerReport->getPayedsum() ?> — <?php echo $salesManagerReport->getRecoiled() ?>) × <?php echo $salesManagerMultiplier ?>">
        Σ = <?php echo $salesManagerResultMultiplied ?> руб.
      </abbr>

      <small class="muted" style="display: block;">Начальник отдела продаж (НОП) = (все оплаты за период – возвраты)*x%. До 1млн х=1, от 1млн до 2млн х=1.5, от 2млн до 3млн х=2, больше 3млн х=2.5</small>
    </div>

    <h3>Начальник цеха</h3>
    <div class="alert alert-info">
      <?php
        $workersChiefResult = $workersChiefReport->getReport();
        $workersChiefMultiplier = computeResultMultiplier($workersChiefResult);
        $workersResultMultiplied = $workersChiefResult * $workersChiefMultiplier;
      ?>
      <abbr title="(<?php echo $workersChiefReport->getCosted() ?> — <?php echo $workersChiefReport->getDesigned() ?> — <?php echo $workersChiefReport->getContracted() ?> — <?php echo $workersChiefReport->getRecoiled() ?>) × <?php echo $workersChiefMultiplier ?>">
        Σ = <?php echo $workersResultMultiplied ?> руб.
      </abbr>

      <small class="muted" style="display: block;">Начальник цеха = (сумма всех заказов в статусе сдан, архив, дебиторка – дизайн – работы подрядчиков – возвраты)*х%. До 1млн х=1, от 1млн до 2млн х=1.5, от 2млн до 3млн х=2, больше 3млн х=2.5</small>
    </div>
  </div>
</div>