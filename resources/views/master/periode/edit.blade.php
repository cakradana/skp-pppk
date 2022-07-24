@extends('layouts.main')
@section('judul')
{{ $title }}
@endsection
@section('isi')
<div class="row">
    <div class="col">
        <a href="/master/periode" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card card-warning card-outline">
            {{-- <div class="card-header">
                <h3 class="card-title mt-2">Edit Periode</h3>
            </div> --}}
            <div class="card-body p-0">
                <div class="" style="padding: 20px 20px 20px;">
                    <form action="/master/periode/{{ $periode->id }}" method="POST" class="mb-5"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Periode</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" value="{{ $periode->nama }}">
                                <div class="invalid-feedback">
                                    @error('nama')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="awal" class="col-sm-3 col-form-label">Awal Periode</label>
                            <div class="col-sm-3">
                                <div class="input-group date" id="datepicker">
                                    <input type="text" class="form-control @error('awal') is-invalid @enderror"
                                        id="awal" name="awal" value="{{ $periode->awal }}">
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-white">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </span>
                                    <div class="invalid-feedback">
                                        @error('awal')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="akhir" class="col-sm-3 col-form-label">Akhir Periode</label>
                            <div class="col-sm-3">
                                <div class="input-group date" id="datepicker2">
                                    <input type="text" class="form-control @error('akhir') is-invalid @enderror"
                                        id="akhir" name="akhir" value="{{ $periode->akhir }}">
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-white">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </span>
                                    <div class="invalid-feedback">
                                        @error('akhir')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection