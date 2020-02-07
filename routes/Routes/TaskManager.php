<?php

// Задачи
Route::get('/', 'TaskController@index')->name('index');
Route::get('/all', 'TaskController@all')->name('all');
Route::get('/store', 'TaskController@store')->name('store');
Route::get('/{id}/info', 'TaskController@info')->name('info');
Route::post('/{id}/show', 'TaskController@show')->name('show');
Route::post('/{id}/edit', 'TaskController@edit')->name('edit');
Route::post('/{id}/update', 'TaskController@update')->name('update');
Route::post('/{id}/attach_files', 'TaskController@attachFiles')->name('attach_files');
Route::post('/{id}/attach_files/{f_id}/destroy_file', 'TaskController@destroyFile')->name('attach_files.destroy');
Route::get('/{id}/subtasks/edit', 'TaskController@getEdit')->name('subtasks.edit');
Route::get('/{id}/subtasks/show', 'TaskController@getShow')->name('subtasks.show');

// Подзадачи
Route::post('/{id}/subtasks', 'SubTaskController@store')->name('subtasks.store');
Route::post('/subtasks/{id}/update', 'SubTaskController@update')->name('subtasks.update');
Route::get('/subtasks/{id}/destroy', 'SubTaskController@destroy')->name('subtasks.destroy');

//Комментарии
Route::get('/subtasks/{id}/comments', 'CommentController@comments')->name('subtasks.comments.index');
Route::post('/comments/{id}/destroy', 'CommentController@destroyComment')->name('subtasks.comments.destroy');
Route::get('/subtasks/{id}/send_message', 'CommentController@sendMessage')->name('subtasks.comments.send_message');
