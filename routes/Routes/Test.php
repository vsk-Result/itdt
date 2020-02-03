<?php

use Illuminate\Support\Facades\Route;

Route::get('test', 'TestController@index')->name('test');
