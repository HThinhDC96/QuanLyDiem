@extends('layouts.hocsinh.layouthocsinh')
@section('content')
    <div class="mt-2 pt-2 card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="cart-title"></div>
            <div class="card-toolbar">
                {{-- <a href="{{ route('canboManage.createCanbo') }}"><button class="btn btn-success">Tạo mới</button></a> --}}
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <table style="width: 100%;" class="table table-hover table-checkable" id="danhSachDiem">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Họ Tên Học Sinh</th>
                        {{-- @foreach ($dataloaidiem as $item => $loaidiem)
                            <th class="text-center" colspan="{{ $loaidiem->soluong }}">{{ $loaidiem->tenloaidiem }}</th>
                        @endforeach --}}
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($danhsach as $item => $value)
                        <tr>
                            <td class="text-center font-weight-bold">{{ $item + 1 }}</td>
                            @foreach($value as $key => $v)
                                @if ($key=='tenhocsinh') <td class="text-center">{{ $v}}</td>
                                @else
                                    @foreach($v as $keydiem=>$diem)
                                    <th class="text-center">{{ $diem }}</th>
                                    @endforeach
                                @endif
                            @endforeach
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/crud/canbo_datatables.js') }}"></script>
@endsection
