/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {

    // Активный элемент меню
    var href = window.location.href;
    // $('.nav-sidebar li a').removeClass('active');
    // $('.nav-sidebar li a[href="' + href + '"]').addClass('active');
    // $('.nav-sidebar li a[href="' + href + '"]').parents('li.nav-item-submenu').addClass('nav-item-open').addClass('nav-item-expanded');

    // Hiding Flash Messages
    // $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

    // Setting datatable defaults
    // $.extend( $.fn.dataTable.defaults, {
    //     dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
    //     ordering: true,
    //     autoWidth: false,
    //     responsive: true,
    //     language: {
    //         "processing": "Подождите...",
    //         "search": "Поиск: ",
    //         "lengthMenu": "Показать _MENU_ записей",
    //         "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
    //         "infoEmpty": "Записи с 0 до 0 из 0 записей",
    //         "infoFiltered": "(отфильтровано из _MAX_ записей)",
    //         "infoPostFix": "",
    //         "loadingRecords": "Загрузка записей...",
    //         "zeroRecords": "Записи отсутствуют.",
    //         "emptyTable": "В таблице отсутствуют данные",
    //         "paginate": {
    //             "first": "Первая",
    //             "previous": "Предыдущая",
    //             "next": "Следующая",
    //             "last": "Последняя"
    //         },
    //         "aria": {
    //             "sortAscending": ": активировать для сортировки столбца по возрастанию",
    //             "sortDescending": ": активировать для сортировки столбца по убыванию"
    //         }
    //     }
    // });
});