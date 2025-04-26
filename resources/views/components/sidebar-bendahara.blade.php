@php
    use App\Models\Setting;
    $pengaturan = Setting::first();
@endphp

<ul class="navbar-nav bg-gradient-{{ $pengaturan->tema }} sidebar sidebar-dark accordion {{ $isMobile ? 'toggled' : '' }}" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('bendahara.dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas {{ $pengaturan->ikon_sidebar }}"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ $pengaturan->nama_aplikasi }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('bendahara.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('bendahara.dashboard') }}">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Data Akademik
    </div>

    <li class="nav-item {{ request()->routeIs('bendahara.siswa.index', 'bendahara.siswa.show') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('bendahara.siswa.index') }}">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Siswa</span></a>
    </li>

    <hr class="sidebar-divider">
        <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <li class="nav-item {{ request()->routeIs('bendahara.biaya.index', 'bendahara.biaya.create', 'bendahara.biaya.edit') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('bendahara.biaya.index') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Biaya</span></a>
    </li>

    <li class="nav-item {{ request()->routeIs('bendahara.tagihan.index', 'bendahara.tagihan.payment') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('bendahara.tagihan.index') }}">
            <i class="fas fa-fw fa-hand-holding-usd"></i>
            <span>Tagihan</span></a>
    </li>
    
    <li class="nav-item {{ request()->routeIs('bendahara.pembayaran.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('bendahara.pembayaran.index') }}">
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