
// Setup module
// ------------------------------

var TaskManagerList = function () {

    //
    // Setup components
    //

    // Datatable
    var _componentDatatable = function() {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }

        // Create an array with the values of all the input boxes in a column
        $.fn.dataTable.ext.order['dom-text'] = function (settings, col) {
            return this.api().column(col, {order:'index'}).nodes().map( function (td, i) {
                return $('input', td).val();
            });
        };

        // Create an array with the values of all the select options in a column
        $.fn.dataTable.ext.order['dom-select'] = function (settings, col) {
            return this.api().column(col, {order:'index'}).nodes().map( function (td, i) {
                return $('select', td).val();
            });
        };

        // Initialize data table
        $('.tasks-list').DataTable({
            autoWidth: false,
            ordering: false,
            paginate: false,
            columnDefs: [
                {
                    type: "natural",
                    width: '5%',
                    targets: 0
                },
                {
                    targets: 1,
                    visible: false
                },
                {
                    width: '40%',
                    targets: 2
                },
                {
                    width: '15%',
                    targets: 3
                },
                {
                    width: '10%',
                    targets: 4
                },
                {
                    width: '10%',
                    targets: 5
                },
                {
                    width: '15%',
                    targets: 6
                }
            ],
            dom: '<"datatable-header"fl><"datatable-scroll-lg"t><"datatable-footer"ip>',
            language: {
                search: '<span>Поиск:</span> _INPUT_',
                searchPlaceholder: 'Найти в таблице...',
                lengthMenu: '<span>Показать:</span> _MENU_',
                paginate: { 'первая': 'Первая', 'последняя': 'Последняя', 'следующая': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'предыдущая': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
            },
            drawCallback: function (settings) {
                var api = this.api();
                var rows = api.rows({page:'current'}).nodes();
                var last=null;

                // Grouod rows
                api.column(1, {page:'current'}).data().each(function (group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                            '<tr class="table-active table-border-double"><td colspan="8" class="font-weight-semibold">'+group+'</td></tr>'
                        );

                        last = group;
                    }
                });

                // Initialize components
                // _componentUiDatepicker();
                _componentSelect2();
            }
        });
    };

    // Datepicker
    var _componentUiDatepicker = function() {
        if (!$().datepicker) {
            console.warn('Warning - jQuery UI components are not loaded.');
            return;
        }

        // Initialize
        $('.datepicker').datepicker({
            showOtherMonths: true,
            dateFormat: 'd MM, y'
        });
    };

    // Select2
    var _componentSelect2 = function() {
        if (!$().select2) {
            console.warn('Warning - select2.min.js is not loaded.');
            return;
        }

        // Initialize
        $('.form-control-select2').select2({
            minimumResultsForSearch: Infinity
        });

        // Length menu styling
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentDatatable();
            _componentSelect2();
        }
    }
}();

var InputsCheckboxesRadios = function () {

    //
    // Setup components
    //

    // Uniform
    var _componentUniform = function() {
        if (!$().uniform) {
            console.warn('Warning - uniform.min.js is not loaded.');
            return;
        }

        // Default initialization
        $('.form-check-input-styled').uniform();
    };

    // Switchery
    var _componentSwitchery = function() {
        if (typeof Switchery == 'undefined') {
            console.warn('Warning - switchery.min.js is not loaded.');
            return;
        }

        // Initialize multiple switches
        var elems = Array.prototype.slice.call(document.querySelectorAll('.form-check-input-switchery'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html);
        });

        // Colored switches
        var primary = document.querySelector('.form-check-input-switchery-primary');
        var switchery = new Switchery(primary, { color: '#2196F3' });
    };

    //
    // Return objects assigned to module
    //

    return {
        initComponents: function() {
            _componentUniform();
            _componentSwitchery();
        }
    }
}();

// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    filter_switch_enabled = true;
    edit_mod_enabled = false;
    was_changes = false;
    updateTasksTable();
    InputsCheckboxesRadios.initComponents();
});

$('body').on('click', '.tasks-list tbody tr.open-modal-task', function(e) {
    var url = $(this).data('task-info-url');
    setEditMod(false);
    setChangesMod(false);
    getTaskInfo(url);
});

$('body').on('click', '#tasks-store', function(e) {
    e.preventDefault();
    var url = $(this).data('store-url');
    $.ajax({
        url: url
    }).done(function (data) {
        updateTasksTable();
        showNotify('store', '', 'Задача успешно добавлена!');
        setTimeout(function () {
            $('tr[data-task-info-url="' + data.info_url + '"]').trigger('click');
        }, 1300);
    });
});

$('body').on('click', '#tasks-update', function(e) {
    updateTasksTable();
});

$('body').on('click', '#tasks-my-other', function(e) {
    filter_switch_enabled = !filter_switch_enabled;
    updateTasksTable();
});

$('body').on('change', '.form-check-input-styled', function(e) {
    e.preventDefault();
    var span = $(this).parents('li.media').find('span.subtask-name');
    span.toggleClass('text-line-through', $(this).prop('checked'));
    sendCheckInfo($(this));
});

$('body').on('click', '.media-body', function(e) {
    $(this).parents('li.media').find('.subtask-comments').trigger('click');
});

$('body').on('click', '#add-subtask', function() {
    addSubtask();
});

$('body').on('click', '.destroy-subtask', function() {
    if (confirm('Вы действительно хотите удалить подзадачу?')) {
        var that = $(this);
        var url = that.data('destroy-url');
        $.ajax({
            url: url
        }).done(function (data) {
            that.parents('li.media').remove();
        }).always(function() {
            showNotify('destroy', '', 'Подзадача успешно удалена!');
        });
    }
});

$('body').on('click', '.subtask-comments', function() {

    if ($(this).parents('li.media').hasClass('active')) {
        $('li.media').removeClass('active');
        $('.subtask-comments').removeClass('active');
        $('#comments').hide();
        return true;
    }

    $('li.media').removeClass('active');
    $('.subtask-comments').removeClass('active');
    var that = $(this);
    var url = that.data('comments-url');
    $.ajax({
        url: url
    }).done(function (data) {
        $('#comments').html(data.comments_render);
        $('#comments').show();
        $('#comment-body').focus();
        that.addClass('active');
        that.parents('li.media').addClass('active');
    });
});

$('body').on('click', '.task-priority', function() {
    var that = $(this);
    if (!that.hasClass('active')) {
        var priority_id = that.data('priority-id');
        setTaskPriority(priority_id);
    }
});

$('body').on('change', '#task-status', function() {
    setTaskStatus($(this).val());
});

$('body').on('change', '#task-type', function() {
    setTaskType($(this).val());
});

$('body').on('keydown', '#comment-body', function(e) {
    if( e.keyCode === 13 ) {
        e.preventDefault();
        var text = $(this).val();
        sendMessage(text);
    }
});

$('body').on('click', '#filter-bar a.filter-list-item', function(e) {
    $(this).parent().find('a.filter-list-item').removeClass('active');
    $(this).addClass('active');
    updateTasksTable();
});

$('body').on('click', '#filter-reset', function(e) {
    $('a.filter-list-item').removeClass('active');
    $('a.type-list-item[data-type-id="all"]').addClass('active');
    $('a.status-list-item[data-status-id="all"]').addClass('active');
    $('a.priority-list-item[data-priority-id="all"]').addClass('active');
    if (!filter_switch_enabled) {
        $('#tasks-my-other').trigger('click');
    }
    updateTasksTable();
});

$('body').on('click', '#switch-edit', function(e) {
    handleSwitchEdit();
});

$('#taskInfo').on('hidden.bs.modal', function() {
    if (was_changes) {
        updateTasksTable();
    }
});

function getTaskInfo(url) {
    $.ajax({
        url: url
    }).done(function (data) {
        $('#taskInfo .modal-body').html(data.info_render);
        $('#taskInfo').modal('show');
    }).always(function() {
        handleSwitchEdit();
    });
}

function sendCheckInfo(elem) {
    $.ajax({
        url: elem.data('info-url'),
        type: 'POST',
        data: {
            checked: elem.prop('checked')
        }
    }).done(function (data) {
        showNotify('update', '', 'Подзадача успешно изменена!');
        setChangesMod(true);
    });
}

function addSubtask() {
    var url = $('#add-subtask').data('add-url');
    $.ajax({
        url: url,
        type: 'POST'
    }).done(function (data) {
        $('ul.list-edit').append(data.subtask_render);
    }).always(function() {
        InputsCheckboxesRadios.initComponents();
        showNotify('store', '', 'Подзадача успешно добавлена!');
    });
}

function setTaskPriority(priority_id) {
    var url = $('#task-info-table').data('task-update-url');
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            priority_id: priority_id
        }
    }).done(function (data) {
        $('#task-details').html(data.task_details);
        showNotify('update', '', 'Задача успешно изменена!');
        setChangesMod(true);
    });
}

function setTaskStatus(status_id) {
    var url = $('#task-info-table').data('task-update-url');
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            status_id: status_id
        }
    }).done(function (data) {
        $('#task-details').html(data.task_details);
        showNotify('update', '', 'Задача успешно изменена!');
        setChangesMod(true);
    });
}

function setTaskType(type_id) {
    var url = $('#task-info-table').data('task-update-url');
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            type_id: type_id
        }
    }).done(function (data) {
        $('#task-details').html(data.task_details);
        showNotify('update', '', 'Задача успешно изменена!');
        setChangesMod(true);
    });
}

function sendMessage(text) {
    var url = $('#comment-body').data('send-url');
    $.ajax({
        url: url,
        data: {
            text: text
        }
    }).done(function (data) {
        $('#comments').html(data.comments_render);
        $('#comments').parents('.card').show();
        $('#comment-body').focus();
        updateCommentCount(data.comments_count);
    });
}

function updateCommentCount(count) {
    $('.subtask-comments.active:first span').text(count);
}

function updateTasksTable() {
    var container = $('#tasks-container');
    setBlockUI(container);
    var url = container.data('all-url');
    var filter_type = $('.type-list-item.active').data('type-id');
    var filter_status = $('.status-list-item.active').data('status-id');
    var filter_priority = $('.priority-list-item.active').data('priority-id');
    var is_only_me = !filter_switch_enabled;
    $.ajax({
        url: url,
        data: {
            filter_type: filter_type,
            filter_status: filter_status,
            filter_priority: filter_priority,
            is_only_me: is_only_me
        }
    }).done(function (data) {
        container.find('.card-body').html(data.tasks_render);
    }).always(function() {
        TaskManagerList.init();
    });
}

function setBlockUI(elem) {
    $(elem).block({
        message: '<span class="font-weight-semibold"><i class="icon-spinner4 spinner mr-2"></i>&nbsp; Обновление данных</span>',
        timeout: 1000,
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            padding: '10px 15px',
            color: '#fff',
            width: 'auto',
            '-webkit-border-radius': 3,
            '-moz-border-radius': 3,
            backgroundColor: '#333'
        }
    });
}

function showNotify(type, title, text) {
    var opts = {
        title: title,
        delay: 2000,
        text: text,
        addclass: "stack-bottom-right bg-primary border-primary",
    };
    switch (type) {
        case 'destroy':
            opts.addclass = "stack-bottom-right bg-danger border-danger";
            opts.type = "error";
            break;

        case 'update':
            opts.addclass = "stack-bottom-right bg-primary border-primary";
            opts.type = "info";
            break;

        case 'store':
            opts.addclass = "stack-bottom-right bg-success border-success";
            opts.type = "success";
            break;
    }
    new PNotify(opts);
}

function handleSwitchEdit() {
    var checked = $('#switch-edit').prop('checked');
    if (checked) {
        setEditMod(true);
        setTaskGeneralEditMode(true);
        setSubtasksEditMode(true);
        setAttachmentEditMode(true);
        $('#comments').hide();
    } else {
        setEditMod(false);
        setTaskGeneralEditMode(false);
        setSubtasksEditMode(false);
        setAttachmentEditMode(false);
        updateTasksTable();
    }
}

function setEditMod(value) {
    edit_mod_enabled = value;
}

function setChangesMod(value) {
    was_changes = value;
}

function setTaskGeneralEditMode(value) {
    var name = '';
    var description = '';
    if (value) {
        var url = $('#task-general-info').data('edit-url');
    } else {
        var url = $('#task-general-info').data('show-url');
        name = $('#task-name').val();
        description = $('#task-description').val();
    }

    $.ajax({
        url: url,
        data: {
            name: name,
            description: description
        }
    }).done(function (data) {
        $('#task-general-info').html(data.task_render);
    });
}

function setSubtasksEditMode(value) {
    subtasks_info = [];
    if (value) {
        var url = $('#subtasks-container').data('edit-url');
    } else {
        var url = $('#subtasks-container').data('show-url');
        $('ul.list-edit li').each(function(index, elem) {
           subtasks_info.push($(this).data('id') + '***' + $(this).find('input').val());
        });
    }

    $.ajax({
        url: url,
        data: {
            subtasks_info: subtasks_info
        }
    }).done(function (data) {
        $('#subtasks-container').html(data.subtasks_render);
    }).always(function() {
        InputsCheckboxesRadios.initComponents();
    });
}

function setAttachment() {
    var url = $("#formdata").data('url');
    $.ajax({
        url: url,
        type: 'POST',
        processData: false,
        contentType: false,
        data: new FormData($("#formdata")[0])
    }).done(function (data) {
        $('#task-attachments').html(data.attachments_render);
        showNotify('store', '', 'Файлы успешно добавлены!');
        setAttachmentEditMode(true);
    });
}

function updateAttachmentListener() {
    var elem = document.getElementById('task-attachments');
    elem.addEventListener('change', setAttachment);
}

function setAttachmentEditMode(value) {
    if (value) {
        $('#formdata').show();
        updateAttachmentListener();
    } else {
        $('#formdata').hide();
    }
}
