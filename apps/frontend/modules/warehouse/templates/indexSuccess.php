<h1 class="page-header">
  Склады
</h1>

<div class="btn-toolbar">
  <div class="btn-group">
    <a href="<?php echo url_for('warehouse/new') ?>" class="btn btn-primary">Добавить</a>
  </div>
</div>

<table class="table table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Наименование</th>
    </tr>
  </thead>
  <tbody><?php foreach ($warehouses as $warehouse): ?>
    <tr>
      <td><a href="<?php echo url_for('warehouse/edit?id='.$warehouse->getId()) ?>"><?php echo $warehouse->getId() ?></a></td>
      <td><?php echo $warehouse->getName() ?></td>
    </tr>
  <?php endforeach; ?></tbody>
</table>
