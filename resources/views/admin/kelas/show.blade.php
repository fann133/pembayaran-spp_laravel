@extends('layouts.master')

@section('title', 'Lihat Kelas')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Kelas - {{ $kelas->nama }}</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa di Kelas {{ $kelas->nama }}</h6>
            <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary btn-sm">&larr; Kembali</a>
        </div>

        <div class="card-body border-bottom-primary">
            <div class="table-responsive pt-2">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $key => $s)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $s->nama }}</td>
                            <td>{{ $s->nis }}</td>
                            <td>{{ $s->jenis_kelamin }}</td>
                            <td>{{ $s->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
