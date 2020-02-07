<?php

Route::get('/', 'UserController@index')->name('index');
Route::get('{user}/edit', 'UserController@edit')->name('edit');
<<<<<<< refs/remotes/origin/master
<<<<<<< refs/remotes/origin/master
Route::put('{user}/edit', 'UserController@update')->name('update');
Route::post('/filter', 'UserController@filter')->name('filter');
Route::post('/online', 'UserController@online')->name('online');
=======
Route::put('{user}/edit', 'UserController@update')->name('update');
>>>>>>> Привел роуты в порядок. Оформил правильно через сервис провайдер (#29)
=======
Route::put('{user}/edit', 'UserController@update')->name('update');
Route::post('/filter', 'UserController@filter')->name('filter');
Route::post('/online', 'UserController@online')->name('online');
>>>>>>> Онлайн пользователей, поиск по сотрудникам, карточка сотрудника, доступ на изменение, сотрудники (#31)
