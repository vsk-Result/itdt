$('body').on('click', '.edit-printer', function () {
    var edit_url = $(this).data('edit-url');
    var update_url = $(this).data('update-url');
    $.ajax({
        url: edit_url
    }).done(function(data) {
        $('#printer-name').val(data.printer.name);
        $('#printer-description').val(data.printer.description);
        $('#printer-model').val(data.printer.model_id);
        $('#printer-object').val(data.printer.object_id);
        $('#edit-printer-form').attr('action', update_url);
    }).always(function() {
        $('#editPrinter').modal('show');
    });
});

$('body').on('click', '.destroy-printer', function () {
    if (confirm('Вы действительно хотите удалить принтер?')) {
        var id = $(this).data('id');
        $('#destroy-printer-form-' + id).submit();
    }
});

$('body').on('click', '.edit-printer-model', function () {
    var edit_url = $(this).data('edit-url');
    var update_url = $(this).data('update-url');
    $.ajax({
        url: edit_url
    }).done(function(data) {
        $('#printer-model-name').val(data.model.name);
        $('#edit-printer-model-form').attr('action', update_url);
    }).always(function() {
        $('#editPrinterModel').modal('show');
    });
});

$('body').on('click', '.destroy-printer-model', function () {
    if (confirm('Вы действительно хотите удалить модель принтера?')) {
        var id = $(this).data('id');
        $('#destroy-printer-model-form-' + id).submit();
    }
});