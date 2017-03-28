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
            <?php echo $form['_csrf_token'] ?>
            <button type="submit" class="btn btn-primary">Получить отчёт</button>
        </form>

        <h2>
            Отчёт
            <small>за период <?php echo date('d.m.Y', strtotime($period['from'])) . '—' . date('d.m.Y',
                        strtotime($period['to'])) ?></small>
        </h2>

        <table class="table table-striped table-condensed">
            <colgroup>
                <col class="span4"/>
                <col class="span"/>
                <col class="span2"/>
            </colgroup>
            <thead>
            <tr>
                <th>Дизайнер</th>
                <th>Количество работ</th>
                <th>Σ</th>
            </tr>
            </thead>
            <tbody><?php
            $allCounter = $allCounterPays = $allSumm = 0;
            foreach ($report as $manager):
                $count = $manager->getWorks()->count();
                if (!$count) {
                    continue;
                }

                $sum = 0;
                foreach ($manager->getWorks() as $work) {
                    $sum += $work->getOrder()->getDesignCost();
                }
                ?>
                <tr>
                    <td><a href="#" onclick="
            var modal = $(this).parents('tr').find('.modal')
              , header = modal.find('.modal-header h3').clone()
              , body = modal.find('.modal-body').contents().clone()
            ;

            modal.modal();
            $([header, body]).appendTo($('body > .print'));

            return false
          "><?php echo $manager ?></a></td>
                    <td><?php $allCounterPays += $count;
                        echo format_number($count) ?></td>
                    <td>
                        <?php $allSumm += $sum;
                        echo format_currency($sum) ?>

                        <div class="modal hide fade" style="width: 50% !important">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3>Отчёт по выполненным работам, дизайн</h3>
                            </div>
                            <div class="modal-body">
                                <p>Дизайнер: <?php echo $manager ?></p>
                                <p>Период: <?php echo date('d.m.Y', strtotime($period['from'])) . '—' . date('d.m.Y',
                                            strtotime($period['to'])) ?></p>

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>№ заказа</th>
                                        <th>Запланировано</th>
                                        <th>Выполнено</th>
                                        <th>Стоимость дизайна, руб.</th>
                                    </tr>
                                    </thead>
                                    <tbody><?php foreach ($manager->getWorks() as $work): ?>
                                        <tr>
                                            <td><a href="<?php echo url_for("order/show?id=" . $work->getOrder()
                                                        ->getId()) ?>" target="_blank">
                                                    <?php echo $work->getOrder()->getId() ?>
                                                </a></td>
                                            <td><?php echo $work->getPlannedStart() ? date("d.m.Y H:i",
                                                    strtotime($work->getPlannedStart())) : "" ?></td>
                                            <td><?php echo $work->getFinishedAt() ?></td>
                                            <td><?php echo $work->getOrder()->getDesignCost() ?></td>
                                        </tr>
                                    <?php endforeach ?></tbody>
                                </table>

                                <strong>Итого, выполнено <?php echo format_number($count); ?>
                                    работ по дизайну общей стоимостью <?php echo format_currency($sum); ?> руб.</strong>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-success"
                                   onclick="window.print(); return false">Распечатать</a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
            <tfoot>
            <tr>
                <td><strong>Итого</strong></td>
                <td><strong><?php echo format_number($allCounterPays) ?></strong></td>
                <td><strong><?php echo format_currency($allSumm) ?></strong></td>
            </tr>
            </tfoot>
        </table>

        <div class="alert alert-info">Клик по дизайнеру — показать подробный отчёт</div>
    </div>
</div>

<style>
    @media print {
        body > * {
            display: none;
        }

        body > .print {
            display: block !important;
        }

        table, td, th {
            border: 1px solid !important;
            border-collapse: collapse;
            padding: 5px;
        }

        h3 {
            text-align: center;
        }

        a {
            td: none;
            color: inherit;
        }
    }
</style>
