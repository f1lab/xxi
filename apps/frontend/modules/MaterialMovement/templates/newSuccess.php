<h2><?php echo $movementTypeTitle ?></h2>

<form action="<?php echo url_for("MaterialMovement/create"); ?>" method="post">
  <?php echo $form->renderUsing("bootstrap"); ?>

  <?php if ($type !== "utilization" or $sf_user->hasCredential("master")): ?>
    <fieldset>
      <legend>
        Список материалов
        <?php if ($type === "arrival"): ?><button class="btn btn-default" id="add-new-material-from-arrival-form">Добавить материал</button><?php endif ?>
      </legend>
      <?php if ($type === "arrival"): ?>
        <div class="copy-me">
          <div class="align-chosen-to-top">
            <?php echo $materialForm["amount"]; ?>
            <?php echo $materialForm["price"]; ?>
            <?php echo $materialForm["material_id"]; ?>
          </div>
        </div>
        <button type="button" class="btn copier">+</button>

      <?php else: ?>
        <?php foreach ($balance->getRawValue() as $material): ?>
          <div class="control-group">
            <label for="materials[<?php echo $material["id"]; ?>]" class="control-label"><?php echo $material["name"]; ?></label>
            <div class="controls">
              <div class="input-append copy-number-inputs-max-to-value">
                <input type="number" value="0" min="0" max="<?php echo $material["amount"]; ?>" step="0.0001" class="span2" name="materials[<?php echo $material["id"]; ?>]" id="materials[<?php echo $material["id"]; ?>]">
                <button class="btn" type="button">Выбрать всё (<?php echo $material["amount"]; ?>)</button>
              </div>
              <input type="hidden" name="materials_descriptions[<?php echo $material["id"]; ?>]" id="materials_descriptions[<?php echo $material["id"]; ?>]">
            </div>
          </div>
        <?php endforeach ?>
      <?php endif ?>
    </fieldset>
  <?php endif ?>

  <div class="form-actions">
    <button type="submit" class="btn btn-primary"><?php echo $movementTypeButton ?></button>
    <a href="<?php echo url_for($type === "utilization" ? "plan/index" : "warehouse/index?id=" . $sf_request->getParameter("from")) ?>" class="btn">
      Назад к
      <?php if ($type === "utilization"): ?>
        плану
      <?php else: ?>
        складу
      <?php endif ?>
    </a>
  </div>
</form>

<style>
  .align-chosen-to-top .chzn-container {
    vertical-align: top;
  }
</style>

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

    $(".copier").click(function(e) {
      e.preventDefault();
      var container = $(".copy-me")
        , last = container.find(">div").last()
        , select = last.find(".chzn-select").show().removeClass("chzn-done")
        , chzn = select.next().remove()
        , copy = last.clone()
      ;

      chzn = null;

      copy
        .appendTo(container)
        .find("input, select")
          .each(function() {
            var $this = $(this)
              , name = $this.attr("name").replace(/(\d+)/, function(me, i) {
                return me.replace(i, +i+1);
              })
            ;

            $this
              .attr("name", name)
              .val(false)
            ;
          })
          .end()
        .find(".chzn-select")
          .chosen({allow_single_deselect: true})
        ;
    });

    $("#from").change(function() {
      document.location.replace("<?php
        $parameters = sfContext::getInstance()->getRequest()->getParameterHolder()->getAll();
        unset($parameters["from"]);
        echo url_for2("", array_merge($parameters, ["from" => ""]));
      ?>" + $(this).val());
    });

    <?php if ($type === 'utilization'): ?>
      var materialsPlan = <?php echo $sf_data->getRaw('materialsPlan'); ?>
        , form = $('form')
      ;

      form.submit(function(e) {
        e.preventDefault();

        var utilization = {};
        $.each(form.serializeObject(), function(input, amount) {
          var matches = input.match(/materials\[(\d+)\]/);

          if (!matches) {
            return;
          }

          var materialId = matches.pop();
          if (!(materialId in utilization)) {
            utilization[materialId] = 0;
          }
          utilization[materialId] += +amount;
        });

        var modals = [];
        $.each(utilization, function(materialId, amount) {
          var push = {
            id: materialId
            , label: $('label[for="materials[' + materialId + ']"]').text()
          };

          if (materialId in materialsPlan) {
            push.type = 'overhead';
            materialsPlan[materialId] < amount && modals.push(push);
          } else {
            push.type = 'not in list';
            amount > 0 && modals.push(push);
          }
        });

        var titles = {
          overhead: 'Вы израсходовали больше материала, чем было запланировано'
          , 'not in list': 'Вы израсходовали не тот материал, расход которого был запланирован'
        };

        var showNextModal = function() {
          if (modals.length > 0) {
            var modal = modals.pop();
            bootbox.prompt({
              title: titles[modal.type]
              , alert: modal.label
              , placeholder: 'Укажите причину'
            }, function(description) {
              if (description && description.trim()) {
                $('#materials_descriptions\\['+ modal.id + '\\]').val(description);
                showNextModal();
              }
            });
          } else {
            form[0].submit();
          }
        };

        showNextModal();
      });
    <?php endif ?>
  });
</script>
