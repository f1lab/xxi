<script type="text/javascript">
  var products = {
    /* 'sfp-solvet': {
      'materials': [
        {
          'name': 'Баннер литой 510г.',
          'widths': [
            '1,37',
            '2,5',
            '3,2'
          ]
        },
        {
          'name': 'Баннер литой 460г.',
          'widths': [
            '3,2'
          ]
        },
        {
          'name': 'Баннер ламинированный 440г.',
          'widths': [
            '1,37',
            '2,5',
            '3,2'
          ]
        },
        {
          'name': 'Баннер ламинированный  340г.',
          'widths': [
            '1,37',
            '2,5',
            '3,2'
          ]
        },
        {
          'name': 'Баннер ламинированный  300г.',
          'widths': [
            '3,2'
          ]
        },
        {
          'name': 'Баннер транслюсцентный 600г.',
          'widths': [
            '1,37',
            '2,5',
            '3,2'
          ]
        },
        {
          'name': 'Баннерная сетка 370г.',
          'widths': [
            '1,6',
            '3,2'
          ]
        },
        {
          'name': 'Самоклеящаяся пленка матовая/глянцевая 140г/м^2, 85мкр.',
          'widths': [
            '1,37',
            '1,52'
          ]
        },
        {
          'name': 'Самоклеящаяся пленка транслюсцентная 120г/м^2, 80мкр.',
          'widths': [
            '1,37'
          ]
        },
        {
          'name': 'Самоклеящаяся пленка перфорированная для оконной графики',
          'widths': [
            '1,37',
            '1,52'
          ]
        },
        {
          'name': 'Синтетический холст 160 г/м^2',
          'widths': [
            '1,52',
            '1,8'
          ]
        }
      ],
      'cost': 'formula',
      'extra': 'formula',
      'options': {
        'prokleika': [
          'не требуется',
          'по периметру',
          'верх',
          'низ',
          'лево',
          'право',
          'верх-низ',
          'лево-право'
        ],
        'skleika': [
          'не требуется',
          'по горизонтали',
          'по вертикали'
        ],
        'rezka': [
          'не требуется',
          'по периметру',
          'верх',
          'низ',
          'лево',
          'право',
          'верх-низ',
          'лево-право'
        ],
        'fields': [0,1,3,5,10,15,20],
        'klapani': [
          'не требуется',
          '3 на на м²',
          '4 на на м²',
        ],
        'luversi': {
          'variants': [
            'не требуется',
            'по периметру',
            'верх',
            'низ',
            'лево',
            'право',
            'верх-низ',
            'лево-право',
            'по углам',
          ],
          'space': [10,20,30,40,50,100]
        }
      }
    }, */
    /* 'sfp-solvet-eco': {
      'materials': [
      
      ],
      'cost': 'formula',
      'extra': 'formula'
    }, */
    'stickers': {
      'materials': [
        {
          'name': 'Самоклеящаяся пленка (глянцевая/матовая/прозрачная) 140г/м^2, 85мкр',
          'widths': [
            '137',
            '152'
          ]
        }, {
          'name': 'Самоклеящаяся пленка металик  (серебро/золото) 140г/м^2, 85мкр',
          'widths': [
            '137'
          ]
        }
      ],
      'cost': 'some formula',
      'extra': 'some formula',
      'options': {
        'lamination': [
          'не требуется',
          'требуется'
        ],
        'fields': [0,1,3,5,10,15,20]
      }
    }
  };

var calculator = products.stickers;

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
  + '  <label for="materials" class="control-label">Материал / ширина рулона</label>'
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
 

  $('#fields-container')
    .html(controlTemplate.replace(/\$ID/g, 'fields').replace('$LABEL', 'Поля'))
      .find('#fields')
        .fillSelect(calculator.options.fields)
  ;

  $('#materials-container')
    .html(renderMaterialsChooser(calculator.materials))
      .find('#materials')
        .change(function() {
          console.log($('#widths') && true);
          $('#widths') || (
            $('#widths-container')
              .html(controlTemplate.replace(/\$ID/g, 'widths').replace('$LABEL', 'Ширина рулона'))
              .find('#widths')
          )
            .fillSelect(($(this).find(':selected').data('widths') + ',').split(','))
          ;

          
        })
      .end()
  ;
})
</script>

<form action="" method="post" class="form-horizontal">
  <div class="control-group" id="materials-container">
    
  </div>

  <div class="control-group" id="widths-container">
    
  </div>

  <div class="options-container">
    <div class="control-group" id="fields-container">
      
    </div>

    
  </div>
</form>
