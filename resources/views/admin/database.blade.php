@extends('layouts.master')

@section('title', 'Aplikasi')
@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Backup Database</h1>
    </div>

    <div class="card">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Database</h6>
        </div>
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