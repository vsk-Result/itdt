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
        Route::get('/{article}/show', 'ArticleController@show')->name('show');
        Route::get('/{article}', 'ArticleController@show')->name('show');
        Route::get('/{article}/edit', 'ArticleController@edit')->name('edit');
        Route::put('/{article}', 'ArticleController@update')->name('update');
        Route::delete('/{article}', 'ArticleController@destroy')->name('destroy');
    });

    Route::group([
        'prefix' => 'categories',
        'as' => 'categories.',
    ], function () {
        Route::post('/', 'CategoryController@store')->name('store');
    });
});