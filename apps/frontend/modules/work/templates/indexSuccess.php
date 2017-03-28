<h1 class="page-header">
    Работы
</h1>

<div class="btn-toolbar">
    <div class="btn-group">
        <a href="<?php echo url_for('work/new') ?>" class="btn btn-primary">Добавить</a>
    </div>
</div>

<table class="table table-condensed table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Участок</th>
        <th>Наименование</th>
        <th>Ставка</th>
    </tr>
    </thead>
    <tbody><?php foreach ($works as $work): ?>
        <tr>
            <td><a href="<?php echo url_for('work/edit?id=' . $work->getId()) ?>"><?php echo $work->getId() ?></a></td>
            <td><?php echo $work->getArea() ?></td>
            <td><?php echo $work->getName() ?></td>
            <td><?php echo $work->getRate() ?></td>
        </tr>
    <?php endforeach; ?></tbody>
</table>
