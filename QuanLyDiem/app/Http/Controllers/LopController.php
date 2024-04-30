<?php

namespace App\Http\Controllers;

use App\Models\CanBo;
use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\NienKhoa;
use Exception;
use Illuminate\Database\QueryException;

class LopController extends Controller
{
    public function index()
    {
        $page_title = "Lớp";
        $data = Lop::from('lop')
            ->join('nienkhoa','nienkhoa.manienkhoa','lop.nienkhoa')
            ->join('canbo','canbo.macanbo','lop.chunhiem')->get();

        confirmDelete("", "");

        // dd(session()->all());
        return view('pages.danhmuc.lop.indexlop', compact('page_title', 'data'));
    }
    public function create()
    {
        $page_title = "Tạo mới";
        $datacanbo=CanBo::where('macanbo','LIKE','CB%')->get();
        $datanienkhoa=NienKhoa::all();
        return view('pages.danhmuc.lop.createlop', compact('page_title','datacanbo','datanienkhoa'));
    }
    public function store(Request $request)
    {
        try {
            $lop = new Lop();

            $lop->fill($request->toArray());

            // Khởi tạo mã cán bộ mới

            $lop->save();

            // Hiển thị thông báo thêm thành công
            toastr()->success('Thêm mới lớp ' . $lop->tenlop . ' thành công!', 'Thành công!');

            return redirect()->route('lopManage.indexLop');
        } catch (Exception $e) {
            echo 'Có lỗi phát sinh: ', $e->getMessage(), "\n";
        }
    }

    public function edit($id)
    {
        $page_title = "Chỉnh Sửa Thông tin Lớp";
        $info = Lop::find($id);
        $datacanbo=CanBo::where('macanbo','LIKE','CB%')->get();
        $datanienkhoa=NienKhoa::all();
        return view('pages.danhmuc.lop.editlop', compact('page_title', 'info','datacanbo','datanienkhoa'));
    }

    public function update(Request $request)
    {
        try {
            $lop = Lop::find($request->malop);


            $lop->fill($request->toArray());

            $lop->save();
            toastr()->success('Cập nhật thông tin thành công!', 'Thành công!');
            return redirect()->route('lopManage.indexLop');
        } catch (Exception $e) {
            echo 'Có lỗi phát sinh: ', $e->getMessage(), "\n";
        }
    }

    public function delete($malop)
    {
        try {
            $lop = Lop::find($malop);
            $lop->delete();
            toastr()->success('Xoá thành công!', 'Thành công!');
            return redirect()->route('lopManage.indexLop');
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
}
