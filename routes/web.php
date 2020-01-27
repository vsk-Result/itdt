<?php

Auth::routes([
    'reset' => false,
    'verify' => false,
    'register' => false,
]);

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('/');
<<<<<<< refs/remotes/origin/master
    Route::redirect('/home', '/')->name('home');
=======
>>>>>>> Привел роуты в порядок. Оформил правильно через сервис провайдер (#29)
    Route::post('/upload', 'UploadController@store')->name('upload');
});
