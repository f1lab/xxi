var calculator = products.stickers;

var controlGroupTemplate = ''
  + '<div class="control-group">$CONTROLS</div>'
;

var controlTemplate = ''
  + '  <label for="$ID" class="control-label">$LABEL</label>'
  + '  <div class="controls">'
  + '    <select name="$NAME" id="$ID">'
//  + '      <option value="">выберите</option>'
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
//  + ''
//  + '    <select name="widths" id="widths">'
//  + '      <option value="">сначала выберите материал</option>'
//  + '    </select>'
  + '  </div>'
;

var materialsOptionTemplate = ''
  + '      <option value="" data-widths="$WIDTHS" data-material-index="$MATERIALINDEX">$NAME</option>'
;

function renderMaterialsChooser(materials) {
  var materialsOptions = $(materials).map(function(index) {
    return materialsOptionTemplate
      .replace('$NAME', this.name)
      .replace('$WIDTHS', this.widths.join())
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
    if (!b || b == 'undefined') return false;

    var result = $optionTemplate.clone()
      .val(b)
      .text(b)
    ;

    return result;
  }).toArray());

  return $(this);
}

$(function () {
  /* $('#fields-container')
    .html(controlTemplate.replace(/\$ID/g, 'fields').replace('$LABEL', 'Поля'))
      .find('#fields')
        .fillSelect(calculator.options.fields)
  ; */

  $('#materials-container')
    .html(renderMaterialsChooser(calculator.materials))
      .find('#materials')
        .change(function() {
          $('#options-container, #widths-container').empty();

          $('#materials :selected').data('material-index') !== undefined
          && $('#widths-container')
            .html(controlTemplate.replace(/\$ID/g, 'widths').replace('$LABEL', 'Ширина рулона'))
            .find('#widths')
              .fillSelect(($(this).find(':selected').data('widths') + ',').split(','))
            .end()
          && $.each(
            $.extend(
              {},
              calculator.options,
              calculator.materials[$('#materials :selected').data('material-index')].options || {}
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
          });
        })
      .end()
  ;
})