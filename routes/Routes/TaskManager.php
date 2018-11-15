<?php

Route::group(['prefix' => 'task-manager', 'namespace' => 'TaskManager'], function () {

    // Задачи
    Route::get('/', 'TaskController@index')->name('tasks.index');
    Route::get('/all', 'TaskController@all')->name('tasks.all');
    Route::get('/store', 'TaskController@store')->name('tasks.store');
    Route::get('/{id}/show', 'TaskController@show')->name('tasks.show');
    Route::get('/{id}/edit', 'TaskController@edit')->name('tasks.edit');
    Route::post('/{id}/update', 'TaskController@update')->name('tasks.update');
    Route::post('/{id}/update', 'TaskController@update')->name('tasks.update');
    Route::get('/{id}/cancel_edit', 'TaskController@cancelEdit')->name('tasks.cancel_edit');
    Route::post('/{id}/attach_files', 'TaskController@attachFiles')->name('tasks.attach_files');

    // Подзадачи
    Route::post('/{id}/subtasks/', 'SubTaskController@store')->name('tasks.subtasks.store');
    Route::post('/subtasks/{id}/update', 'SubTaskController@update')->name('tasks.subtasks.update');
    Route::get('/subtasks/{id}/edit', 'SubTaskController@edit')->name('tasks.subtasks.edit');
    Route::get('/subtasks/{id}/cancel_edit', 'SubTaskController@cancelEdit')->name('tasks.subtasks.cancel_edit');
    Route::get('/subtasks/{id}/destroy', 'SubTaskController@destroy')->name('tasks.subtasks.destroy');
    Route::get('/subtasks/{id}/comments', 'SubTaskController@comments')->name('tasks.subtasks.comments.index');
    Route::get('/subtasks/{id}/send_message', 'SubTaskController@sendMessage')->name('tasks.subtasks.comments.send_message');
});