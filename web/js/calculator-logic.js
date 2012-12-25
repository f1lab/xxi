var calculator = undefined;//products.stickers;

var controlGroupTemplate = ''
  + '<div class="control-group">$CONTROLS</div>'
;

var controlTemplate = ''
  + '  <label for="$ID" class="control-label">$LABEL</label>'
  + '  <div class="controls">'
  + '    <select name="$NAME" id="$ID" class="$CLASS">'
  + '      $OPTIONS'
  + '    </select>'
  + '  </div>'
;

var materialsTemplate = ''
  + '  <label for="materials" class="control-label">Материал</label>'
  + '  <div class="controls">'
  + '    <select name="materials" id="materials">'
  + '      <option value="">выберите</option>'
  + '      $OPTIONS'
  + '    </select>'
  + '  </div>'
;

var materialsOptionTemplate = ''
  + '      <option value="" data-material-index="$MATERIALINDEX">$NAME</option>'
;

function renderMaterialsChooser(materials) {
  var materialsOptions = $(materials).map(function(index) {
    return materialsOptionTemplate
      .replace('$NAME', this.name)
      .replace('$MATERIALINDEX', index)
    ;
  });

  return materialsTemplate
    .replace('$OPTIONS', materialsOptions.toArray().join('\n'))
  ;
}

$.fn.fillSelect = function (options) {
  var $optionTemplate = $('<option></option>');

  $(this).html($(options).map(function(a, b, c) {
    if ((!b || b == 'undefined') && b !== 0) return false;

    var result = $optionTemplate.clone()
      .val(b)
      .text(b)
    ;

    return result;
  }).toArray());

  return $(this);
}

function initCalculator() {
  $('#materials-container')
    .html(renderMaterialsChooser(calculator.materials))
      .find('#materials')
        .change(function() {
          $('#options-container, #widths-container').empty();
          var material = calculator.materials[$('#materials :selected').data('material-index')];

          material !== undefined
          && $('#widths-container')
            .html(controlTemplate.replace(/\$ID/g, 'widths').replace('$LABEL', 'Ширина рулона'))
            .find('#widths')
              .fillSelect((material.widths + ',').split(','))
            .end()
          && $.each(
            $.extend(
              {},
              calculator.options,
              material.options || {}
            ),
            function(optionName, optionObject) {
              if (!optionObject) {
                return;
              }
              $('#options-container')
                .append($(
                  controlGroupTemplate.replace(/\$CONTROLS/g,
                    controlTemplate
                      .replace(/\$ID/g, optionName)
                      .replace(/\$LABEL/g, optionObject.label || optionName)
                      .replace(/\$CLASS/g, 'option')
                  )
                ))
                .find('#' + optionName)
                  .fillSelect(optionObject.values)
                .end()
              ;
            }
          );
        })
      .end()
  ;

  $('#params-container, .form-actions')
    .show()
  ;
}

$(function () {
  $('#params-container, .form-actions')
    .hide()
  ;

  $('.nav-tabs')
    .find('a')
      .click(function(e) {
        e.preventDefault();
        $(this)
          .parents('ul')
            .find('li')
              .removeClass('active')
            .end()
          .end()
          .parents('li')
            .addClass('active')
        ;

        calculator = products[$(this).data('product-index')];
        initCalculator(calculator);
      })
  ;

  $('#calculateIt')
    .click(function(e) {
      e.preventDefault();

      var
        materialObject = calculator.materials[$('#materials :selected').data('material-index')],
        result = ''
      ;

      if (materialObject && materialObject.name) {
        var
          width = Number($('#width').val()),
          height = Number($('#height').val()),
          square = width * height,
          quantity = Number($('#quantity').val()),
          material = materialObject.name,
          materialCost = materialObject.cost,
          options = $('.option'),
          optionsText = [],
          optionsCost = 0
        ;

        $.each(options, function(id, option) {
          var
            optionId = $(option).attr('id'),
            optionValue = $(option).find(':selected').val(),
            optionObject = materialObject.options && materialObject.options[optionId]
              ? materialObject.options[optionId]
              : calculator.options[optionId],
            optionCost = 0,
            optionPricing = optionObject.pricing
          ;

          if (optionPricing == 'square') {
            optionCost = square * optionObject.cost[optionObject.values.indexOf(optionValue)];
            if (isNaN(optionCost)) {
              optionCost = 0;
            }
          } else {
            optionCost = '0 not implemented';
          }

          optionsText.push('' + optionObject.label + ': ' + optionValue + ', стоимость: ' + optionCost);
          optionsCost += Number(optionCost.toString().replace(/[^\d\.]/g, ''));
        });

        var cost = Math.ceil(materialCost * square * quantity + optionsCost * quantity);
        result = ''
          + 'Продукция: ' + calculator.name + '\n'
          + 'Материал: ' + material + ' см\n'
          + 'Ширина: ' + width + ' см\n'
          + 'Высота: ' + height + ' см\n'
          + 'Количество: ' + quantity + ' шт.\n'
          + '\n'
          + 'Опции:\n'
          + optionsText.join('\n')
          + '\n'
          + '\n'
          + 'Цена: ' + (cost) + ' руб.\n'
        ;
      } else {
        result = 'Ничего не выбрано.';
      }

      $('#calculationProposal')
        .text(result)
      ;
    })
  ;
})