@extends('layouts.main')

@section('judul')
{{ $title }}
@endsection

@section('isi')

<div class="row">
    <div class="col">
        @if ($atribut == 'true')
        <a href="/pengajuan/rencana/create" class="btn mb-3 btn-success disabled"><i class="fas fa-check"></i> Rencana
            Telah
            Disetujui Atasan</a>
        <a href="/pengajuan/rencana/cetak-rencana/{{ $user->id }}" class="btn btn-success mb-3"><i
                class="fas fa-file-pdf"></i> Cetak Rencana</a>
        @else
        <a href="/pengajuan/rencana/create" class="btn mb-3 btn-primary"><i class="fas fa-plus"></i> Tambah Rencana</a>
        <a href="#cetak" class="btn btn-success mb-3 disabled"><i class="fas fa-file-pdf"></i> Cetak Rencana</a>
        @endif
        {{-- <a href="/pengajuan/rencana/create"
            class="btn mb-3 {{ $atribut == 'true' ? 'btn-secondary disabled' : 'btn-primary' }}"><i
                class="fas fa-plus"></i> Tambah Rencana</a> --}}
        <div class="card card-secondary card-outline">
            <div class="card-body table-responsive p-0">
                <div class="" style="padding: 20px 20px 20px;">
                    <table id="" class="table table-bordered small" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th rowspan="2" class="align-middle p-1">No</th>
                                <th rowspan="2" class="align-middle">Kegiatan Tugas Jabatan</th>
                                <th rowspan="2" class="align-middle">AK</th>
                                <th colspan="2" class="">Target</th>
                                <th rowspan="2" class="align-middle">Aksi</th>
                            </tr>
                            <tr>
                                <th class="align-middle">Kuantitas / Output</th>
                                <th class="">Waktu (Bulan)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rencanas as $rencana)
                            <?php 
                                $kuantitas = \App\Models\Sasaran::where('user_id', $user->id)->where('kegiatan_id', $rencana->kegiatan_id)->select('kuantitas', $rencana->kuantitas)->sum('kuantitas');
                                $waktu = \App\Models\Sasaran::where('user_id', $user->id)->where('kegiatan_id', $rencana->kegiatan_id)->count();
                            ?>
                            <tr>
                                <td class="text-center p-3">{{ $loop->iteration }}</td>
                                <td>{{ $rencana->kegiatan->nama }}</td>
                                <td class="text-center">{{ $rencana->kegiatan->ak * $kuantitas }}</td>
                                <td>
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="number" min="1" class="form-control form-control-sm"
                                                value="{{ $kuantitas }}" readonly>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm"
                                                value="{{ $rencana->output }}" readonly>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="number" max="12" min="1" class="form-control form-control-sm"
                                                value="{{ $waktu }}" readonly>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="#" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></td>
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