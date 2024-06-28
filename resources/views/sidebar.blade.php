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
        <li class="menu-item {{ Request::is('admin/manajemen_akun') ? 'active' : '' }}">
            <a href="{{route('manajemen-akun')}}" class="menu-link">
                <i class="menu-icon fas fa-user-lock"></i>
                <div class="text-truncate">Manajemen Akun</div>
            </a>
        </li>
        <!-- master data -->
        <li class="menu-item {{ Request::is('admin/data/*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon fas fa-database"></i>
                <div class="text-truncate">Master Data</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('admin/data/guru') ? 'active' : '' }}">
                    <a href="{{route('data-guru')}}" class="menu-link">
                        <div class="text-truncate">Data Guru</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('admin/data/siswa') ? 'active' : '' }}">
                    <a href="{{route('data-siswa')}}" class="menu-link">
                        <div class="text-truncate">Data Siswa</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('admin/data/kelas') ? 'active' : '' }}">
                    <a href="{{route('data-kelas')}}" class="menu-link">
                        <div class="text-truncate">Data Kelas</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('admin/data/mapel') ? 'active' : '' }}">
                    <a href="{{route('data-mapel')}}" class="menu-link">
                        <div class="text-truncate">Data Mapel</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('admin/data/ekskul') ? 'active' : '' }}">
                    <a href="{{route('data-ekskul')}}" class="menu-link">
                        <div class="text-truncate">Data Ekskul</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- /master data -->
        <!-- pengaturan -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon fas fa-cogs"></i>
                <div class="text-truncate">Pengaturan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('profil-sekolah')}}" class="menu-link">
                        <div class="text-truncate">Profil Sekolah</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('pilih-wakel')}}" class="menu-link">
                        <div class="text-truncate">Wali Kelas</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('pilih-guru-mapel')}}" class="menu-link">
                        <div class="text-truncate">Mapel</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- /pengaturan -->
        <!-- pesan -->
        <li class="menu-item">
            <a href="/" class="menu-link">
                <i class="menu-icon fas fa-bullhorn"></i>
                <div class="text-truncate">Pesan</div>
            </a>
        </li>
        <!-- /pesan -->
        <!-- logout -->
        <li class="menu-item bg-danger text-center">
            <a href="/" class="menu-link">
                <i class="menu-icon fas fa-power-off"></i>
                <div class="text-truncate">Logout</div>
            </a>
        </li>
        <!-- /logout -->
    </ul>
</aside>
