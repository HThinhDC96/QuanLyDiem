@extends('layouts.canbo.layoutcanbo')
@section('content')
    <div class="mt-2 pt-2 card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="cart-title"></div>
            <div class="card-toolbar">
                {{-- <a href="{{ route('canboManage.createCanbo') }}"><button class="btn btn-success">Tạo mới</button></a> --}}
                <!--end::Button-->
                <a href="{{ route('canboManage.danhsachlopday', ['mamonhoc' => $mamonhoc, 'hocky' => 1]) }}">
                    <button class="btn {{ request()->is('*1') ? 'btn-success' : '' }}">Học Kì 1</button></a>
                <a href="{{ route('canboManage.danhsachlopday', ['mamonhoc' => $mamonhoc, 'hocky' => 2]) }}">
                    <button class="btn {{ request()->is('*2') ? 'btn-success' : '' }}">Học Kì 2</button></a>
            </div>
        </div>
        <div class="card-body">
            <table style="width: 100%;" class="table table-hover table-checkable" id="danhSachDiem">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Họ Tên Học Sinh</th>
                        @foreach ($dataloaidiem as $item => $loaidiem)
                            <th class="text-center">{{ $loaidiem->tenloaidiem }}</th>
                            @for ($i = 0; $i < $loaidiem->soluong-1; $i++)
                                <th style="opacity: 0;"></th>
                            @endfor
                        @endforeach
                        <th class="text-center">TBM</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($danhsach as $item => $value)
                        <tr>
                            <td class="text-center font-weight-bold">{{ $item + 1 }}</td>
                            @foreach ($value as $key => $v)
                                @if ($key == 'tenhocsinh' || $key == 'tbm')
                                    <td class="text-center">{{ $key=='tbm'?$v==""?"":number_format((float)$v, 1, '.', ''):$v }}</td>
                                @elseif ($key == 'mahocsinh')
                                    <td class="text-center">
                                        <a href="{{ route('diemManage.edit', ['hocki' => $hocki, 'mamonhoc' => $mamonhoc, 'mahocsinh' => $v]) }}" class="btn btn-success" title="Chỉnh sửa">Chỉnh sửa</a>
                                    </td>
                                @else
                                    @foreach ($v as $keydiem => $diem)
                                        <td class="text-center">{{ $diem==""?"": number_format((float)$diem, 1, '.', '') }}</td>
                                    @endforeach
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
@endsection
@section('styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/crud/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.bundle.css') }}"> --}}
@endsection
@section('scripts')
    <script src="{{ asset('js/crud/lopday_datatables.js') }}"></script>
@endsection
