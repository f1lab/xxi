<div class="page-header">
  <h1>Клиенты</h1>
</div>
<div class="btn-toolbar">
  <div class="btn-group">
    <a href="<?php echo url_for('@client-new') ?>" class="btn btn-primary">Добавить клиента</a>
  </div>
</div>
<table class="table table-condensed table-bordered rows-clickable">
  <thead>
  <tr>
    <th>#</th>
    <th>Наименование</th>
    <th>Контактное лицо</th>
    <th>Телефон</th>
    <th>Email</th>
  </tr>
  </thead>
  <tbody><?php foreach ($clients as $client): ?>
  <tr>
    <td><?php echo $client->getId() ?></td>
    <td><a href="<?php echo url_for('@client?id=' . $client->getId()) ?>"><?php echo $client->getName() ?></a></td>
    <td><?php echo $client->getContact() ?></td>
    <td><?php echo $client->getPhone() ?></td>
    <td><?php echo $client->getEmail() ?></td>
  </tr>
  <?php endforeach ?></tbody>
</table>