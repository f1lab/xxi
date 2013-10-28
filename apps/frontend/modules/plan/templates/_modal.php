<div class="clearfix">
  <h4 class="pull-left">
    Заказ №<?php echo $ref->getOrder()->getId() ?>
    <small><a href="<?php echo url_for('order/show?id=' . $ref->getOrder()->getId()) ?>" target="_blank">ещё подробнее!</a></small>
  </h4>
</div>
<div class="well">Описание заказа: <?php echo $ref->getOrder()->getDescription() ?: '—' ?></div>

<h5>Работа «<?php echo $ref->getWork()->getName() ?>» на участке «<?php echo $ref->getWork()->getArea()->getName() ?>»</h5>
<div class="well">
  Мастер: <?php echo $ref->getMaster() ?><br />
  Комментарий к работе: <?php echo $ref->getComment() ?: '—' ?>
</div>
