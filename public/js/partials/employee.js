$('#userFilter').on('input', function(e) {
    let text = $(this).val();
    let url = $(this).data('filter-url');

    if (text.length >= 1) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                text: text
            },
        }).done(function(data) {
            $('#search-result-container').html(data.view_render);
            updateSearchInfo('Сотрудников найдено: ' + data.count);
        });
    } else {
        getUsersOnline();
    }
});

$('#toster').on('click', function() {
    setTimeout(function() {
        $('#userFilter').focus();
        getUsersOnline();
    }, 300);
});

function getUsersOnline() {
    let url = $('#userFilter').data('online-url');
    $.ajax({
        url: url,
        type: 'POST',
    }).done(function(data) {
        $('#search-result-container').html(data.view_render);
        updateSearchInfo('Сотрудников онлайн: ' + data.count);
    });
}

function updateSearchInfo(text) {
    $("#search-result-info").text(text);
}
