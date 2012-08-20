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
    <?php  ?>
    <div class="well">
      <span class="formula">Фонд =
        <span title="общая стоимость"><?php echo format_currency($report->getCost()) ?></span>
        − <span title="монтаж"><?php echo format_currency($report->getInstallationCost()) ?></span>
        − <span title="дизайн"><?php echo format_currency($report->getDesignCost()) ?></span>
        − <span title="подрядчики"><?php echo format_currency($report->getContractorsCost()) ?></span>
        − <span title="возврат"><?php echo format_currency($report->getRecoil()) ?></span>
        − <span title="доставка"><?php echo format_currency($report->getDeliveryCost()) ?></span>
      </span> =
        <?php echo format_currency(
          $report->getCost()
          - $report->getInstallationCost()
          - $report->getDesignCost()
          - $report->getContractorsCost()
          - $report->getRecoil()
          - $report->getDeliveryCost()
        ) ?> руб.
    </div>
  </div>
</div>