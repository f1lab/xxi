<table class="table-condensed add-remove-chzn-for-relations">
  <thead>
    <tr>
      <?php foreach ($columns as $column => $label): ?>
        <td><?php echo $label ?></td>
      <?php endforeach ?>
      <td>На удаление</td>
    </tr>
  </thead>
  <tbody>
    <?php if (count($form[$relationName])): ?>
      <?php foreach ($form[$relationName] as $i => $relation ):?>
        <tr>
          <?php foreach ($columns as $column => $label): ?>
            <td><?php echo $relation[$column]->render();?></td>
          <?php endforeach ?>

          <td align="center">
            <input type="checkbox" name="<?php echo $form->getName() ?>[<?php echo $relationName ?>][<?php echo $i;?>][delete_object]" id="<?php echo $form->getName() ?>_<?php echo $relationName ?>_[<?php echo $i; $i++;?>]_delete_object">
          </td>
          <td>
            <div style="color:red">
              <?php echo $form->renderGlobalErrors() ?>
              <?php foreach ($columns as $column => $label): ?>
                <?php echo $relation[$column]->renderError();?>
              <?php endforeach ?>
            </div>
          </td>
        </tr>
      <?php endforeach ?>
    <?php else: ?>
      <tr>
        <td colspan="3"><div class="alert alert-info"><?php echo $noRelationsMessage ?></div></td>
      </tr>
    <?php endif ?>

    <tr>
      <?php foreach ($columns as $column => $label): ?>
        <td><?php echo $label ?></td>
      <?php endforeach ?>
      <td></td>
    </tr>
    <tr>
      <?php foreach ($columns as $column => $label): ?>
        <td>
          <?php echo $form['new_' . $relationName]['0'][$column]->render();?>
        </td>
      <?php endforeach ?>
      <td>
        <div style="color:red">
          <?php echo $form->renderGlobalErrors() ?>
          <?php foreach ($columns as $column => $label): ?>
            <?php echo $form['new_' . $relationName]['0'][$column]->renderError();?>
          <?php endforeach ?>
        </div>
      </td>
    </tr>
    <tr>
      <td><button type="button" class="btn ahAddRelation" rel="new_<?php echo $relationName ?>">+</button></td>
    </tr>
  </tbody>
</table>
