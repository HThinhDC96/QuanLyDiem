<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CanBo;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Show form đăng nhập
    public function showFormLogin()
    {
        // session()->flush();
        $page_title = 'Đăng nhập';
        return view('auth.login', compact('page_title'));
    }

    // Xác thực tài khoản
    public function xacthuc(Request $request)
    {
        $validator = $this->validateLogin($request);
        // dd($request);
        // dd($validator);
        if ($validator->fails()) {
            toastr()->error('Đăng nhập không thành công!', 'Lỗi!');
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        $taikhoan = CanBo::find($request->username);
        if ($taikhoan != null) {
            if ($taikhoan->matkhau == $request->password) {
                $hethong_ngay = date('d', time());
                $hethong_thang = date('m', time());
                $hethong_nam = date('Y', time());

                session()->put("ngayhientai", $hethong_ngay);
                session()->put("thanghientai", $hethong_thang);
                session()->put("namhientai", $hethong_nam);

                session()->put("userid", $taikhoan->macanbo);
                session()->put("type", 0); // Nếu là tài khoản cán bộ
                session()->put("userhoten", $taikhoan->hoten);

                toastr()->success('Đăng nhập thành công!', 'Thành công!');
                if(substr($taikhoan->macanbo,0,2)=="CB") return redirect()->route('canboManage.indexCanboPage');
                return redirect()->route('dashboard');
            } else {
                toastr()->error('Tài khoản hoặc mật khẩu không chính xác!', 'Lỗi!');
            }
        }

        return redirect()->back()->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Kiểm tra trạng thái đăng nhập
    public static function checkLogin()
    {
        if (session()->has('userid')) {
            return true;
        } else {
            return false;
        }
    }

    // Kiểm tra form dữ liệu
    protected function validateLogin(Request $request)
    {
        try {
            $rules = [
                'username' => 'required|string',
                'password' => 'required|string',
            ];

            $customMessages = [
                'username.required' => "Xin hãy nhập tên đăng nhập",
                'password.required' => "Xin hãy nhập mật khẩu",
            ];

            $validator = Validator::make($request->all(), $rules, $customMessages);
            return $validator;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
