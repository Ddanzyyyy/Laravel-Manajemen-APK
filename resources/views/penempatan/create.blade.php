@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Penempatan</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('penempatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="user_id">Pegawai</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">-- Pilih Pegawai --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->nama }} ({{ $user->Jabatan }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan Penempatan</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="foto_tugas">Foto Tugas</label>
                    <input type="file" name="foto_tugas" id="foto_tugas" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('penempatan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
