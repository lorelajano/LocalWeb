<?php

use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('status');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){

    Route::match(['get','patch'], 'users/{user}/confirmed', 'UsersController@confirmed')->name('users.confirmed');
    Route::get('users/{filename}', 'UsersController@showId');
    Route::resource('users', UsersController::class)->only([
        'index', 'destroy','edit','update',
    ]);
});

Route::namespace('User')->prefix('user')->name('user.')->middleware('can:is-user')->group(function(){
    Route::get('/{id}/{datetime}', 'PermissionController@updated');
    Route::get('/processing', 'PermissionController@showProcessing')->middleware('can:is-processing')->name('processing');
    Route::resource('permission', PermissionController::class)->middleware('can:is-pending')->only([
        'index', 'update'
    ]);


});
