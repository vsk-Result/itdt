
var calendar = $('#calendar');
var modal_default = $('#modalDefault');
var all_url = calendar.data('all-url');
var create_url = calendar.data('create-url');
var update_url = calendar.data('update-url');
var edit_url = calendar.data('edit-url');
var destroy_url = calendar.data('destroy-url');
var status_url = calendar.data('status-url');
var show_url = calendar.data('show-url');

$(document).ready(function() {
    calendar.fullCalendar({
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
            url: all_url,
            success:function(data) {
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
                url: create_url,
            }).done(function(data) {
                modal_default.find('.modal-content').html(data);
                $('.new-event-start-date, .new-event-end-date').val(isoDate);
                modal_default.modal('show');
            });
        },

        viewRender: function (view) {
            var calendarDate = $("#calendar").fullCalendar('getDate');
            var calendarMonth = calendarDate.month();

            $('#calendar .fc-toolbar').attr('data-calendar-month', calendarMonth);
            $('.block-header-calendar > h2 > span').html(view.title);
        },

        eventClick: function (event) {
            modal(event.id);
        },

        eventDrop: function (event) {
            $.ajax({
                url: update_url,
                type: 'POST',
                data: {
                    id: event.id,
                    start_date: event.start.format('YYYY-MM-DD'),
                    start_time: event.start.format('HH:mm'),
                    end_date: event.end.format('YYYY-MM-DD'),
                    end_time: event.end.format('HH:mm'),
                }
            });
        }
    });
});

$('body').on('click', '#vlad', function() {
    var id = $(this).data('event-id');
    $.ajax({
        url: edit_url,
        data: {
            id: id
        }
    }).done(function(data) {
        modal_default.find('.modal-content').html(data);
        modal_default.modal('show');
    });
});

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
    destroy_event(id);
});

function destroy_event(id) {
    if (confirm('Вы действительно хотите удалить бронь?')) {
        $.ajax({
            url: destroy_url,
            data: {
                id: id,
            }
        }).done(function(data) {
            calendar.fullCalendar('removeEvents', id);
            modal_default.modal('hide');
        });
    }
}

function event_change_status(id, status_id) {
    $.ajax({
        url: status_url,
        data: {
            id: id,
            status_id: status_id,
        }
    }).done(function(data) {
        var current_event = calendar.fullCalendar('clientEvents', data.event.id );
        var color = ['bg-warning', 'bg-success'];
        current_event[0].className = color[data.event.confirmed];
        calendar.fullCalendar('updateEvent', current_event[0]);
    });
}

function modal(id) {
    $.ajax({
        url: show_url,
        data: {
            id: id
        }
    }).done(function(data) {
        modal_default.find('.modal-content').html(data);
        modal_default.modal('show');
    });
}
