@extends('layouts.master')

@section('title', $pengaturan->nama_aplikasi . ' | Dashboard')
@section('content')
<div class="container-fluid">

    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
    </nav>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-times-circle"></i> {{ session('error') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <form method="GET" action="" class="form-inline mb-3">
            <div class="form-group mr-2">
                <label for="bulan" class="mr-2">Bulan</label>
                <select name="bulan" id="bulan" class="form-control select2" onchange="this.form.submit()">
                    @foreach ($daftarBulan as $bulan)
                        <option value="{{ str_pad($bulan, 2, '0', STR_PAD_LEFT) }}" {{ $bulanDipilih == str_pad($bulan, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
        
            <div class="form-group mr-2">
                <label for="tahun" class="mr-2">Tahun</label>
                <select name="tahun" id="tahun" class="form-control select2" onchange="this.form.submit()">
                    @foreach ($tahunList as $tahun)
                        <option value="{{ $tahun }}" {{ $tahun == $tahunDipilih ? 'selected' : '' }}>
                            {{ $tahun }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>        
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Siswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahSiswaAktif }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Guru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahGuru }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Progress {{ \Carbon\Carbon::create()->month($bulanDipilih)->translatedFormat('F') }} - {{ $tahunDipilih }}
                            </div>
                            <div class="row no-gutters align-items-center mb-1">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $progress }}%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted">{{ $sudahBayarTagihan }} dari {{ $totalTagihan }} siswa sudah membayar tagihan</small>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Pemasukan {{ \Carbon\Carbon::create()->month($bulanDipilih)->translatedFormat('F') }} - {{ $tahunDipilih }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalPemasukanBulanIni, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4 border-bottom-{{ $pengaturan->tema }}">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-{{ $pengaturan->tema }}">Tabel Pembayaran {{ request('tahun') ?? date('Y') }}</h6>
            
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Opsi:</div>
                            <a class="dropdown-item" href="#" id="fullscreenBar">Full Screen</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" id="downloadPNG">Download PNG</a>
                            <a class="dropdown-item" href="#" id="downloadJPEG">Download JPEG</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" id="downloadPDF">Download PDF</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-bar" id="chartBarContainer">
                        <canvas id="myBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4 border-bottom-{{ $pengaturan->tema }}">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-{{ $pengaturan->tema }}">Diagram Tagihan SPP {{ \Carbon\Carbon::create()->month($bulanDipilih)->translatedFormat('F') }} - {{ $tahunDipilih }}
                    </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Opsi:</div>
                            <a class="dropdown-item" href="#" id="fullscreenPie">Full Screen</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2" id="chartPieContainer">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small" id="pieLabels">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pilih Warna -->
<div class="modal fade" id="colorPickerModal" tabindex="-1" role="dialog" aria-labelledby="colorPickerLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="colorPickerLabel">Pilih Warna Bar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <input type="color" id="barColorPicker" value="#4e73df" class="form-control">
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-primary" id="applyColor">Terapkan</button>
        </div>
      </div>
    </div>
  </div>
  
<script>
    // Bar Chart
    var chartLabels = {!! json_encode($labels) !!};
    var dataSPP = {!! json_encode($dataSPP) !!};
    var dataNonSPP = {!! json_encode($dataNonSPP) !!};

    // Pie Chart
    var pieChartData = @json($dataPie);
    const labels = @json($kelasData);
    const data = @json($jumlahBelumBayar);
</script>

@endsection