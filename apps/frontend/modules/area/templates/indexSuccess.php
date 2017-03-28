<h1 class="page-header">
    Участки
</h1>

<div class="btn-toolbar">
    <div class="btn-group">
        <a href="<?php echo url_for('area/new') ?>" class="btn btn-primary">Добавить</a>
    </div>
</div>

<table class="table table-condensed table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Slug</th>
    </tr>
    </thead>
    <tbody><?php foreach ($areas as $area): ?>
        <tr>
            <td><a href="<?php echo url_for('area/edit?id=' . $area->getId()) ?>"><?php echo $area->getId() ?></a></td>
            <td><?php echo $area->getName() ?></td>
            <td><?php echo $area->getSlug() ?></td>
        </tr>
    <?php endforeach; ?></tbody>
</table>
