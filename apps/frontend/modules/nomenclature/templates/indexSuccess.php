<h1 class="page-header">
    Номенклатура
</h1>

<div class="btn-toolbar">
    <div class="btn-group">
        <a href="<?php echo url_for('nomenclature/new') ?>" class="btn btn-primary">Добавить</a>
    </div>
</div>

<table class="table table-condensed table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Наименование</th>
    </tr>
    </thead>
    <tbody><?php foreach ($nomenclatures as $nomenclature): ?>
        <tr>
            <td><a href="<?php echo url_for('nomenclature/edit?id='
                    . $nomenclature->getId()) ?>"><?php echo $nomenclature->getId() ?></a></td>
            <td><?php echo $nomenclature->getName() ?></td>
        </tr>
    <?php endforeach; ?></tbody>
</table>
