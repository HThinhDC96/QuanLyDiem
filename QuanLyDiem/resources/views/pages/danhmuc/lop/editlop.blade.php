@extends('layouts.admin.layout')
@section('content')
    <div class="card pt-2 mt-2">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            {{ $page_title }}
            @if ($errors->any())
                <div class="alert alert-danger pt-6 pb-0">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="alert-text">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('lopManage.updateLop') }}" class="form" name="formEditLop"
                id="formeditlop">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-8">
                        <div class="my-5">
                            <input type="hidden" name="malop" id="malop" value="{{ $info->malop }}">
                            <div class="row mb-3 align-items-center justify-content-center">
                                <label class="col-3">Tên lớp
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-6">
                                    <input type="text" name="tenlop" id="tenlop" class="form-control"
                                        placeholder="Nhập tên lớp" value="{{ $info->tenlop }}" />
                                </div>
                            </div>
                            <div class="mb-3 align-items-center justify-content-center row">
                                <label class="col-3">Niên khóa<span
                                    class="text-danger">*</span></label>
                            <div class="col-6">
                                <select class="form-select" name="nienkhoa" id="nienkhoa">
                                    @foreach($datanienkhoa as $item =>$nienkhoa)
                                    <option value="{{ $nienkhoa->manienkhoa }}" {{ $info->nienkhoa==$nienkhoa->manienkhoa ? 'selected' : ''}}>{{ $nienkhoa->tennienkhoa }}</option>
                                    @endforeach
                                </select>
                            </div>

                            </div>
                            <div class="mb-3 align-items-center justify-content-center row">
                                <label class="col-3">Cán bộ chủ nhiệm<span
                                    class="text-danger">*</span></label>
                            <div class="col-6">
                                <select class="form-select" name="chunhiem" id="chunhiem">
                                    @foreach($datacanbo as $item =>$canbo)
                                    <option value="{{ $canbo->macanbo }}" {{ $info->chunhiem==$canbo->macanbo ? 'selected' : ''}}>{{$canbo->macanbo}} : {{ $canbo->hoten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                            <div class="modal-footer mt-5 me-5">
                                <div class="d-flex flex-wrap border-0 pt-6 pb-0">
                                    <div class="d-flex">
                                        <a href="{{ route('lopManage.indexLop') }}" @include('layouts.button._button_back')
                                        </a>
                                        <div class="btn-group">
                                            @include('layouts.button._button_save')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection