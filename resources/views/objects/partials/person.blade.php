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
            <a href="#" class="list-icons-item"><i class="icon-info3"></i></a>
        </div>
    </div>
</li>