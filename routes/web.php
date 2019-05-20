<?php

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::redirect('/', '/objects')->name('/');
    Route::redirect('/home', '/');

    foreach (File::allFiles(__DIR__ . '/Routes') as $partial) {
        require_once $partial->getPathname();
    }

});

Route::get('/knowledge/articles/link/{link}', 'Knowledge\ArticleController@link')->name('knowledge.articles.short_link');