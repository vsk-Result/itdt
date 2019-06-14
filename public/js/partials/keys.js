$(function() {
    $('.select').select2();
});

$('#store-key').on('click', function() {
    $('#createKey').modal('show');
});

$('.toggle-password').on('click', function() {
    let parent = $(this).parent();
    let status = parent.attr('data-status');
    let url = parent.data('url');

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            status: status
        }
    }).done(function(data) {
        parent.find('span.password').text(data.password);
        parent.attr('data-status', data.status);
    });
});

$('.add-usage').on('click', function() {
    let container = $(this).closest('.modal-body').find('.usage-container');
    let row = container.find('.row').first().clone();

    row.find('input').each(function(index, elem) {
        $(this).val('');
    });

    container.append(row);
});

$('body').on('click', '.edit-key', function () {
    var edit_url = $(this).data('edit-url');
    var update_url = $(this).data('update-url');
    $.ajax({
        url: edit_url
    }).done(function(data) {
        $('#key-key').val(data.key.key);
        $('#key-login').val(data.key.login);
        $('#key-expire-date').val(data.key.expire_date);
        $('#key-created-at').val(data.key.created_at);
        $('#key-product').val(data.key.product);
        $('#key-password').val(data.key.password);
        $('#key-renewal-id').val(data.key.renewal_id).trigger('change');
        $('#editKey .usage-container').html('').html(data.usages);
        $('#edit-key-form').attr('action', update_url);
    }).always(function() {
        $('#editKey').modal('show');
    });
});

$('body').on('click', '.destroy-key', function () {
    if (confirm('Вы действительно хотите удалить ключ?')) {
        var id = $(this).data('id');
        $('#destroy-key-form-' + id).submit();
    }
});