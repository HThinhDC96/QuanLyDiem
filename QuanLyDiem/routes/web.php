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

    // Quản lý thông tin cán bộ
    Route::name('canboManage.')->group(function () {
        Route::get('/canbo', 'App\Http\Controllers\CanBoController@index')->name('indexCanbo');
        Route::get('/canbo/create', 'App\Http\Controllers\CanBoController@create')->name('createCanbo');
        Route::post('/canbo/store', 'App\Http\Controllers\CanBoController@store')->name('storeCanbo');
        Route::get('/canbo/edit/{username}', 'App\Http\Controllers\CanBoController@edit')->name('editCanbo');
        Route::put('/canbo/update', 'App\Http\Controllers\CanBoController@update')->name('updateCanbo');
        Route::delete('/canbo/delete/{username}', 'App\Http\Controllers\CanBoController@delete')->name('deleteCanbo');
        ///Route dang nhap bang tai khoan can bo
        Route::get('/htql/canbo', 'App\Http\Controllers\CanBoController@indexpagecanbo')->name('indexCanboPage');
        Route::get('/htql/canbo/danhsachlopday/{malop}', 'App\Http\Controllers\DanhSachController@danhsachlopday')->name('danhsachlopday');
        Route::get('/htql/canbo/danhsachlopchunhiem/{malop}', 'App\Http\Controllers\DanhSachController@danhsachlopchunhiem')->name('danhsachlopchunhiem');
    });

    //Phan Quyen - Ban Giam Hieu
    Route::name('phanquyen.')->group(function () {
        Route::get('/bangiamhieu/phanquyen', 'App\Http\Controllers\PhanQuyenController@index')->name('phanquyen');
    });

    //Mon hoc co ban
    Route::name('monManage.')->group(function () {
        Route::get('/mon', 'App\Http\Controllers\MonController@index')->name('indexMon');
        Route::get('/mon/create', 'App\Http\Controllers\MonController@create')->name('createMon');
        Route::post('/mon/store', 'App\Http\Controllers\MonController@store')->name('storeMon');
        Route::get('/mon/edit/{mamon}', 'App\Http\Controllers\MonController@edit')->name('editMon');
        Route::post('/mon/update', 'App\Http\Controllers\MonController@update')->name('updateMon');
        Route::delete('/mon/delete/{mamon}', 'App\Http\Controllers\MonController@delete')->name('deleteMon');
    });

    // Nien khoa
    Route::name('nienkhoaManage.')->group(function () {
        Route::get('/nienkhoa', 'App\Http\Controllers\NienKhoaController@index')->name('indexNienKhoa');
        Route::get('/nienkhoa/create', 'App\Http\Controllers\NienKhoaController@create')->name('createNienKhoa');
        Route::post('/nienkhoa/store', 'App\Http\Controllers\NienKhoaController@store')->name('storeNienKhoa');
        Route::get('/nienkhoa/edit/{manienkhoa}', 'App\Http\Controllers\NienKhoaController@edit')->name('editNienKhoa');
        Route::post('/nienkhoa/update', 'App\Http\Controllers\NienKhoaController@update')->name('updateNienKhoa');
        Route::delete('/nienkhoa/delete/{manienkhoa}', 'App\Http\Controllers\NienKhoaController@delete')->name('deleteNienKhoa');
    });

    // Lop
    Route::name('lopManage.')->group(function () {
        Route::get('/lop', 'App\Http\Controllers\LopController@index')->name('indexLop');
        Route::get('/lop/create', 'App\Http\Controllers\LopController@create')->name('createLop');
        Route::post('/lop/store', 'App\Http\Controllers\LopController@store')->name('storeLop');
        Route::get('/lop/edit/{malop}', 'App\Http\Controllers\LopController@edit')->name('editLop');
        Route::post('/lop/update', 'App\Http\Controllers\LopController@update')->name('updateLop');
        Route::delete('/lop/delete/{malop}', 'App\Http\Controllers\LopController@delete')->name('deleteLop');
    });

    // Quản lý thông tin học sinh
    Route::name('hocsinhManage.')->group(function () {
        Route::get('/hocsinh', 'App\Http\Controllers\HSPHController@index_HS')->name('index');
        Route::get('/hocsinh/create', 'App\Http\Controllers\HSPHController@create_HS')->name('create');
        Route::post('/hocsinh/store', 'App\Http\Controllers\HSPHController@store_HS')->name('store');
        Route::get('/hocsinh/edit/{mahocsinh}', 'App\Http\Controllers\HSPHController@edit_HS')->name('edit');
        Route::put('/hocsinh/update', 'App\Http\Controllers\HSPHController@update_HS')->name('update');
        Route::delete('/hocsinh/delete/{mahocsinh}', 'App\Http\Controllers\HSPHController@delete_HS')->name('delete');
    });

    // Quản lý thông tin phụ huynh
    Route::name('phuhuynhManage.')->group(function () {
        Route::get('/phuhuynh', 'App\Http\Controllers\HSPHController@index_PH')->name('index');
        Route::get('/phuhuynh/create', 'App\Http\Controllers\HSPHController@create_PH')->name('create');
        Route::post('/phuhuynh/store', 'App\Http\Controllers\HSPHController@store_PH')->name('store');
        Route::get('/phuhuynh/edit/{maphuhuynh}', 'App\Http\Controllers\HSPHController@edit_PH')->name('edit');
        Route::put('/phuhuynh/update', 'App\Http\Controllers\HSPHController@update_PH')->name('update');
        Route::delete('/phuhuynh/delete/{maphuhuynh}', 'App\Http\Controllers\HSPHController@delete_PH')->name('delete');
    });

    //Mon Hoc
    Route::name('monhocManage.')->group(function () {
        Route::get('/monhoc', 'App\Http\Controllers\MonHocController@index')->name('indexMonHoc');
        Route::get('/monhoc/create', 'App\Http\Controllers\MonHocController@create')->name('createMonHoc');
        Route::post('/monhoc/store', 'App\Http\Controllers\MonHocController@store')->name('storeMonHoc');
        Route::get('/monhoc/edit/{mamonhoc}', 'App\Http\Controllers\MonHocController@edit')->name('editMonHoc');
        Route::post('/monhoc/update', 'App\Http\Controllers\MonHocController@update')->name('updateMonHoc');
        Route::delete('/monhoc/delete/{mamonhoc}', 'App\Http\Controllers\MonHocController@delete')->name('deleteMonHoc');
    });

    //Loai Diem
    Route::name('loaidiemManage.')->group(function () {
        Route::get('/loaidiem', 'App\Http\Controllers\LoaiDiemController@index')->name('indexLoaiDiem');
        Route::get('/loaidiem/create', 'App\Http\Controllers\LoaiDiemController@create')->name('createLoaiDiem');
        Route::post('/loaidiem/store', 'App\Http\Controllers\LoaiDiemController@store')->name('storeLoaiDiem');
        Route::get('/loaidiem/edit/{maloaidiem}', 'App\Http\Controllers\LoaiDiemController@edit')->name('editLoaiDiem');
        Route::post('/loaidiem/update', 'App\Http\Controllers\LoaiDiemController@update')->name('updateLoaiDiem');
        Route::delete('/loaidiem/delete/{maloaidiem}', 'App\Http\Controllers\LoaiDiemController@delete')->name('deleteLoaiDiem');
    });
});
