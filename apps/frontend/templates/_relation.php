<?php if (isset($form[$relationName]) or isset($form['new_' . $relationName])): ?>
<table class="table-condensed add-remove-chzn-for-relations add-remove-datetimepicker-for-relations relations-table">
  <tbody>
    <?php if (!isset($onlyNew) and isset($form[$relationName])): ?>
      <tr>
        <?php foreach ($columns as $column => $label): ?>
          <th><?php echo $label ?></th>
        <?php endforeach ?>
        <th>На удаление</th>
      </tr>
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
          <td colspan="3"><div class="alert alert-info"><?php echo isset($noRelationsMessage) ? $noRelationsMessage : 'Ничего не найдено' ?></div></td>
        </tr>
      <?php endif ?>
    <?php endif ?>

    <?php if (isset($form['new_' . $relationName])): ?>
      <tr>
        <?php foreach ($columns as $column => $label): ?>
          <th><?php echo $label ?></th>
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
        <td><button type="button" class="btn ahAddRelation" rel="new_<?php echo $relationName ?>">+<?php echo isset($addLabel) ? ' ' . $addLabel : '' ?></button></td>
      </tr>
    <?php endif ?>
  </tbody>
</table>
<?php endif ?>
