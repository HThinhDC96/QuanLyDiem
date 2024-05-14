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
            @foreach ($diem as $i => $value)
                {{  $value['tenloaidiem'] }}
                @foreach ($value['diem'] as $value2)
                    {{ $value2 }}
                @endforeach
                <br>
            @endforeach
        </div>
    </div>
@endsection
