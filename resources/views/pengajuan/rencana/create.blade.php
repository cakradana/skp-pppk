@extends('layouts.main')

@section('judul')
    {{ $title }}
@endsection

@section('isi')
    <div class="row">
        <div class="col">
            <a href="/pengajuan/rencana" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
            <div class="card card-primary card-outline">
                <div class="card-body p-0">
                    <div class="" style="padding: 20px 20px 20px;">
                        <form action="/pengajuan/rencana" method="POST" class="input_fields_wrap"
                            enctype="multipart/form-data" id="">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kegiatan</label>
                                <div class="col-sm-5">
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
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                        data-target="#tambah-kegiatan">Tambah
                                        Kegiatan</button>
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-1">
                                <label class="col-sm-3 col-form-label">Target</label>
                                <div class="col-sm-9">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kualitas</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" name="target_kualitas" value="100"
                                        min="0" max="100" required readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Biaya</label>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" placeholder="Biaya" min="0" class="form-control"
                                            name="target_biaya" value="">
                                    </div>
                                </div>
                                <span class="text-red pt-2 pl-3">*kosongi apabila tidak memerlukan biaya</span>
                            </div>
                            <div class="form-group row">
                                <label for="output" class="col-sm-3 col-form-label">Output</label>
                                <div class="col-sm-5">
                                    <select class="form-control select2 @error('output') is-invalid @enderror"
                                        name="output_id" id="output" data-placeholder="Pilih Output" style="width: 100%;"
                                        required>
                                        <option value="">-- Pilih Output --</option>
                                        @foreach ($outputs as $output)
                                            @if (old('output_id') == $output->id)
                                                <option value="{{ $output->id }}" selected>{{ $output->nama }}</option>
                                            @else
                                                <option value="{{ $output->id }}">{{ $output->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('output')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                        data-target="#tambah-output">Tambah
                                        Output</button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kuantitas / Bulan</label>
                                <div class="col-sm-2">
                                    <input type="number" min="1" placeholder="Kuantitas"
                                        class="form-control @error('kuantitas') is-invalid @enderror" id="kuantitas"
                                        name="target_kuantitas[]" value="{{ old('target_kuantitas[]') }}" required>
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
                                    <button type="button" class="add_field_button btn btn-outline-secondary">Tambah
                                        Fields</button>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
                </form>
            </div>
            {{-- Modal Tambah Output --}}
            <div class="modal fade" id="tambah-output" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content card-primary card-outline">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Output</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="" style="padding: 20px 20px 20px;">
                                <form action="/tambah-output" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label">Nama Output</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control " id="nama" name="nama"
                                                value="" required>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Modal Tambah kegiatan --}}
            <div class="modal fade" id="tambah-kegiatan" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content card-primary card-outline">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="" style="padding: 20px 20px 20px;">
                                <form action="/tambah-kegiatan" method="POST">
                                    @csrf
                                    <input type="hidden" name="jabatan_id" value="{{ $user->jabatan->id }}">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label">Nama Kegiatan</label>
                                        <div class="col-sm-8">
                                            <input required type="text" class="form-control " id="nama"
                                                name="nama">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="ak" class="col-sm-4 col-form-label">Angka Kredit</label>
                                        <div class="col-sm-4">
                                            <input required type="number" step="0.01" min="0" max="10"
                                                class="form-control" id="ak" name="ak">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
