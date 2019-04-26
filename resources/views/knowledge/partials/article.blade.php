<a href="javascript:void(0)" class="dropdown-item article"
            data-show-url="{{ route('knowledge.articles.show', $article) }}"
            data-edit-url="{{ route('knowledge.articles.edit', $article) }}"
            data-update-url="{{ route('knowledge.articles.update', $article) }}"
            data-destroy-url="{{ route('knowledge.articles.destroy', $article) }}"
            title="{{ $article->title }}">
    <i class="{{ $article->icon->name }}"></i> {{ $article->title }}
</a>