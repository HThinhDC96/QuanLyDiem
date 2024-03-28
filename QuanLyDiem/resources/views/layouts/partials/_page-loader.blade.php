{{-- Page Loader Types --}}

{{-- Default --}}
@if (config('layout.page-loader.type') == 'default')
    <div class="page-loader">
        <div class="spinner spinner-primary"></div>
    </div>
@endif

{{-- Spinner Message --}}
@if (config('layout.page-loader.type') == 'spinner-message')
    <div class="loading-screen">
        <div class="loading d-flex justify-content-center">
            <div class="d-flex loading-block">
                <span>Vui lòng chờ...</span>
                <span><div class="spinner-border text-primary"></div></span>
            </div>
        </div>
    </div>
@endif

{{-- Spinner Logo --}}
@if (config('layout.page-loader.type') == 'spinner-logo')
    <div class="page-loader page-loader-logo">
        <img alt="{{ config('app.name') }}" src="{{ asset('media/logos/logo-letter-1.png') }}"/>
        <div class="spinner spinner-primary"></div>
    </div>
@endif
