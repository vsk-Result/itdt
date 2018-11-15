@if (count($breadcrumbs))
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                @foreach ($breadcrumbs as $breadcrumb)
                    <?php $icon = ($breadcrumb->title == 'Главная') ? '<i class="icon-home2 mr-2"></i>' : ''; ?>

                    @if ($breadcrumb->url && !$loop->last)
                        <a href="{{ $breadcrumb->url }}" class="breadcrumb-item">{!! $icon !!} {{ $breadcrumb->title }}</a>
                    @else
                        <span class="breadcrumb-item active">{!! $icon !!} {{ $breadcrumb->title }}</span>
                    @endif
                @endforeach
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
@endif