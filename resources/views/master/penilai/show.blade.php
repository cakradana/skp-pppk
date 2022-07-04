@extends('layouts.main')

@section('judul')
    {{ $title }}: {{ $penilai->name }}
@endsection

@section('isi')
<div class="row">
    <div class="col">
        <a href="/master/penilai" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card card-secondary card-outline">
            <div class="card-header">
                <h3 class="card-title mt-2">Detail Penilai</h3>
            </div>
            <div class="card-body p-0">
                <div class="container" style="padding: 20px 20px 20px;">
                    <form>
                        <div class="form-group row d-none">
                            <label for="role" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="role" name="role" value="{{ $penilai->role }}">
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label for="penilai" class="col-sm-3 col-form-label">Pejabat Penilai</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="penilai" name="penilai" value="{{ $penilai->penilai->name }}">
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="nama" name="nama" value="{{ $penilai->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="nip" name="nip" value="{{ $penilai->nip }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pangkat" class="col-sm-3 col-form-label">Pangkat, Gol. Ruang</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="pangkat" name="pangkat" value="{{ $penilai->pangkat->nama ?? 'None' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="jabatan" name="jabatan" value="{{ $penilai->jabatan->nama ?? 'None' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Unit Kerja</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="Politeknik Negeri Cilacap">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer">
                <a href="/master/penilai/{{ $penilai->id }}/edit" class="btn btn-warning"><i class="fas fa-user-edit"></i> Edit</a>
                <form action="/master/penilai/{{ $penilai->id }}" method="POST" class="d-inline">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger delete-confirm"><i class="fas fa-user-minus"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection