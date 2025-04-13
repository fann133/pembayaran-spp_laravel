@extends('layouts.master')

@section('title', 'Ubah User')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Data</h1>
    </div>

    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-header py-3 d-flex justify-content-center">
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
    
        <form action="{{ route('admin.user.update', $user->id_users) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container d-flex flex-column col-12 col-md-5 justify-content-center">
                <div class="mt-2">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mt-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" value="{{ old('username', $user->username) }}" required>
                </div>

                <div class="mt-2">
                    <label for="password" class="form-label">Password (Kosongkan jika tidak ingin diubah)</label>
                    <input type="text" name="password" class="form-control" id="password"value="{{ old('username', $user->bypass) }}" >
                </div>

                <div class="mt-2 pb-4">
                    <label for="role_id" class="form-label">Role</label>
                    <select name="role_id" id="role_id" class="form-control">
                        <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Siswa</option>
                        <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Guru</option>
                        <option value="4" {{ $user->role_id == 4 ? 'selected' : '' }}>Bendahara</option>
                        <option value="5" {{ $user->role_id == 5 ? 'selected' : '' }}>Kepala Sekolah</option>
                    </select>
                </div>
            </div>

            <div class="container d-flex flex-column col-12 justify-content-start">
                <div class="d-flex mb-5 bg-gray-200">
                    <div class="mb-4 mt-4 text-center w-75">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
