<div class="page-header">
  <h1><?php echo $client->getName() ?></h1>
</div>

<div class="row">
  <div class="span4">
  <table class="table table-condensed table-bordered">
    <tbody>
      <tr>
        <th scope="row">#</th>
        <td><?php echo $client->getId() ?></td>
      </tr>
      <tr>
        <th scope="row">Наименование</th>
        <td><?php echo $client->getName() ?></td>
      </tr>
      <tr>
        <th scope="row">Контактное лицо</th>
        <td><?php echo $client->getContact() ?></td>
      </tr>
      <tr>
        <th scope="row">Телефон</th>
        <td><?php echo $client->getPhone() ?></td>
      </tr>
      <tr>
        <th scope="row">Email</th>
        <td><?php echo $client->getEmail() ?></td>
      </tr>
    </tbody>
  </table>
  </div>
  <div class="span4"><?php if ($sf_user->hasGroup('manager')): ?>
    <a href="<?php echo url_for('@client-edit?id=' . $client->getId()) ?>" class="btn">Редактировать</a>
  <?php endif ?></div>
</div>

<h2>Заказы</h2>
<div class="btn-toolbar clearfix">
  <?php if ($sf_user->hasGroup('manager')): ?><div class="btn-group">
    <a href="<?php echo url_for('@order-new?client=' . $client->getId()) ?>" class="btn btn-primary">Добавить заказ</a>
  </div><?php endif ?>
  <div class="btn-group pull-right">
    <a href="<?php echo url_for('@client?id=' . $client->getId()) ?>" class="btn<?php echo $_state == 'active' ? ' active' : '' ?>">Текущие</a>
  <?php foreach (OrderTable::$states as $state=>$stateTranslated): ?>
    <a href="<?php echo url_for('@client?id=' . $client->getId() . '&state=' . $state) ?>" class="btn<?php echo $_state == $state ? ' active' : '' ?>"><?php echo $stateTranslated ?></a>
  <?php endforeach ?>
  </div>
</div>
<?php include_partial('global/orders', array('orders' => $client->getOrdersByState($_state), 'columns' => array('id', 'approved_at', 'due_date', 'state'))) ?>