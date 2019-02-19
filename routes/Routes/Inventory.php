<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'inventory',
    'as' => 'inventory.',
    'namespace' => 'Inventory',
], function () {
    Route::get('/', 'InventoryController@index')->name('index');

    Route::group([
        'prefix' => 'orders',
        'as' => 'orders.',
    ], function () {
        Route::get('/', 'OrderController@index')->name('index');
        Route::post('/', 'OrderController@store')->name('store');
    });

    Route::group([
        'prefix' => 'printer_models',
        'as' => 'printer_models.',
    ], function () {
        Route::post('/', 'PrinterModelController@store')->name('store');
        Route::get('/{printer_model}/edit', 'PrinterModelController@edit')->name('edit');
        Route::put('/{printer_model}', 'PrinterModelController@update')->name('update');
        Route::delete('/{printer_model}', 'PrinterModelController@destroy')->name('destroy');
    });

    Route::group([
        'prefix' => 'printers',
        'as' => 'printers.',
    ], function () {
        Route::get('/', 'PrinterController@index')->name('index');
        Route::post('/', 'PrinterController@store')->name('store');
        Route::get('/{printer}/edit', 'PrinterController@edit')->name('edit');
        Route::put('/{printer}', 'PrinterController@update')->name('update');
        Route::delete('/{printer}', 'PrinterController@destroy')->name('destroy');
    });

    Route::group([
        'prefix' => 'consumables',
        'as' => 'consumables.',
    ], function () {
        Route::get('/', 'ConsumableController@index')->name('index');
        Route::post('/', 'ConsumableController@store')->name('store');
        Route::get('/{consumable}', 'ConsumableController@show')->name('show');
        Route::get('/{consumable}/edit', 'ConsumableController@edit')->name('edit');
        Route::put('/{consumable}', 'ConsumableController@update')->name('update');
        Route::delete('/{consumable}', 'ConsumableController@destroy')->name('destroy');

        Route::group([
            'prefix' => '/{consumable}/movements',
            'as' => 'movements.',
        ], function () {
            Route::post('/', 'MovementController@store')->name('store');
            Route::get('/{movement}/edit', 'MovementController@edit')->name('edit');
            Route::put('/{movement}', 'MovementController@update')->name('update');
            Route::delete('/{movement}', 'MovementController@destroy')->name('destroy');
            Route::post('/{movement}/pending', 'MovementController@pending')->name('pending');
            Route::post('/{movement}/confirm', 'MovementController@confirm')->name('confirm');
        });

        Route::group([
            'prefix' => '/{consumable}/replacements',
            'as' => 'replacements.',
        ], function () {
            Route::post('/', 'ReplacementController@store')->name('store');
            Route::get('/{replacement}/edit', 'ReplacementController@edit')->name('edit');
            Route::put('/{replacement}', 'ReplacementController@update')->name('update');
            Route::delete('/{replacement}', 'ReplacementController@destroy')->name('destroy');
        });
    });
});