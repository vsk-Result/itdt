$('body').on('click', '.edit-sparepart', function () {
    var edit_url = $(this).data('edit-url');
    var update_url = $(this).data('update-url');
    $.ajax({
        url: edit_url
    }).done(function(data) {
        $('#sparepart-name').val(data.sparepart.name);
        $('#sparepart-part-number').val(data.sparepart.part_number);
        $('#sparepart-url').val(data.sparepart.url);
        $('#sparepart-printer-model').val(data.sparepart.model_id).trigger('change');
        $('#edit-sparepart-form').attr('action', update_url);
    }).always(function() {
        $('#editSparepart').modal('show');
    });
});

$('body').on('click', '.destroy-sparepart', function () {
    if (confirm('Вы действительно хотите удалить запчасть?')) {
        var id = $(this).data('id');
        $('#destroy-sparepart-form-' + id).submit();
    }
});