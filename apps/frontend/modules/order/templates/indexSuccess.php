<div class="page-header">
  <h1>Заказы</h1>
</div>
<div class="btn-toolbar">
  <div class="btn-group">
    <a href="<?php echo url_for('@order-new') ?>" class="btn btn-primary">Добавить заказ</a>
  </div>
</div>

<?php if (isset($orders) and count($orders)): ?>
<table class="table table-condensed table-bordered rows-clickable">
  <thead>
    <tr>
      <th>#</th>
      <th>Статус</th>
      <th>Заказчик</th>
    </tr>
  </thead>
  <tbody><?php foreach ($orders as $order): ?>
    <tr>
      <td><a href="<?php echo url_for('@order?id=' . $order->getId()) ?>"><?php echo $order->getId() ?></a></td>
      <td><?php echo $order->getStateTranslated() ?></td>
      <td><?php echo $order->getClient() ?></td>
    </tr>
  <?php endforeach ?></tbody>
</table>
<?php else: ?>
<p>Нет заказов.</p>
<?php endif ?>