@extends('admin.layouts.master')

@section('title', 'Data Kelas')

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
        <h1 class="h3 mb-0 text-gray-800">kelas</h1>
    </div>


        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data kelas</h6>
                <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"> Tambah Data</i>
                </a>
            </div>
            
            <div class="card-body border-bottom-primary">
                <div class="table-responsive pt-2">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kelas</th>
                                <th>Kode Kelas</th>
                                <th>Pengampu Kelas</th>
                                <th>Jumlah Siswa</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $key => $k)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>{{ $k->kode_kelas }}</td>
                                <td>{{ $k->guruPengampu->nama ?? 'Tidak ada' }}</td>
                                <td>{{ optional($k->siswas)->count() }} Siswa</td>

                                <td>{{ $k->deskripsi }}</td>
                                <td>
                                    <a href="{{ route('admin.kelas.show', $k->id_kelas) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('admin.kelas.edit', $k->id_kelas) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm">Hapus</a>
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
