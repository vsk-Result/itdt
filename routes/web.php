<?php

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/', 'HomeController@index')->name('/');
    Route::redirect('/home', '/');

    foreach (File::allFiles(__DIR__ . '/Routes') as $partial) {
        require_once $partial->getPathname();
    }

    Route::post('/upload', 'UploadController@store')->name('upload');

});

Route::get('/knowledge/articles/link/{link}', 'Knowledge\ArticleController@link')->name('knowledge.articles.short_link');
Route::get('/sign/{company}', 'SignController@show')->name('sign.show');
Route::post('/sign', 'SignController@store')->name('sign.store');

Route::group([
    'prefix' => 'inventory',
    'as' => 'inventory.',
    'namespace' => 'Inventory',
], function () {

    Route::group([
        'prefix' => 'orders',
        'as' => 'orders.',
    ], function () {
        Route::get('/', 'OrderController@index')->name('index');
        Route::post('/', 'OrderController@store')->name('store');
    });
});