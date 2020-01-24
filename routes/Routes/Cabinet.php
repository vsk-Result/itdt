<?php

Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
    Route::get('/', 'ProfileController@index')->name('home');
});