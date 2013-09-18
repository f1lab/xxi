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
        <?php echo $form['material_id']->renderLabel(null, array('class' => 'control-label')) ?>

        <div class="controls">
          <?php echo $form['material_id']->render() ?>
        </div>
      </div>

      <?php echo $form['_csrf_token'] ?>
      <button type="submit" class="btn btn-primary">Получить отчёт</button>
    </form>

    <h2>
      Отчёт
      <small>за период <?php echo date('d.m.Y', strtotime($period['from'])) . '—' . date('d.m.Y', strtotime($period['to'])) ?></small>
    </h2>
    <table class="table table-condensed table-hover">
      <colgroup>
        <col class="span4" />
        <col class="span" />
        <col class="span2" />
        <col class="span2" />
      </colgroup>
      <thead>
        <tr>
          <th>Материал</th>

          <th>Затрачено</th>
          <th>Затрачено на сумму</th>

          <th>Поступило</th>
          <th>Поступило на сумму</th>

          <th>Остаток</th>
          <th>Остаток на сумму</th>
        </tr>
      </thead>
      <tbody><?php
      $utilized = $utilizedSum = $arrived = $arrivedSum = $remained = $remainedSum = 0;
      foreach ($report as $material): ?>
        <tr>
          <td><a href="<?php echo url_for('material/show?id=' . $material->getId()) ?>"><?php echo $material->getNameWithDimension() ?></a></td>

          <td><?php $utilized += $material->getUtilizedCount(); echo $material->getUtilizedCount() ?></td>
          <td><?php $utilizedSum += $material->getUtilizedSum(); echo format_currency($material->getUtilizedSum()) ?></td>

          <td><?php $arrived += $material->getArrivedCount(); echo $material->getArrivedCount() ?></td>
          <td><?php $arrivedSum += $material->getArrivedSum(); echo format_currency($material->getArrivedSum()) ?></td>

          <td><?php $remained += $material->getRemainedCount(); echo $material->getRemainedCount() ?></td>
          <td><?php $remainedSum += $material->getRemainedSum(); echo format_currency($material->getRemainedSum()) ?></td>
        </tr>
      <?php endforeach ?>
        <tr>
          <td><strong>Итого</strong></td>

          <td><strong><?php echo format_number($utilized) ?></strong></td>
          <td><strong><?php echo format_currency($utilizedSum) ?></strong></td>

          <td><strong><?php echo format_number($arrived) ?></strong></td>
          <td><strong><?php echo format_currency($arrivedSum) ?></strong></td>

          <td><strong><?php echo format_number($remained) ?></strong></td>
          <td><strong><?php echo format_currency($remainedSum) ?></strong></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>