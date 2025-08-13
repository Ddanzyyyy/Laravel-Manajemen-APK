@extends('layouts.app')


@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-tasks mr-2"></i>
        {{ $title }}
    </h1>

    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-sm-center justify-content-xl-between">
            <div class="mb-1 mr-2">
                <a href="#" class="btn btn-sm btn-primary ">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Data</a>
            </div>
            <div>
                @if (auth()->user()->is_tugas == true)
                    {{-- <a href="#" class="btn btn-sm btn-success">
                        <i class="fas fa-file-excel mr-2"></i>
                        Excel</a> --}}
                    <a href="{{ route('tugasPdf') }}" class="btn btn-sm btn-danger" target="_blank">
                        <i class="fas fa-file-excel mr-2"></i>
                        PDF</a>
                @endif

            </div>

        </div>
        <div class="card-body">

            @if (auth()->user()->is_tugas == true)
                <div class="row">
                    <div class="col-6">
                        Nama
                    </div>
                    <div class="col-6">
                        : {{ $tugas->user->nama }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        Email
                    </div>
                    <div class="col-6">
                        :
                        <span class="badge badge-primary">
                            {{ $tugas->user->email }}
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        Tugas
                    </div>
                    <div class="col-6">
                        : {{ $tugas->tugas }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        Tanggal Mulai
                    </div>
                    <div class="col-6">
                        :
                        <span class="badge badge-info">
                            {{ $tugas->tanggal_mulai }}
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        Tanggal Selesau
                    </div>
                    <div class="col-6">
                        :
                        <span class="badge badge-info">
                            {{ $tugas->tanggal_selesai }}
                        </span>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-6">
                        Status
                    </div>
                    <div class="col-6">
                        :
                        <span class="badge badge-danger">
                            Anda Belum Ditugaskan
                        </span>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection