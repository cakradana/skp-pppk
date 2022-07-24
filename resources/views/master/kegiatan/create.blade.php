@extends('layouts.main')

@section('judul')
{{ $title }}
@endsection

@section('isi')
<div class="row">
    <div class="col">
        <a href="/master/kegiatan" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card card-primary card-outline">
            {{-- <div class="card-header">
                <h3 class="card-title mt-2">Tambah Kegiatan Tugas Jabatan</h3>
            </div> --}}
            <div class="card-body p-0">
                <div class="" style="padding: 20px 20px 20px;">
                    <form action="/master/kegiatan" method="POST" class="mb-5" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 @error('jabatan_id') is-invalid @enderror"
                                    name="jabatan_id" data-placeholder="Pilih Jabatan">
                                    <option value="">-- Pilih Jabatan --</option>
                                    @foreach ($jabatans as $jabatan)
                                    @if (old('jabatan_id') == $jabatan->id)
                                    <option value="{{ $jabatan->id }}" selected>{{ $jabatan->nama }}</option>
                                    @else
                                    <option value="{{ $jabatan->id }}">{{ $jabatan->nama }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('jabatan_id')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama Kegiatan Tugas Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" value="{{ old('nama') }}">
                                <div class="invalid-feedback">
                                    @error('nama')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ak" class="col-sm-3 col-form-label">Angka Kredit</label>
                            <div class="col-sm-2">
                                <input type="number" step="0.01" min="0" max="10"
                                    class="form-control @error('ak') is-invalid @enderror" id="ak" name="ak"
                                    value="{{ old('ak') }}">
                                <div class="invalid-feedback">
                                    @error('ak')
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