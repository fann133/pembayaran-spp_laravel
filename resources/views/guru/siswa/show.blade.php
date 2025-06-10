@extends('layouts.master')

@section('title', $pengaturan->nama_aplikasi . ' | Lihat Siswa')
@section('content')
<div class="container-fluid">

    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('guru.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('guru.siswa.index') }}">Siswa</a></li>
        <li class="breadcrumb-item active" aria-current="page">Lihat Siswa</li>
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
        <h1 class="h3 mb-0 text-gray-800">Detail Siswa</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-{{ $pengaturan->tema }}">Data Siswa</h6>
                </div>
                
                <div class="card-body border-bottom-{{ $pengaturan->tema }}">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 30%;">Nama</th>
                                <td class="align-middle">{{ $siswa->nama }}</td>
                            </tr>
                            <tr>
                                <th scope="row">NIS</th>
                                <td class="align-middle">{{ $siswa->nis }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jenis Kelamin</th>
                                <td class="align-middle">{{ $siswa->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tempat, Tanggal Lahir</th>
                                <td class="align-middle">{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kelas</th>
                                <td class="align-middle">{{ $siswa->kelas }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kategori</th>
                                <td class="align-middle">{{ $siswa->category }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Status</th>
                                <td class="align-middle">{{ $siswa->status }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
