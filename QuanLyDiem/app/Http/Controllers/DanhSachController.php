<?php

namespace App\Http\Controllers;

use App\Models\Diem;
use App\Models\HocSinh;
use App\Models\LoaiDiem;
use App\Models\Lop;
use App\Models\LopHoc;
use App\Models\MonHoc;
use App\Models\Mon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DanhSachController extends Controller
{
    public function danhsachlopday($mamonhoc)
    {
        $page_title = "Danh sách lớp ";

        $monhoc = Monhoc::select('monhoc.*', 'mon.loaimon')
            ->join('mon', 'mon.mamon', 'monhoc.mamon')
            ->where('mamonhoc', $mamonhoc)->first();

        $malop = $monhoc->malop;
        //du lieu cho sidebar
        $macanbo = session('userid');
        $datalopchunhiem = Lop::from('lop')->where('chunhiem', $macanbo)->get();
        $datalopday = MonHoc::from('monhoc')
            ->join('lop', 'lop.malop', 'monhoc.malop')
            ->join('mon', 'monhoc.mamon', 'mon.mamon')
            ->where('monhoc.macanbo', $macanbo)->get();

        // du lieu noi dung
        $danhsachlop = LopHoc::from('lophoc')
            ->join('hocsinh', 'hocsinh.mahocsinh', 'lophoc.mahocsinh')
            ->where('malop', $malop)->get();

        $dataloaidiem = LoaiDiem::whereIn('loaimon' , [$monhoc->loaimon, 3])->orderBy('heso')->get();
        $danhsach = [];
        foreach ($danhsachlop as $item => $hocsinh) {
            $d = [];
            // dd($dataloaidiem);
            foreach ($dataloaidiem as $item => $loaidiem) {
                $diemhs = Diem::from('diem')
                    ->where('mahocsinh', $hocsinh->mahocsinh)
                    ->where('mamonhoc', $mamonhoc)
                    ->where('loaidiem', $loaidiem->maloaidiem)
                    ->get();
                $i = $loaidiem->soluong;
                $j = 0;
                foreach ($diemhs as $item => $diem) {
                    $soluong = LoaiDiem::where('maloaidiem', $diem->loaidiem)->first();
                    $d = Arr::add($d, $diem->loaidiem . '_' . $j, $diem->diem);
                    $j++;
                }
                if ($j != 0)
                    $j--;
                for ($e = $j; $e < $i; $e++) {
                    $d = Arr::add($d, $loaidiem->maloaidiem . '_' . $e, "");
                }

            }
            $danhsach = Arr::add($danhsach, count($danhsach), ['tenhocsinh' => $hocsinh->hotenhocsinh, 'diem' => $d]);
            // dd($danhsach);
        }
        // dd($danhsach);
        //in thu danh sach
        // foreach($danhsach as $item=>$value){
        //     foreach($value as $key=>$v){
        //         if($key=='tenhocsinh') print($v);
        //         else foreach($v as $keydiem=>$diem){
        //             print('    '.$diem.'  ');
        //         }
        //     }
        // }
        return view('pages.canbo.giaovien.danhsachlopday', compact('page_title', 'datalopchunhiem', 'datalopday', 'danhsachlop', 'dataloaidiem', 'danhsach'));
    }
    public function danhsachlopchunhiem($malop)
    {
        $page_title = "Danh sách lớp ";

        //du lieu cho sidebar
        $macanbo = session('userid');
        $datalopchunhiem = Lop::from('lop')->where('chunhiem', $macanbo)->get();
        $datalopday = MonHoc::from('monhoc')
            ->join('lop', 'lop.malop', 'monhoc.malop')
            ->join('mon', 'monhoc.mamon', 'mon.mamon')
            ->where('monhoc.macanbo', $macanbo)->get();
        //du lieu hien thi noi dung
        $danhsachlop = LopHoc::from('lophoc')
            ->join('hocsinh', 'lophoc.mahocsinh', 'hocsinh.mahocsinh')
            ->join('lop', 'lop.malop', 'lophoc.malop')
            ->where('lop.chunhiem', $macanbo)->get();
        $datamon = MonHoc::from('monhoc')
            ->join('mon', 'monhoc.mamon', 'mon.mamon')
            ->where('malop', $malop)->get();
        return view('pages.canbo.giaovien.danhsachlopchunhiem', compact('page_title', 'datalopchunhiem', 'datalopday', 'datamon', 'danhsachlop'));
    }
}
