@extends('layouts.main')

@section('judul')
    {{ $title }}
@endsection

@section('isi')
    <div class="row">
        <div class="col">

            @if ($atribut == 'false')
                <div class="alert alert-warning alert-dismissible">
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Belum Bisa Mengajukan Realisasi</h5>
                    Mohon tunggu {{ $user->penilai->name }} menyetujui rencana Anda.
                </div>
            @else
                <a href="/pengajuan/realisasi/create" class="d-print-none btn btn-primary mb-3"><i class="fas fa-plus"></i> Isi
                    Realisasi Per
                    Bulan</a>

                @if ($cetak == 'bisa cetak')
                    <a href="/pengajuan/realisasi/cetak-realisasi/{{ $user->id }}"
                        class="btn btn-success mb-3 ml-auto d-print-none float-right"><i class="fas fa-file-pdf"></i>
                        Cetak
                        Realisasi</a>
                @elseif ($cetak == 'belum bisa cetak')
                    <a href="/pengajuan/realisasi/cetak-realisasi/{{ $user->id }}"
                        class="btn btn-warning mb-3 ml-auto d-print-none float-right disabled"><i
                            class="fas fa-exclamation-triangle"></i>
                        Tunggu penilai menilai semua realisasi untuk dapat melakukan cetak realisasi</a>
                @endif
                <div class="d-print-none card card-secondary card-outline">
                    <div class="card-body table-responsive p-0">
                        <div class="" style="padding: 20px 20px 20px;">
                            <table class="table table-striped table-bordered" style="width:100%; font-size:70%">
                                <thead class="text-center">
                                    <tr>
                                        <th rowspan="2" class="align-middle p-1">No</th>
                                        <th rowspan="2" class="align-middle text-left">Kegiatan Tugas Jabatan</th>
                                        <th rowspan="2" class="align-middle">AK</th>
                                        <th colspan="6" class="align-middle">Target</th>
                                        <th rowspan="2" class="align-middle">AK</th>
                                        <th colspan="6" class="align-middle">Realisasi</th>
                                        <th rowspan="2" class="align-middle">Nilai Capaian SKP</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Kuantitas/ Output</th>
                                        <th class="align-middle">Kualitas</th>
                                        <th colspan="2" class="align-middle">Waktu</th>
                                        <th class="align-middle">Biaya</th>
                                        <th colspan="2">Kuantitas/ Output</th>
                                        <th class="align-middle">Kualitas</th>
                                        <th colspan="2" class="align-middle">Waktu</th>
                                        <th class="align-middle">Biaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rencanas as $rencana)
                                        <tr>
                                            <td class="text-center p-3">{{ $loop->iteration }}</td>
                                            <td>{{ $rencana->kegiatan->nama }}</td>
                                            <td class="text-center">{{ $rencana->kegiatan->ak }}</td>
                                            <td class="text-center">{{ $target_kuantitas[$loop->iteration - 1] }}</td>
                                            <td>{{ $rencana->output->nama }}</td>
                                            <td class="text-center">{{ $rencana->target_kualitas }}</td>
                                            <td>{{ $target_waktu[$loop->iteration - 1] }}</td>
                                            <td>Bulan</td>
                                            <td class="text-center">
                                                {{ $target_biaya[$loop->iteration - 1] ? $target_biaya[$loop->iteration - 1] : '-' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $rencana->kegiatan->ak * $realisasi_kuantitas[$loop->iteration - 1] }}
                                            </td>
                                            <td class="text-center">{{ $realisasi_kuantitas[$loop->iteration - 1] }}</td>
                                            <td>{{ $rencana->output->nama }}</td>
                                            <td class="text-center">
                                                {{ $realisasi_kualitas[$loop->iteration - 1] ? $realisasi_kualitas[$loop->iteration - 1] : '-' }}
                                            </td>
                                            <td>{{ $realisasi_waktu[$loop->iteration - 1] }}</td>
                                            <td>Bulan</td>
                                            <td class="text-center">
                                                {{ $realisasi_biaya[$loop->iteration - 1] ? $realisasi_biaya[$loop->iteration - 1] : '-' }}
                                            </td>
                                            <td class="text-center">{{ round($nilai_skp[$loop->iteration - 1], 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="16" class="text-center font-weight-bold">Nilai Capaian SKP</th>
                                        <td class="text-center font-weight-bold">
                                            {{ round($final, 2) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
