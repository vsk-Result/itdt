<?php

Auth::routes([
    'reset' => false,
    'verify' => false,
    'register' => false,
]);

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('/');
    Route::redirect('/home', '/employees')->name('home');
    Route::post('/upload', 'UploadController@store')->name('upload');
});
