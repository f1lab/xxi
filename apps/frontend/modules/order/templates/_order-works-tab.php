<?php if (true == ($refs = $order->getRefOrderWork()) and count($refs)): ?>
  <table class="table table-condensed table-bordered table-hover">
    <thead>
      <tr>
        <th class="span3">Участок / работа</th>
        <th>Мастер</th>
        <th>Комментарий</th>
        <th>Запланировано</th>
        <th>Готовность</th>

        <?php if ($sf_user->hasCredential(["can_print_orders", "can-print-design-orders", "design-worker"], false)): //false is for OR switch ?>
          <th>Действия</th>
        <?php endif ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($refs as $ref): ?>
        <tr class="<?php echo $ref->getIsCompleted() ? 'success' : 'error' ?>">
          <td><?php echo $ref->getWork()->getNameWithArea() ?></td>
          <td><?php echo $ref->getMaster() ?></td>
          <td><?php echo $ref->getComment() ?></td>
          <td><?php echo $ref->getPlannedAt() ?></td>
          <td>
            <span class="icon icon-<?php echo $ref->getIsCompleted() ? 'ok' : 'remove' ?>"></span>
            <?php if ($ref->getIsCompleted()): ?>
              отмечено <?php echo $ref->getFinishedAt() ?>
            <?php endif ?>
          </td>

          <td>
            <?php if ($sf_user->hasCredential(["can_print_orders", "can-print-design-orders", "design-worker"], false)): //false is for OR switch ?>
              <a href="<?php echo url_for("@order-print?order_id=" . $order->getId() . "&id=" . $ref->getId()) ?>" class="btn">Распечатать бланк заказа</a>
            <?php endif ?>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
<?php else: ?>
  <div class="alert alert-info">Нет работ</div>
<?php endif ?>
