@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Detail Siswa</h2>
    <table class="table table-bordered">
        <tr><th>Nama</th><td>{{ $siswa->nama }}</td></tr>
        <tr><th>NIS</th><td>{{ $siswa->nis }}</td></tr>
        <tr><th>Jenis Kelamin</th><td>{{ $siswa->jenis_kelamin }}</td></tr>
        <tr><th>Tempat Lahir</th><td>{{ $siswa->tempat_lahir }}</td></tr>
        <tr><th>Tanggal Lahir</th><td>{{ $siswa->tanggal_lahir }}</td></tr>
        <tr><th>Kelas</th><td>{{ $siswa->kelas }}</td></tr>
        <tr><th>Kategori</th><td>{{ $siswa->category }}</td></tr>
        <tr><th>Status</th><td>{{ $siswa->status }}</td></tr>
    </table>
</div>
@endsection
