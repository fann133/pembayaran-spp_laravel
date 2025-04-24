@extends('layouts.master')

@section('title', 'Data Siswa')
@section('content')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Siswa</h1>
    </div>


        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
            </div>
            
            <div class="card-body border-bottom-primary">
                <div class="table-responsive pt-2">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Kelas</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $key => $siswa)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $siswa->nama }} [{{ $siswa->status }}]</td>
                                <td class="font-weight-bold">{{ $siswa->nis }}</td>
                                <td>{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                                <td>{{ $siswa->jenis_kelamin }}</td>
                                <td>{{ $siswa->kelas }}</td>
                                <td>{{ ucfirst($siswa->category) }}</td>
                                <td>
                                    <a href="{{ route('bendahara.siswa.show', $siswa->id_siswa) }}" class="btn btn-info btn-circle btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection
