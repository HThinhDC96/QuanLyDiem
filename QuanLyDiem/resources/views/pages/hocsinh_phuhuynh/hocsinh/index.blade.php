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
            <div class="cart-title"></div>
            <div class="card-toolbar">
                <a href="{{ route('hocsinhManage.create') }}"><button class="btn btn-success">Tạo mới</button></a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <table style="width: 100%;" class="table table-hover table-checkable" id="danhSachHocSinh">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Mã số</th>
                        <th class="text-center">Họ Tên</th>
                        {{-- <th class="text-center">Lớp</th> --}}
                        <th class="text-center">Giới Tính</th>
                        <th class="text-center">Ngày sinh</th>
                        <th class="text-center">Địa chỉ</th>
                        <th class="text-center">SĐT</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item => $value)
                        <tr>
                            <td class="text-center font-weight-bold">{{ $item + 1 }}</td>
                            <td class="text-center">{{ $value->mahocsinh }}</td>
                            <td class="text-center">{{ $value->hotenhocsinh }}</td>
                            {{-- <td class="text-center"></td> --}}
                            <td class="text-center">
                                @if ($value->gioitinh == 0)
                                    Nam
                                @else
                                    @if ($value->gioitinh == 1)
                                        Nữ
                                    @else
                                        Khác
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">{{ $value->ngaysinh }}</td>
                            <td class="text-center">{{ $value->diachi }}</td>
                            <td class="text-center">{{ $value->sdt }}</td>
                            <td class="text-center" style="display: flex; justify-content: center">
                                <table>
                                    <tr>
                                        <td class="border-0 pt-0 pb-0">
                                            <a href="{{ route('hocsinhManage.edit', ['mahocsinh' => $value->mahocsinh]) }}"
                                                class="btn btn-sm btn-clean btn-icon btn-primary" title="Chỉnh sửa">
                                                Chỉnh Sửa
                                            </a>
                                        </td>
                                        <td style="padding-left: 3px" class="border-0 pt-0 pb-0">
                                            <a href="{{ route('hocsinhManage.delete', ['mahocsinh' => $value->mahocsinh]) }}"
                                                id="delete" class="btn btn-sm btn-icon btn-danger"
                                                data-confirm-delete="true" title="xoá">
                                                <i class="la la-trash"></i>Xoá
                                            </a>
                                        </td>
                                    </tr>
                                </table>
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
    <script src="{{ asset('js/crud/datatables/dateformat.js') }}"></script>
    <script src="{{ asset('js/crud/hocsinh_datatables.js') }}"></script>
@endsection
