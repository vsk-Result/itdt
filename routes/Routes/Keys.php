<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'keys',
    'as' => 'keys.',
    'namespace' => 'Keys',
], function () {
    Route::get('/', 'KeyController@index')->name('index');
    Route::get('/show', 'KeyController@show')->name('show');
    Route::post('/', 'KeyController@store')->name('store');
    Route::get('{id}/edit', 'KeyController@edit')->name('edit');
    Route::put('{id}/edit', 'KeyController@update')->name('update');
    Route::delete('{id}/destroy', 'KeyController@destroy')->name('destroy');
    Route::post('{id}/password', 'KeyController@getPassword')->name('password');
    Route::post('{id}/renewal', 'KeyController@changeRenewalUse')->name('renewal');
});