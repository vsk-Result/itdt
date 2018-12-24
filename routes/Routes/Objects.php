<?php

Route::group(['prefix' => 'objects', 'namespace' => 'Objects'], function () {

    // Объекты
    Route::get('/', 'ObjectController@index')->name('home');
    Route::get('/create', 'ObjectController@create')->name('objects.create');
    Route::get('/{id}/info', 'ObjectController@show')->name('objects.show');
});