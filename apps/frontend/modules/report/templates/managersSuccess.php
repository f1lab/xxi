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
      foreach ($report as $manager): ?>
        <tr>
          <td><?php echo $manager ?></td>
          <td><?php $allCounterPays += $manager->getPayscount(); echo format_number($manager->getPayscount()) ?></td>
          <td><?php $allSumm += ($payed = (double)$manager->getPayed());
            echo format_currency($payed) ?></td>
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
  </div>
</div>