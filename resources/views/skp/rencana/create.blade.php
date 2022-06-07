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
                    <form action="/skp/rencana" method="POST" class="mb-5" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="kegiatan" class="col-sm-3 col-form-label">Kegiatan</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('kegiatan_id') is-invalid @enderror" name="kegiatan_id">
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
                            <div class="col-sm-1">
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
                                <select class="form-control @error('output') is-invalid @enderror" name="output" id="output" value="{{ old('output') }}">
                                    <option value="">-- Pilih Output --</option>
                                    <option value="Dokumen">Dokumen</option>
                                    <option value="Laporan">Laporan</option>
                                    <option value="Berkas">Berkas</option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('output')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="waktu" class="col-sm-3 col-form-label">Waktu (Bulan)</label>
                            <div class="col-sm-1">
                                <input type="number" min="1" max="12" class="form-control @error('waktu') is-invalid @enderror" id="waktu" name="waktu" value="{{ old('waktu') }}">
                                <div class="invalid-feedback">
                                    @error('waktu')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama Kegiatan Tugas Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                                <div class="invalid-feedback">
                                    @error('nama')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Berikutnya</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection