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
    <a href="" class="btn btn-primary">Добавить заказ</a>
  </div>
</div>
<?php if (isset($orders) and count($orders)): ?>
<table>
  <thead>
    <tr>
      <th>#</th>
    </tr>
  </thead>
  <tbody><?php foreach ($orders as $order): ?>
    <tr>
      
    </tr>
  <?php endforeach ?></tbody>
</table>
<?php else: ?>
<p>Нет заказов</p>
<?php endif ?>