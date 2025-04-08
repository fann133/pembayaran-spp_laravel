@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Backup Database</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">Pilih Opsi Backup</div>
        <div class="card-body">
            <!-- Backup Seluruh Database -->
            <form action="{{ route('admin.database.backup') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Backup Seluruh Database</button>
            </form>

            <hr>

            <!-- Backup Per Tabel -->
            <h5>Backup Per Tabel</h5>
            <form action="{{ route('admin.database.backup') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="table">Pilih Tabel:</label>
                    <select name="table" id="table" class="form-control select2">
                        <option value="">-- Pilih Tabel --</option>
                        @foreach($tables as $table)
                            <option value="{{ $table->$tableKey }}">{{ $table->$tableKey }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success mt-2">Backup Tabel Terpilih</button>
            </form>
        </div>
    </div>
</div>
@endsection
