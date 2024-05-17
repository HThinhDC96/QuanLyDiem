@extends('layouts.canbo.layoutcanbo')
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
            <form action="{{ route('diemManage.update') }}" method="post">
                @csrf
                @method('post')
                <input type="hidden" name="mahocsinh" value="{{ $datahocsinh->mahocsinh }}"/>
                <input type="hidden" name="mamonhoc" value="{{ $monhoc->mamonhoc }}"/>
                <input type="hidden" name="hocki" value="{{ $hocki }}"/>
                @foreach ($diem as $i => $value)
                    <div>
                        {{ $value['tenloaidiem'] }}
                        @foreach ($value['diem'] as $key => $value2)
                            <input name="{{ $key }}" type="number" min="0" max="10" step="0.01" value="{{ $value2 }}" />
                        @endforeach
                    </div>
                @endforeach
                <div>
                    <button type="submit">Luu</button>
                </div>
            </form>
        </div>
    </div>
@endsection
