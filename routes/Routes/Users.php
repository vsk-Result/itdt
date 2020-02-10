<?php

Route::get('/', 'UserController@index')->name('index');
Route::get('{user}/edit', 'UserController@edit')->name('edit');
Route::put('{user}/edit', 'UserController@update')->name('update');
Route::post('/filter', 'UserController@filter')->name('filter');
Route::post('/online', 'UserController@online')->name('online');
Route::put('{user}/edit', 'UserController@update')->name('update');
Route::post('/filter', 'UserController@filter')->name('filter');
Route::post('/online', 'UserController@online')->name('online');
