<div class="card mb-2">
    <div class="card-header">
        <h6 class="card-title">
            <a class="text-default collapsed" data-toggle="collapse" href="#infopart{{ $infopart->id }}">
                <i class="icon-help mr-2 text-slate"></i> {{ $infopart->title }}
            </a>
        </h6>
    </div>

    <div id="infopart{{ $infopart->id }}" class="collapse">
        <div class="card-body">
            {!! $infopart->body !!}
            @if ($infopart->attachments->count() > 0)
                <div class="row">
                    <div class="col-lg-12">
                        <hr>
                        <ul class="list list-unstyled">
                            @foreach($infopart->attachments as $attachment)
                                <li>
                                    <i class="icon-attachment text-primary mr-2"></i>
                                    <a href="{{ $attachment->getUrl() }}" class="list-icons-item">{{ $attachment->filename }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>

        <div class="card-footer bg-transparent d-sm-flex align-items-sm-center border-top-0 pt-0">
            <span class="text-muted">Посл. изменение: {{ $infopart->updated_at->format('d.m.Y H:i') }}</span>
        </div>
    </div>
</div>