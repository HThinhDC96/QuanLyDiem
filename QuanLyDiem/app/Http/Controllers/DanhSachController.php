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
    public function danhsachlopday($mamonhoc,$hocki)
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
            $tongdiem = 0;
            $tonghesodiem = 0;
            // dd($dataloaidiem);
            foreach ($dataloaidiem as $item => $loaidiem) {
                $diemhs = Diem::from('diem')
                    ->where('mahocsinh', $hocsinh->mahocsinh)
                    ->where('mamonhoc', $mamonhoc)
                    ->where('loaidiem', $loaidiem->maloaidiem)
                    ->where('hocky',$hocki)
                    ->get();
                $i = $loaidiem->soluong;
                $j = 0;
                foreach ($diemhs as $item => $diem) {
                    $d = Arr::add($d, $diem->loaidiem . '_' . $j, $diem->diem);
                    $j++;
                    $tongdiem += $loaidiem->heso * $diem->diem;
                    $tonghesodiem += (int) $loaidiem->heso;
                }
                if ($j != 0)
                    $j--;
                for ($e = $j; $e < $i; $e++) {
                    $d = Arr::add($d, $loaidiem->maloaidiem . '_' . $e, "");
                }
            }

            if ($tonghesodiem!=0)
            {
                $tbm = $tongdiem / $tonghesodiem ;
            } else {
                $tbm = "";
            };
            $danhsach = Arr::add($danhsach, count($danhsach), ['tenhocsinh' => $hocsinh->hotenhocsinh, 'diem' => $d, 'tbm' => $tbm, 'mahocsinh' => $hocsinh->mahocsinh]);
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
        return view('pages.canbo.giaovien.danhsachlopday', compact('page_title', 'datalopchunhiem', 'datalopday', 'dataloaidiem', 'danhsach', 'mamonhoc'));
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

    public function diemhocsinh($malop,$hocki){
        $page_title = "Bảng điểm cá nhân";
        $mahocsinh=session('userid');
        //du lieu sidebar
        $datalop=LopHoc::join('lop','lophoc.malop','lop.malop')
                        ->where('mahocsinh',$mahocsinh)->get();
        //du lieu noi dung
        $dataloaidiem = LoaiDiem::orderBy('heso')->get();
        $dsmon=MonHoc::from('monhoc')->join('mon','monhoc.mamon','mon.mamon')
                        ->where('malop',$malop)->get();
        $danhsach = [];
        foreach ($dsmon as $item => $mon) {
            $d = [];
            $tongdiem = 0;
            $tonghesodiem = 0;
            // dd($dataloaidiem);
            foreach ($dataloaidiem as $item => $loaidiem) {
                $diemhs = Diem::from('diem')
                    ->where('mahocsinh', $mahocsinh)
                    ->where('mamonhoc', $mon->mamonhoc)
                    ->where('loaidiem', $loaidiem->maloaidiem)
                    ->where('hocky',$hocki)
                    ->get();
                $i = $loaidiem->soluong;
                $j = 0;
                foreach ($diemhs as $item => $diem) {
                    $d = Arr::add($d, $diem->loaidiem . '_' . $j, $diem->diem);
                    $j++;
                    $tongdiem += $loaidiem->heso * $diem->diem;
                    $tonghesodiem += (int) $loaidiem->heso;
                }
                if ($j != 0)
                    $j--;
                for ($e = $j; $e < $i; $e++) {
                    $d = Arr::add($d, $loaidiem->maloaidiem . '_' . $e, "");
                }

            }
            if ($tonghesodiem!=0)
            {
                $tbm = $tongdiem / $tonghesodiem ;
            } else {
                $tbm = "";
            };
            $danhsach = Arr::add($danhsach, count($danhsach), ['tenmon' => $mon->tenmon, 'diem' => $d,'tbm' => $tbm]);

        }
        // dd($danhsach);
        //in thu danh sach
        // foreach($danhsach as $item=>$value){
        //     foreach($value as $key=>$v){
        //         if($key=='tenmon') print($v);
        //         else foreach($v as $keydiem=>$diem){
        //             print('    '.$diem.'  ');
        //         }
        //     }
        // }
        return view('pages.hocsinh.diem', compact('page_title', 'datalop', 'dataloaidiem', 'danhsach','malop'));

    }
}
