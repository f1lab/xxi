<h1 class="page-header">
  Материалы
</h1>

<div class="btn-toolbar">
  <div class="btn-group">
    <a href="<?php echo url_for('material/new') ?>" class="btn btn-primary">Добавить материал</a>
  </div>
  <div class="btn-group">
    <select name="" id="" style="float:left;margin-bottom:0" onchange="document.location.href = '<?php echo url_for('material/edit?id=') ?>/' + $(this).val()" class="chzn-select" data-placeholder="Быстрый переход">
      <option value=""></option>
    <?php foreach ($materials as $material): ?>
      <option value="<?php echo $material->getId() ?>"><?php echo $material ?></option>
    <?php endforeach ?></select>
  </div>
</div>

<?php if (count($materials)): ?>
<table class="table table-condensed table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Наименование</th>
      <th>Размерность</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($materials as $material): ?>
    <tr>
        <td><a href="<?php echo url_for('material/edit?id='.$material->getId()) ?>"><?php echo $material->getId() ?></a></td>
        <td><?php echo $material->getName() ?></td>
        <td><?php echo $material->getDimension() ?></td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
<?php else: ?>
  <div class="alert alert-info">Нет материалов</div>
<?php endif ?>