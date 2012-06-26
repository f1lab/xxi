<div class="page-header">
  <h1>Добавить заказ</h1>
</div>

<form action="<?php echo url_for('@order-create') ?>" method="post">
  <?php echo $form->renderUsing('bootstrap') ?>
  <div class="form-actions">
    <button type="submit" class="btn btn-primary">Добавить</button>
    <a href="<?php echo url_for('@orders') ?>" class="btn">Назад</a>
  </div>
</form>