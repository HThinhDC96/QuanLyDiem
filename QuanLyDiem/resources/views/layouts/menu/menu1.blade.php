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
                <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Xin chào,</span>
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
                    <a id="canbo" href="{{ route('monManage.indexMon') }}" class="nav_link {{ request()->is('mon*') ? 'active' : '' }}">
                        <i class='bx bx-bookmark nav_icon'></i>
                        <span class="nav_name">Cán bộ</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-message-square-detail nav_icon'></i>
                        <span class="nav_name">Messages</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-bookmark nav_icon'></i>
                        <span class="nav_name">Bookmark</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-folder nav_icon'></i>
                        <span class="nav_name">Files</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                        <span class="nav_name">Stats</span>
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
