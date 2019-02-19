
$(function() {
    $('.popover-info').popover({
        title: 'Информация о статусе',
        placement: 'top',
        trigger: 'focus'
    });
});

$('.arrival-check').on('change', function () {
    handleArrival($(this));
});

function handleArrival(checkbox) {
    var check = checkbox.prop('checked');
    var select = checkbox.parents('.modal-body').find('.sender-select');

    if (check) {
        select.hide();
    } else {
        select.show();
    }
}

$('.edit-movement').on('click', function () {
    var edit_url = $(this).data('edit-url');
    var update_url = $(this).data('update-url');
    $.ajax({
        url: edit_url
    }).done(function(data) {
        $('#movement-sender').val(data.movement.sender_id);
        $('#movement-recipient').val(data.movement.recipient_id);
        $('#movement-count').val(data.movement.count);
        $('#movement-comment').val(data.movement.comment);
        $('#movement-arrival').prop('checked', data.movement.is_arrival);

        $('#edit-movement-form').attr('action', update_url);
        handleArrival( $('#edit-movement-form .arrival-check'));
    }).always(function() {
        $('#editMovement').modal('show');
    });
});

$('.destroy-movement').on('click', function () {
    if (confirm('Вы действительно хотите удалить движение?')) {
        var id = $(this).data('id');
        $('#destroy-form-' + id).submit();
    }
});

$('.edit-replacement').on('click', function () {
    var edit_url = $(this).data('edit-url');
    var update_url = $(this).data('update-url');
    $.ajax({
        url: edit_url
    }).done(function(data) {
        $('#replacement-printer').val(data.replacement.printer_id);
        $('#replacement-replaced-date').val(data.replacement.replaced_at);
        $('#replacement-comment').val(data.replacement.comment);
        $('#edit-replacement-form').attr('action', update_url);
    }).always(function() {
        $('#editReplacement').modal('show');
    });
});

$('.destroy-replacement').on('click', function () {
    if (confirm('Вы действительно хотите удалить замену?')) {
        var id = $(this).data('id');
        $('#destroy-replacement-form-' + id).submit();
    }
});

$('body').on('click', '.edit-consumable', function () {
    var edit_url = $(this).data('edit-url');
    var update_url = $(this).data('update-url');
    $.ajax({
        url: edit_url
    }).done(function(data) {
        $('#consumable-name').val(data.consumable.name);
        $('#consumable-color').val(data.consumable.color_id);
        $('#consumable-printers').val(data.printers);
        $('#edit-consumable-form').attr('action', update_url);
    }).always(function() {
        $('#editConsumable').modal('show');
    });
});

$('body').on('click', '.destroy-consumable', function () {
    if (confirm('Вы действительно хотите удалить расходный материал?')) {
        var id = $(this).data('id');
        $('#destroy-consumable-form-' + id).submit();
    }
});

$('.printers-list tbody tr').on('click', function () {
    var row = $(this);
    var id = row.data('id');
    var printers_url = row.data('printers-url');
    var consumables_url = row.data('consumables-url');

    $('.printers-list tbody tr').removeClass('active');
    $('.printers-list tbody tr').removeClass('font-weight-bold');
    row.addClass('active');
    row.addClass('font-weight-bold');

    getPrinters(id, printers_url);
    getConsumables(id, consumables_url);

    $('.printers-title').html('Список принтеров: выбран ' + '<strong>' + row.find('td:first').text() + '</strong>');
});

function getPrinters(id, url) {
    $.ajax({
        url: url,
        data: {
            model_id: id
        }
    }).done(function(data) {
        $('#printers-list').html(data.render_view);
    });
}

function getConsumables(id, url) {
    $.ajax({
        url: url,
        data: {
            model_id: id
        }
    }).done(function(data) {
        $('#consumables-list').html(data.render_view);
    });
}