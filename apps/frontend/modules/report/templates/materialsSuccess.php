<?php use_helper('Number') ?>

<div class="page-header">
    <h1>Отчётность</h1>
</div>

<div class="tabbable tabs-left">
    <?php include_partial('tabs', ['currentRoute' => $sf_context->getRouting()->getCurrentRouteName()]) ?>

    <div class="tab-content">
        <h2>Параметры отчёта</h2>
        <form action="?report" method="post" class="well">
            <div class="control-group<?php if ($form['from']->hasError()): ?> error<?php endif ?>">
                <?php echo $form['from']->renderLabel(null, ['class' => 'control-label']) ?>

                <div class="controls form-horizontal">
                    <?php echo $form['from']->render(['placeholder' => 'from']) ?>

                    <?php echo $form['to']->render(['placeholder' => 'to']) ?>
                    <?php if ($form['from']->hasError()): ?>
                        <div class="help-inline"><?php echo $form['from']->getError() ?></div><?php endif ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form['material_id']->renderLabel(null, ['class' => 'control-label']) ?>

                <div class="controls">
                    <?php echo $form['material_id']->render() ?>
                </div>
            </div>

            <?php echo $form['_csrf_token'] ?>
            <button type="submit" class="btn btn-primary">Получить отчёт</button>
        </form>

        <h2>
            Отчёт
            <small>за период <?php echo date('d.m.Y', strtotime($period['from'])) . '—' . date('d.m.Y',
                        strtotime($period['to'])) ?></small>
        </h2>
        <table class="table table-condensed table-hover">
            <colgroup>
                <col class="span4"/>
                <col class="span"/>
                <col class="span2"/>
                <col class="span2"/>
            </colgroup>
            <thead>
            <tr>
                <th>Материал</th>

                <th>Остаток на начало периода</th>
                <th>Поступило</th>
                <th>Затрачено</th>
                <th>Остаток на конец периода</th>
            </tr>
            </thead>
            <tbody><?php foreach ($report as $material): ?>
                <tr>
                    <td><a href="<?php echo url_for('material/show?id='
                            . $material->getId()) ?>"><?php echo $material->getNameWithDimension() ?></a></td>

                    <td><?php echo $material->getRemainedAmount('2000-01-01', $period['from']) ?> ед.
                        / <?php echo $material->getRemainedSum('2000-01-01', $period['from']) ?> руб.
                    </td>
                    <td><?php echo $material->getArrivalsAmount($period['from'], $period['to']) ?> ед.
                        / <?php echo format_currency($material->getArrivalsSum($period['from'], $period['to'])) ?> руб.
                    </td>
                    <td><?php echo $material->getUtilizationsAmount($period['from'], $period['to']) ?> ед.
                        / <?php echo format_currency($material->getUtilizationsSum($period['from'], $period['to'])) ?>
                         руб.
                    </td>
                    <td><?php echo $material->getRemainedAmount('2000-01-01',
                            date('Y-m-d', strtotime('+1 day', strtotime($period['to'])))) ?> ед.
                        / <?php echo $material->getRemainedSum('2000-01-01',
                            date('Y-m-d', strtotime('+1 day', strtotime($period['to'])))) ?> руб.
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
