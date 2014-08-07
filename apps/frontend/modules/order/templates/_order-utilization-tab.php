<h4>План</h4>
<?php if (count($order->getUtilizationPlans())): ?>
  <table class="table table-condensed table-bordered table-hover">
    <thead>
      <tr>
        <th class="span3">Материал</th>
        <th class="span2">Количество</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($order->getUtilizationPlans() as $utilizationPlan): ?>
        <tr>
          <td>
            <a href="<?php echo $sf_user->hasCredential('can_edit_materials') ? url_for('material/edit?id=' . $utilizationPlan->getMaterial()->getId()) : '#' ?>">
              <?php echo $utilizationPlan->getMaterial()->getNameWithDimension() ?>
            </a>
          </td>
          <td><?php echo $utilizationPlan->getAmount() ?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
<?php else: ?>
  <div class="alert alert-info">Нет расходов</div>
<?php endif ?>

<h4>Факт</h4>
<?php if (count($utilizations)): $totalPrice = 0; ?>
  <table class="table table-condensed table-bordered table-hover">
    <thead>
      <tr>
        <th class="span3">Материал</th>
        <th class="span2">Количество</th>
        <th>Когда расходован</th>
        <th>Кем расходован</th>
        <th>Стоимость</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($utilizations as $movement): ?>
        <tr>
          <td>
            <a href="<?php echo $sf_user->hasCredential('can_edit_materials') ? url_for('material/edit?id=' . $movement->getMaterial()->getId()) : '#' ?>">
              <?php echo $movement->getMaterial()->getNameWithDimension() ?>
            </a>
          </td>
          <td><?php echo $movement->getAmount() ?></td>
          <td><?php echo date('d.m.Y H:i', strtotime($movement->getCreatedAt())) ?></td>
          <td><?php echo $movement->getCreator() ?></td>
          <td>
            <abbr title="<?php echo $movement->getAmount() . '×' . $movement->getPrice() ?>">
              <?php
                $totalPrice += $movement->getAmount() * $movement->getPrice();
                echo sprintf('%.4f', $movement->getAmount() * $movement->getPrice())
              ?>
            </abbr>
          </td>
        </tr>
      <?php endforeach ?>
      <tr>
        <th colspan="4" scope="row">Итого</th>
        <td><?php echo sprintf('%.4f', $totalPrice) ?></td>
      </tr>
    </tbody>
  </table>
<?php else: ?>
  <div class="alert alert-info">Нет расходов</div>
<?php endif ?>
