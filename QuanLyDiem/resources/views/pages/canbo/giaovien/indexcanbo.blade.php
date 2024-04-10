@extends('layouts.admin.layout')
@section('content')
    {{-- @include('layouts.menu.menu1') --}}
    <a href="{{ route('canboManage.createCanbo') }}"><button class="btn btn-success">Tạo mới</button></a>

@endsection
