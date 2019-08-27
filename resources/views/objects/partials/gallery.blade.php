<div class="card mb-2" data-id="gallery">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">
            <i class="icon-images2 mr-2 text-slate"></i> Галлерея
        </h6>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item collap" data-action="collapse"></a>
            </div>
        </div>
    </div>
    
    <div id="infopartgallery" class="collapse">
        <div class="card-body">
            @foreach($object->images as $image)
                <div id="caption{{ $image->id }}" style="display:none">
                    <p>{{ '(' . $image->created_at->format('d.m.y') . ') ' . $image->description }}</p>
                </div>
            @endforeach

            <div class="fileuploader fileuploader-theme-thumbnails pr-0">
                <div class="fileuploader-items">
                    <div class="row lightgallery fileuploader-items-list lightgallery">
                        @forelse($object->images as $image)
                            <div class="col-md-2 fileuploader-item file-has-popup">
                                <div class="fileuploader-item-inner light-item" data-src="{{ $image->getUrl() }}" data-sub-html="#caption{{ $image->id }}">
                                    <div class="thumbnail-holder">
                                        <div class="fileuploader-item-image">
                                            <img src="{{ $image->getThumbUrl() }}">
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
</div>