<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'knowledge',
    'as' => 'knowledge.',
    'namespace' => 'Knowledge',
], function () {
    Route::get('/', 'KnowledgeController@index')->name('index');

    Route::group([
        'prefix' => 'articles',
        'as' => 'articles.',
    ], function () {
        Route::post('/', 'ArticleController@store')->name('store');
    });

    Route::group([
        'prefix' => 'categories',
        'as' => 'categories.',
    ], function () {
        Route::post('/', 'CategoryController@store')->name('store');
    });
});