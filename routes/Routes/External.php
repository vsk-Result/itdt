<?php

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

    Route::group([
        'prefix' => 'orderhistory',
        'as' => 'orderhistory.',
    ], function() {
        Route::get('/', 'OrderHistoryController@index')->name('index');
        Route::get('/{order}', 'OrderHistoryController@destroy')->name('destroy');
        Route::get('/export/{order}', 'OrderHistoryController@excel')->name('excel');
    });
});