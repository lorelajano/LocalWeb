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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('users', UsersController::class)->only([
        'index', 'destroy','edit','update'
    ]);
});

Route::namespace('User')->prefix('user')->name('user.')->group(function(){
//    Route::resource('user', UserController::class)->only([
//        'index', 'destroy','edit','update'
//    ]);

    Route::match(['get', 'post'], '/upload-id', 'PermissionController@index')->name('upload.id');;
});
