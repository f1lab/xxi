<?php
use_helper('Text')
?>

<h1 class="page-header">
    <?php echo __('Groups') ?>
</h1>

<div class="btn-toolbar">
    <div class="btn-group">
        <a href="<?php echo url_for('groups/new') ?>" class="btn btn-primary">New</a>
    </div>
</div>

<table class="table table-condensed table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th class="span3">Description</th>
        <th>Users</th>
        <th>Credentials</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($sf_guard_groups as $sf_guard_group): ?>
        <tr>
            <td><a href="<?php echo url_for('groups/edit?id='
                    . $sf_guard_group->getId()) ?>"><?php echo $sf_guard_group->getId() ?></a></td>
            <td><?php echo $sf_guard_group->getName() ?></td>
            <td><?php echo $sf_guard_group->getDescription() ?></td>
            <td>
                <ul><?php foreach ($sf_guard_group->getUsers() as $user): ?>
                        <li><?php echo $user ?></li>
                    <?php endforeach ?></ul>
            </td>
            <td>
                <ul><?php foreach ($sf_guard_group->getPermissions() as $permission): ?>
                        <li><?php echo $permission ?></li>
                    <?php endforeach ?></ul>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
