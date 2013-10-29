<h1 class="page-header">
  Планирование
</h1>

<div class="row-fluid">
  <div class="span3">
    <?php if (!$sf_user->hasGroup('master')): ?><div class="well well-small">
      <h4>Фильтр</h4>

      <form id="works-filter">
        <?php echo $filter->renderUsing('bootstrap') ?>
      </form>
    </div><?php endif ?>

    <?php if ($sf_user->hasCredential('сan_edit_planning')): ?><div id='new-events' class="well well-small">
      <h4>Нераспределённые работы</h4>

      <ul class="unstyled emptable"><?php foreach ($refs as $ref): ?>
        <li class="fc-event fc-event-draggable fc-event-start fc-event-end fc-event-vert event-of-area-<?php echo $ref->getWork()->getArea()->getSlug() ?>" data-id="<?php echo $ref->getId() ?>" data-area-slug="<?php echo $ref->getWork()->getArea()->getSlug() ?>">
          <span class="name">
            <?php echo $ref->getWork()->getNameWithArea() ?>
          </span>
        </li>
      <?php endforeach ?></ul>

      <div class="alert alert-info">Нет работ.</div>
    </div><?php endif ?>
  </div>

  <div id='calendar' class="span9"></div>
</div>

<p><br /></p>
<p><br /></p>
<p><br /></p>

<script>
$(function() {
  var isMaster = <?php echo $sf_user->hasGroup('master') ? 'true' : 'false' ?>
    , isSuper = <?php echo $sf_user->hasCredential('can_finish_any_work_ref') ? 'true' : 'false' ?>

  var clickHandler = function(event, e) {
    e.preventDefault();

    var modalNode = $('#event-details')
      .find('.modal-body')
        .html('<p>Загружаю…</p>')
        .end()
      .find('.modal-footer')
        .removeClass(isMaster||isSuper ? 'hide' : '')
        .find('a')
          .attr('href', '<?php echo url_for('plan/finishRef?id=') ?>' + event.id)
          .end()
        .end()
      .modal()

    $.get('<?php echo url_for('plan/modal?id=') ?>' + event.id)
      .done(function(data) {
        modalNode
          .find('.modal-body')
            .html(data)
      })
      .fail(function() {
        modalNode
          .find('.modal-body')
            .html('<div class="alert alert-error">Ошибка получения данных :(</div>')
      })

    return false;
  }

  , changeHandler = function(event) {
    $.post('<?php echo url_for('plan/planEvent') ?>', {
      event: $.extend({}, event, {
        start: (new Date(event.start)).getTime()/1000
        , end: (new Date(event.end)).getTime()/1000
      })
    })
    .fail(function() {
      alert('Ошибка установления даты для работы :(');
    })
    .always(function() {
      $('#calendar').fullCalendar('refetchEvents');
    })
  }

  , filterChangeHandler = function() {
    $('#calendar').fullCalendar('refetchEvents');
  }

  $('#new-events .fc-event').each(function() {
    var eventObject = {
      id: $(this).data('id')
      , title: $.trim($(this).find('.name').text())
      , className: 'event-of-area-' + $(this).data('area-slug')
      , allDay: false
    };

    $(this)
      .data('eventObject', eventObject)
      .draggable({
        zIndex: 999,
        revert: true,
        revertDuration: 0
      })
  });

  $(document).on('click', '#new-events .fc-event', function(e) {
    clickHandler.call(this, $(this).data('eventObject'), e);
  });
  $('#works-filter-area, #works-filter-master').change(filterChangeHandler);

  $('#calendar').fullCalendar({
    editable: <?php echo $sf_user->hasCredential('сan_edit_planning') ? 'true' : 'false' ?>
    , droppable: true

    , drop: function(date) {
      var eventObject = $.extend($(this).data('eventObject'), {start: date})
      $('#calendar').fullCalendar('renderEvent', eventObject);

      $.post('<?php echo url_for('plan/planEvent') ?>', {
        event: $.extend({}, eventObject, {
          start: (new Date(eventObject.start)).getTime()/1000
        })
      })
      .fail(function() {
        alert('Ошибка установления даты для работы :(');
      })
      .always(function() {
        $('#calendar').fullCalendar('refetchEvents');
      })

      $(this).remove();
    }

    , eventDrop: changeHandler
    , eventResize: changeHandler
    , eventClick: clickHandler

    , eventSources: [{
      url: '<?php echo url_for('plan/eventsource') ?>'
      , data: function() {
        return {
          'filter': isMaster
            ? 'works-filter-master%5B%5D=<?php echo $sf_user->getGuardUser()->getId() ?>'
            : $('#works-filter').serialize()
        }
      }
    }]

    , firstDay: 1
    /* , minTime: 8
    , maxTime: 22 */
    , header: {
      left: 'agendaWeek month'
      , center: 'title'
    }
    , defaultView: 'agendaWeek'
    , timeFormat: 'H:mm'
    , axisFormat: 'H:mm'
    , allDaySlot: false
    , monthNames: ['Январь','Февраль','Март','Апрель','Май','οюнь','οюль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь']
    , monthNamesShort: ['Янв.','Фев.','Март','Апр.','Май','οюнь','οюль','Авг.','Сент.','Окт.','Ноя.','Дек.']
    , dayNames: ["Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота"]
    , dayNamesShort: ["ВС","ПН","ВТ","СР","ЧТ","ПТ","СБ"]
    , buttonText: {
      prev: "&nbsp;&#9668;&nbsp;"
      , next: "&nbsp;&#9658;&nbsp;"
      , prevYear: "&nbsp;&lt;&lt;&nbsp;"
      , nextYear: "&nbsp;&gt;&gt;&nbsp;"
      , today: "Сегодня"
      , month: "Месяц"
      , week: "Неделя"
      , day: "День"
    }
  });
});
</script>

<style type="text/css">
  #new-events .fc-event+.fc-event {
    margin-top: 1em;
  }
</style>

<div class="modal hide" id="event-details">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Подробнее!</h3>
  </div>
  <div class="modal-body"></div>
  <div class="modal-footer hide">
    <a href="#" class="btn btn-success">Я всё сделал!</a>
  </div>
</div>
