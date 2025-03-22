@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Edit User</h2>
    
    <form action="{{ route('user.update', $user->id_users) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" value="{{ old('username', $user->username) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password (Kosongkan jika tidak ingin diubah)</label>
            <input type="text" name="password" class="form-control" id="password">
        </div>

        <div class="mb-3">
            <label for="role_id" class="form-label">Role</label>
            <select name="role_id" id="role_id" class="form-control">
                <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Siswa</option>
                <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Guru</option>
                <option value="4" {{ $user->role_id == 4 ? 'selected' : '' }}>Bendahara</option>
                <option value="5" {{ $user->role_id == 5 ? 'selected' : '' }}>Kepala Sekolah</option>
            </select>
        </div>        


        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
