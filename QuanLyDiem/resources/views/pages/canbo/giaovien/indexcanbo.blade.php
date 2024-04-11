@extends('layouts.admin.layout')
@section('content')
    <div class="mt-2 pt-2 card card-custom">
        {{-- @if (session('success'))
            <div class="alert alert-success">
                <p>{{ session('success') }}</p>
            </div>
        @endif --}}
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            {{-- @include('layout.base._pagename') --}}
            <div class="card-toolbar">
                <a href="{{ route('canboManage.createCanbo') }}"><button class="btn btn-success">Tạo mới</button></a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <table style="width: 100%;" class="table table-hover table-checkable" id="danhSachCanBo">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Mã Cán Bộ</th>
                        <th class="text-center">Họ Tên</th>
                        <th class="text-center">Giới Tính</th>
                        <th class="text-center">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item => $value)
                        <tr>
                            <td class="text-center font-weight-bold">{{ $item + 1 }}</td>
                            <td class="text-center">{{ $value->macanbo }}</td>
                            <td class="text-center">{{ $value->hoten }}</td>
                            <td class="text-center">{{ $value->gioitinh }}</td>
                            <td class="text-center">
                                {{ $value->loai }}
                                {{-- <table>
                                    <tr>
                                        <td class="border-0 pt-0 pb-0">
                                            <a href="{{ route('nhomquyenManage.editNhomQuyen', ['nhom_quyen_id' => $value->nhom_quyen_id]) }}"
                                                class="btn btn-sm btn-clean btn-icon" title="{{ __('cap_nhat') }}">
                                                Chỉnh Sửa
                                            </a>
                                        </td>
                                    </tr>
                                </table> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/crud/canbo_datatables.js') }}"></script>
@endsection
