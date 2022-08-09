@extends('layouts.main')

@section('judul')
{{ $title }}
@endsection

@section('isi')

<div class="row">
    <div class="col">
        {{-- <a href="/pengajuan/rencana/create" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah
            Rencana</a>
        <a href="#cetak" class="btn btn-success mb-3"><i class="fas fa-file-pdf"></i> Cetak Rencana</a> --}}
        <div class="card card-secondary card-outline">
            <div class="card-body table-responsive p-0">
                <div class="" style="padding: 20px 20px 20px;">
                    <table id="" class="table table-striped table-bordered small" style="width:100%">
                        <thead class="text-left">
                            <tr>
                                <th class="align-middle">No</th>
                                <th class="align-middle">NIP</th>
                                <th class="align-middle">Nama</th>
                                <th class="align-middle">Jabatan</th>
                                {{-- <th class="align-middle">Jangka Waktu</th> --}}
                                {{-- <th class="align-middle">Status</th> --}}
                                <th class="align-middle col-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajuans as $pengajuan)
                            <tr>
                                <td class="">{{ $loop->iteration }}</td>
                                <td>{{ $pengajuan->nip }}</td>
                                <td>{{ $pengajuan->name }}</td>
                                <td>{{ $pengajuan->jabatan->nama }}</td>
                                <td><button {{ $pengajuan->perilaku ? 'disabled' : '' }} class="btn btn-sm btn-primary"
                                        data-toggle="modal"
                                        data-target="#isi-perilaku-{{ $pengajuan->id }}"><i class="fas fa-plus"></i> Isi
                                        Realisasi</button>
                                    <form action="/penilaian/perilaku-pegawai/{{ $pengajuan->id }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button {{ $pengajuan->perilaku ? '' : 'disabled' }} class="btn btn-sm
                                            btn-warning text-white reset-rencana-confirm"><i
                                                class="fas fa-sync-alt"></i>
                                            Reset
                                            Rencana</button>
                                    </form>
                                </td>
                                <div class="modal fade" id="isi-perilaku-{{ $pengajuan->id }}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content card-primary card-outline">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Isi Perilaku</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/penilaian/perilaku-pegawai" method="POST"
                                                    enctype="multipart/form-data" class="form-inline">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $pengajuan->id }}">
                                                    <input type="hidden" name="penilai_id"
                                                        value="{{ Auth::user()->id }}">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Orientasi
                                                            Pelayanan</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control"
                                                                name="orientasi_pelayanan" min="0" max="100"
                                                                required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Integritas</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control" name="integritas"
                                                                min="0" max="100" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Komitmen</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control" name="komitmen"
                                                                min="0" max="100" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Kerjasama</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control" name="kerjasama"
                                                                min="0" max="100" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Kepemimpinan</label>
                                                        <div class="col-sm-9">
                                                            <input type="number" class="form-control"
                                                                name="kepemimpinan" min="0" max="100" required="">
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fas fa-save"></i>
                                                    Simpan</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
