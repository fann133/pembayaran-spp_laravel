@php
    use App\Models\Setting;
    $pengaturan = Setting::first();
@endphp

<ul class="navbar-nav bg-gradient-{{ $pengaturan->tema }} sidebar sidebar-dark accordion {{ $isMobile ? 'toggled' : '' }}" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('kepsek.dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas {{ $pengaturan->ikon_sidebar }}"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ $pengaturan->nama_aplikasi }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('kepsek.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kepsek.dashboard') }}">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Dashboard</span></a>
    </li>
    
    <li class="nav-item {{ request()->routeIs('kepsek.profil.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kepsek.profil.index') }}">
            <i class="fas fa-fw fa-school"></i>
            <span>Profil</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Data Akademik
    </div>

    <li class="nav-item {{ request()->routeIs('kepsek.siswa.index', 'kepsek.siswa.show') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kepsek.siswa.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Siswa</span></a>
    </li>
    
    <li class="nav-item {{ request()->routeIs('kepsek.guru.index', 'kepsek.guru.show') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kepsek.guru.index') }}">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Guru</span></a>
    </li>
    
    <li class="nav-item {{ request()->routeIs('kepsek.kelas.index', 'kepsek.kelas.show') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kepsek.kelas.index') }}">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>Kelas</span></a>
    </li>

    <hr class="sidebar-divider">
        <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <li class="nav-item {{ request()->routeIs('kepsek.biaya.index', 'kepsek.biaya.create', 'kepsek.biaya.edit') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kepsek.biaya.index') }}">
            <i class="fas fa-fw fa-money-bill-alt"></i>
            <span>Biaya</span></a>
    </li>

    <li class="nav-item {{ request()->routeIs('kepsek.tagihan.index', 'kepsek.tagihan.payment') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kepsek.tagihan.index') }}">
            <i class="fas fa-fw fa-hand-holding-usd"></i>
            <span>Tagihan</span></a>
    </li>
    
    <li class="nav-item {{ request()->routeIs('kepsek.pembayaran.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kepsek.pembayaran.index') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Pembayaran</span></a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>