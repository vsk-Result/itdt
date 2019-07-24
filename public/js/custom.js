
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function() {
    $('.form-check-input-styled').uniform();
    updateSignExternalLink();
});

$('.sign-company').on('click', updateSignExternalLink);

function updateSignExternalLink() {
    var external_link = $('.sign-company:checked').data('url');
    $('#sign-external-link').val(external_link).select();
}