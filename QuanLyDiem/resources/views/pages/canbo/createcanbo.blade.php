@extends('layouts.admin.layout')
@section('content')
    <div class="d-flex">
        <div class="col-sm-6">
            <form action="{{ route('canboManage.storeCanbo') }}" method="POST" id="formcreatecanbo">
                {{ csrf_field() }}
                <div>
                    <input type="text" name="macanbo" id="macanbo" class="form-control" placeholder="Nhập vào mã cán bộ" />
                </div>
                <div>
                    <input type="text" name="hoten" id="hoten" class="form-control" placeholder="Nhập họ tên cán bộ" />
                </div>
                <div>
                    <input type="radio" name="gioitinh" id="nam">Nam
                    <input type="radio" name="gioitinh" id="nu">Nữ
                    <input type="radio" name="gioitinh" id="khac">Khác
                </div>
                <div>
                    <input type="date" name="ngaysinh" id="ngaysinh" class="form-control">
                </div>
                <div>
                    <textarea class="form-control" name="diachi" id="diachi" cols="30" rows="5" placeholder="Nhập vào địa chỉ"></textarea>
                </div>
                <div>
                    <input class="form-control" type="text" name="sdt" id="sdt" placeholder="Nhập vào số điện thoại"/>
                </div>
                <div>
                    <select class="form-select" name="loai" id="loai">
                    <option value="0">Giáo viên</option>
                    <option value="1">Hiệu trưởng/Phó hiệu trưởng</option>
                </select>
                </div>
                <div>
                    <input class="form-control" type="password" name="matkhau" id="matkhau" placeholder="Nhập vào mật khẩu"/>
                </div>
                <div>
                    <input type="submit" value="Tạo">
                </div>


            </form>
        </div>
    </div>
@endsection
