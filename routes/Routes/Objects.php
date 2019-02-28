<?php

Route::group(['prefix' => 'objects', 'namespace' => 'Objects'], function () {

    // Объекты
    Route::get('/', 'ObjectController@index')->name('home');
    Route::get('/create', 'ObjectController@create')->name('objects.create');
    Route::post('/create', 'ObjectController@store')->name('objects.store');
    Route::get('/{id}/edit', 'ObjectController@edit')->name('objects.edit');
    Route::post('/{id}/edit', 'ObjectController@update')->name('objects.update');
    Route::get('/{id}/info', 'ObjectController@show')->name('objects.show');
    Route::get('/{id}/word', 'ObjectController@word')->name('objects.word');
    Route::get('/create_infopart', 'ObjectController@createInfopart')->name('objects.create_infopart');
    Route::get('/create_person', 'ObjectController@createPerson')->name('objects.create_person');
});