<h1 class="page-header">
    <?php echo $material->getNameWithDimension() ?>
    <small>материал</small>
</h1>

<div class="btn-toolbar">
    <div class="btn-group">
        <a href="<?php echo url_for('material/edit?id=' . $material->getId()) ?>"
           class="btn btn-primary">Редактировать</a>
    </div>
    <?php if ($sf_user->hasCredential('can_edit_arrivals')): ?>
        <div class="btn-group">
            <a href="<?php echo url_for('arrival/index?material_id=' . $material->getId()) ?>" class="btn">Показать
                поступления</a>
        </div>
    <?php endif ?>
</div>
