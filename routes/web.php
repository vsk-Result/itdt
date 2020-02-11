<?php

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('/');
    Route::post('/upload', 'UploadController@store')->name('upload');
});

Route::get('events', 'EventController@index')->name('events');
Route::get('events/pidr', 'EventController@all')->name('all');
Route::get('events/create', 'EventController@create')->name('event_create');
Route::get('events/show', 'EventController@update')->name('event_show');
Route::get('events/modal/{id}', 'EventController@modal')->name('event_modal');


Route::get('events/{name}', function($name) {
    return view("calendar.". $name);
});
