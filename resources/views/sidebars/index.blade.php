@foreach ($employees as $employee)

<div class="dropdown-content-body dropdown-scrollable">
    <ul class="media-list">
        <li class="media">
            <div class="mr-3">
                <a href="#" class="btn bg-transparent border-info text-info rounded-round border-2 btn-icon"><i class="icon-git-branch"></i></a>
            </div>

            <div class="media-body">
                <a href="#" class="media-title font-weight-semibold">{{ $employee->user-> }}</a>

                <span class="d-block text-muted font-size-sm">{{ $employee->phone_number }}</span>

                @if ($employee->email)
                  <a class="lgi-text" href="">{{ $employee->email }}</a>
                @endif
                @if ($employee->email2)
                  <a class="lgi-text" href="">{{ $employee->email2 }}</a>
                @endif

            </div>

            <div class="ml-3 align-self-center"><span class="badge badge-mark border-success"></span></div>
        </li>
    </ul>
</div>
@endforeach
