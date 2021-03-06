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

        <h3>Менеджеры</h3>
        <table class="table table-striped table-condensed">
            <colgroup>
                <col class="span4"/>
                <col class="span"/>
                <col class="span2"/>
                <col class="span2"/>
            </colgroup>
            <thead>
            <tr>
                <th>Менеджер</th>
                <th>Количество оплат</th>
                <th>Σ</th>
                <th>Σ * 0,03</th>
            </tr>
            </thead>
            <tbody><?php
            $allCounter = $allCounterPays = $allSumm = $allSummPercented = 0;
            foreach ($report as $row):
                $name = $row['manager']['first_name'] . ' ' . $row['manager']['last_name'] . ' ('
                    . $row['manager']['username'] . ')';
                $count = count($row['pays']);
                if ($count === 0) {
                    continue;
                }

                $sum = 0;
                foreach ($row['pays'] as $pay) {
                    $sum += $pay['amount'];
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
          "><?php echo $name ?></a></td>
                    <td><?php $allCounterPays += $count;
                        echo format_number($count) ?></td>
                    <td><?php $allSumm += $sum;
                        echo format_currency($sum) ?></td>
                    <td>
                        <?php $allSummPercented += ($sum * 0.03);
                        echo format_currency($sum * 0.03) ?>

                        <div class="modal hide fade" style="width: 50% !important">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3>Отчёт по оплатам по заказам менеджера</h3>
                            </div>
                            <div class="modal-body">
                                <p>Менеджер: <?php echo $name ?></p>
                                <p>Период: <?php echo date('d.m.Y', strtotime($period['from'])) . '—' . date('d.m.Y',
                                            strtotime($period['to'])) ?></p>

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>№ заказа</th>
                                        <th>Сумма оплаты, руб.</th>
                                        <th>Способ оплаты</th>
                                        <th>Дата оплаты</th>
                                    </tr>
                                    </thead>
                                    <tbody><?php foreach ($row['pays'] as $pay): $id = $pay['Order']['id'] ?>
                                        <tr>
                                            <td><a href="<?php echo url_for("order/show?id=" . $id) ?>" target="_blank">
                                                    <?php echo $id ?>
                                                </a></td>
                                            <td><?php echo $pay['amount'] ?></td>
                                            <td><?php echo \OrderTable::$payMethods[$pay['Order']['pay_method']] ?></td>
                                            <td><?php echo date("d.m.Y H:i", strtotime($pay['payed_at'])) ?></td>
                                        </tr>
                                    <?php endforeach; ?></tbody>
                                </table>

                                <strong>Итого, выполнено <?php echo format_number($count); ?>
                                    оплат по заказам, на сумму <?php echo format_currency($sum); ?> руб.</strong>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-success"
                                   onclick="window.print(); return false">Распечатать</a>
                            </div>
                        </div>
                    </td>
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
        <div class="alert alert-info">
            <small class="muted">Менеджер = (все оплаты по своим заказам за период)*3%</small>
        </div>

        <!-- <h3>Начальник отдела продаж</h3>
    <div class="alert alert-info">
      <?php
        function computeResultMultiplier($result)
        {
            /*
              >3 2.5
              >=2 2
              >=1 1.5
              1
            */
            return ($result > 3000000 ? 2.5 : ($result >= 2000000 ? 2 : ($result >= 1000000 ? 1.5 : 1))) / 100;
        }

        $salesManagerResult = $salesManagerReport->getPayedsum();
        $salesManagerMultiplier = computeResultMultiplier($salesManagerResult);
        $salesManagerResultMultiplied = $salesManagerResult * $salesManagerMultiplier;
        ?>
      <abbr title="<?php echo $salesManagerReport->getPayedsum() ?> × <?php echo $salesManagerMultiplier ?>">
        Σ = <?php echo $salesManagerResultMultiplied ?> руб.
      </abbr>

      <small class="muted" style="display: block;">Начальник отдела продаж (НОП) = (все оплаты за период)*x%. До 1млн х=1, от 1млн до 2млн х=1.5, от 2млн до 3млн х=2, больше 3млн х=2.5</small>
    </div> -->

        <!-- <h3>Начальник цеха</h3>
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
    </div> -->
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
