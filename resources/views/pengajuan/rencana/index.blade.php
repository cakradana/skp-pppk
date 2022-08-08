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
                <a href="/pengajuan/rencana/cetak-rencana/{{ $user->id }}" class="btn btn-success mb-3 float-right"><i
                        class="fas fa-file-pdf"></i> Cetak Rencana</a>
            @else
                <a href="/pengajuan/rencana/create" class="btn mb-3 btn-primary"><i class="fas fa-plus"></i> Tambah
                    Rencana</a>
                <a href="#cetak" class="btn btn-warning mb-3 float-right disabled"><i
                        class="fas fa-exclamation-triangle"></i>
                    Tunggu penilai menyetujui rencana untuk dapat melakukan cetak rencana</a>
            @endif
            {{-- <a href="/pengajuan/rencana/create"
            class="btn mb-3 {{ $atribut == 'true' ? 'btn-secondary disabled' : 'btn-primary' }}"><i
                class="fas fa-plus"></i> Tambah Rencana</a> --}}
            <div class="card card-secondary card-outline">
                <div class="card-body table-responsive p-0">
                    <div class="" style="padding: 20px 20px 20px;">
                        <table id="" class="table table-bordered small" style="width:100%;">
                            <thead class="text-center">
                                <tr>
                                    <th rowspan="2" class="align-middle p-1">No</th>
                                    <th rowspan="2" class="align-middle text-left">Kegiatan Tugas Jabatan</th>
                                    <th rowspan="2" class="align-middle">AK</th>
                                    <th colspan="4" class="">Target</th>
                                    <th rowspan="2" class="align-middle col-2">Aksi</th>
                                </tr>
                                <tr>
                                    <th colspan="2" class="align-middle">Kuantitas/
                                        Output</th>
                                    <th colspan="2" class="align-middle">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rencanas as $rencana)
                                    {{-- {{ dd($rencana->kegiatan_id) }} --}}

                                    <?php
                                    $kuantitas = \App\Models\Sasaran::where('user_id', $user->id)
                                        ->where('kegiatan_id', $rencana->kegiatan_id)
                                        ->select('target_kuantitas', $rencana->kuantitas)
                                        ->sum('target_kuantitas');
                                    $waktu = \App\Models\Sasaran::where('user_id', $user->id)
                                        ->where('kegiatan_id', $rencana->kegiatan_id)
                                        ->count();
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
                                        <td class="text-center">
                                            <form action="/pengajuan/rencana/{{ $rencana->kegiatan_id }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-warning text-white reset-rencana-confirm"
                                                    {{ $atribut == 'true' ? 'disabled' : '' }}><i class="fas fa-sync-alt"></i>
                                                    Reset
                                                    Rencana</button>
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
    </div>
@endsection
