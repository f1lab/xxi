<h1 class="page-header">
  Склады
  <?php if ($sf_user->hasCredential("can edit warehouses")): ?>
    <small>
      <a href="<?php echo url_for('warehouse/new') ?>" class="btn btn-primary">Добавить склад</a>
    </small>
  <?php endif ?>
</h1>

<form action="?filter" method="get" class="well well-small submit-on-select-change">
  <span>Фильтр по наименованию:</span>
  <?php echo $filter["id"] ?>
</form>

<h2>Остатки</h2>

<?php if ($warehouses and count($warehouses)): ?>
  <?php foreach ($warehouses as $warehouse): ?>
    <h3>
      <?php if ($sf_user->hasCredential("can edit warehouses")): ?>
        <a href="<?php echo url_for('warehouse/edit?id='.$warehouse->getId()) ?>"><?php echo $warehouse ?></a>
      <?php else: ?>
        <?php echo $warehouse ?>
      <?php endif ?>
      <?php if ($sf_user->hasCredential("can transfer material")): ?>
        <a href="<?php echo url_for("MaterialMovement/new?type=arrival&to=" . $warehouse->getId()); ?>" class="btn btn-small">Принять материалы</a>
        <a href="<?php echo url_for("MaterialMovement/new?type=transfer&from=" . $warehouse->getId()); ?>" class="btn btn-small">Переместить материалы</a>
        <a href="<?php echo url_for("MaterialMovement/new?type=writeoff&from=" . $warehouse->getId()); ?>" class="btn btn-small">Списать материалы</a>
        <a href="<?php echo url_for("MaterialMovement/index?id=" . $warehouse->getId()); ?>" class="btn btn-small">Посмотреть историю</a>
      <?php endif ?>
    </h3>
    <?php
      $balance = $warehouse->getBalance();
      if (count($balance)):
    ?>
      <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th>Материал</th>
            <th>Остаток</th>
            <?php if ($sf_user->hasCredential("can view material costs")): ?>
              <th>Цена => остаток</th>
            <?php endif ?>
          </tr>
        </thead>
        <tbody><?php foreach ($balance as $material): ?>
          <tr>
            <td><?php echo $material["name"]; ?></td>
            <td><?php echo $material["amount"]; ?></td>
            <?php if ($sf_user->hasCredential("can view material costs")): ?>
              <td><pre><?php echo str_replace(["Array\n(\n", "    ", ")\n"], "", print_r($material["amounts"]->getRawValue(), 1)); ?></pre></td>
            <?php endif ?>
          </tr>
        <?php endforeach ?></tbody>
      </table>
    <?php else: ?>
      <div class="alert alert-info">Нет материалов</div>
    <?php endif ?>


  <?php endforeach ?>

<?php else: ?>
  <div class="alert alert-info">Нет складов</div>
<?php endif ?>
