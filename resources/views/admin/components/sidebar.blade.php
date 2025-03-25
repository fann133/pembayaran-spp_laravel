<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin</div>
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

    {{-- Tampilan Siswa --}}
    <li class="nav-item {{ request()->routeIs('admin.siswa.index', 'admin.siswa.create', 'admin.siswa.edit') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.siswa.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Siswa</span>
        </a>
    </li>



    
    {{-- Tampilan guru --}}
    <li class="nav-item {{ request()->routeIs('admin.guru.index', 'admin.guru.create', 'admin.guru.edit') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.guru.index') }}">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>Guru</span></a>
    </li>


    {{-- Tampilan Kelas --}}
    <li class="nav-item {{ request()->routeIs('admin.kelas.index', 'admin.kelas.create', 'admin.kelas.show', 'admin.kelas.edit') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.kelas.index') }}">
            <i class="fas fa-fw fa-school"></i>
            <span>Kelas</span></a>
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
    

    
    <li class="nav-item {{ request()->routeIs('admin.user.index', 'admin.user.edit') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.user.index') }}">
            <i class="fas fa-fw fa-hand-holding-usd"></i>
            <span>Tagihan</span></a>
    </li>
    


    <li class="nav-item {{ request()->routeIs('admin.user.index', 'admin.user.edit') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.user.index') }}">
            <i class="fas fa-shopping-cart"></i>
            <span>Pembayaran</span></a>
    </li>


    <li class="nav-item {{ request()->routeIs('admin.user.index', 'admin.user.edit') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.user.index') }}">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Laporan</span></a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Hak Akses
    </div>

    {{-- Tampilan User --}}
    <li class="nav-item {{ request()->routeIs('admin.user.index', 'admin.user.edit') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.user.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>User</span></a>
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