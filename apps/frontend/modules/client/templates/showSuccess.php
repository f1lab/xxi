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
  <div class="span4">
    <a href="<?php echo url_for('@client-edit?id=' . $client->getId()) ?>" class="btn">Редактировать</a>
  </div>
</div>

<h2>Заказы</h2>
<div class="btn-toolbar">
  <div class="btn-group">
    <a href="" class="btn active">Текущие</a>
    <a href="" class="btn">Архивные</a>
  </div>
  <div class="btn-group">
    <a href="<?php echo url_for('@order-new?client=' . $client->getId()) ?>" class="btn btn-primary">Добавить заказ</a>
  </div>
</div>
<?php if (true == ($orders=$client->getOrders()) and count($orders)): ?>
<table class="table table-condensed table-bordered rows-clickable">
  <thead>
    <tr>
      <th>#</th>
      <th>Статус</th>
    </tr>
  </thead>
  <tbody><?php foreach ($orders as $order): ?>
    <tr>
      <td><a href="<?php echo url_for('@order?id=' . $order->getId()) ?>"><?php echo $order->getId() ?></a></td>
      <td><?php echo $order->getStateTranslated() ?></td>
    </tr>
  <?php endforeach ?></tbody>
</table>
<?php else: ?>
<p>Нет заказов</p>
<?php endif ?>