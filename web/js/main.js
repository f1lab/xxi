$(function() {
  $('.rows-clickable tbody')
    .find('tr')
      .each(function() {
        $(this)
          .click(function() {
            document.location.href = $(this).find('a').eq(0).attr('href');
          })
        ;
      })
  ;

  $('[rel="popover"]')
    .popover({
      'trigger': 'hover'
    })
  ;

  $('table')
    .tablesorter({dateFormat: 'uk'})
  ;

  $('.makePizdatoWithDiscount')
    .find('option')
      .each(function(a, b) {
        var
          $this = $(this),
          temp = $this.text().split('|')
        ;

        $(this)
          .text(temp[0])
          .data('discount', temp[1])
        ;
      })
      .end()
    .on('change', function() {
      var
        $this = $(this),
        $element = $this.find('option[value="' + $this.val() + '"]')
      ;

      $this
        .parent()
          .find('span#discount')
            .remove()
            .end()
          .append('<span id="discount" style="padding-left: 10px">Скидка: ' + $element.data('discount') + '%</span>')
      ;
    })
  ;

  $(".chzn-select")
    .chosen()
  ;

  $('.toggler')
    .click(function() {
      $(this)
        .toggleClass('active')
      ;
    })
  ;

  $('.datetimepickable').datetimepicker({
    'language': 'ru'
  });
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
  ;

  return false;
}