@extends('layouts.main')

@section('judul')
    {{ $title }}
@endsection

@section('isi')
    <div class="row">
        <div class="col">
            <form method="POST" action="/pengajuan/realisasi">
                @csrf
                {{-- <input type="text" value="Januari" name="bulan"> --}}
                <div class="form-inline">
                    <a href="/pengajuan/realisasi" class="btn btn-secondary mb-3 d-print-none"><i
                            class="fas fa-arrow-left"></i>
                        Kembali</a>
                    <div class="input-group ml-1 mb-3 d-print-none" style="width: 25%">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Pilih Bulan:</div>
                        </div>
                        <select class="form-control" name="bulan">
                            <option hidden selected value="{{ $selected }}">{{ $selected }}</option>
                            <option value="Semua Bulan">Semua Bulan</option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary ml-1 mb-3 d-print-none"><i
                            class="fas fa-search d-print-none"></i>
                        Proses</button>
            </form>
            {{-- <a href="#cetak" onclick="window.print()" class="btn btn-success mb-3 ml-auto d-print-none"><i
                class="fas fa-file-pdf"></i> Cetak
            Realisasi</a> --}}
        </div>
        <div class="card card-primary card-outline">
            <div class="card-body table-responsive p-0">
                <div class="" style="padding: 20px 20px 20px;">
                    <table id="" class="table table-striped table-bordered small"
                        style="width:100%; font-size:70%">
                        <thead class="text-center">
                            <tr>
                                <th rowspan="2" class="align-middle p-1">No</th>
                                <th rowspan="2" class="align-middle text-left">Kegiatan Tugas Jabatan</th>
                                <th colspan="2" class="align-middle">Target</th>
                                <th colspan="2" class="align-middle">Realisasi</th>
                                <th rowspan="2" class="align-middle">Bulan</th>
                                <th rowspan="2" class="align-middle">Pengajuan Nilai</th>
                                <th rowspan="2" class="align-middle">Nilai Atasan</th>
                                <th rowspan="2" class="align-middle d-print-none">Aksi</th>
                            </tr>
                            <tr>
                                <th colspan="2" class="align-middle">Kuantitas/
                                    Output
                                </th>
                                <th colspan="2" class="align-middle">Kuantitas/
                                    Output
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rencanas as $rencana)
                                <tr>
                                    <td class="text-center p-3">{{ $loop->iteration }}</td>
                                    <td>{{ $rencana->kegiatan->nama }}</td>
                                    <td class="text-center p-3">{{ $rencana->target_kuantitas }}</td>
                                    <td>{{ $rencana->output->nama }}</td>
                                    <td class="text-center p-3">
                                        {{ $rencana->realisasi_kuantitas ? $rencana->realisasi_kuantitas : '-' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $rencana->output->nama }}
                                    </td>
                                    <td class="text-center">
                                        {{ $rencana->bulan }}
                                    </td>
                                    <td class="text-center p-3">
                                        {{ $rencana->pengajuan_nilai ? $rencana->pengajuan_nilai : '-' }}</td>
                                    <td class="text-center p-3">
                                        {{ $rencana->realisasi_kualitas ? $rencana->realisasi_kualitas : '-' }}
                                    </td>
                                    <td class="text-center" style="">
                                        <div class="d-inline-flex" style="inline-size: max-content; gap: 3px;">
                                            @if ($rencana->realisasi_kuantitas == null)
                                                <?php
                                                $disabled = '';
                                                $enable = 'disabled';
                                                ?>
                                            @elseif ($rencana->realisasi_kualitas !== null)
                                                <?php
                                                $disabled = 'disabled';
                                                $enable = 'disabled';
                                                ?>
                                            @else
                                                <?php
                                                $disabled = 'disabled';
                                                $enable = '';
                                                ?>
                                            @endif
                                            <button {{ $disabled }} class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#isi-realisasi-{{ $rencana->id }}"><i
                                                    class="fas fa-plus"></i> Isi
                                                Realisasi</button>
                                            <form action="/pengajuan/realisasi/reset/{{ $rencana->id }}" method="POST"
                                                enctype="multipart/form-data" class="">
                                                @method('put')
                                                @csrf
                                                <button {{ $enable }}
                                                    class="text-white btn btn-sm btn-warning text-white reset-realisasi-confirm"><i
                                                        class="fas fa-sync-alt"></i> Reset Realisasi
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="isi-realisasi-{{ $rencana->id }}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content card-primary card-outline">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Isi Realisasi Bulan {{ $rencana->bulan }}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/pengajuan/realisasi/{{ $rencana->id }}" method="POST"
                                                    enctype="multipart/form-data" class="form-inline">
                                                    @method('put')
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Kegiatan Tugas
                                                            Jabatan</label>
                                                        <div class="col-sm-9">
                                                            <textarea rows="3" type="text" class="form-control" disabled style="resize: none">{{ $rencana->kegiatan->nama }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Target</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group mb-0">
                                                                <input type="number" class="form-control" disabled
                                                                    value="{{ $rencana->target_kuantitas }}"
                                                                    id="samakan-kuantitas{{ $rencana->id }}">
                                                                <div class="input-group-append">
                                                                    <span
                                                                        class="input-group-text">{{ $rencana->output->nama }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if ($rencana->target_biaya !== null)
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Target Biaya</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group mb-0">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp</span>
                                                                    </div>
                                                                    <input type="number" class="form-control" disabled
                                                                        value="{{ $rencana->target_biaya }}"
                                                                        id="samakan-biaya{{ $rencana->id }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    {{-- Samakan realisasi dengan target --}}
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label"></label>
                                                        <div class="col-sm-9">
                                                            <a href="#"
                                                                onclick="myFunction('{{ $rencana->id }}')">Samakan
                                                                realisasi dengan
                                                                target</a>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Realisasi</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group mb-1">
                                                                <input type="number" class="form-control" min="0"
                                                                    name="realisasi_kuantitas"
                                                                    max="{{ $rencana->target_kuantitas }}" value=""
                                                                    id="disamakan-realisasi{{ $rencana->id }}" required>
                                                                <div class="input-group-append">
                                                                    <span
                                                                        class="input-group-text">{{ $rencana->output->nama }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if ($rencana->target_biaya !== null)
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Realisasi Biaya</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group mb-1">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp</span>
                                                                    </div>
                                                                    <input type="number" class="form-control"
                                                                        min="0" name="realisasi_biaya"
                                                                        max="" value=""
                                                                        id="disamakan-biaya{{ $rencana->id }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Pengajuan Nilai</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control"
                                                                name="pengajuan_nilai" min="0" max="100"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label"></label>
                                                        <div class="col-sm-9">
                                                            <a class="text-info" href="" data-toggle="modal"
                                                                data-target="#dasar-pengajuan-nilai"><i
                                                                    class="fas fa-eye"></i>
                                                                Lihat Dasar
                                                                Pengajuan Nilai</a>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fas fa-save"></i>
                                                    Simpan</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                </div>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="dasar-pengajuan-nilai">
        <div class="modal-dialog modal-md">
            <div class="modal-content card-info card-outline">
                <div class="modal-header">
                    <h4 class="modal-title">Dasar Pengajuan Nilai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped small">
                        <thead class="text-center">
                            <tr>
                                <th>Kriteria Nilai</th>
                                <th class="align-middle">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">91 - 100</td>
                                <td>Hasil kerja sempurna, tidak ada kesalahan, tidak ada revisi, dan pelayanan di atas
                                    standar yang ditentukan, dll.</td>
                            </tr>
                            <tr>
                                <td class="text-center">76 - 90</td>
                                <td>Hasil kerja mempunyai 1 atau 2 kesalahan kecil, tidak ada kesalahan besar, revisi,
                                    dan
                                    pelayanan sesuai standar yang ditentukan, dll.</td>
                            </tr>
                            <tr>
                                <td class="text-center">61 - 75</td>
                                <td>Hasil kerja mempunyai 3 atau 4 kesalahan kecil, tidak ada kesalahan besar, revisi,
                                    dan
                                    pelayanan cukup memenuhi standar yang ditentukan, dll.</td>
                            </tr>
                            <tr>
                                <td class="text-center">51 - 60</td>
                                <td>Hasil kerja mempunyai 5 kesalahan kecil, ada kesalahan besar, revisi, dan pelayanan
                                    tidak cukup memenuhi standar yang ditentukan, dll.</td>
                            </tr>
                            <tr>
                                <td class="text-center">&lt; 50</td>
                                <td>Hasil kerja mempunyai lebih dari 5 kesalahan kecil, ada kesalahan besar, kurang
                                    memuaskan, revisi, dan pelayanan di bawah standar yang ditentukan, dll.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@push('script')
    <script>
        function myFunction(p1) {
            var p = $('#samakan-kuantitas' + p1).val();
            $('#disamakan-realisasi' + p1).val(p)

            var p = $('#samakan-biaya' + p1).val();
            $('#disamakan-biaya' + p1).val(p)
        }
    </script>
@endpush
