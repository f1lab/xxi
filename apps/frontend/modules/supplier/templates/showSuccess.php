<div class="page-header">
  <h1>
    <?php echo $client->getName() ?>
    <small>Поставщик</small>
  </h1>
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
          <th scope="row">ФИО бухгалтера</th>
          <td><?php echo $client->getBuhgalter() ?></td>
        </tr>
        <tr>
          <th scope="row">Телефон бухгалтера</th>
          <td><?php echo $client->getBuhgalterPhone() ?></td>
        </tr>
        <tr>
          <th scope="row">Скидка</th>
          <td><?php echo $client->getDiscount() ?></td>
        </tr>
      </tbody>
    </table>

    <div class="accordion">
      <div class="accordion-group">
        <div class="accordion-heading">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
            <i class="icon icon-plus-sign"></i> Подробнее
          </a>
        </div>
        <div id="collapseOne" class="accordion-body collapse">
          <div class="accordion-inner">
            <table class="table-condensed table-striped">
              <colgroup>
                <col />
                <col class="span5" />
              </colgroup>
              <tbody>
                <tr>
                  <th scope="row">Полное наименование</th>
                  <td><?php echo $client->getFullName() ?></td>
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
        </div>
      </div>
    </div>
  </div>
  <div class="span4"><?php if ($sf_user->hasGroup('director') or $sf_user->hasCredential('can_edit_suppliers')): ?>
    <a href="<?php echo url_for('@supplier-edit?id=' . $client->getId()) ?>" class="btn">Редактировать</a>
  <?php endif ?></div>
</div>

<h2>Поступления материалов</h2>
<?php if ($sf_user->hasGroup('director') or $sf_user->hasCredential('can_edit_arrivals')): ?>
  <div class="btn-toolbar clearfix">
    <div class="btn-group">
      <a href="<?php echo url_for('arrival/new?supplier_id=' . $client->getId()) ?>" class="btn btn-primary">Добавить поступление</a>
    </div>
  </div>
<?php endif ?>

<?php if (true == ($arrivals = $client->getArrivals()) and count($arrivals)): ?>
  <table class="table table-condensed table-bordered table-hover rows-clickable">
    <thead>
      <tr>
        <th>Id</th>
        <th>Дата поступления</th>
        <th>Накладная</th>
        <th>Материал</th>
        <th>Количество</th>
        <th>Цена за единицу</th>
      </tr>
    </thead>
    <tbody><?php foreach ($arrivals as $arrival): ?>
      <tr>
        <td><a href="<?php echo url_for('arrival/edit?id='.$arrival->getId()) ?>"><?php echo $arrival->getId() ?></a></td>
        <td><?php echo date('d.m.Y', strtotime($arrival->getArrivedAt())) ?></td>
        <td><?php echo $arrival->getBill() ?></td>
        <td><?php echo $arrival->getMaterial()->getNameWithDimension() ?></td>
        <td><?php echo $arrival->getCount() ?></td>
        <td><?php echo $arrival->getPrice() ?></td>
      </tr>
    <?php endforeach; ?></tbody>
  </table>
<?php else: ?>
  <div class="alert alert-info">Нет поступлений</div>
<?php endif ?>
