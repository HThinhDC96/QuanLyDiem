<?php

namespace App\Http\Controllers;

use App\Models\Diem;
use App\Http\Requests\StoreDiemRequest;
use App\Http\Requests\UpdateDiemRequest;

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

    public function edit($ma)
    {
        $page_title = "Chỉnh sửa điểm";
        return view('pages.danhmuc.diem.edit', compact('page_title'));
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
