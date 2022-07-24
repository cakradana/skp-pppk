@extends('layouts.main')

@section('judul')
{{ $title }}
@endsection

@section('isi')

<div class="row">
    <div class="col">
        <form method="POST" action="/pengajuan/realisasi/search/">
            @csrf
            {{-- <input type="text" value="Januari" name="bulan"> --}}
            <div class="form-inline">
                <a href="/pengajuan/realisasi" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
                <div class="input-group ml-1 mb-3" style="width: 25%">
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
                <button type="submit" class="btn btn-primary ml-1 mb-3"><i class="fas fa-search"></i> Proses</a>
        </form>
        <button type="button" class="btn btn-success ml-auto p-2 mb-3" data-toggle="modal"
            data-target="#dasar-pengajuan-nilai"><i class="fas fa-eye"></i> Lihat Dasar Pengajuan Nilai</button>
    </div>
    <div class="card card-primary card-outline">
        <div class="card-body table-responsive p-0">
            <div class="" style="padding: 20px 20px 20px;">
                <table id="" class="table table-striped table-bordered small" style="width:100%">
                    <thead class="text-center">
                        <tr>
                            <th rowspan="2" class="align-middle p-1">No</th>
                            <th rowspan="2" class="align-middle text-left">Kegiatan Tugas Jabatan</th>
                            <th rowspan="2" class="align-middle">AK</th>
                            <th colspan="2" class="">Target</th>
                            <th colspan="2" class="">Realisasi</th>
                            <th rowspan="2" class="align-middle">Bulan</th>
                            <th rowspan="2" class="align-middle">Pengajuan Nilai</th>
                            <th rowspan="2" class="align-middle">Nilai Atasan</th>
                            <th rowspan="2" class="col-1 align-middle">Aksi</th>
                        </tr>
                        <tr>
                            <th class="align-middle p-3">Kuantitas</th>
                            <th class="">Output</th>
                            <th class="align-middle">Kuantitas</th>
                            <th class="">Output</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rencanas as $rencana)
                        <tr>
                            <td class="text-center p-3">{{ $loop->iteration }}</td>
                            <td>{{ $rencana->kegiatan->nama }}</td>
                            <td>{{ $rencana->kegiatan->ak * $rencana->kuantitas }}</td>
                            <td class="text-center p-3">{{ $rencana->kuantitas }}</td>
                            <td>{{ $rencana->output }}</td>
                            <td class="text-center p-3">{{ $rencana->realisasi }}</td>
                            <td>
                                {{ $rencana->output }}
                                {{-- <a href="/persetujuan/rencana-pegawai/{{ $pengajuan->user->id }}"
                                    class="btn btn-sm btn-success"><i class="fas fa-search"></i></a>
                                <a href="/persetujuan/rencana-pegawai/setuju/{{ $pengajuan->user->id }}"
                                    class="btn btn-sm {{ $pengajuan->status == 'disetujui' ? 'btn-secondary disabled' : 'btn-primary' }}"><i
                                        class="fas fa-check"></i></a> --}}
                            </td>
                            <td>{{ $rencana->bulan }}</td>
                            <td class="text-center p-3">{{ $rencana->pengajuan_nilai }}</td>
                            <td class="text-center p-3">{{ $rencana->nilai_atasan }}</td>
                            <td>
                                @if ($rencana->realisasi == null)
                                <?php $disabled = "" ?>
                                @else
                                <?php $disabled = "disabled" ?>
                                @endif
                                <button {{ $disabled }} class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#isi-realisasi-{{ $rencana->id }}"><i class="fas fa-plus"></i></button>
                            </td>
                        </tr>
                        <div class="modal fade" id="isi-realisasi-{{ $rencana->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content card-primary card-outline">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Isi Realisasi</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/pengajuan/realisasi/{{ $rencana->id }}" method="POST"
                                            enctype="multipart/form-data" class="form-inline">
                                            @method('put')
                                            @csrf
                                            {{-- <input type="hidden" name="kegiatan_id"
                                                value="{{ $rencana->kegiatan_id }}">
                                            <input type="hidden" name="rencana_id" value="{{ $rencana->id }}"> --}}
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Kegiatan Tugas Jabatan</label>
                                                <div class="col-sm-9">
                                                    <textarea rows="3" type="text" class="form-control" disabled
                                                        style="resize: none">{{
                                                        $rencana->kegiatan->nama }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Target</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group mb-0">
                                                        <input type="number" class="form-control" disabled
                                                            value="{{ $rencana->kuantitas }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">{{ $rencana->output }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <a href="#">Samakan realisasi dengan target</a>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Realisasi</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group mb-1">
                                                        <input type="number" class="form-control" min="0"
                                                            name="realisasi" max="{{ $rencana->kuantitas }}"
                                                            value="blm tau" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">{{ $rencana->output }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Pengajuan Nilai</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" name="pengajuan_nilai"
                                                        min="0" max="100" required>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                            Simpan</button>
                                    </div>
                                    </form>
                                    {{-- <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Nama Kegiatan Tugas
                                            Jabatan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                id="nama" name="nama" value="{{ old('nama') }}">
                                            <div class="invalid-feedback">
                                                @error('nama')
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div> --}}
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
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
                            <td>Hasil kerja mempunyai 1 atau 2 kesalahan kecil, tidak ada kesalahan besar, revisi, dan
                                pelayanan sesuai standar yang ditentukan, dll.</td>
                        </tr>
                        <tr>
                            <td class="text-center">61 - 75</td>
                            <td>Hasil kerja mempunyai 3 atau 4 kesalahan kecil, tidak ada kesalahan besar, revisi, dan
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