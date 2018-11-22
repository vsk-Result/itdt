<?php

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::redirect('/', '/objects')->name('/');

    foreach (File::allFiles(__DIR__ . '/Routes') as $partial) {
        require_once $partial->getPathname();
    }

});
