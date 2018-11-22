<?php

Route::group(['prefix' => 'objects', 'namespace' => 'Objects'], function () {

    // Объекты
    Route::get('/', 'ObjectController@index')->name('home');
    Route::get('/{id}/info', 'ObjectController@show')->name('objects.show');
});