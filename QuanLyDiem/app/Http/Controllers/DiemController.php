<?php

namespace App\Http\Controllers;

use App\Models\Diem;
use App\Models\HocSinh;
use App\Models\LoaiDiem;
use App\Models\Lop;
use App\Models\MonHoc;
use App\Http\Requests;

use Illuminate\Support\Arr;

class DiemController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store($request)
    {
        //
    }

    public function edit($mahocsinh, $mamonhoc)
    {
        $page_title = "Chỉnh sửa điểm";

        // Sidebar
        $macanbo=session('userid');
        $datalopchunhiem=Lop::from('lop')->where('chunhiem',$macanbo)->get();
        $datalopday=MonHoc::from('monhoc')
                                ->join('lop','lop.malop','monhoc.malop')
                                ->join('mon','monhoc.mamon','mon.mamon')
                                ->where('monhoc.macanbo',$macanbo)->get();

        // Noi dung phuong thuc chinh
        $monhoc = MonHoc::where('mamonhoc', $mamonhoc)
            ->join('mon', 'mon.mamon', 'monhoc.mamon')
            ->first();

        $datahocsinh = HocSinh::where('mahocsinh', $mahocsinh)->first();
        $datadiemhocsinh = Diem::where('mahocsinh', $mahocsinh)->get();
        $dataloaidiem = LoaiDiem::whereIn('loaimon' , [$monhoc->loaimon, 3])->orderBy('heso')->get();

        $datadiem_loaidiem = [];
        $diem = collect([]);
        foreach ($dataloaidiem as $key => $loaidiem) {
            $diem_loaidiem = $datadiemhocsinh->where('loaidiem', $loaidiem->maloaidiem);

            $d = [];
            foreach ($diem_loaidiem as $key => $value) {
                $d = Arr::add($d, $value['madiem'], $value['diem']);
            }

            $i = count($d);
            for ($t = $i; $t < $loaidiem->soluong; $t++) {
                $d = Arr::add($d, 'new'.'_'.$t-$i, "");
            }

            $dtam = Arr::add($loaidiem->toArray(), 'diem', $d);

            $diem = Arr::add($diem, count($diem), $dtam);
        }

        // dd($diem);
        return view('pages.danhmuc.diem.edit', compact('page_title', 'diem', 'datahocsinh', 'datalopchunhiem', 'datalopday'));
    }

    public function update($request)
    {
        //
    }

    public function delete($madiem)
    {
        //
    }
}
