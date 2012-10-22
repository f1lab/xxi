<div class="page-header">
  <h1>Заказы</h1>
</div>
<div class="btn-toolbar clearfix">
  <?php if ($sf_user->hasGroup('manager') or $sf_user->hasCredential('can_create_orders')): ?><div class="btn-group">
    <a href="<?php echo url_for('@order-new') ?>" class="btn btn-primary">Добавить заказ</a>
  </div><?php endif ?>

  <?php if ($sf_user->hasCredential('can_use_search_in_orders')): ?><div class="btn-group">
    <select name="" id="" style="float:left;margin-bottom:0;width:110px" class="span2 chzn-select" data-placeholder="Перейти к заказу" onchange="document.location.href = '<?php echo url_for('@orders') ?>/' + $(this).val()">
      <option value=""></option>
    <?php
      $q = Doctrine_Core::getTable('Order')->createQuery('a')->select('a.id')->orderBy('id')->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
      foreach ($q as $order): ?>
      <option value="<?php echo $order['id'] ?>"><?php echo $order['id'] ?></option>
    <?php endforeach ?></select>
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

<?php if ($sf_user->hasGroup('manager') or $sf_user->hasCredential('can_create_orders')): ?>
  <div class="btn-group pull-right">
    <a href="<?php echo url_for('@orders?state=' . $_state . '&my=' . ($_my == 'my' ? 'all' : 'my'))
      ?>" class="btn<?php echo $_my == 'my' ? ' active' : '' ?>">Только мои</a>
  </div>
<?php endif ?>
</div>

<?php
  if ($_state == 'debt') {
    include_partial('global/orders-debt', array('pager' => $pager, 'columns' => array(
      'id',
      'client_id',
      'approved_at',
      'submited_at',
      'manager',
      'cost',
      'payed',
      'debt',
      'comments',
      'bill_made',
      'bill_given',
    )));
  } else {
    $columns = array(
      'id',
      'client_id',
      'approved_at',
      'due_date',
      'state',
      'manager',
      'comments',
    );

    if ($sf_user->hasGroup('monitor')) {
      unset($columns[1]); // don't show client
    }

    if ($sf_user->hasGroup('buhgalter')) {
      $columns = array(
        'id',
        'client_id',
        'cost',
        'payed',
        'pay_method',
        'payed_at',
        'approved_at',
        'submited_at',
        'manager',
        'comments',
        'bill_made',
        'bill_given',
      );
    }

    if ($sf_user->hasGroup('director')) {
      array_push($columns, 'bill_made');
      array_push($columns, 'bill_given');
    }

    include_partial('global/orders', array('pager' => $pager, 'columns' => $columns));
  }
?>

<script type="text/javascript">
  setTimeout(function() {
    //window.location.reload();
  }, 30000);
</script>

<?php if ($sf_user->hasCredential('monitor') and !$sf_user->isSuperAdmin()): ?>
<style type="text/css">
  .navbar,
  .page-header {
    display: none;
  }
</style>
<?php endif ?>