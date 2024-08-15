<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo ">
        <a href="{{route('dashboard-admin')}}" class="app-brand-link">
            <h5 class="text-white"> SI NILAI </h5>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ Request::is('admin') ? 'active' : '' }}">
            <a href="{{route('dashboard-admin')}}" class="menu-link">
                <i class="menu-icon fas fa-dashboard"></i>
                <div class="text-truncate">Dashboard</div>
            </a>
        </li>
        <!-- master data -->
        <li class="menu-item {{ Request::is('admin/data/*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon fas fa-pen"></i>
                <div class="text-truncate">Input Nilai</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('admin/data/kejuruan') ? 'active' : '' }}">
                    <a href="{{route('data-kejuruan')}}" class="menu-link">
                        <div class="text-truncate">Nilai Siswa</div>
                    </a>
                </li>
                @if($dataGuru->wali_kelas == "Y")

                    <li class="menu-item {{ Request::is('admin/data/kejuruan') ? 'active' : '' }}">
                        <a href="{{route('data-kejuruan')}}" class="menu-link">
                            <div class="text-truncate">Nilai Sikap</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('admin/data/kejuruan') ? 'active' : '' }}">
                        <a href="{{route('data-kejuruan')}}" class="menu-link">
                            <div class="text-truncate">Absensi</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('admin/data/kejuruan') ? 'active' : '' }}">
                        <a href="{{route('data-kejuruan')}}" class="menu-link">
                            <div class="text-truncate">Ekstrakulikuler</div>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('admin/data/kejuruan') ? 'active' : '' }}">
                        <a href="{{route('data-kejuruan')}}" class="menu-link">
                            <div class="text-truncate">Kenaikan</div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        <!-- /master data -->
        <!-- cetak -->
        @if($dataGuru->wali_kelas == "Y")
        <li class="menu-item {{ Request::is('admin/data/*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon fas fa-print"></i>
                <div class="text-truncate">Cetak</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('admin/data/kejuruan') ? 'active' : '' }}">
                    <a href="{{route('data-kejuruan')}}" class="menu-link">
                        <div class="text-truncate">Raport</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('admin/data/kejuruan') ? 'active' : '' }}">
                    <a href="{{route('data-kejuruan')}}" class="menu-link">
                        <div class="text-truncate">Leger</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        <!-- /cetak -->
        <!-- logout -->
        <li class="menu-item bg-danger text-center">
            <a class="menu-link logout">
                <i class="menu-icon fas fa-power-off"></i>
                <div class="text-truncate">Logout</div>
            </a>
        </li>
        <!-- /logout -->
    </ul>
</aside>
