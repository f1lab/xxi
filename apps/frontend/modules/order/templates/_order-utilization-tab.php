<?php if (true == ($utilizations = $order->getUtilizations()) and count($utilizations)): ?>
  <table class="table table-condensed table-bordered">
    <tr>
      <th class="span3">Материал</th>
      <th class="span2">Количество</th>
      <th>Когда расходован</th>
      <th>Кем расходован</th>
    </tr>
    <?php foreach ($utilizations as $utilization): ?><tr>
      <td><?php echo $utilization->getMaterial()->getNameWithDimension() ?></th>
      <td><?php echo $utilization->getAmount() ?></td>
      <td><?php echo date('d.m.Y H:i', strtotime($utilization->getCreatedAt())) ?></td>
      <td><?php echo $utilization->getCreator() ?></td>
    </tr><?php endforeach ?>
  </table>
<?php else: ?>
  <div class="alert alert-info">Нет расходов</div>
<?php endif ?>
