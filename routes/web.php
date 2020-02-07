<?php

Auth::routes([
    'reset' => false,
    'verify' => false,
    'register' => false,
]);

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('/');
<<<<<<< refs/remotes/origin/master
<<<<<<< refs/remotes/origin/master
    Route::redirect('/home', '/')->name('home');
=======
>>>>>>> Привел роуты в порядок. Оформил правильно через сервис провайдер (#29)
=======
    Route::redirect('/home', '/')->name('home');
>>>>>>> Онлайн пользователей, поиск по сотрудникам, карточка сотрудника, доступ на изменение, сотрудники (#31)
    Route::post('/upload', 'UploadController@store')->name('upload');
});
