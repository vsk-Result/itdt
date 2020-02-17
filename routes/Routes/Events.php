<?php

Route::get('/', 'EventController@index')->name('index');
Route::get('all', 'EventController@all')->name('all');
Route::get('create', 'EventController@create')->name('create');
Route::post('/', 'EventController@store')->name('store');
Route::get('edit', 'EventController@edit')->name('edit');
Route::post('edit', 'EventController@update')->name('update');
Route::get('show', 'EventController@show')->name('show');
Route::get('destroy', 'EventController@destroy')->name('destroy');
Route::get('status', 'EventController@status')->name('status');