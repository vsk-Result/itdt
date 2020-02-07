<ul class="media-list my-2">
    <li id="search-result-info" class="media font-weight-semibold border-0 py-2"></li>
    @foreach ($employees as $employee)
        <li class="media pl-0 pr-0">
            <div class="mr-3">
                <img src="{{ $employee->getAvatarUrl() }}" class="rounded-circle" width="40" height="40" alt="">
            </div>
            <div class="media-body">
                <a class="media-title font-weight-semibold" href="{{ route('employees.show', $employee) }}">{{ $employee->fullname }}</a><br>
                @if ($employee->work_phone)
                    <span class="text-muted font-size-sm">{{ '#'.$employee->work_phone }}</span><br>
                @endif
                @if ($employee->phone_number)
                    <span class="text-muted font-size-sm">{{ $employee->phone_number }}</span><br>
                @endif
                @if ($employee->email)
                    <a class="lgi-text text-default" href="mailto:{{ $employee->email }}">{{ $employee->email }}</a><br>
                @endif
                @if ($employee->email2)
                    <a class="lgi-text text-default" href="mailto:{{ $employee->email2 }}">{{ $employee->email2 }}</a>
                @endif
            </div>
            <div class="align-self-center ml-3">
                <span class="badge badge-mark {{ $employee->isOnline() ? 'bg-success border-success' : 'bg-danger border-danger' }}"></span>
            </div>
        </li>
    @endforeach
</ul>
