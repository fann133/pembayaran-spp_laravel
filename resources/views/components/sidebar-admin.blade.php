@php
    use App\Models\Setting;
    $pengaturan = Setting::first();
@endphp

<ul class="navbar-nav bg-gradient-{{ $pengaturan->tema }} sidebar sidebar-dark accordion {{ $isMobile ? 'toggled' : '' }}" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas {{ $pengaturan->ikon_sidebar }}"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ $pengaturan->nama_aplikasi }}</div>
    </a>



    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master
    </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Data Akademik</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ request()->routeIs('admin.profil.index') ? 'active' : '' }}" href="{{ route('admin.profil.index') }}">
                        <i class="fas fa-fw fa-school"></i> Profil Sekolah
                    </a>
                    <a class="collapse-item {{ request()->routeIs('admin.siswa.index', 'admin.siswa.create', 'admin.siswa.edit') ? 'active' : '' }}" href="{{ route('admin.siswa.index') }}">
                        <i class="fas fa-fw fa-user"></i> Siswa
                    </a>
                    <a class="collapse-item {{ request()->routeIs('admin.guru.index', 'admin.guru.create', 'admin.guru.edit') ? 'active' : '' }}" href="{{ route('admin.guru.index') }}">
                        <i class="fas fa-fw fa-user-graduate"></i> Guru
                    </a>
                    <a class="collapse-item {{ request()->routeIs('admin.kelas.index', 'admin.kelas.create', 'admin.kelas.show', 'admin.kelas.edit') ? 'active' : '' }}" href="{{ route('admin.kelas.index') }}">
                        <i class="fas fa-fw fa-chalkboard-teacher"></i> Kelas
                    </a>
                </div>
            </div>
        </li>

        
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    {{-- Tampilan User --}}
    <li class="nav-item {{ request()->routeIs('admin.biaya.index', 'admin.biaya.create', 'admin.biaya.edit') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.biaya.index') }}">
            <i class="fas fa-money-bill-alt"></i>
            <span>Biaya</span></a>
    </li>
    

    
    <li class="nav-item {{ request()->routeIs('admin.tagihan.index', 'admin.tagihan.edit') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.tagihan.index') }}">
            <i class="fas fa-fw fa-hand-holding-usd"></i>
            <span>Tagihan</span></a>
    </li>
    


    <li class="nav-item {{ request()->routeIs('admin.pembayaran.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.pembayaran.index') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Pembayaran</span></a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Aplikasi
    </div>

    {{-- Tampilan User --}}
    <li class="nav-item {{ request()->routeIs('admin.user.index', 'admin.user.edit') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.user.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>User</span></a>
    </li>


    <li class="nav-item {{ request()->routeIs('admin.pengaturan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.pengaturan') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Setting</span></a>
    </li>


    <!-- Nav Item - Database -->
    <li class="nav-item {{ request()->routeIs('admin.database') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.database') }}">
            <i class="fas fa-fw fa-database"></i>
            <span>Database</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>