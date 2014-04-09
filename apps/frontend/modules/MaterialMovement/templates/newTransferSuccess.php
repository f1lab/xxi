<form action="?submit" method="post">
  <?php echo $form->renderUsing("bootstrap"); ?>

  <fieldset>
    <legend>Список материалов</legend>
    <?php foreach ($balance->getRawValue() as $material): ?>
      <div class="control-group">
        <label for="materials[<?php echo $material["id"]; ?>]" class="control-label"><?php echo $material["name"]; ?></label>
        <div class="controls">
          <div class="input-append copy-number-inputs-max-to-value">
            <input type="number" value="0" min="0" max="<?php echo $material["amount"]; ?>" step="0.0001" class="span2" name="materials[<?php echo $material["id"]; ?>]" id="materials[<?php echo $material["id"]; ?>]">
            <button class="btn" type="button">Выбрать всё (<?php echo $material["amount"]; ?>)</button>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </fieldset>

  <div class="form-actions">
    <button type="submit" class="btn btn-primary">Переместить</button>
  </div>
</form>

<script>
  $(function() {
    $(".copy-number-inputs-max-to-value .btn").click(function(e) {
      e.preventDefault();

      var $this = $(this)
        , input = $this.siblings("input[type=number]")
      ;

      if (input.length) {
        input.val(input.attr("max"));
      }
    });
  });
</script>
