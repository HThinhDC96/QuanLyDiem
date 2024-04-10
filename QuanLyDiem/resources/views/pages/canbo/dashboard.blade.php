@extends('layouts.admin.layout')
@section('content')
    @include('layouts.menu.menu1')
    <a href="{{ route('canboManage.indexCanbo') }}">Canbo</a>
@endsection
