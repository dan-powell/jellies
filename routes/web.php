<?php


//
// Route::get('/', function () {
//     return view('public.home.publicHome');
// });

Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['auth']], function () {

        Route::get('dashboard', 'DanPowell\Jellies\Http\Controllers\DashboardController@index')->name('dashboard');

        Route::resource('message', 'DanPowell\Jellies\Http\Controllers\MessageController');
        Route::resource('minion', 'DanPowell\Jellies\Http\Controllers\MinionController', ['only' => [
            'index', 'show', 'create', 'store', 'edit', 'update'
        ]]);
        Route::get('miniondeleted', 'DanPowell\Jellies\Http\Controllers\MinionController@indexDeleted')->name('minion.deleted');
        Route::post('minion/{id}/heal', 'DanPowell\Jellies\Http\Controllers\MinionController@heal')->name('minion.heal');

        Route::resource('enemy', 'DanPowell\Jellies\Http\Controllers\EnemyController', ['only' => [
            'index', 'show'
        ]]);

        Route::resource('realm', 'DanPowell\Jellies\Http\Controllers\RealmController', ['only' => [
            'index', 'show'
        ]]);

        Route::resource('zone', 'DanPowell\Jellies\Http\Controllers\ZoneController', ['only' => [
            'show'
        ]]);

        Route::resource('incursion', 'DanPowell\Jellies\Http\Controllers\IncursionController', ['only' => [
            'index', 'show', 'create', 'store', 'destroy'
        ]]);
        Route::post('incursion/{id}/proceed', 'DanPowell\Jellies\Http\Controllers\IncursionController@proceed')->name('incursion.proceed');
        Route::get('incursion/{id}/process', 'DanPowell\Jellies\Http\Controllers\IncursionController@process')->name('incursion.process');
    });

});
