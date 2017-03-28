<?php slot('title', 'Orders table settingss List') ?>

<h1 class="page-header">
    Orders table settingss List
</h1>

<div class="btn-toolbar">
    <div class="btn-group">
        <a href="<?php echo url_for('OrdersTableSettings/new') ?>" class="btn btn-primary">New</a>
    </div>
</div>

<table class="table table-condensed table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>User</th>
        <th>Id enabled</th>
        <th>Client id enabled</th>
        <th>Approved at enabled</th>
        <th>Due date enabled</th>
        <th>Submited at enabled</th>
        <th>State enabled</th>
        <th>Cost enabled</th>
        <th>Payed enabled</th>
        <th>Pay method enabled</th>
        <th>Payed at enabled</th>
        <th>Manager enabled</th>
        <th>Bill made enabled</th>
        <th>Bill given enabled</th>
        <th>Docs given enabled</th>
        <th>Comments enabled</th>
    </tr>
    </thead>
    <tbody><?php foreach ($orders_table_settingss as $orders_table_settings): ?>
        <tr>
            <td><a href="<?php echo url_for('OrdersTableSettings/edit?id='
                    . $orders_table_settings->getId()) ?>"><?php echo $orders_table_settings->getId() ?></a></td>
            <td><?php echo $orders_table_settings->getUserId() ?></td>
            <td><?php echo $orders_table_settings->getIdEnabled() ?></td>
            <td><?php echo $orders_table_settings->getClientIdEnabled() ?></td>
            <td><?php echo $orders_table_settings->getApprovedAtEnabled() ?></td>
            <td><?php echo $orders_table_settings->getDueDateEnabled() ?></td>
            <td><?php echo $orders_table_settings->getSubmitedAtEnabled() ?></td>
            <td><?php echo $orders_table_settings->getStateEnabled() ?></td>
            <td><?php echo $orders_table_settings->getCostEnabled() ?></td>
            <td><?php echo $orders_table_settings->getPayedEnabled() ?></td>
            <td><?php echo $orders_table_settings->getPayMethodEnabled() ?></td>
            <td><?php echo $orders_table_settings->getPayedAtEnabled() ?></td>
            <td><?php echo $orders_table_settings->getManagerEnabled() ?></td>
            <td><?php echo $orders_table_settings->getBillMadeEnabled() ?></td>
            <td><?php echo $orders_table_settings->getBillGivenEnabled() ?></td>
            <td><?php echo $orders_table_settings->getDocsGivenEnabled() ?></td>
            <td><?php echo $orders_table_settings->getCommentsEnabled() ?></td>
        </tr>
    <?php endforeach; ?></tbody>
</table>
