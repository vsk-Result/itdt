$(function() {
    var elems = Array.prototype.slice.call(document.querySelectorAll('.form-check-input-switchery'));
    elems.forEach(function(html) {
        var switchery = new Switchery(html);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    filter_active_enabled = false;
    updateObjects();
});

$('body').on('click', '#objects-active', function(e) {
    filter_active_enabled = !filter_active_enabled;
    updateObjects();
});

function updateObjects() {

    var container = $('#objects-container');

    $(container).block({
        message: '<i class="icon-spinner spinner"></i>',
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'none'
        }
    });

    var url = container.data('url');
    var is_active = !filter_active_enabled;
    $.ajax({
        url: url,
        data: {
            is_active: is_active
        }
    }).done(function (data) {
        container.html(data.view_render);
    }).always(function() {
        $(container).unblock();
    });
}