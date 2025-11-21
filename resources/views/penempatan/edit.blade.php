@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Penempatan</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('penempatan.update', $penempatan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="user_id">Pegawai</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">-- Pilih Pegawai --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $penempatan->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->jabatan }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan Penempatan</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{ $penempatan->keterangan }}" required>
                </div>
                <div class="form-group">
                    <label for="foto_tugas">Foto Tugas</label>
                    <input type="file" name="foto_tugas" id="foto_tugas" class="form-control" accept="image/*">
                    @if($penempatan->foto_tugas)
                        <br>
                        <img src="{{ asset('storage/penempatan/'.$penempatan->foto_tugas) }}" width="120" alt="Foto Tugas">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('penempatan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
