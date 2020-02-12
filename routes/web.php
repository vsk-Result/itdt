<?php

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('/');
    Route::post('/upload', 'UploadController@store')->name('upload');
});

Route::get('events', 'EventController@index')->name('events');
Route::get('events/pidr', 'EventController@all')->name('all');
Route::get('events/create', 'EventController@create')->name('event_create');
Route::get('events/update', 'EventController@update')->name('event_update');
Route::get('events/modal/{id}', 'EventController@modal')->name('event_modal');
Route::get('events/edit/{id}', 'EventController@edit')->name('event_edit');
Route::get('events/destroy/{id}', 'EventController@destroy')->name('event_destroy');
Route::get('events/status', 'EventController@status')->name('event_status');



Route::get('events/{name}', function($name) {
    return view("calendar.". $name);
});
