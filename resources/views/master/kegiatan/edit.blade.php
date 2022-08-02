@extends('layouts.main')

@section('judul')
{{ $title }}
@endsection

@section('isi')
<div class="row">
    <div class="col">
        <a href="/master/kegiatan" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card card-warning card-outline">
            {{-- <div class="card-header">
                <h3 class="card-title mt-2">Edit Kegiatan Tugas Jabatan</h3>
            </div> --}}
            <div class="card-body p-0">
                <div class="" style="padding: 20px 20px 20px;">
                    <form action="/master/kegiatan/{{ $kegiatan->id }}" method="POST" class="mb-5"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 @error('jabatan_id') is-invalid @enderror"
                                    name="jabatan_id">
                                    @foreach ($jabatans as $jabatan)
                                    @if (old('jabatan_id', $kegiatan->jabatan_id) == $jabatan->id)
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
                            <label for="nama" class="col-sm-3 col-form-label">Nama Kegiatan Tugas Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" value="{{ $kegiatan->nama }}">
                                <div class="invalid-feedback">
                                    @error('nama')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-warning text-white"><i class="fas fa-save"></i> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection