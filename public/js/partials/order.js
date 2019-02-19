$('.count-field').on('change', function() {
    var input = $(this);
    var count = input.val();
    var parent = input.parents('.dropdown-item');

    parent.removeClass('filled');
    if (count > 0) {
        parent.addClass('filled');
    }
});