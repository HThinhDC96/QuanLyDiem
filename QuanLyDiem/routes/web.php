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
    })->name('dashboard')->middleware('checkloginadmin::class');

    // Quản lý thông tin cán bộ
    Route::name('canboManage.')->group(function () {
        Route::get('/canbo', 'App\Http\Controllers\CanBoController@index')->name('indexCanbo')->middleware('checkloginadmin::class');
        Route::get('/canbo/create', 'App\Http\Controllers\CanBoController@create')->name('createCanbo')->middleware('checkloginadmin::class');
        Route::post('/canbo/store', 'App\Http\Controllers\CanBoController@store')->name('storeCanbo')->middleware('checkloginadmin::class');
        Route::get('/canbo/edit/{username}', 'App\Http\Controllers\CanBoController@edit')->name('editCanbo')->middleware('checkloginadmin::class');
        Route::put('/canbo/update', 'App\Http\Controllers\CanBoController@update')->name('updateCanbo')->middleware('checkloginadmin::class');
        Route::delete('/canbo/delete/{username}', 'App\Http\Controllers\CanBoController@delete')->name('deleteCanbo')->middleware('checkloginadmin::class');
        ///Route dang nhap bang tai khoan can bo
        Route::get('/htql/canbo', 'App\Http\Controllers\CanBoController@indexpagecanbo')->name('indexCanboPage')->middleware('checklogincanbo::class');
        Route::get('/htql/canbo/danhsachlopday/{mamonhoc}/{hocky}', 'App\Http\Controllers\DanhSachController@danhsachlopday')->name('danhsachlopday')->middleware('checklogincanbo::class');
        Route::get('/htql/canbo/danhsachlopchunhiem/{malop}/{hocky}', 'App\Http\Controllers\DanhSachController@danhsachlopchunhiem')->name('danhsachlopchunhiem')->middleware('checklogincanbo::class');
        Route::get('/htql/canbo/danhsachlopchunhiem/bangdiem/{malop}/3', 'App\Http\Controllers\DanhSachController@bangdiemcanamlopchunhiem')->name('bangdiemcanamlopchunhiem')->middleware('checklogincanbo::class');
        Route::get('/htql/canbo/danhsachlopday/bangdiem/{mamonhoc}/3', 'App\Http\Controllers\DanhSachController@bangdiemcanamlopday')->name('bangdiemcanamlopday')->middleware('checklogincanbo::class');
    });

    //Phan Quyen - Ban Giam Hieu
    Route::name('phanquyen.')->group(function () {
        Route::get('/bangiamhieu/phanquyen', 'App\Http\Controllers\PhanQuyenController@index')->name('phanquyen')->middleware('checkloginadmin::class');
    });

    //Mon hoc co ban
    Route::name('monManage.')->group(function () {
        Route::get('/mon', 'App\Http\Controllers\MonController@index')->name('indexMon')->middleware('checkloginadmin::class');
        Route::get('/mon/create', 'App\Http\Controllers\MonController@create')->name('createMon')->middleware('checkloginadmin::class');
        Route::post('/mon/store', 'App\Http\Controllers\MonController@store')->name('storeMon')->middleware('checkloginadmin::class');
        Route::get('/mon/edit/{mamon}', 'App\Http\Controllers\MonController@edit')->name('editMon')->middleware('checkloginadmin::class');
        Route::post('/mon/update', 'App\Http\Controllers\MonController@update')->name('updateMon')->middleware('checkloginadmin::class');
        Route::delete('/mon/delete/{mamon}', 'App\Http\Controllers\MonController@delete')->name('deleteMon')->middleware('checkloginadmin::class');
    });

    // Nien khoa
    Route::name('nienkhoaManage.')->group(function () {
        Route::get('/nienkhoa', 'App\Http\Controllers\NienKhoaController@index')->name('indexNienKhoa')->middleware('checkloginadmin::class');
        Route::get('/nienkhoa/create', 'App\Http\Controllers\NienKhoaController@create')->name('createNienKhoa')->middleware('checkloginadmin::class');
        Route::post('/nienkhoa/store', 'App\Http\Controllers\NienKhoaController@store')->name('storeNienKhoa')->middleware('checkloginadmin::class');
        Route::get('/nienkhoa/edit/{manienkhoa}', 'App\Http\Controllers\NienKhoaController@edit')->name('editNienKhoa')->middleware('checkloginadmin::class');
        Route::post('/nienkhoa/update', 'App\Http\Controllers\NienKhoaController@update')->name('updateNienKhoa')->middleware('checkloginadmin::class');
        Route::delete('/nienkhoa/delete/{manienkhoa}', 'App\Http\Controllers\NienKhoaController@delete')->name('deleteNienKhoa')->middleware('checkloginadmin::class');
    })->middleware('checkloginadmin::class');

    // Lop
    Route::name('lopManage.')->group(function () {
        Route::get('/lop', 'App\Http\Controllers\LopController@index')->name('indexLop')->middleware('checkloginadmin::class');
        Route::get('/lop/create', 'App\Http\Controllers\LopController@create')->name('createLop')->middleware('checkloginadmin::class');
        Route::post('/lop/store', 'App\Http\Controllers\LopController@store')->name('storeLop')->middleware('checkloginadmin::class');
        Route::get('/lop/edit/{malop}', 'App\Http\Controllers\LopController@edit')->name('editLop')->middleware('checkloginadmin::class');
        Route::post('/lop/update', 'App\Http\Controllers\LopController@update')->name('updateLop')->middleware('checkloginadmin::class');
        Route::delete('/lop/delete/{malop}', 'App\Http\Controllers\LopController@delete')->name('deleteLop')->middleware('checkloginadmin::class');
    })->middleware('checkloginadmin::class');

    // Quản lý thông tin học sinh
    Route::name('hocsinhManage.')->group(function () {
        Route::get('/hocsinh', 'App\Http\Controllers\HSPHController@index_HS')->name('index')->middleware('checkloginadmin::class');
        Route::get('/hocsinh/create', 'App\Http\Controllers\HSPHController@create_HS')->name('create')->middleware('checkloginadmin::class');
        Route::post('/hocsinh/store', 'App\Http\Controllers\HSPHController@store_HS')->name('store')->middleware('checkloginadmin::class');
        Route::get('/hocsinh/edit/{mahocsinh}', 'App\Http\Controllers\HSPHController@edit_HS')->name('edit')->middleware('checkloginadmin::class');
        Route::put('/hocsinh/update', 'App\Http\Controllers\HSPHController@update_HS')->name('update')->middleware('checkloginadmin::class');
        Route::delete('/hocsinh/delete/{mahocsinh}', 'App\Http\Controllers\HSPHController@delete_HS')->name('delete')->middleware('checkloginadmin::class');
        //Giao dien hoc sinh
        Route::get('/htql/hocsinh', 'App\Http\Controllers\HSPHController@indexHocSinhPage')->name('indexHocsinhPage')->middleware('checkloginhocsinh::class');
        Route::get('/htql/hocsinh/{malop}/{hocki}', 'App\Http\Controllers\DanhSachController@diemhocsinh')->name('diemhocsinh')->middleware('checkloginhocsinh::class');
        Route::get('/htql/hocsinh/canam/{malop}/3', 'App\Http\Controllers\DanhSachController@getDiemCaNamHS')->name('getDiemCaNamHS')->middleware('checkloginhocsinh::class');
    });

    // Quản lý thông tin phụ huynh
    Route::name('phuhuynhManage.')->group(function () {
        Route::get('/phuhuynh', 'App\Http\Controllers\HSPHController@index_PH')->name('index')->middleware('checkloginadmin::class');
        Route::get('/phuhuynh/create', 'App\Http\Controllers\HSPHController@create_PH')->name('create')->middleware('checkloginadmin::class');
        Route::post('/phuhuynh/store', 'App\Http\Controllers\HSPHController@store_PH')->name('store')->middleware('checkloginadmin::class');
        Route::get('/phuhuynh/edit/{maphuhuynh}', 'App\Http\Controllers\HSPHController@edit_PH')->name('edit')->middleware('checkloginadmin::class');
        Route::put('/phuhuynh/update', 'App\Http\Controllers\HSPHController@update_PH')->name('update')->middleware('checkloginadmin::class');
        Route::delete('/phuhuynh/delete/{maphuhuynh}', 'App\Http\Controllers\HSPHController@delete_PH')->name('delete')->middleware('checkloginadmin::class');
        //giao dien phu huynh
        Route::get('/htql/phuhuynh', 'App\Http\Controllers\HSPHController@indexPhuHuynhPage')->name('indexPhuHuynhPage')->middleware('checkloginphuhuynh::class');
        Route::get('/htql/phuhuynh/{mahocsinh}/{malop}/{hocki}', 'App\Http\Controllers\DanhSachController@diemhocsinhPH')->name('diemhocsinhPH')->middleware('checkloginphuhuynh::class');
        Route::get('/htql/phuhuynh/canam/{mahocsinh}/{malop}/3', 'App\Http\Controllers\DanhSachController@getDiemCaNamHSPH')->name('getDiemCaNamHSPH')->middleware('checkloginphuhuynh::class');
    });

    //Mon Hoc
    Route::name('monhocManage.')->group(function () {
        Route::get('/monhoc', 'App\Http\Controllers\MonHocController@index')->name('indexMonHoc')->middleware('checkloginadmin::class');
        Route::get('/monhoc/create', 'App\Http\Controllers\MonHocController@create')->name('createMonHoc')->middleware('checkloginadmin::class');
        Route::post('/monhoc/store', 'App\Http\Controllers\MonHocController@store')->name('storeMonHoc')->middleware('checkloginadmin::class');
        Route::get('/monhoc/edit/{mamonhoc}', 'App\Http\Controllers\MonHocController@edit')->name('editMonHoc')->middleware('checkloginadmin::class');
        Route::post('/monhoc/update', 'App\Http\Controllers\MonHocController@update')->name('updateMonHoc')->middleware('checkloginadmin::class');
        Route::delete('/monhoc/delete/{mamonhoc}', 'App\Http\Controllers\MonHocController@delete')->name('deleteMonHoc')->middleware('checkloginadmin::class');
    });

    //Loai Diem
    Route::name('loaidiemManage.')->group(function () {
        Route::get('/loaidiem', 'App\Http\Controllers\LoaiDiemController@index')->name('indexLoaiDiem')->middleware('checkloginadmin::class');
        Route::get('/loaidiem/create', 'App\Http\Controllers\LoaiDiemController@create')->name('createLoaiDiem')->middleware('checkloginadmin::class');
        Route::post('/loaidiem/store', 'App\Http\Controllers\LoaiDiemController@store')->name('storeLoaiDiem')->middleware('checkloginadmin::class');
        Route::get('/loaidiem/edit/{maloaidiem}', 'App\Http\Controllers\LoaiDiemController@edit')->name('editLoaiDiem')->middleware('checkloginadmin::class');
        Route::post('/loaidiem/update', 'App\Http\Controllers\LoaiDiemController@update')->name('updateLoaiDiem')->middleware('checkloginadmin::class');
        Route::delete('/loaidiem/delete/{maloaidiem}', 'App\Http\Controllers\LoaiDiemController@delete')->name('deleteLoaiDiem')->middleware('checkloginadmin::class');
    });

    // Quan ly diem
    Route::name('diemManage.')->group(function () {
        Route::get('/diem/edit/hk{hocki}/{mahocsinh}/{mamonhoc}', 'App\Http\Controllers\DiemController@edit')->name('edit')->middleware('checklogincanbo::class');
        Route::post('/diem/update', 'App\Http\Controllers\DiemController@update')->name('update')->middleware('checklogincanbo::class');
    });
});
