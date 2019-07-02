<?php

Route::group(['prefix' => 'task-manager', 'namespace' => 'TaskManager'], function () {

    // Задачи
    Route::get('/', 'TaskController@index')->name('tasks.index');
    Route::get('/all', 'TaskController@all')->name('tasks.all');
    Route::get('/store', 'TaskController@store')->name('tasks.store');
    Route::get('/{id}/info', 'TaskController@info')->name('tasks.info');
    Route::post('/{id}/show', 'TaskController@show')->name('tasks.show');
    Route::post('/{id}/edit', 'TaskController@edit')->name('tasks.edit');
    Route::post('/{id}/update', 'TaskController@update')->name('tasks.update');
    Route::post('/{id}/attach_files', 'TaskController@attachFiles')->name('tasks.attach_files');
    Route::post('/{id}/attach_files/{f_id}/destroy_file', 'TaskController@destroyFile')->name('tasks.attach_files.destroy');
    Route::get('/{id}/subtasks/edit', 'TaskController@getEdit')->name('tasks.subtasks.edit');
    Route::get('/{id}/subtasks/show', 'TaskController@getShow')->name('tasks.subtasks.show');

    // Подзадачи
    Route::post('/{id}/subtasks', 'SubTaskController@store')->name('tasks.subtasks.store');
    Route::post('/subtasks/{id}/update', 'SubTaskController@update')->name('tasks.subtasks.update');
    Route::get('/subtasks/{id}/destroy', 'SubTaskController@destroy')->name('tasks.subtasks.destroy');
    Route::get('/subtasks/{id}/comments', 'SubTaskController@comments')->name('tasks.subtasks.comments.index');
    Route::post('/comments/{id}/destroy', 'SubTaskController@destroyComment')->name('tasks.subtasks.comments.destroy');
    Route::get('/subtasks/{id}/send_message', 'SubTaskController@sendMessage')->name('tasks.subtasks.comments.send_message');

});