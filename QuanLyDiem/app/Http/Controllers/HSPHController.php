<?php

namespace App\Http\Controllers;

use App\Models\HocSinh;
use App\Models\LopHoc;
use App\Models\PhuHuynh;
// use Carbon\Traits\ToStringFormat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Symfony\Component\Console\Logger\ConsoleLogger;

use function PHPUnit\Framework\isNull;

class HSPHController extends Controller
{
    public function index_HS()
    {
        $page_title = "Học Sinh";
        $data = HocSinh::getAll();
        // foreach($data as $item=>$value){
        //     print($value);
        //  }
        confirmDelete("", "");

        // dd(session()->all());
        return view('pages.hocsinh_phuhuynh.hocsinh.index', compact('page_title', 'data'));
    }

    public function create_HS()
    {
        $page_title = "Tạo mới - Học sinh";
        return view('pages.hocsinh_phuhuynh.hocsinh.create', compact('page_title'));
    }
    public function store_HS(Request $request)
    {
        try {
            $hocsinh = new HocSinh();
            // if (HocSinh::where('mahocsinh', $request->mahocsinh)->first()) {
            //     return redirect()->back()->withInput();
            // }

            $hocsinh->fill($request->toArray());

            // Khởi tạo mã cán bộ mới
            $hs_lastest = HocSinh::latest('mahocsinh')->select('mahocsinh')->first();
            if ($hs_lastest == null) {
                $mhs_lastest = "HS00001";
            } else {
                $mhs_lastest = $hs_lastest->mahocsinh;
                $mhs_lastest = ((int) substr($mhs_lastest, 2)) + 1;
                $mhs_lastest = "HS" . sprintf("%05d", $mhs_lastest);
            }

            $hocsinh->mahocsinh = $mhs_lastest;
            $hocsinh->save();

            // Hiển thị thông báo thêm thành công
            toastr()->success('Thêm mới thành công!', 'Thành công!');

            return redirect()->route('hocsinhManage.index');
        } catch (Exception $e) {
            echo 'Có lỗi phát sinh: ', $e->getMessage(), "\n";
        }
    }

    public function edit_HS($id)
    {
        $page_title = "Chỉnh Sửa Thông tin học sinh - MSHS: ".$id;
        $info = HocSinh::find($id);
        return view('pages.hocsinh_phuhuynh.hocsinh.edit', compact('page_title', 'info'));
    }

    public function update_HS(Request $request)
    {
        try {
            $hocsinh = HocSinh::find($request->mahocsinh);

            $matkhau = $hocsinh->matkhau;
            $hocsinh->fill($request->toArray());
            if ($request->matkhau == "" || $request->matkhau == null) {
                $hocsinh->matkhau = $matkhau;
            }
            $hocsinh->save();
            toastr()->success('Cập nhật thông tin thành công!', 'Thành công!');
            return redirect()->route('hocsinhManage.index');
        } catch (Exception $e) {
            echo 'Có lỗi phát sinh: ', $e->getMessage(), "\n";
        }
    }

    public function delete_HS($mahocsinh)
    {
        try {
            $hocsinh = HocSinh::find($mahocsinh);
            $hocsinh->delete();
            toastr()->success('Xoá thành công!', 'Thành công!');
            return redirect()->route('hocsinhManage.indexhocsinh');
        } catch (QueryException $e) {
            // Lỗi dữ liệu được sử dụng (cha-con)
            if ($e->errorInfo[1] == 1451) {
                toastr()->error('Xoá không thành công! Dữ liệu đã được sử dụng!', 'Lỗi!');
                return redirect()->back();
            }
        } catch (Exception $e) {
            echo 'Có lỗi phát sinh: ', $e->getMessage(), "\n";
        }
    }

    /* -------------------------------------------------------------------- */
    // QUẢN LÝ THÔNG TIN PHỤ HUYNH

    // Show page - Quản lý phụ huynh
    public function index_PH()
    {
        $page_title = "Phụ Huynh - Danh Sách";
        $data = PhuHuynh::getAll();
        // foreach($data as $item=>$value){
        //     print($value);
        //  }
        confirmDelete("", "");
        // dd(session()->all());
        return view('pages.hocsinh_phuhuynh.phuhuynh.index', compact('page_title', 'data'));
    }

    public function create_PH()
    {
        $page_title = "Phụ Huynh - Thêm Mới";
        return view('pages.hocsinh_phuhuynh.phuhuynh.create', compact('page_title'));
    }
    public function store_PH(Request $request)
    {
        try {
            $phuhuynh = new PhuHuynh();
            $phuhuynh->fill($request->toArray());

            // Khởi tạo mã cán bộ mới
            $ph_lastest = PhuHuynh::latest('maphuhuynh')->select('maphuhuynh')->first();
            if ($ph_lastest == null) {
                $mph_lastest = "PH00001";
            } else {
                $mph_lastest = $ph_lastest->mahocsinh;
                $mph_lastest = ((int) substr($mph_lastest, 2)) + 1;
                $mph_lastest = "PH" . sprintf("%05d", $mph_lastest);
            }

            $phuhuynh->maphuhuynh = $mph_lastest;
            $phuhuynh->save();

            // Hiển thị thông báo thêm thành công
            toastr()->success('Thêm mới thành công!', 'Thành công!');

            return redirect()->route('phuhuynhManage.index');
        } catch (Exception $e) {
            echo 'Có lỗi phát sinh: ', $e->getMessage(), "\n";
        }
    }

    public function edit_PH($id)
    {
        $page_title = "Phụ huynh - Chỉnh Sửa Thông tin - Mã Số: ".$id;
        $info = PhuHuynh::find($id);
        return view('pages.hocsinh_phuhuynh.phuhuynh.edit', compact('page_title', 'info'));
    }

    public function update_PH(Request $request)
    {
        try {
            $phuhuynh = PhuHuynh::find($request->maphuhuynh);

            $matkhau = $phuhuynh->matkhau;
            $phuhuynh->fill($request->toArray());
            if ($request->matkhau == "" || $request->matkhau == null) {
                $phuhuynh->matkhau = $matkhau;
            }
            $phuhuynh->save();
            toastr()->success('Cập nhật thông tin thành công!', 'Thành công!');
            return redirect()->route('hocsinhManage.index');
        } catch (Exception $e) {
            echo 'Có lỗi phát sinh: ', $e->getMessage(), "\n";
        }
    }

    public function delete_PH($maphuhuynh)
    {
        try {
            $phuhuynh = PhuHuynh::find($maphuhuynh);
            $phuhuynh->delete();
            toastr()->success('Xoá thành công!', 'Thành công!');
            return redirect()->route('hocsinhManage.indexhocsinh');
        } catch (QueryException $e) {
            // Lỗi dữ liệu được sử dụng (cha-con)
            if ($e->errorInfo[1] == 1451) {
                toastr()->error('Xoá không thành công! Dữ liệu đã được sử dụng!', 'Lỗi!');
                return redirect()->back();
            }
        } catch (Exception $e) {
            echo 'Có lỗi phát sinh: ', $e->getMessage(), "\n";
        }
    }

    public function indexHocSinhPage(){
        $page_title = "Bảng điểm cá nhân";
        $mahocsinh=session('userid');

        $datalop=LopHoc::join('lop','lophoc.malop','lop.malop')
                        ->where('mahocsinh',$mahocsinh)->get();
        return view('pages.hocsinh.index', compact('page_title','datalop'));
    }
}
