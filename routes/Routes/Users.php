<?php

Route::get('/', 'UserController@index')->name('index');
Route::get('{user}/edit', 'UserController@edit')->name('edit');
Route::put('{user}/edit', 'UserController@update')->name('update');