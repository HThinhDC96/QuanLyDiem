<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\Auth\LoginController@showFormLogin')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@xacthuc')->name('xacthuc-login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['App\Http\Middleware\checkPermission']], function () {
    Route::get('/dashboard', function () {
        $page_title="Quản trị";
        return view('pages.canbo.dashboard', compact('page_title'));
    })->name('dashboard');
    Route::name('canboManage.')->group(function () {
        Route::get('/canbo', 'App\Http\Controllers\CanBoController@index')->name('indexCanbo');
        Route::get('/canbo/create', 'App\Http\Controllers\CanBoController@create')->name('createCanbo');
        Route::post('/canbo/store', 'App\Http\Controllers\CanBoController@store')->name('storeCanbo');
        Route::get('/canbo/edit/{username}', 'App\Http\Controllers\CanBoController@edit')->name('editCanbo');
        Route::put('/canbo/update/{username}', 'App\Http\Controllers\CanBoController@update')->name('updateCanbo');
    });
});
