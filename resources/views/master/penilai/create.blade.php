@extends('layouts.main')

@section('judul')
    {{ $title }}
@endsection

@section('isi')
    <div class="row">
        <div class="col">
            <a href="/master/penilai" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
            <div class="card card-primary card-outline">
                {{-- <div class="card-header">
                <h3 class="card-title mt-2">Tambah Penilai</h3>
            </div> --}}
                <div class="card-body p-0">
                    <div class="" style="padding: 20px 20px 20px;">
                        <form action="/master/penilai" method="POST" class="mb-5" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row d-none">
                                <label for="role" class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('role') is-invalid @enderror"
                                        name="role" value="Pejabat Penilai">
                                    {{-- <select class="form-control @error('role') is-invalid @enderror" name="role">
                                    @error('nip')
                                    <option value="{{ old('role') }}">{{ old('role') }}</option>
                                    @enderror
                                    @error('name')
                                    <option value="{{ old('role') }}">{{ old('role') }}</option>
                                    @enderror
                                    @error('jabatan_id')
                                    <option value="{{ old('role') }}">{{ old('role') }}</option>
                                    @enderror
                                    @error('pangkat_id')
                                    <option value="{{ old('role') }}">{{ old('role') }}</option>
                                    @enderror
                                    <option value="">-- Pilih Role --</option>
                                    <option value="Pegawai yang Dinilai">Pegawai yang Dinilai</option>
                                    <option value="Pejabat Penilai">Pejabat Penilai</option>
                                    <option value="Atasan Pejabat Penilai">Atasan Pejabat Penilai</option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('role')
                                    {{ $message }}
                                    @enderror
                                </div> --}}
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                            <label for="penilai" class="col-sm-3 col-form-label">Pejabat Penilai</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('penilai_id') is-invalid @enderror"
                                    name="penilai_id">
                                    <option value="">-- Pilih Pejabat Penilai --</option>
                                    @foreach ($penilais as $penilai)
                                    @if (old('penilai_id') == $penilai->id)
                                    <option value="{{ $penilai->id }}" selected>{{ $penilai->name }}</option>
                                    @else
                                    <option value="{{ $penilai->id }}">{{ $penilai->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('penilai_id')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div> --}}
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}">
                                    <div class="invalid-feedback">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control @error('nip') is-invalid @enderror"
                                        id="nip" name="nip" value="{{ old('nip') }}">
                                    <div class="invalid-feedback">
                                        @error('nip')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pangkat" class="col-sm-3 col-form-label">Pangkat, Gol. Ruang</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 @error('pangkat_id') is-invalid @enderror"
                                        name="pangkat_id" data-placeholder="Pilih Pangkat">
                                        <option value="">-- Pilih Pangkat --</option>
                                        @foreach ($pangkats as $pangkat)
                                            @if (old('pangkat_id') == $pangkat->id)
                                                <option value="{{ $pangkat->id }}" selected>{{ $pangkat->nama }}</option>
                                            @else
                                                <option value="{{ $pangkat->id }}">{{ $pangkat->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('pangkat_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
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
                            <div class="form-group row d-none">
                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" value="12345">
                                    <div class="invalid-feedback">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row d-none">
                                <label for="atasan" class="col-sm-3 col-form-label">Atasan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('atasan_id') is-invalid @enderror"
                                        id="atasan_id" name="atasan_id" value="{{ $atasan->id }}">
                                    <div class="invalid-feedback">
                                        @error('atasan_id')
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
