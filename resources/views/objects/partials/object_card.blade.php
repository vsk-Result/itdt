<div class="col-md-3">
    <div class="card">
        <div class="card-img-actions">
            <img class="card-img-top img-fluid" src="http://demo.interface.club/limitless/demo/bs4/Template/global_assets/images/demo/flat/10.png" alt="">
            <div class="card-img-actions-overlay card-img-top">
                <a href="http://demo.interface.club/limitless/demo/bs4/Template/global_assets/images/demo/flat/10.png" class="btn btn-outline bg-white text-white border-white border-2" data-popup="lightbox">
                    Фото
                </a>
                <a href="{{ route('objects.show', [$object->id]) }}" class="btn btn-outline bg-white text-white border-white border-2 ml-2">
                    Детали
                </a>
            </div>
        </div>

        <div class="card-body">
            <h5 class="card-title"><a href="{{ route('objects.show', [$object->id]) }}">{{ $object->getFullName() }}</a></h5>
            <p class="card-text">{{ $object->address }}</p>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <span class="text-muted">Last updated 3 mins ago</span>
            <span>
                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                <i class="icon-star-half font-size-base text-warning-300"></i>
                <span class="text-muted ml-2">(12)</span>
            </span>
        </div>
    </div>
</div>