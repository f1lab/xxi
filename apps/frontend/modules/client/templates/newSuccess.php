<div class="page-header">
  <h1>Добавить клиента</h1>
</div>

<form action="<?php echo url_for('@client-create') ?>" method="post">
  <?php echo $form->renderUsing('bootstrap') ?>
  <div class="form-actions">
    <button type="submit" class="btn btn-primary">Создать</button>
    <a href="<?php echo url_for('@clients') ?>" class="btn">Назад</a>
  </div>
</form>