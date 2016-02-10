(function() {
  /**
   * Корректировка округления десятичных дробей.
   *
   * @param {String}  type  Тип корректировки.
   * @param {Number}  value Число.
   * @param {Integer} exp   Показатель степени (десятичный логарифм основания корректировки).
   * @returns {Number} Скорректированное значение.
   */
  function decimalAdjust(type, value, exp) {
    // Если степень не определена, либо равна нулю...
    if (typeof exp === 'undefined' || +exp === 0) {
      return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // Если значение не является числом, либо степень не является целым числом...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
      return NaN;
    }
    // Сдвиг разрядов
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // Обратный сдвиг
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
  }

  // Десятичное округление к ближайшему
  if (!Math.round10) {
    Math.round10 = function(value, exp) {
      return decimalAdjust('round', value, exp);
    };
  }
  // Десятичное округление вниз
  if (!Math.floor10) {
    Math.floor10 = function(value, exp) {
      return decimalAdjust('floor', value, exp);
    };
  }
  // Десятичное округление вверх
  if (!Math.ceil10) {
    Math.ceil10 = function(value, exp) {
      return decimalAdjust('ceil', value, exp);
    };
  }
})();

$(function() {
  $(".addNewOrdersTableFilter").click(function(event) {
    var name = prompt("Название нового фильтра");
    if (name === null) {
      event.preventDefault();
      return false;
    }

    if (name === "") {
      alert("Имя обязательно для заполнения");
      event.preventDefault();
      return false;
    }

    var isDefault = confirm("Использовать по-умолчанию?");

    $('#filter-saver-name').val(name);
    $('#filter-saver-is-default').val(+isDefault);

    $(this).parents('form').attr('action', App['add-new-orders-table-filter']);
  });

  $('.calculate-cost').click(function(event) {
    event.preventDefault();

    var rows = $(this).parents('table').find('tr:has(input[type=number])')
      , total = 0
    ;
    rows.each(function() {
      var $row = $(this)
        , number = $row.find('.invoice-number')
        , price = $row.find('.invoice-price')
        , sum = $row.find('.invoice-sum')
        , newSum = Math.round10(number.val() * price.val(), -2)
      ;

      if (newSum > 0) {
        sum.val(newSum);
        total += newSum;
      }
    });

    $('#order_cost').val(total);
  });

  $(".submit-on-select-change")
    .find("select").eq(0)
    .change(function() {
      $(this).parents("form").submit();
    })
  ;

  $('.rows-clickable tbody')
    .find('tr')
      .each(function() {
        $(this)
          .click(function() {
            document.location.href = $(this).find('a').eq(0).attr('href');
          })
      })

  $('[rel="popover"]').popover({
    'trigger': 'hover'
  })

  $('table').tablesorter({dateFormat: 'uk'})

  $('.makePizdatoWithDiscount')
    .find('option')
      .each(function(a, b) {
        var $this = $(this)
          , temp = $this.text().split('|')

        $(this)
          .text(temp[0])
          .data('discount', temp[1])
      })
      .end()
    .on('change', function() {
      var $this = $(this)
        , $element = $this.find('option[value="' + $this.val() + '"]')

      $this
        .parent()
          .find('span#discount')
            .remove()
            .end()
          .append('<span id="discount" style="padding-left: 10px">Скидка: ' + ($element.data('discount')||0) + '%</span>')
    })

  $(".chzn-select").chosen({
    allow_single_deselect: true
  })

  $('.toggler')
    .click(function() {
      $(this).toggleClass('active')
    })

  $('.datetimepickable').datetimepicker({
    'language': 'ru',
    'weekStart': 1
  });

  $('.add-remove-chzn-for-relations')
    .find('tr')
      .on('beforeclone.ah', function() {
        $(this)
          .find('.chzn-select')
            .show()
              .removeClass('chzn-done')
              .next()
                .remove()
      })
      .on('afteradd.ah', function() {
        $('.chzn-select').chosen();
      })

  $('.add-remove-datetimepicker-for-relations')
    .find('tr')
      .on('beforeclone.ah', function() {
        $(this)
          .find('.datetimepickable')
            .datetimepicker('remove')
      })
      .on('afteradd.ah', function() {
        $('.datetimepickable').datetimepicker({
          'language': 'ru'
        });
      })

  $(document)
    .on('change', 'select.area-selector', function() {
      var that = $(this)
        , works = that.parents('tr').find('.work-selector')
        , masters = that.parents('tr').find('.master-selector')

      $.getJSON('/frontend_dev.php/main/getWorksAndMastersForArea', {id: that.val()}, function(data) {
        works
          .html(data.works)
          .trigger('liszt:updated')

        masters
          .html(data.masters)
          .trigger('liszt:updated')
      });
    })

    .on("click", ".confirm", function() {
      return confirm("Вы уверены?");
    })

    .on("submit", "#orders-quick-search", function(e) {
      e.preventDefault();

      var id = +$(this).find("input").val()
        , url = $(this).data("action")
      ;

      if (id > 0) {
        document.location.href = url + id;
      }
    })

    .on('change', '.makePizdatoWithDiscount', function(e) {
      $.getJSON(App['get-client-credit-info'], {
        id: $(this).val()
      }, function(creditInfo) {
        console.log(creditInfo);
        $('.alerts .alert').addClass('hide');

        if (creditInfo['orders-count'] < 1) {
          $('.alert.first-order').removeClass('hide');
        }

        if (creditInfo['is-blacklisted']) {
          $('.alert.blacklisted').removeClass('hide');
        }

        if (creditInfo['credit-line']) {
          if (creditInfo['credit-line'] < creditInfo['debt']) {
            $('.alert.credit-bad')
              .removeClass('hide')
              .find('span')
                .eq(0)
                  .text(creditInfo['credit-line'])
                  .end()
                .eq(1)
                  .text(creditInfo['debt'])
                  .end()
            ;
          } else {
            $('.alert.credit-ok')
              .removeClass('hide')
              .find('span')
                .text(creditInfo['credit-line'])
                .end()
            ;
          }
        }
      });
    })

    .on("click", "#add-new-client-from-order-form", function(e) {
      e.preventDefault();

      var button = $(this)
        , select = button.parent().find("select")
        , form = $($("#template-add-new-client").html())
        , modal = bootbox.dialog(form, [{
          label: "Добавить"
          , "class": "btn-primary"
          , callback: function() {
            var submited = form.serializeObject()
            ;

            if (submited.name && submited.contact && submited.phone) {
              form.find(".fill-form").addClass("hide");

              $.post(App["add-new-client"], submited)
                .done(function() {
                  form.find(".try-again").addClass("hide");

                  $.getJSON(App["dump-all-clients"], function(clients) {
                    select.empty();

                    var option = $("<option></option>")
                    ;

                    $.each(clients, function() {
                      var newOption = option.clone()
                        , text = this.pop()
                        , value = this.pop()
                      ;

                      if (submited.name === text) {
                        newOption.attr("selected", "selected");
                      }

                      select.append(newOption.text(text).val(value));
                    });

                    select.trigger("liszt:updated").trigger("open");
                  });

                  modal.modal("hide");
                })
                .fail(function() {
                  form.find(".try-again").removeClass("hide");
                })
              ;

              return false;
            } else {
              form.find(".fill-form").removeClass("hide");
              form.find(".try-again").addClass("hide");
              return false;
            }
          }
        }, {
          label: "Отменить"
          , "class": "btn"
        }], {
          header: "Добавить клиента"
        })
      ;

      modal
        .on("shown", function(e) {
          form.find("input:first").focus();
        })
        .on("hidden", function(e) {
          form.find(":focus").blur();
        })
      ;
    })

    .on("click", "#add-new-material-from-arrival-form", function(e) {
      e.preventDefault();

      var button = $(this)
        , select = $('.copy-me .chzn-select').last()
        , form = $($("#template-add-new-material").html())
        , modal = bootbox.dialog(form, [{
          label: "Добавить"
          , "class": "btn-primary"
          , callback: function() {
            var submited = form.serializeObject()
            ;

            if (submited.name && submited.dimension_id) {
              form.find(".fill-form").addClass("hide");

              $.post(App["add-new-material"], submited)
                .done(function() {
                  form.find(".try-again").addClass("hide");

                  $.getJSON(App["dump-all-materials"], function(materials) {

                    var option = $("<option></option>")
                      , selected = select.val()
                    ;
                    select.empty();

                    $.each(materials, function() {
                      var newOption = option.clone()
                        , text = this.pop()
                        , value = this.pop()
                      ;
                      select.append(newOption.text(text).val(value));
                    });
                    select.val(selected);

                    select.trigger("liszt:updated").trigger("open");
                  });

                  modal.modal("hide");
                })
                .fail(function() {
                  form.find(".try-again").removeClass("hide");
                })
              ;

              return false;
            } else {
              form.find(".fill-form").removeClass("hide");
              form.find(".try-again").addClass("hide");
              return false;
            }
          }
        }, {
          label: "Отменить"
          , "class": "btn"
        }], {
          header: "Добавить материал"
        })
      ;

      modal
        .on("shown", function(e) {
          form.find("input:first").focus();
        })
        .on("hidden", function(e) {
          form.find(":focus").blur();
        })
      ;
    })
  ;
});

function resetNearestSelect(that) {
  $(that)
    .parent()
      .find('select')
        .eq(0)
          .find('option[selected]')
            .removeAttr('selected')
            .end()
          .trigger('liszt:updated')

  return false;
}
