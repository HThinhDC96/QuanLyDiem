<?php

namespace App\Http\Controllers;

use App\Models\CanBo;
use Carbon\Traits\ToStringFormat;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\Console\Logger\ConsoleLogger;

class CanBoController extends Controller
{
    public function index()
    {
        $page_title = "Cán bộ";
        $data = CanBo::getAllCanBo();
        // foreach($data as $item=>$value){
        //     print($value);
        //  }
        return view('pages.canbo.giaovien.indexcanbo', compact('page_title', 'data'));
    }
    public function create()
    {
        $page_title = "Tạo mới";
        return view('pages.canbo.giaovien.createcanbo', compact('page_title'));
    }
    public function store(Request $request)
    {
        try {
            $canbo = new Canbo();
            if (CanBo::where('macanbo', $request->macanbo)->first()) {
                return redirect()->back()->withInput();
            }

            // $canbo->macanbo = $request->macanbo;
            // $canbo->matkhau = $request->matkhau;
            // $canbo->hoten = $request->hoten;
            // $canbo->gioitinh = $request->gioitinh;
            // $canbo->ngaysinh = $request->ngaysinh;
            // $canbo->diachi = $request->diachi;
            // $canbo->sdt = $request->sdt;
            // $canbo->loai = $request->loai;
            $canbo->fill($request->toArray());

            // Khởi tạo mã cán bộ mới
            $mcb_lastest = CanBo::latest('macanbo')->select('macanbo')->first()->macanbo;
            $mcb_lastest = ((int) substr($mcb_lastest, 2)) + 1;
            $mcb_lastest = "CB".sprintf("%04d", $mcb_lastest);

            $canbo->macanbo = $mcb_lastest;
            $canbo->save();

            // Hiển thị thông báo thêm thành công
            toastr()->success('Thêm mới thành công!', 'Thành công!');

            return redirect()->route('canboManage.indexCanbo');
        } catch (Exception $e) {
            echo 'Có lỗi phát sinh: ', $e->getMessage(), "\n";
        }
    }
}
