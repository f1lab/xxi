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
        <?php echo $form['manager']->renderLabel(null, array('class' => 'control-label')) ?>

        <div class="controls">
          <?php echo $form['manager']->render() ?>
        </div>
      </div>

      <div class="control-group">
        <?php echo $form['state']->renderLabel(null, array('class' => 'control-label')) ?>

        <div class="controls">
          <?php echo $form['state']->render() ?>
        </div>
      </div>
      <?php echo $form['_csrf_token'] ?>
      <button type="submit" class="btn btn-primary">Получить отчёт</button>
    </form>

    <h2>Отчёт</h2>
    <div class="alert alert-info">
      За период <?php echo date('d.m.Y', strtotime($period['from'])) . '—' . date('d.m.Y', strtotime($period['to'])) ?>

      <?php if ($manager and true == ($manager=Doctrine_Core::getTable('sfGuardUser')->find($manager))): ?>
        по менеджеру <?php echo $manager->getFirstName() . ' ' . $manager->getLastName() ?>
      <?php else: ?>
        по всем менеджерам
      <?php endif ?>

      в статусе «<?php $stateRaw = $sf_data->getRaw('state'); echo count($state) > 1 ? 'Архив + Дебиторка' : $states[array_pop($stateRaw)] ?>»
    </div>
    <table class="table table-striped table-condensed">
      <colgroup>
        <col class="span3" />
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
          <td>Стоимость монтажа</td>
          <td><?php echo format_currency($report->getInstallationCost()) ?></td>
        </tr>
        <tr>
          <td>Стоимость дизайна</td>
          <td><?php echo format_currency($report->getDesignCost()) ?></td>
        </tr>
        <tr>
          <td>Стоимость работ подрядчиков</td>
          <td><?php echo format_currency($report->getContractorsCost()) ?></td>
        </tr>
        <tr>
          <td>Стоимость доставки</td>
          <td><?php echo format_currency($report->getDeliveryCost()) ?></td>
        </tr>
        <tr>
          <td>Общая стоимость работ</td>
          <td><?php echo format_currency($report->getCost()) ?></td>
        </tr>
        <tr>
          <td>Возврат денежных средств</td>
          <td><?php echo format_currency($report->getRecoil()) ?></td>
        </tr>
        <tr>
          <td>Внесённые средства</td>
          <td><?php echo format_currency($report->getPayedSum()) ?></td>
        </tr>
        <tr>
          <td><strong>Сальдо</strong></td>
          <td><strong><?php echo format_currency($report->getPayedSum() - $report->getRecoil() - $report->getCost()) ?></strong></td>
        </tr>
      </tbody>
    </table>
    <div class="alert alert-info">
      Количество заказов: <?php echo $report->getCount() ?>
    </div>
  </div>
</div>