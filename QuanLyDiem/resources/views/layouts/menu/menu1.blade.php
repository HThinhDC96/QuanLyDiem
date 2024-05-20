<section id="body-pd" class="bg-light">
    <header class="header" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        <div class="d-flex align-items-center">
            <div class="header_img">
                {{-- <img src="{{ asset('images/logo1000.png') }}" alt="No image"> --}}
            </div>
            <div class="w-auto d-flex align-items-center btn-lg px-2">
                <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Xin chào</span>
                <span
                    class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">&nbsp;{{ session()->get('userhoten') }}</span>
            </div>
        </div>

    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <i class='bx bx-layer nav_logo-icon'></i>
                    {{-- <img style="width:100px" src="{{ asset('images/logo.png') }}" alt="No image" /> --}}
                    <span class="nav_logo-name"></span>
                </a>
                <div class="nav_list">

                    <a id="dashboard" href="{{ route('dashboard') }}" class="nav_link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>

                    <a id="canbo" href="{{ route('canboManage.indexCanbo') }}" class="nav_link {{ request()->is('canbo*') ? 'active' : '' }}">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Cán bộ</span>
                    </a>
                    <a id="hocsinh" href="{{ route('hocsinhManage.index') }}" class="nav_link {{ request()->is('hocsinh*') ? 'active' : '' }}">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Học sinh</span>
                    </a>
                    <a id="phuhuynh" href="{{ route('phuhuynhManage.index') }}" class="nav_link {{ request()->is('phuhuynh*') ? 'active' : '' }}">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Phụ huynh</span>
                    </a>
                    <a id="mon" href="{{ route('monManage.indexMon') }}" class="nav_link {{ request()->is('mon*') ? 'active' : '' }}">
                        <i class='bx bx-bookmark nav_icon'></i>
                        <span class="nav_name">Môn</span>
                    </a>
                    <a id="nienkhoa" href="{{ route('nienkhoaManage.indexNienKhoa') }}" class="nav_link {{ request()->is('nienkhoa*') ? 'active' : '' }}">
                        <i class='bx bx-calendar nav_icon'></i>
                        <span class="nav_name">Niên Khóa</span>
                    </a>
                    <a id="lop" href="{{ route('lopManage.indexLop') }}" class="nav_link {{ request()->is('lop*') ? 'active' : '' }}">
                        <i class='bx bx-calendar nav_icon'></i>
                        <span class="nav_name">Lớp</span>
                    </a>
                    <a id="monhoc" href="{{ route('monhocManage.indexMonHoc') }}" class="nav_link {{ request()->is('monhoc*') ? 'active' : '' }}">
                        <i class='bx bx-message-square-detail nav_icon'></i>
                        <span class="nav_name">Phân công giảng dạy</span>
                    </a>
                    <a id="monhoc" href="{{ route('loaidiemManage.indexLoaiDiem') }}" class="nav_link {{ request()->is('loaidiem*') ? 'active' : '' }}">
                        <i class='bx bx-bookmark nav_icon'></i>
                        <span class="nav_name">Loại Điểm</span>
                    </a>
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            <a href="{{ route('logout') }}" class="nav_link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">Đăng xuất</span>
            </a>
        </nav>
    </div>
</section>
<script src="{{ asset('js/menu.js') }}"></script>
