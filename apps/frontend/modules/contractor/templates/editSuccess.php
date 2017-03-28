<div class="page-header">
    <h1>Редактировать <?php echo $client->getName() ?></h1>
</div>
<form action="<?php echo url_for('@contractor-update?id=' . $client->getId()) ?>" method="post">
    <?php echo $form->renderUsing('bootstrap') ?>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="<?php echo url_for('@contractor?id=' . $client->getId()) ?>" class="btn">Назад</a>
    </div>
</form>
