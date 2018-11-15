<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::middleware('auth')->group(function () {

    Route::redirect('/', '/home')->name('/');
    Route::get('/home', 'HomeController@index')->name('home');

    foreach (File::allFiles(__DIR__ . '/Routes') as $partial) {
        require_once $partial->getPathname();
    }
});
