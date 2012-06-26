<div class="page-header">
  <h1>Заказ №<?php echo $order->getId() ?></h1>
</div>

<?php echo '<pre>' . print_r( $order->toArray(1), 1 ) . '</pre>'; ?>

<div class="btn-toolbar">
  <div class="btn-group">
    <a href="<?php echo url_for('@order-edit?id=' . $order->getId()) ?>" class="btn">Редактировать</a>
  </div>
</div>