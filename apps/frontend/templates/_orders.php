<?php if (isset($orders) and count($orders) and true == ($columns = $sf_data->getRaw('columns'))): ?>
<table class="table table-condensed table-bordered rows-clickable">
  <thead>
    <tr>
      <?php if (in_array('id', $columns)): ?><th>#</th><?php endif ?>
      <?php if (in_array('client_id', $columns)): ?><th>Заказчик</th><?php endif ?>
      <?php if (in_array('approved_at', $columns)): ?><th>Дата согласования</th><?php endif ?>
      <?php if (in_array('due_date', $columns)): ?><th>Срок исполнения</th><?php endif ?>
      <?php if (in_array('state', $columns)): ?><th>Статус</th><?php endif ?>
      <?php if (in_array('manager', $columns)): ?><th>Менеджер</th><?php endif ?>
    </tr>
  </thead>
  <tbody><?php foreach ($orders as $order): ?>
    <tr
      rel="popover"
      data-placement="top"
      data-title="Описание заказа"
      data-content="<?php echo $order->getDescription() ?>"
      class="<?php echo $order->getColorIndicator() ?>"
    >
      <?php if (in_array('id', $columns)): ?><td><a href="<?php echo url_for('@order?id=' . $order->getId()) ?>"><?php echo $order->getId() ?></a></td><?php endif ?>
      <?php if (in_array('client_id', $columns)): ?><td><?php echo $order->getClient() ?></td><?php endif ?>
      <?php if (in_array('approved_at', $columns)): ?><td><?php echo $order->getApprovedAt() ? date('d.m.Y', strtotime($order->getApprovedAt())): '' ?></td><?php endif ?>
      <?php if (in_array('due_date', $columns)): ?><td><?php echo $order->getDueDate() ? date('d.m.Y', strtotime($order->getDueDate())) : '' ?></td><?php endif ?>
      <?php if (in_array('state', $columns)): ?><td><?php echo $order->getStateTranslated() ?></td><?php endif ?>
      <?php if (in_array('manager', $columns)): ?><td><?php echo $order->getCreator() ?></td><?php endif ?>
    </tr>
  <?php endforeach ?></tbody>
</table>
<?php else: ?>
<div class="alert alert-info"><strong>Нет заказов</strong>.</div>
<?php endif ?>