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

      <div class="control-group">
        <?php echo $form['client']->renderLabel(null, array('class' => 'control-label')) ?>

        <div class="controls">
          <?php echo $form['client']->render() ?>
        </div>
      </div>

      <?php echo $form['_csrf_token'] ?>
      <button type="submit" class="btn btn-primary">Получить отчёт</button>
    </form>

    <h2>Отчёт</h2>
    <div class="alert alert-info">
      За период <strong><?php echo date('d.m.Y', strtotime($period['from'])) . '—' . date('d.m.Y', strtotime($period['to'])) ?></strong>

      <?php if ($client and true == ($client = Doctrine_Core::getTable('Client')->find($client))): ?>
        по клиенту <strong><?php echo $client->getName() . ($client->getFullName() ? ' (' . $client->getOwnershipTranslated() . ' «' . $client->getFullName() . '»)' : '')?></strong>
      <?php else: ?>
        по <strong>всем</strong> клиентам
      <?php endif ?>
    </div>
    <table class="table table-striped table-condensed">
      <colgroup>
        <col class="span4" />
        <col />
      </colgroup>
      <thead>
        <tr>
          <th>Параметр</th>
          <th>Значение, руб.</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Объём текущих заказов <br />(сумма общих стоимостей)</td>
          <td><?php echo format_currency($report->getCostActive()) ?></td>
        </tr>
        <tr>
          <td>Внесённые средства <br />(сумма внесённых средств)</td>
          <td><?php echo format_currency($payedActive) ?></td>
        </tr>
        <tr>
          <td>Объём выполненных заказов в архиве</td>
          <td><?php echo format_currency($report->getCostArchived()) ?></td>
        </tr>
        <tr>
          <td>Объём выполненных заказов в дебиторке</td>
          <td><?php echo format_currency($report->getCostDebt()) ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>