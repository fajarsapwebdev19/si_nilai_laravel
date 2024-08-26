<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo ">
        <a href="{{route('home_siswa')}}" class="app-brand-link">
            <h5 class="text-white"> SI NILAI </h5>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ Request::is('siswa') ? 'active' : '' }}">
            <a href="{{route('home_siswa')}}" class="menu-link">
                <i class="menu-icon fas fa-dashboard"></i>
                <div class="text-truncate">Dashboard</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('siswa/lihat_nilai') ? 'active' : '' }}">
            <a href="{{route('lihat_nilai')}}" class="menu-link">
                <i class="menu-icon fas fa-file"></i>
                <div class="text-truncate">Lihat Nilai</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('siswa/cetak_raport') ? 'active' : '' }}">
            <a href="{{route('cetak_raport_siswa')}}" class="menu-link">
                <i class="menu-icon fas fa-print"></i>
                <div class="text-truncate">Cetak Raport Siswa</div>
            </a>
        </li>
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
