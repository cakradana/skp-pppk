@extends('layouts.main')

@section('judul')
    {{ $title }}
@endsection

@section('isi')

<div class="row">
    <div class="col">
        {{-- <a href="/skp/rencana/create" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Rencana</a>
        <a href="#cetak" class="btn btn-success mb-3"><i class="fas fa-file-pdf"></i> Cetak Rencana</a> --}}
        <div class="card card-secondary card-outline">
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
                                <th class="align-middle col-2">Aksi</th>
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
                                <td class="text-center">
                                    <a href="/penilaian/persetujuan/{{ $pengajuan->user->id }}" class="btn btn-sm btn-success"><i class="fas fa-search"></i></a>
                                    <a href="/penilaian/persetujuan/setuju/{{ $pengajuan->user->id }}" class="btn btn-sm {{ $pengajuan->status == 'disetujui' ? 'btn-secondary disabled' : 'btn-primary' }}"><i class="fas fa-check"></i></a>
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