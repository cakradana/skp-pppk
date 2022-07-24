@extends('layouts.main')

@section('judul')
{{ $title }}
@endsection

@section('isi')
<div class="row">
    <div class="col">
        <a href="/pengajuan/rencana" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card card-primary card-outline">
            {{-- <div class="card-header">
                <h3 class="card-title mt-2">Tambah Kegiatan</h3>
            </div> --}}
            <div class="card-body p-0">
                <div class="" style="padding: 20px 20px 20px;">
                    <form action="/pengajuan/rencana" method="POST" class="mb-5 input_fields_wrap"
                        enctype="multipart/form-data" id="">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kegiatan</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 @error('kegiatan_id') is-invalid @enderror"
                                    name="kegiatan_id" data-placeholder="Pilih Kegiatan" style="width: 100%;" required>
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
                            <label for="output" class="col-sm-3 col-form-label">Output</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 @error('output') is-invalid @enderror" name="output"
                                    id="output" data-placeholder="Pilih Output" style="width: 100%;" required>
                                    <option value="">-- Pilih Output --</option>
                                    <option value="Dokumen" {{ old('output')=='Dokumen' ? 'selected' : '' }}>
                                        Dokumen
                                    </option>
                                    <option value="Laporan" {{ old('output')=='Laporan' ? 'selected' : '' }}>
                                        Item Laporan
                                    </option>
                                    <option value="Berkas" {{ old('output')=='Berkas' ? 'selected' : '' }}>
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
                            <label for="kuantitas" class="col-sm-3 col-form-label">Kuantitas / Bulan</label>
                            <div class="col-sm-2">
                                <input type="number" min="1"
                                    class="form-control @error('kuantitas') is-invalid @enderror" id="kuantitas"
                                    name="kuantitas[]" value="{{ old('kuantitas[]') }}" required>
                                <div class="invalid-feedback">
                                    @error('kuantitas')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control @error('bulan') is-invalid @enderror" name="bulan[]"
                                    data-placeholder="Pilih Bulan" value="{{ old('bulan[]') }}" style="width: 100%;"
                                    required>
                                    <option value="" hidden>Pilih Bulan</option>
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
                            <div class="col-sm-2">
                                <button type="button" class="add_field_button btn btn-outline-secondary">Add More
                                    Fields</button>
                            </div>
                        </div>





                        {{-- <div class="input-group mb-3"><input placeholder="Enter Price" type="text" name="mytext[]"
                                class="form-control">
                            <div class="input-group-append"><button class="btn btn-outline-danger remove_field"
                                    type="button">Remove</button></div>
                        </div> --}}



                        {{-- <div class="form-group row">
                            <label for="bulan" class="col-sm-3 col-form-label">Bulan</label>
                            <div class="col-sm-9">
                                <select class="select2bulan form-control @error('bulan') is-invalid @enderror"
                                    name="bulan[]" multiple="multiple" data-placeholder="-- Pilih Bulan --"
                                    value="{{ old('bulan[]') }}" style="width: 100%;">
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
                        </div> --}}
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