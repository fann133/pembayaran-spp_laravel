@extends('layouts.master')

@section('content')
<div class="container">
    <h4>Tambah User</h4>
    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <select name="name" id="name" class="form-control" required>
                <option value="">-- Pilih Nama --</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" readonly required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role_id" id="role_id" class="form-control" required>
                <option value="2">Siswa</option>
                <option value="3">Guru</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

@endsection
