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
                            <?php 
                                $total_nilai = 0;
                                $banyak_kegiatan = \App\Models\Sasaran::where('user_id', $user->id)->select('kegiatan_id')->groupBy('kegiatan_id')->get()->count();
                            ?>
                            @foreach ($rencanas as $rencana)
                            <?php
                                $target_kuantitas = \App\Models\Sasaran::where('user_id', $user->id)->where('kegiatan_id', $rencana->kegiatan_id)->select('target_kuantitas', $rencana->kuantitas)->sum('target_kuantitas');
                                $realisasi_kuantitas = \App\Models\Sasaran::where('kegiatan_id', $rencana->kegiatan->id)->sum('realisasi_kuantitas');
                                
                                $target_waktu = \App\Models\Sasaran::where('user_id', $user->id)->where('kegiatan_id', $rencana->kegiatan_id)->count();
                                $realisasi_waktu = \App\Models\Sasaran::where('user_id', $user->id)->where('kegiatan_id', $rencana->kegiatan_id)->whereNotNull('realisasi_kuantitas')->count();
                                
                                $realisasi_kualitas = \App\Models\Sasaran::where('user_id', $user->id)->where('kegiatan_id', $rencana->kegiatan_id)->whereNotNull('realisasi_kualitas')->value('realisasi_kualitas');

                                $target_biaya = \App\Models\Sasaran::where('user_id', $user->id)->where('kegiatan_id', $rencana->kegiatan_id)->whereNotNull('target_biaya')->value('target_biaya');
                                $realisasi_biaya = \App\Models\Sasaran::where('user_id', $user->id)->where('kegiatan_id', $rencana->kegiatan_id)->whereNotNull('realisasi_biaya')->value('realisasi_biaya');

                                $aspek_kuantitas = $realisasi_kuantitas/$target_kuantitas*100;
                                $aspek_kualitas = $realisasi_kualitas/$rencana->target_kualitas*100;

                                $persen_waktu = 100-($realisasi_waktu/$target_waktu*100);
                                if ($persen_waktu > 24) {
                                    $aspek_waktu = 76-((((1.76*$target_waktu-$realisasi_waktu)/$target_waktu)*100)-100);
                                } elseif ($persen_waktu < 24) {
                                    $aspek_waktu = ((1.76*$target_waktu-$realisasi_waktu)/$target_waktu)*100;
                                }

                                if (!empty($target_biaya)) {
                                    $persen_biaya = 100-($realisasi_biaya/$target_biaya*100);
                                    if ($persen_biaya > 24) {
                                    $aspek_biaya = 76-((((1.76*$target_biaya-$realisasi_biaya)/$target_biaya)*100)-100);
                                    } elseif ($persen_biaya < 24) {
                                    $aspek_biaya = ((1.76*$target_biaya-$realisasi_biaya)/$target_biaya)*100;
                                    }
                                } else {
                                    $persen_biaya = null;
                                    $aspek_biaya = null;    
                                }

                                $perhitungan = $aspek_kuantitas + $aspek_kualitas + $aspek_waktu + $aspek_biaya;

                                if (!empty($target_biaya)) {
                                    if ($realisasi_biaya == null) {
                                        $nilai_skp = $perhitungan/3;
                                    } else {
                                        $nilai_skp = $perhitungan/4;
                                    }
                                } else {
                                    $nilai_skp = $perhitungan/3;
                                }

                                $total_nilai += $nilai_skp;
                            ?>
                            <tr>
                                <td class="text-center p-3">{{ $loop->iteration }}</td>
                                <td>{{ $rencana->kegiatan->nama }}</td>
                                <td class="text-center">{{ $rencana->kegiatan->ak}}</td>
                                <td class="text-center">{{ $target_kuantitas }}</td>
                                <td>{{ $rencana->output->nama }}</td>
                                <td class="text-center">{{ $rencana->target_kualitas }}</td>
                                <td>{{ $target_waktu }}</td>
                                <td>Bulan</td>
                                <td class="text-center">{{ $target_biaya ? $target_biaya : '-' }}</td>
                                <td class="text-center">{{ $rencana->kegiatan->ak * $realisasi_kuantitas}}</td>
                                <td class="text-center">{{ $realisasi_kuantitas }}</td>
                                <td>{{ $rencana->output->nama }}</td>
                                <td class="text-center">{{ $realisasi_kualitas ? $realisasi_kualitas : '-' }}</td>
                                <td>{{ $realisasi_waktu }}</td>
                                <td>Bulan</td>
                                <td class="text-center">{{ $realisasi_biaya ? $realisasi_biaya : '-' }}</td>
                                <td class="text-center">{{ round($nilai_skp, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="16" class="text-center font-weight-bold">Nilai Capaian SKP</th>
                                <td class="text-center font-weight-bold">{{ round($total_nilai / $banyak_kegiatan, 2) }}
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