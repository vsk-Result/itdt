<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'users',
    'as' => 'users.',
    'namespace' => 'Users',
], function () {
    Route::get('/', 'UserController@index')->name('index');
    Route::get('{user}/edit', 'UserController@edit')->name('edit');
    Route::put('{user}/edit', 'UserController@update')->name('update');
});