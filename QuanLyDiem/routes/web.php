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
});
