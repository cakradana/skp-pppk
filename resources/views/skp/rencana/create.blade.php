@extends('layouts.main')

@section('judul')
    {{ $title }}
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
                    <form action="/skp/rencana" method="POST" class="mb-5" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="kegiatan" class="col-sm-3 col-form-label">Kegiatan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('kegiatan_id') is-invalid @enderror" name="kegiatan_id" data-placeholder="Pilih Kegiatan">
                                    <option value="">-- Pilih Kegiatan --</option>
                                    @foreach ($kegiatans as $kegiatan)
                                    @if (old('kegiatan_id') == $kegiatan->id)
                                        <option value="{{ $kegiatan->id }}" selected>{{ $kegiatan->nama }}</option>
                                    @else
                                        <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('kegiatan_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kuantitas" class="col-sm-3 col-form-label">Kuantitas</label>
                            <div class="col-sm-2">
                                <input type="number" min="1" class="form-control @error('kuantitas') is-invalid @enderror" id="kuantitas" name="kuantitas" value="{{ old('kuantitas') }}">
                                <div class="invalid-feedback">
                                    @error('kuantitas')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="output" class="col-sm-3 col-form-label">Output</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('output') is-invalid @enderror" name="output" id="output">
                                    <option value="">-- Pilih Output --</option>
                                    <option value="Dokumen"  {{ old('output') == 'Dokumen' ? 'selected' : '' }}>
                                        Dokumen
                                    </option>
                                    <option value="Laporan" {{ old('output') == 'Laporan' ? 'selected' : '' }}>
                                        Item Laporan
                                    </option>
                                    <option value="Berkas" {{ old('output') == 'Berkas' ? 'selected' : '' }}>
                                        Item Berkas
                                    </option>                                    
                                </select>
                                <div class="invalid-feedback">
                                    @error('output')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bulan" class="col-sm-3 col-form-label">Bulan</label>
                            <div class="col-sm-9">
                                <select class="select2bulan form-control @error('bulan') is-invalid @enderror" name="bulan[]" multiple="multiple" data-placeholder="-- Pilih Bulan --" value="{{ old('bulan[]') }}" style="width: 100%;">
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
                                    @error('bulan')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
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