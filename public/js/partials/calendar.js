$(document).ready(function() {
    var date = new Date();
    var m = date.getMonth();
    var y = date.getFullYear();
    $('#calendar').fullCalendar({
        header: {
            left: '',
            center: 'title',
            right:  'today,prev,next',
        },
        editable: true,
        fixedWeekCount: false,
        theme: false,
        selectable: false,
        selectHelper: true,
        eventOrder: ['order_id', 'title'],
        events: {
            url: '/events/all',
            success:function(data){
                var events = [];

                $.each(data.events, function(key, event) {
                  events.push(event);
                });

                return events;
              }
          },
          dayClick: function(date) {
            var isoDate = moment(date).toISOString();

            $.ajax({
              url: '/events/event_create',
            })
            .done(function(data) {
              $('#modalDefault').find('.modal-content').html(data);
              $('.new-event-start-date').val(isoDate);
              $('.new-event-end-date').val(isoDate);
              $('#modalDefault').modal('show');
            })
            .fail(function(data) {
              error_report('error event_create modal');
            });
          },

          viewRender: function (view) {
            var calendarDate = $("#calendar").fullCalendar('getDate');
            var calendarMonth = calendarDate.month();

            //Set data attribute for header. This is used to switch header images using css
            $('#calendar .fc-toolbar').attr('data-calendar-month', calendarMonth);

            //Set title in page header
            $('.block-header-calendar > h2 > span').html(view.title);
          },

          eventClick: function (event) {
              if (event.allDay !== true) {
                modal(event.id);
              }
          },

          eventDrop: function (event) {
            $.ajax({
              url: '/events/update',
              dataType: 'json',
              data:
              {
                id: event.id,
                start_date: event.start.format('YYYY-MM-DD'),
                start_time: event.start.format('HH:mm'),
                end_date: event.end.format('YYYY-MM-DD'),
                end_time: event.end.format('HH:mm'),
              }
            })
            .done(function(data) {
              console.log("success");
            })
            .fail(function(data) {
              error_report('Ошибка js event_drop!');
          });
        }
      });

      $('body').on('click', '#vlad', function() {
          var id = $(this).data('event-id');
              $.ajax({
                url: '/events/edit/' + id,
              })
              .done(function(data) {
                $('#modalDefault').find('.modal-content').html(data);
                $('#modalDefault').modal('show');
              })
      });
      // Confirm/Define event
      $('body').on('click', '.event-confirm', function(){
        var id = $(this).data('id');
        event_change_status(id, 1);
      });

      $('body').on('click', '.event-define', function(){
        var id = $(this).data('id');
        event_change_status(id, 0);
      });

      $('body').on('click', '.event-destroy', function(){
        var id = $(this).data('id');
        event_change_status(id, -1);
      });

      function event_change_status(id, status_id) {
          if (status_id == -1) {
              if (confirm('Вы действительно хотите удалить бронь?')) {
                  $.ajax({
                      url: '/events/status',
                      dataType: 'json',
                      data:
                          {
                              id: id,
                              status_id: status_id,
                          }
                  }).done(function(data) {
                      $('#calendar').fullCalendar('removeEvents', data.id);
                      window.location.reload();
                  }).fail(function(data) {
                      error_report('error event_mr change status');
                  });
              }
          } else {
              $.ajax({
                  url: '/events/status',
                  dataType: 'json',
                  data:
                      {
                          id: id,
                          status_id: status_id,
                      }
              })
                  .done(function(data) {
                      var current_event = $('#calendar').fullCalendar('clientEvents', data.event.id );
                      var color = ['bg-warning', 'bg-success'];
                      current_event[0].className = color[data.event.confirmed];
                      $('#calendar').fullCalendar('updateEvent', current_event[0]);
                  })
                  .fail(function(data) {
                      error_report('error event_mr change status');
                  });
          }
      }
      //Calendar Next
      $('body').on('click', '.calendar-next', function (e) {
        e.preventDefault();
        $('#calendar').fullCalendar('next');
      });


      //Calendar Prev
      $('body').on('click', '.calendar-prev', function (e) {
        e.preventDefault();
        target.fullCalendar('prev');
      });
    });

    function modal(id) {
      $.ajax({
        url: '/events/modal/' + id,
      })
      .done(function(data) {
        $('#modalDefault').find('.modal-content').html(data);
        $('#modalDefault').modal('show');
      })
      .fail(function(data) {
        error_report('error event_mr_modal');
      });

    }
