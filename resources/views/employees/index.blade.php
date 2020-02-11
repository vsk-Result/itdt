@extends('layouts.app')

@section('title', 'Сотрудники')
@section('page-title', 'Сотрудники')

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="employees" class="table table-lg table-hover">
                <thead>
                <tr>
                    <th>Сотрудник</th>
                    <th>Контакты</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <a target="_blank" href="{{ route('employees.show', $employee->id) }}">
                                            <img src="{{ $employee->getAvatarUrl() }}" class="rounded-circle" width="32" height="32" alt="">
                                        </a>
                                    </div>
                                    <div>
                                        <a target="_blank" href="{{ route('employees.show', $employee->id) }}" class="text-default font-weight-semibold">{{ $employee->fullname }}</a>
                                        @if($employee->post)
                                            <div class="text-muted font-size-sm">{{ $employee->post->name }}</div>
                                        @endif
                                        @if($employee->leader)
                                            <div class="font-size-sm">(Руководитель <a target="_blank" href="{{ route('employees.show', $employee->leader->id) }}">{{ $employee->leader->fullname }}</a>)</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($employee->work_phone)
                                    <span class="text-muted font-size-sm">{{ '#'.$employee->work_phone }}</span><br>
                                @endif
                                @if ($employee->phone_number)
                                    <a class="lgi-text text-default" href="tel:{{ $employee->phone_number }}">{{ $employee->phone_number }}</a><br>
                                @endif
                                @if ($employee->email)
                                    <a class="lgi-text text-default" href="mailto:{{ $employee->email }}">{{ $employee->email }}</a><br>
                                @endif
                                @if ($employee->email2)
                                    <a class="lgi-text text-default" href="mailto:{{ $employee->email2 }}">{{ $employee->email2 }}</a>
                                @endif
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
            $('#employees').dataTable({
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