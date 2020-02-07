@extends('layouts.app')

@section('title', 'Пользователи')
@section('page-title', 'Пользователи')

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="users" class="table table-lg table-hover">
                <thead>
                <tr>
                    <th>#ID</th>
                    <th>Сотрудник</th>
                    <th>Имя</th>
                    <th>Имя пользователя</th>
                    <th>Доступ к разделам</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>#{{ $user->id }}</td>
                            <td>
                                @if($user->employee)
                                    <a target="_blank" href="{{ route('employees.show', $user->employee->id) }}">{{ $user->employee->fullname }}</a>
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                @foreach($user->permissions as $permission)
                                    <span class="badge badge-flat border-grey-800 text-default">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 16px, 0px);">

                                        <a target="_blank" href="{{ route('users.edit', $user) }}" class="dropdown-item text-primary edit-key"><i class="icon-pencil7"></i> Изменить доступ</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendors/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendors/tables/datatables/extensions/natural_sort.js') }}"></script>
    <script>
        $(function() {
            $('#users').dataTable({
                language: {
                    "processing": "Подождите...",
                    "search": "",
                    "searchPlaceholder": "Поиск по таблице...",
                    "lengthMenu": "Показать _MENU_ записей",
                    "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                    "infoEmpty": "Записи с 0 до 0 из 0 записей",
                    "infoFiltered": "(отфильтровано из _MAX_ записей)",
                    "infoPostFix": "",
                    "loadingRecords": "Загрузка записей...",
                    "zeroRecords": "Записи отсутствуют.",
                    "emptyTable": "В таблице отсутствуют данные",
                    "paginate": {
                        "first": "Первая",
                        "previous": "Предыдущая",
                        "next": "Следующая",
                        "last": "Последняя"
                    },
                    "aria": {
                        "sortAscending": ": активировать для сортировки столбца по возрастанию",
                        "sortDescending": ": активировать для сортировки столбца по убыванию"
                    },
                    "select": {
                        "rows": {
                            "_": "Выбрано записей: %d",
                            "0": "Кликните по записи для выбора",
                            "1": "Выбрана одна запись"
                        }
                    }
                }
            });
        });
    </script>
@endpush