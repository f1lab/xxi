<?php slot('title', 'Material movements List') ?>

<h1 class="page-header">
    Движения материалов
</h1>

<form action="?filter" method="get" class="well well-small submit-on-select-change">
    <span>Фильтр по наименованию:</span>
    <?php echo $filter["id"] ?>

    <?php if ($sf_request->getParameter("id")): ?>
        <a href="<?php echo url_for("warehouse/index?id=" . $sf_request->getParameter("id")); ?>" class="btn">Перейти к
            складу</a>
    <?php endif ?>
</form>

<table class="table table-condensed table-bordered table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Тип операции</th>
        <th>Из</th>
        <th>В</th>
        <th>Движение (количество стоимость материал)</th>
        <th>Время создания</th>
        <th>Создал</th>
    </tr>
    </thead>
    <tbody><?php foreach ($material_movements as $material_movement): ?>
        <tr>
            <td><?php echo $material_movement->getId() ?></td>
            <td><?php echo $material_movement->getTypeTranslated() ?></td>
            <td><?php
                echo($material_movement->getType() == "arrival"
                    ? $material_movement->getArrival()->getSupplier()
                    : $material_movement->getFrom())
                ?></td>
            <td><?php echo $material_movement->getTo() ?></td>
            <td>
                <ul><?php foreach ($material_movement->getMaterials()->getRawValue() as $material): ?>
                        <li><?php echo $material->getAmount(); ?>
                            <?php echo $material->getPrice(); ?>
                            <?php echo $material->getMaterial()->getNameWithDimension(); ?></li>
                    <?php endforeach ?></ul>
            </td>
            <td><?php echo date("d.m.Y H:i:s", strtotime($material_movement->getCreatedAt())) ?></td>
            <td><?php echo $material_movement->getCreator() ?></td>
        </tr>
    <?php endforeach; ?></tbody>
</table>
