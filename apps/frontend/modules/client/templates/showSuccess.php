<div class="page-header">
  <h1><?php echo $client->getName() ?></h1>
</div>

<?php if ($client->getIsBlacklisted()): ?>
  <div class="alert text-inverse">
    Клиент в чёрном списке. Заказы принимаются только после согласования с руководством.
  </div>
<?php endif ?>

<div class="tabbable" style="margin-top: 2em;">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab-info" data-toggle="tab">Информация</a></li>
    <li><a href="#tab-finance" data-toggle="tab">Финансы</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab-info">
      <?php include_partial('client-info-tab', ['client' => $client]) ?>
    </div>
    <div class="tab-pane" id="tab-finance">
      <?php include_partial('client-finance-tab', ['client' => $client]) ?>
    </div>
  </div>
</div>

<h2>Заказы</h2>
<div class="btn-toolbar clearfix">
  <?php if ($sf_user->hasGroup('manager')): ?><div class="btn-group">
    <a href="<?php echo url_for('@order-new?client=' . $client->getId()) ?>" class="btn btn-primary">Добавить заказ</a>
  </div><?php endif ?>
  <div class="btn-group pull-right">
    <a href="<?php echo url_for('@client?id=' . $client->getId()) ?>" class="btn<?php echo $_state == 'active' ? ' active' : '' ?>">Текущие</a>
  <?php foreach (OrderTable::$states as $state => $stateTranslated): if ($state == 'submited') { continue; }?>
    <a href="<?php echo url_for('@client?id=' . $client->getId() . '&state=' . $state) ?>" class="btn<?php echo $_state == $state ? ' active' : '' ?>"><?php echo $stateTranslated ?></a>
  <?php endforeach ?>
  </div>
</div>
<?php
  $columns = array(
    'id',
    'client_id',
    'approved_at',
    'submited_at',
    'manager',
    'cost',
    'payed',
    'debt',
  );

  if ($sf_request->getParameter('state') == 'debt') {
    $columns = array_merge($columns, array(
      'bill_made',
      'bill_given',
      'docs_given',
    ));
  }

  include_partial(
    'global/orders',
    array(
      'orders' => $client->getOrdersByState(
        $_state,
        !$sf_user->hasCredential('can_view_all_orders_of_client')
      ),
      'columns' => $columns,
    )
  );
