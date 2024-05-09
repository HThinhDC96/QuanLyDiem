<?php

namespace App\Http\Controllers;

use App\Models\HocSinh;
use App\Models\LoaiDiem;
use App\Models\Lop;
use App\Models\LopHoc;
use App\Models\MonHoc;
use Illuminate\Http\Request;

class DanhSachController extends Controller
{
    public function danhsachlopday($malop){
        $page_title="Danh sách lớp ";

        //du lieu cho sidebar
        $macanbo=session('userid');
        $datalopchunhiem=Lop::from('lop')->where('chunhiem',$macanbo)->get();
        $datalopday=MonHoc::from('monhoc')
                                ->join('lop','lop.malop','monhoc.malop')
                                ->join('mon','monhoc.mamon','mon.mamon')
                                ->where('monhoc.macanbo',$macanbo)->get();
        // du lieu noi dung
        $i=0;
        $danhsachlop=LopHoc::from('lophoc')
                        ->join('hocsinh','hocsinh.mahocsinh','lophoc.mahocsinh')
                        ->where('malop',$malop)->get();
        $dataloaidiem=LoaiDiem::all();
        return view('pages.canbo.giaovien.danhsachlopday', compact('page_title','datalopchunhiem','datalopday','danhsachlop','dataloaidiem'));
    }
    public function danhsachlopchunhiem($malop){
        $page_title="Danh sách lớp ";

        //du lieu cho sidebar
        $macanbo=session('userid');
        $datalopchunhiem=Lop::from('lop')->where('chunhiem',$macanbo)->get();
        $datalopday=MonHoc::from('monhoc')
                                ->join('lop','lop.malop','monhoc.malop')
                                ->join('mon','monhoc.mamon','mon.mamon')
                                ->where('monhoc.macanbo',$macanbo)->get();
        //du lieu hien thi noi dung
        $danhsachlop=LopHoc::from('lophoc')
            ->join('hocsinh','lophoc.mahocsinh','hocsinh.mahocsinh')
            ->join('lop','lop.malop','lophoc.malop')
            ->where('lop.chunhiem',$macanbo)->get();
        $datamon=MonHoc::from('monhoc')
                ->join('mon','monhoc.mamon','mon.mamon')
        ->where('malop',$malop)->get();
        return view('pages.canbo.giaovien.danhsachlopchunhiem', compact('page_title','datalopchunhiem','datalopday','datamon','danhsachlop'));
    }
}
