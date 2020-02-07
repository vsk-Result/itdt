<<<<<<< refs/remotes/origin/master
<<<<<<< refs/remotes/origin/master
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
=======

$('#test').on('input', function(e) {
=======
$('#userFilter').on('input', function(e) {
>>>>>>> Онлайн пользователей, поиск по сотрудникам, карточка сотрудника, доступ на изменение, сотрудники (#31)
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
<<<<<<< refs/remotes/origin/master
>>>>>>> писос
=======

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
>>>>>>> Онлайн пользователей, поиск по сотрудникам, карточка сотрудника, доступ на изменение, сотрудники (#31)
