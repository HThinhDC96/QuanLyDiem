<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhanQuyenController extends Controller
{
    public function index() {
        return view('pages.canbo.bangiamhieu.phanquyen');
    }
}
