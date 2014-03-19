$(function() {
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

  $(".chzn-select").chosen()

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
          header: "Добавить групповой диалог"
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
