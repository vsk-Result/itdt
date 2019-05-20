<div id="showArticle" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-2">
                <h5 class="modal-title"></h5>
                <div class="list-icons ml-auto pt-1 no-print">
                    <div class="list-icons-item dropdown">
                        <a href="javascript:void(0)" class="list-icons-item pr-2 text-primary link-article" title="Внешняя ссылка" data-link="_"  style="display:none;"><i class="icon-link2"></i></a>
                        <a href="#" class="list-icons-item dropdown-toggle caret-0 pr-2" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 16px, 0px);">

                            <a href="javascript:void(0)" class="dropdown-item text-primary edit-article" data-edit-url=" " data-update-url=" "><i class="icon-pencil7"></i> Изменить</a>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0)" class="dropdown-item text-danger-800 print-article"><i class="icon-file-pdf"></i> В PDF</a>
                            <div class="dropdown-divider"></div>
                            <form id="destroy-article-form" method="POST" action="" class="mr-1">
                                @csrf
                                @method('DELETE')
                                <a href="javascript:void(0)" class="dropdown-item text-muted destroy-article"><i class="icon-cross2"></i> Удалить</a>
                            </form>
                        </div>
                        <a href="javascript:void(0)" class="list-icons-item" data-dismiss="modal"><i class="icon-cross2"></i></a>
                    </div>
                </div>
            </div>

            <div class="article-link mx-2" style="display: none;">
                <div class="form-group">
                    {{ Form::text('link', null, ['id' => 'article-link', 'class' => 'form-control form-control-sm']) }}
                </div>
            </div>

            <div class="modal-body border-top-1">

            </div>
        </div>
    </div>
</div>