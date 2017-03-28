<h1 class="page-header">
    Импортировать поступления
</h1>

<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
    <div class="alert alert-block alert-info">
        Поступления импортируются в формате "Номенклатура, Базовая единица измерения" TAB "Стоимость" TAB "Количество (в
        базовых единицах)" TAB "Цена". <br/>
    </div>

    <?php echo $form->renderUsing('bootstrap') ?>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Импортировать</button>
    </div>
</form>
