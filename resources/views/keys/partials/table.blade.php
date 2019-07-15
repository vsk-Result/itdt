<table id="keys" class="table table-lg table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Лицензионный ключ</th>
        <th>Логин</th>
        <th>Пароль</th>
        <th>Продукт</th>
        <th><i class="icon-users4"></i></th>
        <th>Статус</th>
        <th>Добавлен</th>
        <th>Срок действия</th>
        <th>Использован</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($keys as $key)
        <tr class="{{ $key->isRenewalUse() ? 'active' : '' }}">
            <td>#{{ $key->id }}</td>
            <td>{{ $key->key }}</td>
            <td>{{ $key->login }}</td>
            <td>
                <div class="password-container" data-url="{{ route('keys.password', $key->id) }}" data-status="hidden">
                    <span class="password">{{ $key->getHiddenPassword() }}</span>
                    <span class="cursor-pointer toggle-password"><i class="icon-eye"></i></span>
                </div>
            </td>
            <td>{{ $key->product }}</td>
            <td>
                <div class="dropup">
                    @if ($key->usages->count() > 0)
                        <a href="#" class="badge badge-flat badge-pill border-primary text-primary-600 dropdown-toggle" data-toggle="dropdown">{{ $key->usages->count() }}</a>

                        <div class="dropdown-menu">
                            @foreach($key->usages as $usage)
                                <div class="dropdown-item cursor-default">
                                    <span class="mr-3">{{ $usage->user_name }}</span>
                                    <span class="ml-auto">{{ $usage->getPCInfo() }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </td>
            <td>{{ $key->getRenewal() }}</td>
            <td>{{ $key->created_at->format('d.m.Y') }}</td>
            <td>
                {{ $key->expire_date }}
                @if ($key->expire_date > Carbon::now()->format('Y-m-d'))
                    <div id="progressBar" style="background-image: linear-gradient(90deg, rgb(76, 175, 80) {{ $key->getExpirePercent() }}%, rgba(255, 255, 255, 0.9) {{ $key->getExpirePercent() }}%);">
                                        <span id="progressText" style="background-image: linear-gradient(90deg, rgb(255, 255, 255) {{ $key->getExpirePercent() }}%, rgba(0, 0, 0, 0.7) {{ $key->getExpirePercent() }}%);">
                                            Через {{ $key->getExpireDays() }} {{ daysFormat($key->getExpireDays()) }}
                                        </span>
                    </div>
                @endif
            </td>
            <td>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="is_renewal_use" class="form-check-input renewal-use" value="is_renewal_use" data-url="{{ route('keys.renewal', $key->id) }}" {{ $key->isRenewalUse() ? 'checked' : '' }}>
                        </label>
                    </div>
                </div>
            </td>
            <td>
                <div class="list-icons-item dropdown">
                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 16px, 0px);">

                        <a href="javascript:void(0)" class="dropdown-item text-primary edit-key" data-edit-url="{{ route('keys.edit', $key) }}" data-update-url="{{ route('keys.update', $key) }}"><i class="icon-pencil7"></i> Изменить</a>

                        <div class="dropdown-divider"></div>

                        <form id="destroy-key-form-{{ $key->id }}" method="POST" action="{{ route('keys.destroy', $key) }}" class="mr-1">
                            @csrf
                            @method('DELETE')
                            <a href="javascript:void(0)" class="dropdown-item text-danger-800 destroy-key" data-id="{{ $key->id }}"><i class="icon-cross2"></i> Удалить</a>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>