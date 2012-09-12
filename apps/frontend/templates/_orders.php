<?php if (isset($orders) and count($orders) and true == ($columns = $sf_data->getRaw('columns'))): ?>
<table class="table table-condensed table-bordered rows-clickable">
  <thead>
    <tr>
      <?php if (in_array('id', $columns)): ?><th>#</th><?php endif ?>
      <?php if (in_array('client_id', $columns)): ?><th>Заказчик</th><?php endif ?>
      <?php if (in_array('approved_at', $columns)): ?><th>Дата согласования</th><?php endif ?>
      <?php if (in_array('due_date', $columns)): ?><th>Срок исполнения</th><?php endif ?>
      <?php if (in_array('submited_at', $columns)): ?><th>Дата сдачи</th><?php endif ?>
      <?php if (in_array('state', $columns)): ?><th>Статус</th><?php endif ?>
      <?php if (in_array('cost', $columns)): ?><th>Стоимость работ</th><?php endif ?>
      <?php if (in_array('payed', $columns)): ?><th>Внесённые средства</th><?php endif ?>
      <?php if (in_array('pay_method', $columns)): ?><th>Способ оплаты</th><?php endif ?>
      <?php if (in_array('payed_at', $columns)): ?><th>Дата полной оплаты</th><?php endif ?>
      <?php if (in_array('manager', $columns)): ?><th>Менеджер</th><?php endif ?>
      <?php if (in_array('comments', $columns)): ?><th title="Комментарии"></th><?php endif ?>
    </tr>
  </thead>
  <tbody><?php foreach ($sf_data->getRaw('orders') as $order): ?>
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
      <?php if (in_array('submited_at', $columns)): ?><td><?php echo $order->getSubmitedAt() ? date('d.m.Y', strtotime($order->getSubmitedAt())): '' ?></td><?php endif ?>
      <?php if (in_array('state', $columns)): ?><td><?php echo $order->getStateTranslated() ?></td><?php endif ?>
      <?php if (in_array('cost', $columns)): ?><td><?php echo $order->getCost() ?></td><?php endif ?>
      <?php if (in_array('payed', $columns)): ?><td><?php echo $order->getPayed() ?></td><?php endif ?>
      <?php if (in_array('pay_method', $columns)): ?><td><?php echo $order->getPayMethodTranslated() ?></td><?php endif ?>
      <?php if (in_array('payed_at', $columns)): ?><td><?php echo $order->getPayedAt() ?></td><?php endif ?>
      <?php if (in_array('manager', $columns)): ?><td><?php echo $order->getCreator() ?></td><?php endif ?>
      <?php if (in_array('comments', $columns)):
        $comments = $order->getComments()->count();
        $commentsRead = array_reduce($order->getComments()->toArray(), function($return, $item) {
          if ($item['read'] > 0) {
            $return++;
          }
          return $return;
        });
      ?>
        <td><span class="badge<?php echo $comments > $commentsRead ? ' badge-warning' : '' ?>" title="<?php echo $comments - $commentsRead ?> unread"><?php echo $comments ?></span></td>
      <?php endif ?>
    </tr>
  <?php endforeach ?></tbody>
</table>
<?php else: ?>
<div class="alert alert-info"><strong>Нет заказов</strong>.</div>
<?php endif ?>