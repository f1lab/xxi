<?php if (true == ($refs = $order->getRefOrderWork()) and count($refs)): ?>
  <table class="table table-condensed table-bordered table-hover">
    <thead>
      <tr>
        <th class="span3">Участок / работа</th>
        <th>Комментарий</th>
        <th>Запланировано</th>
        <th>Готовность</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($refs as $ref): ?>
        <tr>
          <td><?php echo $ref->getWork()->getNameWithArea() ?></td>
          <td><?php echo $ref->getComment() ?></td>
          <td><?php echo $ref->getPlannedAt() ?></td>
          <td><span class="icon icon-<?php echo $ref->getIsCompleted() ? 'ok' : 'remove' ?>"></span></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
<?php else: ?>
  <div class="alert alert-info">Нет работ</div>
<?php endif ?>
