<?php use_helper('Number') ?>

<div class="page-header">
    <h1>Отчётность</h1>
</div>

<div class="tabbable tabs-left">
    <?php include_partial('tabs', ['currentRoute' => $sf_context->getRouting()->getCurrentRouteName()]) ?>

    <div class="tab-content">
        <h2>Параметры отчёта</h2>
        <form action="?report" method="post" class="well">
            <div class="control-group">
                <?php echo $form['manager']->renderLabel(null, ['class' => 'control-label']) ?>

                <div class="controls">
                    <?php echo $form['manager']->render() ?>
                </div>
            </div>

            <?php echo $form['_csrf_token'] ?>
            <button type="submit" class="btn btn-primary">Получить отчёт</button>
        </form>

        <h2>Отчёт</h2>
        <div class="alert alert-info">
            <?php if ($manager and true == ($manager = Doctrine_Core::getTable('sfGuardUser')->find($manager))): ?>
                По менеджеру <?php echo $manager->getFirstName() . ' ' . $manager->getLastName() ?>
            <?php else: ?>
                По всем менеджерам
            <?php endif ?>

            в статусах «В цех», «В работе», «Всё готово»
        </div>
        <table class="table table-striped table-condensed">
            <colgroup>
                <col class="span3"/>
                <col/>
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
                <td><strong><?php echo format_currency($report->getPayedSum() - $report->getRecoil()
                            - $report->getCost()) ?></strong></td>
            </tr>
            </tbody>
        </table>
        <div class="alert alert-info">
            Количество заказов: <?php echo $report->getCount() ?>
        </div>
    </div>
</div>
