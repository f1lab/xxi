<div class="page-header">
  <h1>Заказы</h1>
</div>
<div class="btn-toolbar clearfix">
  <?php if ($sf_user->hasGroup('manager')): ?><div class="btn-group">
    <a href="<?php echo url_for('@order-new') ?>" class="btn btn-primary">Добавить заказ</a>
  </div><?php endif ?>

<?php
if (
  $sf_user->hasGroup('manager')
  or $sf_user->hasGroup('worker')
  or $sf_user->hasGroup('director')
  or $sf_user->hasGroup('buhgalter')
): ?>
  <div class="btn-group pull-right">
    <a href="<?php echo url_for('@orders?state=active&my=' . $_my) ?>" class="btn<?php
      echo $_state == 'active' ? ' active' : '' ?>">Текущие</a>
  <?php
    $states = $sf_user->hasGroup('worker') ? OrderTable::$statesForWorker : OrderTable::$states;
    foreach ($states as $state=>$stateTranslated):
  ?>
    <a href="<?php echo url_for('@orders?state=' . $state . '&my=' . $_my) ?>" class="btn<?php
      echo $_state == $state ? ' active' : '' ?>"><?php echo $stateTranslated ?></a>
  <?php endforeach ?>
  </div>
<?php endif ?>

<?php if ($sf_user->hasGroup('manager')): ?>
  <div class="btn-group pull-right">
    <a href="<?php echo url_for('@orders?state=' . $_state . '&my=' . ($_my == 'my' ? 'all' : 'my'))
      ?>" class="btn<?php echo $_my == 'my' ? ' active' : '' ?>">Только мои</a>
  </div>
<?php endif ?>
</div>

<?php
  $columns = array('id', 'client_id', 'approved_at', 'due_date', 'state', 'manager');

  if ($sf_user->hasGroup('worker') or $sf_user->hasGroup('monitor')) {
    unset($columns[1]); // don't show client
  }

  include_partial('global/orders', array('orders' => $orders, 'columns' => $columns));
?>

<?php if ($sf_user->hasGroup('monitor')): ?>
<script type="text/javascript">
  setTimeout(function() {
    window.location.reload();
  }, 15000);
</script>
<?php endif ?>
