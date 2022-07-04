<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="/assets/dist/img/eskp-icon.png" alt="ESKP Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text">eSKP PPPK PNC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image justify-content-center align-self-center">
                <img src="/assets/dist/img/blank.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info" style="white-space: normal">
                <a href="/profil" class="d-block">{{ auth()->user()->name }}</a>
                <span class="badge badge-primary">{{ auth()->user()->role }}</span>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @can('Admin')
                <li class="nav-item">
                    <a href="" class="nav-link {{ Request::is('master*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/master/periode" class="nav-link {{ Request::is('master/periode*') ? 'active' : '' }}">
                                <i class="fas fa-calendar-alt nav-icon"></i>
                                <p>Master Periode</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/master/pangkat" class="nav-link {{ Request::is('master/pangkat*') ? 'active' : '' }}">
                                <i class="fas fa-star nav-icon"></i>
                                <p>Master Pangkat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/master/jabatan" class="nav-link {{ Request::is('master/jabatan*') ? 'active' : '' }}">
                                <i class="fas fa-briefcase nav-icon"></i>
                                <p>Master Jabatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/master/pegawai" class="nav-link {{ Request::is('master/pegawai*') ? 'active' : '' }}">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Master Pegawai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/master/penilai" class="nav-link {{ Request::is('master/penilai*') ? 'active' : '' }}">
                                <i class="fas fa-user-tie nav-icon"></i>
                                <p>Master Penilai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/master/kegiatan" class="nav-link {{ Request::is('master/kegiatan*') ? 'active' : '' }}">
                                <i class="fas fa-tasks nav-icon"></i>
                                <p>Master Kegiatan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('Pegawai yang Dinilai')
                <li class="nav-item">
                    <a href="" class="nav-link {{ Request::is('skp*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            SKP & Perilaku Kerja
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/skp/rencana" class="nav-link {{ Request::is('skp/rencana*') ? 'active' : '' }}">
                                <i class="fas fa-calendar-alt nav-icon"></i>
                                <p>Rencana SKP</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/skp/realisasi" class="nav-link {{ Request::is('skp/realisasi*') ? 'active' : '' }}">
                                <i class="fas fa-calendar-check nav-icon"></i>
                                <p>Pengajuan Realisasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/skp/prestasi" class="nav-link {{ Request::is('skp/prestasi*') ? 'active' : '' }}">
                                <i class="fas fa-file nav-icon"></i>
                                <p>Nilai Prestasi Kerja</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('Pejabat Penilai')
                <li class="nav-item">
                    <a href="" class="nav-link {{ Request::is('penilaian*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Penilaian Pegawai
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/penilaian/persetujuan" class="nav-link {{ Request::is('penilaian/persetujuan*') ? 'active' : '' }}">
                                <i class="fas fa-calendar-alt nav-icon"></i>
                                <p>Persetujuan Rencana</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/penilaian/prealisasi" class="nav-link {{ Request::is('penilaian/prealisasi*') ? 'active' : '' }}">
                                <i class="fas fa-calendar-check nav-icon"></i>
                                <p>Penilaian Realisasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/penilaian/perilaku" class="nav-link {{ Request::is('penilaian/perilaku*') ? 'active' : '' }}">
                                <i class="fas fa-balance-scale nav-icon"></i>
                                <p>Penilaian Perilaku</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>