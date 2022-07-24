@extends('layouts.main')

@section('judul')
{{ $title }}
@endsection

@section('isi')
<div class="row">
    <div class="col">
        <a href="/master/pangkat" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card card-warning card-outline">
            {{-- <div class="card-header">
                <h3 class="card-title mt-2">Edit Pangkat</h3>
            </div> --}}
            <div class="card-body p-0">
                <div class="" style="padding: 20px 20px 20px;">
                    <form action="/master/pangkat/{{ $pangkat->id }}" method="POST" class="mb-5"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Pangkat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" value="{{ $pangkat->nama }}">
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
                <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection