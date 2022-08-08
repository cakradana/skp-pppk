@extends('layouts.main')

@section('judul')
    {{ $title }}: {{ $pegawai->name }}
@endsection

@section('isi')
    <div class="row">
        <div class="col">
            <a href="/persetujuan/rencana-pegawai" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i>
                Kembali</a>
            @if ($atribut == 'true')
                <a href="/persetujuan/rencana-pegawai/tolak/{{ $pegawai->id }}"
                    class="btn mb-3 btn-danger tolak-pengajuan"><i class="fas fa-times"></i> Tolak Pengajuan</a>
            @else
                <a href="/persetujuan/rencana-pegawai/setuju/{{ $pegawai->id }}" class="btn btn-primary mb-3"><i
                        class="fas fa-check"></i> Setujui Pengajuan</a>
            @endif
            {{-- <a href="/pengajuan/rencana/create" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah
            Rencana</a>
        <a href="#cetak" class="btn btn-success mb-3"><i class="fas fa-file-pdf"></i> Cetak Rencana</a> --}}
            <div class="card card-secondary card-outline">
                <div class="card-body table-responsive p-0">
                    <div class="" style="padding: 20px 20px 20px;">
                        <table id="" class="table table-striped table-bordered small" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th rowspan="2" class="align-middle p-1">No</th>
                                    <th rowspan="2" class="align-middle text-left">Kegiatan Tugas Jabatan</th>
                                    <th rowspan="2" class="align-middle">AK</th>
                                    <th colspan="4" class="">Target</th>
                                </tr>
                                <tr>
                                    <th colspan="2" class="align-middle">Kuantitas/
                                        Output</th>
                                    <th colspan="2" class="align-middle">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rencanas as $rencana)
                                    <?php
                                    $waktu = \App\Models\Sasaran::where('user_id', $pegawai->id)
                                        ->where('kegiatan_id', $rencana->kegiatan_id)
                                        ->count();
                                    $kuantitas = \App\Models\Sasaran::where('user_id', $pegawai->id)
                                        ->where('kegiatan_id', $rencana->kegiatan_id)
                                        ->select('target_kuantitas', $rencana->kuantitas)
                                        ->sum('target_kuantitas');
                                    ?>
                                    <tr>
                                        <td class="text-center p-3">{{ $loop->iteration }}</td>
                                        <td>{{ $rencana->kegiatan->nama }}</td>
                                        <td class="text-center">{{ $rencana->kegiatan->ak * $kuantitas }}</td>
                                        <td class="text-center">
                                            {{ $kuantitas }}
                                        </td>
                                        <td class="text-center">
                                            {{ $rencana->output->nama }}
                                        </td>
                                        <td class="text-center">
                                            {{ $waktu }}
                                        </td>
                                        <td class="text-center">
                                            Bulan
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
