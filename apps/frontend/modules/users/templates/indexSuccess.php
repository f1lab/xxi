<?php
use_helper('Text')
?>

<h1 class="page-header">
    <?php echo __('Users') ?>
</h1>

<div class="btn-toolbar">
    <div class="btn-group">
        <a href="<?php echo url_for('users/new') ?>" class="btn btn-primary">New</a>
    </div>
</div>

<table class="table table-condensed table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Username</th>
        <th>Email address</th>
        <th>Last login</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($sf_guard_users as $sf_guard_user): ?>
        <tr class="<?php echo ($sf_guard_user->getIsActive() ? '' : ' muted') . ($sf_guard_user->getIsSuperAdmin()
                ? 'success' : '') ?>">
            <td><a href="<?php echo url_for('users/edit?id='
                    . $sf_guard_user->getId()) ?>"><?php echo $sf_guard_user->getId() ?></a></td>
            <td><?php echo $sf_guard_user->getName() ?></td>
            <td><?php echo $sf_guard_user->getUsername() ?></td>
            <td><?php echo $sf_guard_user->getEmailAddress() ?></td>
            <td><?php echo $sf_guard_user->getLastLogin() ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
