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
        Route::get('miniondeleted', 'DanPowell\Jellies\Http\Controllers\MinionController@indexDeleted')->name('minion.deleted');

        Route::resource('attack', 'DanPowell\Jellies\Http\Controllers\AttackController', ['only' => [
            'index', 'show', 'create', 'store'
        ]]);

        Route::resource('defence', 'DanPowell\Jellies\Http\Controllers\DefenceController', ['only' => [
            'index', 'show'
        ]]);

        Route::resource('type', 'DanPowell\Jellies\Http\Controllers\TypeController', ['only' => [
            'index', 'show'
        ]]);



        Route::resource('realm', 'DanPowell\Jellies\Http\Controllers\RealmController', ['only' => [
            'index', 'show'
        ]]);

        Route::resource('zone', 'DanPowell\Jellies\Http\Controllers\ZoneController', ['only' => [
            'show'
        ]]);

        Route::resource('enemy', 'DanPowell\Jellies\Http\Controllers\EnemyController', ['only' => [
            'index', 'show'
        ]]);


        Route::resource('incursion', 'DanPowell\Jellies\Http\Controllers\IncursionController', ['only' => [
            'index', 'show', 'create', 'store', 'destroy'
        ]]);
        Route::post('incursion/{id}/proceed', 'DanPowell\Jellies\Http\Controllers\IncursionController@proceed')->name('incursion.proceed');
        Route::get('incursion/{id}/process', 'DanPowell\Jellies\Http\Controllers\IncursionController@process')->name('incursion.process');
        Route::delete('incursion/{id}/finish', 'DanPowell\Jellies\Http\Controllers\IncursionController@finish')->name('incursion.finish');

        Route::resource('encounter', 'DanPowell\Jellies\Http\Controllers\EncounterController', ['only' => [
            'show'
        ]]);


    });

});
