<h1 class="page-header">
    Импортировать материал
</h1>

<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
    <div class="alert alert-block alert-info">
        Материалы импортируются в формате "Наименование, размерность"
    </div>

    <?php echo $form->renderUsing('bootstrap') ?>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Импортировать</button>
    </div>
</form>
