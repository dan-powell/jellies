<?php

Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['auth']], function () {

        Route::get('dashboard', 'DanPowell\Jellies\Http\Controllers\DashboardController@index')->name('dashboard');

        Route::resource('user', 'DanPowell\Jellies\Http\Controllers\UserController', ['only' => [
            'show'
        ]]);
        Route::get('showtypes', 'DanPowell\Jellies\Http\Controllers\UserController@showtypes')->name('user.types');

        Route::resource('message', 'DanPowell\Jellies\Http\Controllers\MessageController');

        Route::resource('minion', 'DanPowell\Jellies\Http\Controllers\MinionController', ['only' => [
            'index', 'show', 'create', 'store', 'edit', 'update'
        ]]);

        Route::resource('attack', 'DanPowell\Jellies\Http\Controllers\AttackController', ['only' => [
            'index', 'show', 'create', 'store'
        ]]);

        Route::resource('defence', 'DanPowell\Jellies\Http\Controllers\DefenceController', ['only' => [
            'index', 'show'
        ]]);

        Route::resource('type', 'DanPowell\Jellies\Http\Controllers\TypeController', ['only' => [
            'index', 'show'
        ]]);

        Route::get('miniondeleted', 'DanPowell\Jellies\Http\Controllers\MinionController@indexDeleted')->name('minion.deleted');
        Route::post('minion/{id}/heal', 'DanPowell\Jellies\Http\Controllers\MinionController@heal')->name('minion.heal');

        Route::resource('realm', 'DanPowell\Jellies\Http\Controllers\RealmController', ['only' => [
            'index', 'show'
        ]]);

    });

});
