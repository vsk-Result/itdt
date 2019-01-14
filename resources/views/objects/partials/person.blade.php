<li class="media lightgallery">
    <a href="{{ $person->getImageUrl() }}" class="mr-3 light-item cursor-pointer">
        <img src="{{ $person->getImageUrl() }}" class="rounded-circle" width="36" height="36" alt="">
    </a>
    <div class="media-body">
        <a href="#" class="media-title font-weight-semibold text-default cursor-default">{{ $person->fullname }}</a>
        <span class="font-size-sm text-muted d-block">{{ $person->appointment }}</span>
    </div>
    <div class="align-self-center ml-3">
        <div class="list-icons">
            @if (!empty($person->phone) && !is_null($person->phone))
                <a href="#" class="list-icons-item mr-2 text-success" data-popup="tooltip" title="{{ $person->phone }}" data-trigger="click"><i class="icon-phone2"></i></a>
            @endif
            @if (!empty($person->email) && !is_null($person->email))
                <a href="#" class="list-icons-item mr-2 text-warning" data-popup="tooltip" title="{{ $person->email }}" data-trigger="click"><i class="icon-mail5"></i></a>
            @endif
            @if (!empty($person->link) && !is_null($person->link))
                <a target="_blank" href="{{ $person->link }}" class="list-icons-item text-primary"><i class="icon-link"></i></a>
            @endif
        </div>
    </div>
</li>