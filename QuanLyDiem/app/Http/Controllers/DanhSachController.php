<?php

namespace App\Http\Controllers;

use App\Models\HocSinh;
use App\Models\Diem;
use App\Models\LoaiDiem;
use App\Models\Lop;
use App\Models\LopHoc;
use App\Models\MonHoc;
use App\Models\Mon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
        $danhsachlop=LopHoc::from('lophoc')
                        ->join('hocsinh','hocsinh.mahocsinh','lophoc.mahocsinh')
                        ->where('malop',$malop)->get();

        // du lieu mon
        $monhoc = MonHoc::where([['malop', $malop], ['macanbo', $macanbo]])->get()->first();
        $mon = Mon::where('mamon', $monhoc->mamon)->get()->first();

        $dataloaidiem=LoaiDiem::where('loaimon', $mon->loaimon)->orWhere('loaimon', 3)->orderBy('heso')->get();

        // du lieu diem
        $diem = Diem::where([['mamonhoc', $monhoc->mamonhoc]])->get();
        $diemloai = $dataloaidiem->select('maloaidiem', 'soluong')->toArray();

        // $diemhs = [];
        // foreach ($danhsachlop as $item => $value) {
        //     $diemhs = Arr::add($diemhs, $value->mahocsinh, []);
        //     foreach ($dataloaidiem as $item2 => $value2) {
        //         $diemmonhs = $diem->select('loaidiem','diem')->toArray();
        //         dd($diemmonhs);
        //         $mahs = $value->mahs;
        //         for ($i=0; $i < $value2->soluong; $i++) {
        //             $diemmon = Arr::add('');
        //         }
        //         $diemhs[$value->mahocsinh] = Arr::add($diemhs[$value->mahocsinh], $value2->maloaidiem, []);

        //     }
        // }

        // dd($diemhs);

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
