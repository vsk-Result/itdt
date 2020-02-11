<?php

Route::get('/', 'EmployeeController@index')->name('index');
Route::get('/{employee}/show', 'EmployeeController@show')->name('show');
Route::post('/{employee}/edit', 'EmployeeController@update')->name('update');
Route::get('/{employee}/sign/{company}', 'EmployeeController@sign')->name('sign');
