<?php

Route::group(['prefix' => 'objects', 'namespace' => 'Objects'], function () {

    // Объекты
    Route::get('/', 'ObjectController@index')->name('home');
    Route::get('/create', 'ObjectController@create')->name('objects.create');
    Route::post('/create', 'ObjectController@store')->name('objects.store');
    Route::get('/{id}/info', 'ObjectController@show')->name('objects.show');
    Route::get('/create_infopart', 'ObjectController@createInfopart')->name('objects.create_infopart');
});