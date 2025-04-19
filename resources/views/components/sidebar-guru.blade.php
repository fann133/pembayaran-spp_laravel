@php
    use App\Models\Setting;
    $pengaturan = Setting::first();
@endphp

<ul class="navbar-nav bg-gradient-{{ $pengaturan->tema }} sidebar sidebar-dark accordion {{ $isMobile ? 'toggled' : '' }}" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('guru.dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas {{ $pengaturan->ikon_sidebar }}"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ $pengaturan->nama_aplikasi }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('guru.dashboard') }}">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item {{ request()->routeIs('guru.siswa.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('guru.siswa.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Data Siswa</span></a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>
    
    <li class="nav-item {{ request()->routeIs('guru.tagihan.index', 'guru.tagihan.payment') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('guru.tagihan.index') }}">
            <i class="fas fa-fw fa-hand-holding-usd"></i>
            <span>Tagihan</span></a>
    </li>
    

    <li class="nav-item {{ request()->routeIs('guru.pembayaran.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('guru.pembayaran.index') }}">
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