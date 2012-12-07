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
  if ($sf_user->hasGroup('monitor')):
    if (true == ($hasToCheck = $sf_request->hasParameter('order_filters'))) {
      $requestedState = sfContext::getInstance()->getRequest()->getParameter('order_filters')['state'];
    }
?>
    <div class="btn-group pull-right">
      <a href="<?php echo url_for('@orders') ?>" class="btn<?php
        echo !$hasToCheck ? ' active' : '' ?>">Текущие</a>
    <?php foreach (OrderTable::$statesForMonitor as $state=>$stateTranslated): ?>
      <a href="<?php echo url_for('@orders?order_filters[state][]=' . $state) ?>" class="btn<?php
        echo $hasToCheck && in_array($state, $requestedState) ? ' active' : '' ?>"><?php echo $stateTranslated ?></a>
    <?php endforeach ?>
    </div>
  <?php else: ?>
    <div class="btn-group pull-right">
      <a class="btn toggler collapsed" data-toggle="collapse" href="#filterator">
        <i class="icon icon-list"></i> Фильтровать…
      </a>
    </div>
  <?php endif ?>
</div>

  <?php if (!$sf_user->hasGroup('monitor')): ?>
    <div id="filterator" class="collapse"><?php include_partial('filter', array('form' => $filter)) ?></div>
  <?php endif ?>

<?php
  $columns = array(
    'id',
    'client_id',
    'approved_at',
    'due_date',
    'state',
    'manager',
    'comments',
    'bill_made',
    'bill_given',
    'docs_given',
  );

  if ($sf_user->hasGroup('monitor')) {
    unset (
      $columns['client_id'],
      $columns['bill_made'],
      $columns['bill_given'],
      $columns['docs_given']
    );
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
      'docs_given',
    );
  }

  include_partial('global/orders', array('pager' => $pager, 'columns' => $columns));
?>


<?php if ($sf_user->hasCredential('monitor') and !$sf_user->isSuperAdmin()): ?>
  <script type="text/javascript">
    setTimeout(function() {
      window.location.reload();
    }, 30000);
  </script>

  <style type="text/css">
    .navbar,
    .page-header {
      display: none;
    }
  </style>
<?php endif ?>
