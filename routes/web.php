<?php

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('/');
    Route::post('/upload', 'UploadController@store')->name('upload');
});
