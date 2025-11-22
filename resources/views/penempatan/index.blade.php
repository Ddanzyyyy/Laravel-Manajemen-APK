@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Penempatan Pegawai</h1>
    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahPenempatanModal">
            <i class="fas fa-plus"></i> Tambah Penempatan
        </button>
    </div>
    <!-- Modal Tambah Penempatan -->
    <div class="modal fade" id="tambahPenempatanModal" tabindex="-1" role="dialog" aria-labelledby="tambahPenempatanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPenempatanLabel">Tambah Penempatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('penempatan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Penempatan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white text-center">
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
                    <tbody class="align-middle text-center">
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
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal{{ $penempatan->id }}">Hapus</button>
                                <!-- Modal Hapus -->
                                <div class="modal fade" id="hapusModal{{ $penempatan->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel{{ $penempatan->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusModalLabel{{ $penempatan->id }}">Konfirmasi Hapus</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Yakin ingin menghapus data penempatan pegawai <b>{{ $penempatan->user->nama }}</b>?</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                <form action="{{ route('penempatan.destroy', $penempatan->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
