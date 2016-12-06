<div class="page-header">
    <h1>Заказы</h1>
</div>
<div class="btn-toolbar clearfix">
    <?php if ($sf_user->hasGroup('manager') or $sf_user->hasCredential('can_create_orders')): ?>
        <div class="btn-group">
        <a href="<?php echo url_for('@order-new') ?>" class="btn btn-primary">Добавить заказ</a>
        </div><?php endif ?>

    <?php if ($sf_user->hasCredential('can_use_search_in_orders')): ?>
        <div class="btn-group">
        <form action="#" id="orders-quick-search" data-action="<?php echo url_for('@orders') ?>/">
            <input type="text" value="" tabindex="1" placeholder="Номер заказа" class="span2"/>
        </form></div><?php endif ?>

    <?php
    if ($sf_user->hasGroup('monitor')):
        if (true == ($hasToCheck = $sf_request->hasParameter('order_filters'))) {
            $requestedState = sfContext::getInstance()->getRequest()->getParameter('order_filters')['state'];
        }
        ?>
        <div class="btn-group pull-right">
            <a href="<?php echo url_for('@orders') ?>" class="btn<?php
            echo !$hasToCheck ? ' active' : '' ?>">Текущие</a>
            <?php foreach (OrderTable::$statesForMonitor as $state => $stateTranslated): ?>
                <a href="<?php echo url_for('@orders?order_filters[state][]=' . $state) ?>" class="btn<?php
                echo $hasToCheck && in_array($state, $requestedState) ? ' active' : '' ?>"><?php echo $stateTranslated ?></a>
            <?php endforeach ?>
        </div>
    <?php else: ?>
        <div class="btn-group pull-right">
            <a href="<?php echo url_for('OrdersTableSettings/edit?id=' . $settings->getId()) ?>" class="btn">
                <i class="icon icon-cog"></i> Настроить вид
            </a>
        </div>
        <div class="btn-group pull-right">
            <a class="btn toggler collapsed" data-toggle="collapse" href="#filterator">
                <i class="icon icon-list"></i> Фильтровать…
            </a>
        </div>
    <?php endif ?>
</div>

<?php if (!$sf_user->hasGroup('monitor')): ?>
    <div id="filterator"
         class="collapse"><?php include_partial('filter', array('form' => $filter, 'filters' => $filters, 'currentFilter' => $currentFilter)) ?></div>
<?php endif ?>

<?php
$columns = $settings->getColumnsForPartial();
include_partial('global/orders', array('pager' => $pager, 'columns' => $columns));
?>

<?php if ($sf_user->hasCredential('can-view-orders-money-summary')): ?>
    <div class="well">
        <h4>Сводка</h4>
        Всего заказов: <?php echo count($pager->getResults()) ?> <br>
        <?php $sum = 0; foreach ($pager->getResults() as $order) {
            $sum += $order->getCost();
        } ?>
        На сумму: <?php echo $sum; ?>
        <h4>Внесённые средства</h4>
        <?php
        $summary = [
            'cash' => 0,
            'non-cash' => 0,
            'barter' => 0,
            'settlement' => 0,
            'other' => 0,
        ];
        foreach ($pager->getResults() as $order) {
            $summary[$order->getPayMethod() ?: 'other'] += $order->getPayed();
        }
        ?>
        <?php foreach (\OrderTable::$payMethods as $method => $label): ?>
            <?php echo $label ?: 'Другое' ?>: <?php echo number_format($summary[$method ?: 'other'], 2) ?> руб. <br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


<?php if ($sf_user->hasCredential('monitor') and !$sf_user->isSuperAdmin()): ?>
    <script type="text/javascript">
        setTimeout(function () {
            window.location.reload();
        }, 30000);
    </script>

    <style type="text/css">
        .navbar,
        .page-header {
            display: none;
        }
    </style>
<?php endif ?>
