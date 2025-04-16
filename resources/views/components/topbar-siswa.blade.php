<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">{{ $tagihanCount }}</span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Tagihan Terbaru
                </h6>

                @forelse ($tagihan as $item)
                <a class="dropdown-item d-flex align-items-center" href="{{ route('siswa.tagihan.show', $item->id_tagihan) }}">
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-money-bill text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</div>
                        <span class="font-weight-bold">{{ $item->nama_pembayaran }} {{ $item->bulan ?? ' ' }} - Rp{{ number_format($item->jumlah, 0, ',', '.') }}</span>
                    </div>
                </a>
                @empty
                <div class="text-center small text-gray-500">Tidak ada tagihan baru</div>
                @endforelse

                <a class="dropdown-item text-center small text-gray-500" href="{{ route('siswa.tagihan.index') }}">Lihat Semua Tagihan</a>
            </div>
        </li>


        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
                <img class="img-profile rounded-circle"
                    src="{{ asset('assets/img/no-avatar.png') }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profileModal">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->