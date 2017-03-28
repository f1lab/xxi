<?php slot('title', 'Orders table filters List') ?>

<h1 class="page-header">
    Orders table filters List
</h1>

<div class="btn-toolbar">
    <div class="btn-group">
        <a href="<?php echo url_for('OrdersTableFilter/new') ?>" class="btn btn-primary">New</a>
    </div>
</div>

<table class="table table-condensed table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>User</th>
        <th>Is default</th>
        <th>Fitler</th>
        <th>Created at</th>
        <th>Updated at</th>
    </tr>
    </thead>
    <tbody><?php foreach ($orders_table_filters as $orders_table_filter): ?>
        <tr>
            <td><a href="<?php echo url_for('OrdersTableFilter/edit?id='
                    . $orders_table_filter->getId()) ?>"><?php echo $orders_table_filter->getId() ?></a></td>
            <td><?php echo $orders_table_filter->getUserId() ?></td>
            <td><?php echo $orders_table_filter->getIsDefault() ?></td>
            <td><?php echo $orders_table_filter->getFitler() ?></td>
            <td><?php echo $orders_table_filter->getCreatedAt() ?></td>
            <td><?php echo $orders_table_filter->getUpdatedAt() ?></td>
        </tr>
    <?php endforeach; ?></tbody>
</table>
