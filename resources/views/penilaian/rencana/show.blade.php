@extends('layouts.main')

@section('judul')
    Detail Rencana SKP {{ $pegawai->name }}
@endsection

@section('isi')

<div class="row">
    <div class="col">
        <a href="/penilaian/persetujuan" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- <a href="/skp/rencana/create" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Rencana</a>
        <a href="#cetak" class="btn btn-success mb-3"><i class="fas fa-file-pdf"></i> Cetak Rencana</a> --}}
        <div class="card card-secondary card-outline">
            <div class="card-body table-responsive p-0">
                <div class="container" style="padding: 20px 20px 20px;">
                    <table id="" class="table table-striped table-bordered small" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th rowspan="2" class="align-middle p-1">No</th>
                                <th rowspan="2" class="align-middle">Kegiatan Tugas Jabatan</th>
                                <th rowspan="2" class="align-middle">AK</th>
                                <th colspan="2" class="">Target</th>
                            </tr>
                            <tr>
                                <th class="col-3 align-middle">Kuantitas / Output</th>
                                <th class="col-2">Waktu (Bulan)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rencanas as $rencana)
                            <tr>
                                <td class="text-center p-3">{{ $loop->iteration }}</td>
                                <td>{{ $rencana->kegiatan->nama }}</td>
                                <td class="text-center">{{ $rencana->kegiatan->ak * $rencana->kuantitas}}</td>
                                <td>
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="number" min="1" class="form-control form-control-sm" value="{{ $rencana->kuantitas }}" readonly>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm" value="{{ $rencana->output }}" readonly>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="number" max="12" min="1" class="form-control form-control-sm" value="{{ \App\Models\Rencana::where('user_id', $pegawai->id)->where('kegiatan_id', $rencana->kegiatan_id)->count() }}" readonly>
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
</div>
@endsection