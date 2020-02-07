<?php

Route::get('/', 'ObjectController@index')->name('index');
Route::get('/create', 'ObjectController@create')->name('create');
Route::post('/create', 'ObjectController@store')->name('store');
Route::get('/{id}/edit', 'ObjectController@edit')->name('edit');
Route::post('/{id}/edit', 'ObjectController@update')->name('update');
Route::get('/{id}/info', 'ObjectController@show')->name('show');
Route::get('/{id}/word', 'ObjectController@word')->name('word');
Route::get('/create_infopart', 'ObjectController@createInfopart')->name('create_infopart');
Route::get('/create_person', 'ObjectController@createPerson')->name('create_person');
Route::post('/reorder', 'ObjectController@reorder')->name('reorder');