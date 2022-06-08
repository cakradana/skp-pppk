@extends('layouts.main')

@section('judul')
    Tambah Kegiatan
@endsection

@section('isi')
<div class="row">
    <div class="col">
        <a href="/skp/rencana" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title mt-2">Tambah Kegiatan</h3>
            </div>
            <div class="card-body p-0">
                <div class="container" style="padding: 20px 20px 20px;">
                    <form action="/skp/rencana/bulan" method="POST" class="mb-5" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row d-none">
                            <label for="waktu" class="col-sm-3 col-form-label">waktu</label>
                            <div class="col-sm-1">
                                <input type="number" min="1" class="form-control @error('waktu') is-invalid @enderror" id="waktu" name="waktu" value="{{ $data['waktu'] }}">
                                <div class="invalid-feedback">
                                    @error('waktu')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @for ($i = 0; $i < $data['waktu']; $i++)
                        <div class="form-group row">
                            <label for="bulan" class="col-sm-3 col-form-label">Bulan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('bulan_id') is-invalid @enderror" name="bulan[{{ $i }}]">
                                    <option value="">-- Pilih bulan --</option>
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
                                <div class="invalid-feedback">
                                    @error('bulan_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @endfor
                        <div class="form-group row d-none">
                            <label for="user_id" class="col-sm-3 col-form-label">user_id</label>
                            <div class="col-sm-1">
                                <input type="number" min="1" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" value="{{ $data['user_id'] }}">
                                <div class="invalid-feedback">
                                    @error('user_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label for="kegiatan_id" class="col-sm-3 col-form-label">kegiatan_id</label>
                            <div class="col-sm-1">
                                <input type="number" min="1" class="form-control @error('kegiatan_id') is-invalid @enderror" id="kegiatan_id" name="kegiatan_id" value="{{ $data['kegiatan_id'] }}">
                                <div class="invalid-feedback">
                                    @error('kegiatan_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label for="kuantitas" class="col-sm-3 col-form-label">Kuantitas</label>
                            <div class="col-sm-1">
                                <input type="number" min="1" class="form-control @error('kuantitas') is-invalid @enderror" id="kuantitas" name="kuantitas" value="{{ $data['kuantitas'] }}">
                                <div class="invalid-feedback">
                                    @error('kuantitas')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label for="output" class="col-sm-3 col-form-label">output</label>
                            <div class="col-sm-5">
                                <input type="text" min="1" class="form-control @error('output') is-invalid @enderror" id="output" name="output" value="{{ $data['output'] }}">
                                <div class="invalid-feedback">
                                    @error('output')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label for="penilai_id" class="col-sm-3 col-form-label">penilai_id</label>
                            <div class="col-sm-1">
                                <input type="number" min="1" class="form-control @error('penilai_id') is-invalid @enderror" id="penilai_id" name="penilai_id" value="{{ $data['penilai_id'] }}">
                                <div class="invalid-feedback">
                                    @error('penilai_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label for="status" class="col-sm-3 col-form-label">status</label>
                            <div class="col-sm-5">
                                <input type="text" min="1" class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="{{ $data['status'] }}">
                                <div class="invalid-feedback">
                                    @error('status')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        

                        






                        {{-- <input type="hidden" value="{{ $data['kegiatan_id'] }}" name="kegiatan_id">
                        <input type="hidden" value="{{ $data['kuantitas'] }}" name="kuantitas">
                        <input type="hidden" value="{{ $data['output'] }}" name="output">
                        <input type="hidden" value="{{ $data['user_id'] }}" name="user_id">
                        <input type="hidden" value="{{ $data['penilai_id'] }}" name="penilai_id">
                        <input type="hidden" value="{{ $data['status'] }}" name="status">
                        <input type="hidden" value="{{ $data['waktu'] }}" name="waktu">  --}}
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection