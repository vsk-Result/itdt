<div id="our-icon-list" style="display: none">
    <div class="row no-gutters glyphs">
        @foreach($icons as $icon)
            <div class="col-md-1 col-sm-2">
                <div class="d-flex align-items-center cursor-pointer">
                    <i data-id="{{ $icon->id }}" class="{{ $icon->name }} icon-2x"></i>
                </div>
            </div>
        @endforeach
    </div>
</div>