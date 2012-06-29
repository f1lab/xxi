<div class="page-header">
  <h1>Заказы</h1>
</div>
<div class="btn-toolbar">
  <div class="btn-group">
    <a href="<?php echo url_for('@order-new') ?>" class="btn btn-primary">Добавить заказ</a>
  </div>
  <div class="btn-group pull-right">
    <a href="<?php echo url_for('@orders') ?>" class="btn<?php echo $_state == 'active' ? ' active' : '' ?>">Текущие</a>
  <?php foreach (OrderTable::$states as $state=>$stateTranslated): ?>
    <a href="<?php echo url_for('@orders?state=' . $state) ?>" class="btn<?php echo $_state == $state ? ' active' : '' ?>"><?php echo $stateTranslated ?></a>
  <?php endforeach ?>
  </div>
</div>

<?php include_partial('global/orders', array('orders' => $orders, 'columns' => array('id', 'client_id', 'approved_at', 'due_date', 'state'))) ?>