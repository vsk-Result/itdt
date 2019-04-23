<div class="breadcrumb-elements-item dropdown p-0 ml-0 pl-2">
    <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
        <i class="{{ $article->icon->name }} pr-2"></i> {{ $article->title }}
    </a>

    <div class="dropdown-menu dropdown-menu-right">
        <a href="javascript:void(0)" class="dropdown-item text-success article" data-url="{{ route('knowledge.articles.show', $article) }}"><i class="icon-list3"></i> Открыть</a>
        <a href="javascript:void(0)" class="dropdown-item text-primary edit-article" data-edit-url="{{ route('knowledge.articles.edit', $article) }}" data-update-url="{{ route('knowledge.articles.update', $article) }}"><i class="icon-pencil7"></i> Изменить</a>
        <div class="dropdown-divider"></div>
        <form id="destroy-article-form-{{ $article->id }}" method="POST" action="{{ route('knowledge.articles.destroy', $article) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <a href="javascript:void(0)" class="dropdown-item text-danger-800 destroy-article" data-id="{{ $article->id }}"><i class="icon-cross2"></i> Удалить</a>
        </form>
    </div>
</div>