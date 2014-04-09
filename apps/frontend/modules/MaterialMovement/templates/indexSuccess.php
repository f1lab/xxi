<?php slot('title', 'Material movements List') ?>

<h1 class="page-header">
  Material movements List
</h1>

<div class="btn-toolbar">
  <div class="btn-group">
    <a href="<?php echo url_for('MaterialMovement/new') ?>" class="btn btn-primary">New</a>
  </div>
</div>

<table class="table table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Type</th>
      <th>From</th>
      <th>To</th>
      <th>Transfer</th>
      <th>Arrival</th>
      <th>Utilization</th>
      <th>Writeoff</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Created by</th>
      <th>Updated by</th>
      <th>Deleted at</th>
    </tr>
  </thead>
  <tbody><?php foreach ($material_movements as $material_movement): ?>
    <tr>
      <td><a href="<?php echo url_for('MaterialMovement/edit?id='.$material_movement->getId()) ?>"><?php echo $material_movement->getId() ?></a></td>
      <td><?php echo $material_movement->getType() ?></td>
      <td><?php echo $material_movement->getFromId() ?></td>
      <td><?php echo $material_movement->getToId() ?></td>
      <td><?php echo $material_movement->getTransferId() ?></td>
      <td><?php echo $material_movement->getArrivalId() ?></td>
      <td><?php echo $material_movement->getUtilizationId() ?></td>
      <td><?php echo $material_movement->getWriteoffId() ?></td>
      <td><?php echo $material_movement->getCreatedAt() ?></td>
      <td><?php echo $material_movement->getUpdatedAt() ?></td>
      <td><?php echo $material_movement->getCreatedBy() ?></td>
      <td><?php echo $material_movement->getUpdatedBy() ?></td>
      <td><?php echo $material_movement->getDeletedAt() ?></td>
    </tr>
  <?php endforeach; ?></tbody>
</table>
