<div class="col-md-4">
    <div class="mb-3">
        <h6 class="font-weight-semibold mt-2">
            <i class="{{ $category->icon->name }} mr-2"></i>
            {{ $category->name }} <span class="ml-1">({{ $category->articles->count() }})</span>
        </h6>
        <div class="dropdown-divider mb-2"></div>
        @each('knowledge.partials.article', $category->articles, 'article')
    </div>
</div>