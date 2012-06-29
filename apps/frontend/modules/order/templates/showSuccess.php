<div class="page-header">
  <h1>Заказ №<?php echo $order->getId() ?></h1>
</div>

<table class="table table-condensed table-bordered">
  <colgroup>
    <col class="span3" />
    <col />
  </colgroup>
  <tr>
    <th scope="row">Клиент</th>
    <td><?php echo $order->getClient() ?></td>
  </tr>
  <tr>
    <th scope="row">Описание заказа</th>
    <td><pre><?php echo $order->getDescription() ?></pre></td>
  </tr>
  <tr>
    <th scope="row">Срок исполнения</th>
    <td><?php echo $order->getDueDate() ?></td>
  </tr>
  <tr>
    <th scope="row">Дата согласования с заказчиком</th>
    <td><?php echo $order->getApprovedAt() ?></td>
  </tr>
  <tr>
    <th scope="row">Файлы и коментарии к ним</th>
    <td><pre><?php echo $order->getFiles() ?></pre></td>
  </tr>
  <tr>
    <th scope="row">Стоимость монтажа</th>
    <td><?php echo $order->getInstallationCost() ?></td>
  </tr>
  <tr>
    <th scope="row">Стоимость дизайна</th>
    <td><?php echo $order->getDesignCost() ?></td>
  </tr>
  <tr>
    <th scope="row">Стоимость работ подрядчиков</th>
    <td><?php echo $order->getContractorsCost() ?></td>
  </tr>
  <tr>
    <th scope="row">Стоимость работ</th>
    <td><?php echo $order->getCost() ?></td>
  </tr>
  <tr>
    <th scope="row">Дата поступления в работу</th>
    <td><?php echo $order->getStartedAt() ?></td>
  </tr>
  <tr>
    <th scope="row">Дата выполнения</th>
    <td><?php echo $order->getFinishedAt() ?></td>
  </tr>
  <tr>
    <th scope="row">Дата сдачи заказа</th>
    <td><?php echo $order->getSubmitedAt() ?></td>
  </tr>
  <tr>
    <th scope="row">Статус</th>
    <td><?php echo $order->getStateTranslated() ?></td>
  </tr>
</table>

<div class="btn-toolbar">
  <div class="btn-group">
    <a href="<?php echo url_for('@order-edit?id=' . $order->getId()) ?>" class="btn">Редактировать</a>
  </div>
</div>

<div class="alert alert-info">
  <strong>Ждите!</strong>
  Здесь будет комментирование заказа и вы сможете оставлять заметки.
</div>