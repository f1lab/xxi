<div class="page-header">
  <h1>Редактировать заказ №<?php echo $order->getId() ?></h1>
</div>

<form action="<?php echo url_for('@order-update?id=' . $order->getId()) ?>" method="post">
  <?php echo $form->renderUsing('bootstrap') ?>
  <div class="form-actions">
    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="<?php echo url_for('@order?id=' . $order->getId()) ?>" class="btn">Назад</a>
  </div>
</form>