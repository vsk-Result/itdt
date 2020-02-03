
$('#test').on('input', function(e) {
    let text = $(this).val();
    let url = $(this).data('filter-url');
    $.ajax({
        url: url,
        data: {
            text: text
        },
    }).done(function(data) {
        $('#search-result-container').html(data.view_render);
    });
});

$('#toster').on('click', function() {
    setTimeout(function() {
        $('#test').focus();
    }, 300);
});
