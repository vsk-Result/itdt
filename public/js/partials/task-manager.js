
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
            columnDefs: [
                {
                    type: "natural",
                    width: '5%',
                    targets: 0
                },
                {
                    visible: false,
                    targets: 1
                },
                {
                    width: '50%',
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
                    targets: [5, 6]
                }
            ],
            order: [[4, 'asc']],
            dom: '<"datatable-header"fl><"datatable-scroll-lg"t><"datatable-footer"ip>',
            language: {
                search: '<span>Поиск:</span> _INPUT_',
                searchPlaceholder: 'Найти в таблице...',
                lengthMenu: '<span>Показать:</span> _MENU_',
                paginate: { 'первая': 'Первая', 'последняя': 'Последняя', 'следующая': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'предыдущая': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
            },
            lengthMenu: [ 15, 25, 50, 75, 100 ],
            displayLength: 25,
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
    updateTasksTable();
    edit_mod_enabled = false;
});

$('body').on('click', '.tasks-list tbody tr.open-modal-task', function(e) {
    var url = $(this).data('task-info-url');
    edit_mod_enabled = false;
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
    });
});

$('body').on('click', '#tasks-update', function(e) {
    updateTasksTable();
});

$('body').on('change', '.form-check-input-styled', function(e) {
    e.preventDefault();
    var parent = $(this).parents('.form-check-label').find('span.subtask-name');
    parent.toggleClass('text-line-through', $(this).prop('checked'));
    sendCheckInfo($(this));
});

$('body').on('click', '.subtask-name', function(e) {
    e.preventDefault();
});

$('body').on('click', '#add-subtask', function() {
    addSubtask();
    if (!edit_mod_enabled) {
        $('#switch-edit').trigger('click');
        handleSwitchEdit();
    }
    setTimeout(function () {
        $('#subtasks-container .form-check:last .subtask-edit').trigger('click');
    }, 200);
});

$('body').on('keydown', '.subtask-container input', function(e) {
    if( e.keyCode === 13 ) {
        e.preventDefault();
        $(this).parent().find('.apply-edit').trigger('click');
    }
});

$('body').on('click', '.subtask-edit', function() {
    var that = $(this);
    var url = that.data('edit-url');
    $.ajax({
        url: url
    }).done(function (data) {
        var container = that.parents('.subtask-container');
        container.html(data.subtask_render);
        container.find('input').select();
    });
});

$('body').on('click', '.subtask-destroy', function() {
    if (confirm('Вы действительно хотите удалить подзадачу?')) {
        var that = $(this);
        var url = that.data('destroy-url');
        $.ajax({
            url: url
        }).done(function (data) {
            $('#subtasks-container').html(data.subtasks_render);
        }).always(function() {
            InputsCheckboxesRadios.initComponents();
            handleSwitchEdit();
            showNotify('destroy', '', 'Подзадача успешно удалена!');
        });
    }
});

$('body').on('click', '.subtask-container', function() {

    if (edit_mod_enabled) return false;

    var that = $(this);
    var url = that.data('comments-url');
    $.ajax({
        url: url
    }).done(function (data) {
        $('#comments').html(data.comments_render);
        $('#comments').show();
        $('#comment-body').focus();
        $('.subtask-container').removeClass('active');
        that.addClass('active');
    });
});

$('body').on('click', '.apply-edit', function() {
    var that = $(this);
    var url = that.data('apply-url');
    var text = that.parents('.input-group').find('input').val();
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            name: text
        }
    }).done(function (data) {
        that.parents('.subtask-container').html(data.subtask_render);
    }).always(function() {
        InputsCheckboxesRadios.initComponents();
        handleSwitchEdit();
        showNotify('update', '', 'Подзадача успешно изменена!');
    });
});

$('body').on('click', '.cancel-edit', function() {
    var that = $(this);
    var url = that.data('cancel-url');
    $.ajax({
        url: url
    }).done(function (data) {
        that.parents('.subtask-container').html(data.subtask_render);
    }).always(function() {
        InputsCheckboxesRadios.initComponents();
        handleSwitchEdit();
    });
});

$('body').on('click', '.task-name-edit', function() {
    var that = $(this);
    var url = that.data('name-edit-url');
    $.ajax({
        url: url
    }).done(function (data) {
        that.parents('.card').html(data.task_render);
    });
});

$('body').on('click', '.apply-task-edit', function() {
    var that = $(this);
    var url = that.data('apply-url');
    var name = that.parents('.card').find('input#task-name').val();
    var description = that.parents('.card').find('input#task-description').val();
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            name: name,
            description: description
        }
    }).done(function (data) {
        that.parents('.card').html(data.task_render);
        showNotify('update', '', 'Задача успешно изменена!');
    });
});

$('body').on('click', '.cancel-task-edit', function() {
    var that = $(this);
    var url = that.data('cancel-url');
    $.ajax({
        url: url
    }).done(function (data) {
        that.parents('.card').html(data.task_render);
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

$('body').on('keydown', '#comment-body', function(e) {
    if( e.keyCode === 13 ) {
        e.preventDefault();
        var text = $(this).val();
        sendMessage(text);
    }
});

$('body').on('click', '#switch-edit', function(e) {
    handleSwitchEdit();
});

$('#taskInfo').on('hidden.bs.modal', function() {
    updateTasksTable();
});

function getTaskInfo(url) {
    $.ajax({
        url: url
    }).done(function (data) {
        $('#taskInfo .modal-body').html(data.info_render);
        $('#taskInfo').modal('show');
    }).always(function() {
        InputsCheckboxesRadios.initComponents();
        var elem = document.getElementById('task-attachments');
        elem.addEventListener('change', setAttachment);
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

    });
}

function addSubtask() {
    var url = $('#add-subtask').data('add-url');
    $.ajax({
        url: url,
        type: 'POST'
    }).done(function (data) {
        $('#subtasks-container').html(data.subtasks_render);
    }).always(function() {
        InputsCheckboxesRadios.initComponents();
        var elem = document.getElementById('task-attachments');
        elem.addEventListener('change', setAttachment);
        handleSwitchEdit();
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
        updateTaskDetails(data.task_details);
        showNotify('update', '', 'Задача успешно изменена!');
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
        updateTaskDetails(data.task_details);
        showNotify('update', '', 'Задача успешно изменена!');
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
        handleSwitchEdit();
        showNotify('store', '', 'Файлы успешно загружены!');
    });
}

function updateTaskDetails(render_view) {
    $('#task-details').html(render_view);
    var elem = document.getElementById('task-attachments-input');
    elem.addEventListener('change', setAttachment);
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
    });
}

function handleSwitchEdit() {
    var checked = $('#switch-edit').prop('checked');
    if (checked) {
        $('.task-name-edit').show();
        $('.subtask-edit').show();
        $('.subtask-destroy').show();
        $('#formdata').show();
        edit_mod_enabled = true;
        $('.subtask-container').removeClass('stock');
    } else {
        $('.task-name-edit').hide();
        $('.subtask-edit').hide();
        $('.subtask-destroy').hide();
        $('#formdata').hide();
        edit_mod_enabled = false;
        $('.subtask-container').addClass('stock');
    }
}

function updateTasksTable() {
    var container = $('#tasks-container');
    setBlockUI(container);
    var url = container.data('all-url');
    $.ajax({
        url: url
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