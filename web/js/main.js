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
    .tablesorter()
  ;

  $(".chzn-select")
    .chosen()
  ;
});