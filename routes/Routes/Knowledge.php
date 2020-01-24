<?php

Route::get('/', 'KnowledgeController@index')->name('index');
Route::post('/filter', 'KnowledgeController@filter')->name('filter');

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
    Route::get('/{category}/edit', 'CategoryController@edit')->name('edit');
    Route::put('/{category}', 'CategoryController@update')->name('update');
});