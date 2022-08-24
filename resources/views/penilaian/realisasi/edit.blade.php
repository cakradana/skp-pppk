@extends('layouts.main')

@section('judul')
    {{ $title }}
@endsection

@section('isi')
    <div class="row">
        <div class="col">
            <form method="POST" action="/penilaian/realisasi-pegawai/{{ $pegawai->id }}/edit">
                @csrf
                {{-- <input type="text" value="Januari" name="bulan"> --}}
                <div class="form-inline">
                    <a href="/penilaian/realisasi-pegawai" class="btn btn-secondary mb-3 d-print-none"><i
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
                            @foreach ($pengajuans as $pengajuan)
                                <tr>
                                    <td class="text-center p-3">{{ $loop->iteration }}</td>
                                    <td>{{ $pengajuan->kegiatan->nama }}</td>
                                    <td class="text-center p-3">{{ $pengajuan->target_kuantitas }}</td>
                                    <td>{{ $pengajuan->output->nama }}</td>
                                    <td class="text-center p-3">
                                        {{ $pengajuan->realisasi_kuantitas ? $pengajuan->realisasi_kuantitas : '-' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $pengajuan->output->nama }}
                                    </td>
                                    <td class="text-center">
                                        {{ $pengajuan->bulan }}
                                    </td>
                                    <td class="text-center p-3">
                                        {{ $pengajuan->pengajuan_nilai ? $pengajuan->pengajuan_nilai : '-' }}</td>
                                    <td class="text-center p-3">
                                        {{ $pengajuan->realisasi_kualitas ? $pengajuan->realisasi_kualitas : '-' }}
                                    </td>
                                    <td class="text-center" style="">
                                        <div class="d-inline-flex" style="inline-size: max-content; gap: 3px;">
                                            @if ($pengajuan->realisasi_kualitas !== null && $pengajuan->realisasi_kuantitas !== null)
                                                <?php
                                                $tambah = 'disabled';
                                                $reset = '';
                                                ?>
                                            @elseif ($pengajuan->realisasi_kualitas == null && $pengajuan->realisasi_kuantitas !== null)
                                                <?php
                                                $tambah = '';
                                                $reset = 'disabled';
                                                ?>
                                            @elseif ($pengajuan->realisasi_kualitas == null && $pengajuan->realisasi_kuantitas == null)
                                                <?php
                                                $tambah = 'disabled';
                                                $reset = 'disabled';
                                                ?>
                                            @endif
                                            <button {{ $tambah }} class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#isi-realisasi-{{ $pengajuan->id }}"><i
                                                    class="fas fa-plus"></i> Isi Penilaian</button>
                                            <form
                                                action="/penilaian/realisasi-pegawai/{{ $pegawai->id }}/reset/{{ $pengajuan->id }}"
                                                method="POST" enctype="multipart/form-data" class="">
                                                @method('put')
                                                @csrf
                                                <button {{ $reset }}
                                                    class="text-white btn btn-sm btn-warning text-white reset-nilai-realisasi-confirm"><i
                                                        class="fas fa-sync-alt"></i> Reset Penilaian
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>




                                <div class="modal fade" id="isi-realisasi-{{ $pengajuan->id }}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content card-primary card-outline">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Isi Penilaian Realisasi Bulan
                                                    {{ $pengajuan->bulan }}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="/penilaian/realisasi-pegawai/{{ $pegawai->id }}/nilai/{{ $pengajuan->id }}"
                                                    method="POST" enctype="multipart/form-data" class="form-inline">
                                                    @method('put')
                                                    @csrf
                                                    {{-- <input type="hidden" name="bulan" value="{{ $selected }}"> --}}
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Kegiatan Tugas
                                                            Jabatan</label>
                                                        <div class="col-sm-9">
                                                            <textarea rows="3" type="text" class="form-control" disabled style="resize: none">{{ $pengajuan->kegiatan->nama }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Target</label>
                                                        <div class="col-sm-3">
                                                            <div class="input-group mb-0">
                                                                <input type="number" class="form-control" disabled
                                                                    value="{{ $pengajuan->target_kuantitas }}">
                                                                <div class="input-group-append">
                                                                    <span
                                                                        class="input-group-text">{{ $pengajuan->output->nama }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <label class="col-sm-3 col-form-label">Realisasi</label>
                                                        <div class="col-sm-3">
                                                            <div class="input-group mb-1">
                                                                <input type="number" class="form-control" min="0"
                                                                    name="realisasi_kuantitas"
                                                                    value="{{ $pengajuan->target_kuantitas }}" disabled>
                                                                <div class="input-group-append">
                                                                    <span
                                                                        class="input-group-text">{{ $pengajuan->output->nama }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if ($pengajuan->target_biaya !== null)
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">Target Biaya</label>
                                                            <div class="col-sm-3">
                                                                <div class="input-group mb-0">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp</span>
                                                                    </div>
                                                                    <input type="number" class="form-control" disabled
                                                                        value="{{ $pengajuan->target_biaya }}">
                                                                </div>
                                                            </div>
                                                            <label class="col-sm-3 col-form-label">Realisasi Biaya</label>
                                                            <div class="col-sm-3">
                                                                <div class="input-group mb-1">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Rp</span>
                                                                    </div>
                                                                    <input type="number" class="form-control"
                                                                        min="0" name="realisasi_biaya"
                                                                        max=""
                                                                        value="{{ $pengajuan->realisasi_biaya }}"
                                                                        disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Pengajuan Nilai</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control"
                                                                name="pengajuan_nilai"
                                                                value="{{ $pengajuan->pengajuan_nilai }}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Nilai Realisasi</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control"
                                                                name="realisasi_kualitas" required>
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
@endsection
