<div class="card card-body">
    <div class="media">
        <div class="mr-3">
            <a href="#">
                <img src="http://demo.interface.club/limitless/demo/bs4/Template/global_assets/images/demo/users/face1.jpg" class="rounded-circle" width="42" height="42" alt="">
            </a>
        </div>

        <div class="media-body">
            <h6 class="mb-0">{{ $person->fullname }}</h6>
            <span class="text-muted">{{ $person->appointment }}</span>
        </div>

        <div class="ml-3 align-self-center">
            <div class="list-icons">
                <div class="list-icons-item dropdown">
                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-164px, 16px, 0px);">
                        @if (!empty($person->phone) && !is_null($person->phone))
                            <a href="tel:{{ $person->phone }}" class="dropdown-item"><i class="icon-phone2"></i> Позвонить</a>
                        @endif
                        @if (!empty($person->email) && !is_null($person->email))
                            <a href="mailto:{{ $person->email }}" class="dropdown-item"><i class="icon-mail5"></i> Написать письмо</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>