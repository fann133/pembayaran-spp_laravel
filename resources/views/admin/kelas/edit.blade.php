@extends('layouts.master')

@section('title', 'Ubah Kelas')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Data</h1>
    </div>

    <div class="card shadow mb-4 border-bottom-primary">
            <div class="card-header py-3 d-flex justify-content-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
            </div>

            <form action="{{ route('admin.kelas.update', $kelas->id_kelas) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="container d-flex flex-column col-12 col-md-5 justify-content-center">

                    <div class="mt-2">
                        <label for="nama" class="form-label">Nama Kelas</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="{{ $kelas->nama }}" required>
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Kode Kelas</label>
                        <input type="text" name="kode_kelas" class="form-control" value="{{ $kelas->kode_kelas }}" required>
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Pengampu Kelas</label>
                        <select name="pengampu_kelas" class="form-control">
                            <option value="">Pilih Guru</option>
                            @foreach ($gurus as $guru)
                                <option 
                                    value="{{ $guru->id_guru }}"
                                    {{ $kelas->pengampu_kelas == $guru->id_guru ? 'selected' : '' }}
                                    {{ \App\Models\Kelas::where('pengampu_kelas', $guru->id_guru)
                                        ->where('id_kelas', '!=', $kelas->id_kelas)
                                        ->exists() ? 'disabled' : '' }}>
                                    {{ $guru->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mt-2 pb-4">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control">{{ $kelas->deskripsi }}</textarea>
                    </div>

                </div>
                <div class="container d-flex flex-column col-12 justify-content-start">
                    <div class="d-flex mb-5 bg-gray-200">
                        <div class="mb-4 mt-4 text-center w-75">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>
@endsection
