<div class="page-header">
  <h1><?php echo $client->getName() ?></h1>
</div>

<div class="row">
  <div class="span8">
  <table class="table table-condensed table-bordered">
    <colgroup>
      <col />
      <col class="span5" />
    </colgroup>
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
        <th scope="row">Полное наименование</th>
        <td><?php echo $client->getFullName() ?></td>
      </tr>
      <tr>
        <th scope="row">Форма собственности</th>
        <td><?php echo $client->getOwnershipTranslated() ?></td>
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
      <tr>
        <th scope="row">Юридический адрес</th>
        <td><?php echo $client->getAddressJure() ?></td>
      </tr>
      <tr>
        <th scope="row">ИНН</th>
        <td><?php echo $client->getInn() ?></td>
      </tr>
      <tr>
        <th scope="row">КПП</th>
        <td><?php echo $client->getKpp() ?></td>
      </tr>
      <tr>
        <th scope="row">Расчётный счёт</th>
        <td><?php echo $client->getRs() ?></td>
      </tr>
      <tr>
        <th scope="row">Наименование и адрес банка</th>
        <td><?php echo $client->getBank() ?></td>
      </tr>
      <tr>
        <th scope="row">БИК</th>
        <td><?php echo $client->getBik() ?></td>
      </tr>
      <tr>
        <th scope="row">Корр. счёт</th>
        <td><?php echo $client->getKs() ?></td>
      </tr>
      <tr>
        <th scope="row">ОГРН</th>
        <td><?php echo $client->getOgrn() ?></td>
      </tr>
      <tr>
        <th scope="row">ОКПО</th>
        <td><?php echo $client->getOkpo() ?></td>
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
<?php
include_partial(
  'global/orders',
  array(
    'orders' => $client->getOrdersByState(
      $_state,
      ($sf_user->hasGroup('buhgalter')||$sf_user->hasGroup('director')) ? false : true // show just mine orders or all
      // TODO: replace by permission `can view all orders'
    ),
    'columns' => array('id', 'approved_at', 'due_date', 'state', 'manager')
  )
) ?>