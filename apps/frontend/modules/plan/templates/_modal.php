<?php
/**
 * @var RefOrderWork $ref
 */
?>
<div class="clearfix">
    <h4 class="pull-left">
        Заказ №<?php echo $ref->getOrder()->getId() ?>
        <small><a href="<?php echo url_for('order/show?id=' . $ref->getOrder()->getId()) ?>" target="_blank">ещё
                подробнее!</a></small>
    </h4>
</div>
<div class="well">
    <b>Срок исполнения</b>: <?php echo $ref->getOrder()->getDueDate() ?: '—' ?><br>
    <b>Описание заказа</b>: <?php echo nl2br($ref->getOrder()->getDescription()) ?: '—' ?>
</div>

<h5>
    <b>Работа</b> «<?php echo $ref->getWork()->getName() ?>»
    <b>на участке</b> «<?php echo $ref->getWork()->getArea()->getName() ?>»
</h5>
<div class="well">
    <b>Мастер</b>: <?php echo $ref->getMaster() ?><br/>
    <b>Комментарий к работе</b>: <?php echo $ref->getComment() ?: '—' ?><br/><br/>

    <b>Файлы</b>: <?php echo $ref->getOrder()->getFiles() ?: '—' ?>
</div>
