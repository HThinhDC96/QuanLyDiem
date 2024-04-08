@extends('layouts.admin.layout')

@section('content')
    <form action="{{ route('xacthuc-login') }}" method="post">
        @csrf
        <div>
            <label>Tên đăng nhập* </label>
            <input type="text" name="username" placeholder="Nhập username" />
        </div>
        <div>
            <label>Mật khẩu* </label>
            <input type="password" name="password" placeholder="Nhập mật khẩu" />
        </div>
        <div>
            <input type="submit" value="Đăng nhập" />
        </div>
    </form>
@endsection
