@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Penempatan Pegawai</h1>
    <a href="{{ route('penempatan.create') }}" class="btn btn-primary mb-3">Tambah Penempatan</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Penempatan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Email</th>
                            <th>Jabatan</th>
                            <th>Keterangan Penempatan</th>
                            <th>Foto Tugas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penempatans as $penempatan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $penempatan->user->nama }}</td>
                            <td>{{ $penempatan->user->email }}</td>
                            <td>{{ $penempatan->user->Jabatan }}</td>
                            <td>{{ $penempatan->keterangan }}</td>
                            <td>
                                @if($penempatan->foto_tugas)
                                    <img src="{{ asset('storage/penempatan/'.$penempatan->foto_tugas) }}" width="80" alt="Foto Tugas">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('penempatan.edit', $penempatan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('penempatan.destroy', $penempatan->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
