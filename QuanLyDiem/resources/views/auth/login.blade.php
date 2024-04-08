@extends('layouts.login.layout')

@section('styles')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection
@section('content')
    <div class="d-flex full">
        <div class="form-login">
            <div class="login text-center p-2">
                <form action="{{ route('xacthuc-login') }}" method="post">
                    @csrf
                    <div class="login-title">
                        <h3>Đăng nhập</h3>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Nhập username" />
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Nhập mật khẩu" />
                    </div>
                    <div>
                        <input class="btn btn-success" type="submit" value="Đăng nhập" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
