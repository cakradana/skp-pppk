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
                        <table id="" class="table table-striped small table-bordered projects" style="width:100%">
                            <thead class="text-left">
                                <tr>
                                    <th class="align-middle text-center">No</th>
                                    <th class="align-middle text-center">NIP</th>
                                    <th class="align-middle">Nama
                                        <br>
                                        <small>
                                            Jabatan
                                        </small>
                                    </th>
                                    <th class="align-middle">Jabatan</th>
                                    {{-- <th class="align-middle">Jangka Waktu</th> --}}
                                    {{-- <th class="align-middle">Status</th> --}}
                                    <th class="align-middle col-2 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuans as $pengajuan)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="text-center align-middle">{{ $pengajuan->nip }}</td>
                                        <td>
                                            <ul class="list-inline d-flex">
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar"
                                                        @if ($pengajuan->foto == null) src="{{ asset('assets/dist/img/blank.png') }}"
                                            @else
                                            src="{{ asset('/files' . '/' . $pengajuan->foto) }}" @endif
                                                        alt="User profile picture">
                                                </li>
                                                <li class="list-inline-item">
                                                    {{ $pengajuan->name }}
                                                    <br>
                                                    <small>
                                                        {{ $pengajuan->jabatan->nama }}
                                                    </small>
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="align-middle">{{ $pengajuan->jabatan->nama }}</td>
                                        <td>
                                            <div class="d-inline-flex" style="inline-size: max-content; gap: 3px;">
                                                <button {{ $pengajuan->perilaku ? 'disabled' : '' }}
                                                    class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#isi-perilaku-{{ $pengajuan->id }}"><i
                                                        class="fas fa-plus"></i> Nilai Perilaku</button>
                                                <form action="/penilaian/perilaku-pegawai/{{ $pengajuan->id }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button {{ $pengajuan->perilaku ? '' : 'disabled' }}
                                                        class="btn btn-sm
                                            btn-warning text-white reset-rencana-confirm"><i
                                                            class="fas fa-sync-alt"></i>
                                                        Reset
                                                        Nilai</button>
                                                </form>
                                            </div>
                                        </td>






                                        <div class="modal fade" id="isi-perilaku-{{ $pengajuan->id }}">
                                            <div class="modal-dialog modal-lg">

                                                <div class="modal-content card card-widget widget-user-2">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Isi Nilai Perilaku</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="widget-user-header bg-white" style="align-self: center">
                                                        <div class="widget-user-image pr-4">
                                                            <img alt="Avatar" class="img-circle elevation-2"
                                                                @if ($pengajuan->foto == null) src="{{ asset('assets/dist/img/blank.png') }}"
                                                                @else
                                                                src="{{ asset('/files' . '/' . $pengajuan->foto) }}" @endif
                                                                alt="User profile picture">
                                                        </div>
                                                        <h3 class="widget-user-username">{{ $pengajuan->name }}</h3>
                                                        <h5 class="widget-user-desc">{{ $pengajuan->jabatan->nama }}</h5>
                                                    </div>
                                                    <div class="modal-body bg-light border-top">
                                                        <form action="/penilaian/perilaku-pegawai" method="POST"
                                                            enctype="multipart/form-data" class="form-inline">
                                                            @csrf
                                                            <input type="hidden" name="user_id"
                                                                value="{{ $pengajuan->id }}">
                                                            <input type="hidden" name="penilai_id"
                                                                value="{{ Auth::user()->id }}">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">Orientasi
                                                                    Pelayanan</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" class="form-control"
                                                                        name="orientasi_pelayanan" min="0"
                                                                        max="100" required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">Integritas</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" class="form-control"
                                                                        name="integritas" min="0" max="100"
                                                                        required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">Komitmen</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" class="form-control"
                                                                        name="komitmen" min="0" max="100"
                                                                        required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">Kerjasama</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" class="form-control"
                                                                        name="kerjasama" min="0" max="100"
                                                                        required="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">Kepemimpinan</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" class="form-control"
                                                                        name="kepemimpinan" min="0" max="100"
                                                                        required="">
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
