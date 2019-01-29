<div class="media flex-column flex-md-row">
    <div class="mr-md-3 mb-2 mb-md-0">
        <a href="javascript:void(0)"><img src="{{ asset('images/placeholder.jpg') }}" class="rounded-circle" width="36" height="36" alt=""></a>
    </div>

    <div class="media-body">
        <div class="media-title">
            <a href="javascript:void(0)" class="font-weight-semibold">{{ $comment->user->name }}</a>
            <span class="font-size-sm text-muted ml-sm-2 mb-2 mb-sm-0 d-block d-sm-inline-block">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
            @if (substr_count($comment->text, 'Пользователь') == 0)
                <span class="destroy-comment float-right text-danger cursor-pointer" data-source="{{ route('tasks.subtasks.comments.destroy', $comment->id) }}"><i class="icon-cross3"></i></span>
            @endif
        </div>

        <p>{!! $comment->getText() !!}</p>
    </div>
</div>