<div class="card gallery">
    <div class="card-header bg-transparent header-elements-inline">
        <span class="card-title font-weight-bold">Галлерея</span>
    </div>

    <div class="card-body">

        @foreach($object->images as $image)
            <div id="caption{{ $image->id }}" style="display:none">
                <p>{{ $image->description }}</p>
            </div>
        @endforeach

        <div class="fileuploader fileuploader-theme-thumbnails pr-0">
            <div class="fileuploader-items">
                <div class="row lightgallery fileuploader-items-list lightgallery">
                    @forelse($object->images as $image)
                        <div class="col-md-6 fileuploader-item file-has-popup">
                            <div class="fileuploader-item-inner light-item" data-src="{{ $image->getUrl() }}" data-sub-html="#caption{{ $image->id }}">
                                <div class="thumbnail-holder">
                                    <div class="fileuploader-item-image">
                                        <img src="{{ $image->getUrl() }}">
                                    </div>
                                    <span class="fileuploader-action-popup"></span>

                                    <div class="content-holder">
                                        <h5></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        Данные отсутствуют
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>