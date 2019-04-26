$(document).ready(function() {
    initialize();
});

$('.article').on('click', function() {
    var show_url = $(this).data('show-url');
    var edit_url = $(this).data('edit-url');
    var update_url = $(this).data('update-url');
    var destroy_url = $(this).data('destroy-url');
    $.ajax({
        url: show_url
    }).done(function(data) {
        $('#showArticle .modal-title').text(data.article.title);
        $('#showArticle .modal-body').html(data.article.content);
        $('#showArticle .edit-article').data('edit-url', edit_url);
        $('#showArticle .edit-article').data('update-url', update_url);
        $('#showArticle #destroy-article-form').attr('action', destroy_url);
        $('#showArticle').modal('show');
    });
});

$('body').on('click', '.edit-article', function () {
    var edit_url = $(this).data('edit-url');
    var update_url = $(this).data('update-url');
    $.ajax({
        url: edit_url
    }).done(function(data) {
        $('#article-category').val(data.article.category_id).trigger('change');
        $('#article-icon').val(data.article.icon_id).trigger('change');
        $('#article-title').val(data.article.title);
        $('#article-tags').tokenfield('setTokens', data.tags);
        $('#article-content').summernote('code', data.article.content);
        $('#edit-article-form').attr('action', update_url);
    }).always(function() {
        $('#showArticle').modal('hide');
        $('#editArticle').modal('show');
    });
});

$('body').on('click', '.destroy-article', function () {
    if (confirm('Вы действительно хотите удалить статью?')) {
        $('#destroy-article-form').submit();
    }
});

function setIcon (icon) {
    if (!icon.id) { return icon.text; }
    return $('<span><i class="' + icon.element.id + ' mr-2"></i>' + icon.text + '</span>');
}

function initialize() {
    $('.summernote').summernote({
        height: 400,
        dialogsInBody: true
    });

    $('.select').select2();
    $('.select-icon').select2({
        templateResult: setIcon,
        templateSelection: setIcon
    });

    $('.tokenfield').tokenfield();
}

