<h1 class="page-header">
  Поступления материалов
</h1>

<div class="btn-toolbar">
  <div class="btn-group">
    <a href="<?php echo url_for('arrival/new') ?>" class="btn btn-primary">Добавить</a>
  </div>
</div>

<table class="table table-condensed table-bordered table-hover rows-clickable">
  <thead>
    <tr>
      <th>Id</th>
      <th>Дата поступления</th>
      <th>Накладная</th>
      <th>Поставщик</th>
      <th>Материал</th>
      <th>Количество</th>
      <th>Остаток</th>
      <th>Цена за единицу</th>
    </tr>
  </thead>
  <tbody><?php foreach ($arrivals as $arrival): ?>
    <tr class="<?php if (!$arrival->getRemained()) echo ' muted' ?>">
      <td><a href="<?php echo url_for('arrival/edit?id='.$arrival->getId()) ?>"><?php echo $arrival->getId() ?></a></td>
      <td><?php echo date('d.m.Y', strtotime($arrival->getArrivedAt())) ?></td>
      <td><?php echo $arrival->getBill() ?></td>
      <td><?php echo $arrival->getSupplier() ?></td>
      <td><?php echo $arrival->getMaterial()->getNameWithDimension() ?></td>
      <td><?php echo $arrival->getAmount() ?></td>
      <td><?php echo $arrival->getRemained() ?></td>
      <td><?php echo $arrival->getPrice() ?></td>
    </tr>
  <?php endforeach; ?></tbody>
</table>
