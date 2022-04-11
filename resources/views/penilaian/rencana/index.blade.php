@extends('layouts.main')

@section('judul')
    Persetujuan Rencana SKP
@endsection

@section('isi')

<div class="row">
    <div class="col">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- <a href="/skp/rencana/create" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Rencana</a>
        <a href="#cetak" class="btn btn-success mb-3"><i class="fas fa-file-pdf"></i> Cetak Rencana</a> --}}
        <div class="card card-secondary card-outline">
            <div class="card-header">
                <h3 class="card-title mt-2">Persetujuan Rencana SKP Pegawai</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <div class="container" style="padding: 20px 20px 20px;">
                    <table id="" class="table table-striped table-bordered small" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th class="align-middle p-1">No</th>
                                <th class="align-middle">NIP</th>
                                <th class="align-middle">Nama</th>
                                <th class="align-middle">Jabatan</th>
                                <th class="align-middle">Jangka Waktu</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajuans as $pengajuan)
                            <tr>
                                <td class="text-center p-3">{{ $loop->iteration }}</td>
                                <td>{{ $pengajuan->user->nip }}</td>
                                <td>{{ $pengajuan->user->name }}</td>
                                <td>{{ $pengajuan->user->jabatan->nama }}</td>
                                <td>1 Jan s/d 31 Des 2022</td>
                                <td>{{ $pengajuan->status }}</td>
                                <td>
                                    <a href="/penilaian/persetujuan/{{ $pengajuan->user->id }}" class="btn btn-sm btn-success mb-3"><i class="fas fa-search"></i></a>
                                    <a href="/penilaian/persetujuan/{{ $pengajuan->user->id }}" class="mb-3 btn btn-sm btn-primary"><i class="fas fa-check"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            



                            {{-- @foreach ($rencanas as $rencana)
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
                                            <input type="number" max="12" min="1" class="form-control form-control-sm" value="{{ $rencana->waktu }}" readonly>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="#" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                            </tr>
                            @endforeach --}}
                            {{-- @foreach ($jabatans as $jabatan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jabatan->nama }}</td>
                                <td>
                                    <a href="/master/jabatan/{{ $jabatan->id }}/edit" class="btn btn-warning"><i class="fas fa-pen"></i> Edit</a>
                                    <form action="/master/jabatan/{{ $jabatan->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" onclick="return confirm('Yakin?')"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection