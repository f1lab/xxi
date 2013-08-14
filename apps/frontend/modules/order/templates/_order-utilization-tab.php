<?php if (true == ($utilizations = $order->getUtilizations()) and count($utilizations)): $totalPrice = 0; ?>
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
      <?php foreach ($utilizations as $utilization): ?>
        <tr>
          <td>
            <a href="<?php echo $sf_user->hasCredential('can_edit_materials') ? url_for('material/edit?id=' . $utilization->getMaterial()->getId()) : '#' ?>">
              <?php echo $utilization->getMaterial()->getNameWithDimension() ?>
            </a>
          </th>
          <td><?php echo $utilization->getAmount() ?></td>
          <td><?php echo date('d.m.Y H:i', strtotime($utilization->getCreatedAt())) ?></td>
          <td><?php echo $utilization->getCreator() ?></td>
          <td>
            <abbr title="<?php echo $utilization->getAmount() . '×' . $utilization->getPriceForOne() ?>">
              <?php
                $totalPrice += $utilization->getPrice();
                echo sprintf('%.2f', $utilization->getPrice())
              ?>
            </abbr>
          </td>
        </tr>
      <?php endforeach ?>
      <tr>
        <th colspan="4" scope="row">Итого</th>
        <td><?php echo sprintf('%.2f', $totalPrice) ?></td>
      </tr>
    </tbody>
  </table>
<?php else: ?>
  <div class="alert alert-info">Нет расходов</div>
<?php endif ?>
