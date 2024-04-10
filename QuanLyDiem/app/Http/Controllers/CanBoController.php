<?php

namespace App\Http\Controllers;

use App\Models\CanBo;
use Exception;
use Illuminate\Http\Request;

class CanBoController extends Controller
{
    public function index(){
        $page_title="Cán bộ";
        $data=CanBo::from('canbo')
                ->select(['macanbo','hoten','gioitinh','ngaysinh','diachi','sdt','loai'])
                ->get();
        return view('pages.canbo.indexcanbo',compact('page_title','data'));
    }
    public function create(){
        $page_title="Tạo mới";
        return view('pages.canbo.createcanbo',compact('page_title'));
    }
    public function store(Request $request){
        try{
            $canbo=new Canbo();
            return $request;
        }catch(Exception $e){
            echo 'Có lỗi phát sinh: ', $e->getMessage(), "\n";
        }
    }
}
