<div class="col-md-4">
    <div class="mb-3">
        <h6 class="font-weight-semibold mt-2">
            <span class="category cursor-pointer pr-2"
               data-edit-url="{{ route('knowledge.categories.edit', $category) }}"
               data-update-url="{{ route('knowledge.categories.update', $category) }}"
            >
                <i class="{{ $category->icon->name }}"></i>
            </span>

            {{ $category->name }} <span class="ml-1">({{ $category->articles->count() }})</span>
        </h6>
        <div class="dropdown-divider mb-2"></div>
        @each('knowledge.partials.article', $category->articles, 'article')
    </div>
</div>