var calculator = undefined;//products.stickers;

var controlGroupTemplate = ''
  + '<div class="control-group">$CONTROLS</div>'
;

var controlTemplate = ''
  + '  <label for="$ID" class="control-label">$LABEL</label>'
  + '  <div class="controls">'
  + '    <select name="$NAME" id="$ID">'
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
}

$(function () {
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
          quantity = Number($('#quantity').val()),
          material = materialObject.name,
          materialCost = materialObject.cost,
          options = [],
          cost = Math.ceil(materialCost * width * height * quantity)
        ;

        result = ''
          + 'Продукция: ' + calculator.name + '\n'
          + 'Материал: ' + material + ' см\n'
          + 'Ширина: ' + width + ' см\n'
          + 'Высота: ' + height + ' см\n'
          + 'Количество: ' + quantity + ' шт.\n'
          + '\n'
          + 'Цена: ' + cost + ' руб.\n'
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