$(document).ready(function() {
    var date = new Date();
    var m = date.getMonth();
    var y = date.getFullYear();
    $('#calendar').fullCalendar({
        header: {
            left:   'prev,next,today',
            center: 'title',
            right:  'month,agendaWeek,agendaDay'
        },
        editable: true,
        fixedWeekCount: false,
        theme: false,
        selectable: true,
        selectHelper: true,
        eventOrder: ['order_id', 'title'],
        events: {
            url: '/events/pidr',
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
              $('.new-event-start-date').val(isoDate);
              $('.new-event-end-date').val(isoDate);
              $('#vlad').modal('show');
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
              url: '/events/show',
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
                      url: '/events/mr/status',
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
                  url: '/events/mr/status',
                  dataType: 'json',
                  data:
                      {
                          id: id,
                          status_id: status_id,
                      }
              })
                  .done(function(data) {
                      var current_event = $('#calendar').fullCalendar('clientEvents', data.event.id );
                      var color = ['bgm-deeporange', 'bgm-green'];
                      current_event[0].className = color[data.event.confirmed];
                      $('#calendar').fullCalendar('updateEvent', current_event[0]);
                  })
                  .fail(function(data) {
                      error_report('error event_mr change status');
                  });
          }


      }

      //Update/Delete an Event
      $('body').on('click', '[data-calendar]', function(){
        var calendarAction = $(this).data('calendar');
        var currentId = $('.edit-event-id').val();
        var currentTitle = $('.edit-event-title').val();
        var currentDesc = $('.edit-event-description').val();
        var currentClass = $('.event-tag-edit input:checked').val();
        var currentEvent = $('#calendar').fullCalendar( 'clientEvents', currentId );

        //Update
        if(calendarAction === 'update') {
          if (currentTitle != '') {
            currentEvent[0].title = currentTitle;
            currentEvent[0].description = currentDesc;
            currentEvent[0].className = currentClass;

            $('#calendar').fullCalendar('updateEvent', currentEvent[0]);
            $('#modal-edit-event').modal('hide');
          }
          else {
            $('.edit-event-title').closest('.form-group').addClass('has-error');
            $('.edit-event-title').focus();
          }
        }

        //Delete
        if(calendarAction === 'delete') {
          $('#modal-edit-event').modal('hide');

          setTimeout(function () {
            swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then(function() {
              target.fullCalendar('removeEvents', currentId);
              swal(
                'Deleted!',
                'Your list has been deleted.',
                'success'
              );
            });
          }, 200);
        }
      });


      //Calendar views switch
      $('body').on('click', '[data-calendar-view]', function(e){
        e.preventDefault();

        $('[data-calendar-view]').removeClass('active');
        $(this).addClass('active');
        var calendarView = $(this).attr('data-calendar-view');
        target.fullCalendar('changeView', calendarView);
      });


      //Calendar Next
      $('body').on('click', '.calendar-next', function (e) {
        e.preventDefault();
        target.fullCalendar('next');
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
        var modal = $('#dima');
        modal.find('.modal-content').html(data);
        autosize(modal.find('.auto-size'));
        modal.modal('show');
      })
      .fail(function(data) {
        error_report('error event_mr_modal');
      });

    }
