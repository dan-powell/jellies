<?php


//
// Route::get('/', function () {
//     return view('public.home.publicHome');
// });

Route::group(['middleware' => ['web']], function () {

// Authentication Routes...
Route::get('login', 'DanPowell\Jellies\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'DanPowell\Jellies\Http\Controllers\Auth\LoginController@login');
Route::post('logout', 'DanPowell\Jellies\Http\Controllers\Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'DanPowell\Jellies\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'DanPowell\Jellies\Http\Controllers\Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'DanPowell\Jellies\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'DanPowell\Jellies\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'DanPowell\Jellies\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'DanPowell\Jellies\Http\Controllers\Auth\ResetPasswordController@reset');


    Route::group(['middleware' => ['auth']], function () {

        Route::get('dashboard', 'DanPowell\Jellies\Http\Controllers\DashboardController@index')->name('dashboard');

        Route::get('test/processIncursion/{id}', 'DanPowell\Jellies\Http\Controllers\TestController@processIncursion')->name('test.processIncursion');


        Route::resource('message', 'DanPowell\Jellies\Http\Controllers\MessageController');
        Route::resource('minion', 'DanPowell\Jellies\Http\Controllers\MinionController', ['only' => [
            'index', 'show', 'store', 'edit', 'update'
        ]]);
        Route::get('miniondeleted', 'DanPowell\Jellies\Http\Controllers\MinionController@indexDeleted')->name('minion.deleted');
        Route::post('minion/{id}/heal', 'DanPowell\Jellies\Http\Controllers\MinionController@heal')->name('minion.heal');

        Route::resource('enemy', 'DanPowell\Jellies\Http\Controllers\EnemyController', ['only' => [
            'index', 'show'
        ]]);
        Route::resource('incursion', 'DanPowell\Jellies\Http\Controllers\IncursionController', ['only' => [
            'index', 'show', 'create', 'store', 'destroy'
        ]]);
    });

});
