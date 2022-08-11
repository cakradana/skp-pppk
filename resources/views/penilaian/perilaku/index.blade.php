@extends('layouts.main')

@section('judul')
    {{ $title }}
@endsection

@section('isi')
    <div class="row">
        <div class="col">
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
                                    <th class="align-middle text-center">Nilai Perilaku</th>
                                    <th class="align-middle col-2 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($perilakus as $perilaku)
                                    @php
                                        $op = \App\Models\Perilaku::where('penilai_id', $user->id)
                                            ->where('user_id', $perilaku->id)
                                            ->value('orientasi_pelayanan');
                                        $int = \App\Models\Perilaku::where('penilai_id', $user->id)
                                            ->where('user_id', $perilaku->id)
                                            ->value('integritas');
                                        $kom = \App\Models\Perilaku::where('penilai_id', $user->id)
                                            ->where('user_id', $perilaku->id)
                                            ->value('komitmen');
                                        $dis = \App\Models\Perilaku::where('penilai_id', $user->id)
                                            ->where('user_id', $perilaku->id)
                                            ->value('disiplin');
                                        $krjsm = \App\Models\Perilaku::where('penilai_id', $user->id)
                                            ->where('user_id', $perilaku->id)
                                            ->value('kerjasama');
                                        $kpmn = \App\Models\Perilaku::where('penilai_id', $user->id)
                                            ->where('user_id', $perilaku->id)
                                            ->value('kepemimpinan');
                                        
                                        $nilai_perilaku = ($op + $int + $kom + $dis + $krjsm + $kpmn) / 6;
                                    @endphp
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="text-center align-middle">{{ $perilaku->nip }}</td>
                                        <td>
                                            <ul class="list-inline d-flex">
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar"
                                                        @if ($perilaku->foto == null) src="{{ asset('assets/dist/img/blank.png') }}"
                                            @else
                                            src="{{ asset('/files' . '/' . $perilaku->foto) }}" @endif
                                                        alt="User profile picture">
                                                </li>
                                                <li class="list-inline-item">
                                                    {{ $perilaku->name }}
                                                    <br>
                                                    <small>
                                                        {{ $perilaku->jabatan->nama }}
                                                    </small>
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="align-middle text-center">{{ round($nilai_perilaku, 2) }}</td>
                                        <td class="align-middle">
                                            <div class="d-inline-flex" style="inline-size: max-content; gap: 3px;">
                                                <button {{ $perilaku->perilaku ? 'disabled' : '' }}
                                                    class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#isi-perilaku-{{ $perilaku->id }}"><i
                                                        class="fas fa-plus"></i> Nilai Perilaku</button>
                                                <form action="/penilaian/perilaku-pegawai/{{ $perilaku->id }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button {{ $perilaku->perilaku ? '' : 'disabled' }}
                                                        class="btn btn-sm
                                            btn-warning text-white reset-perilaku-confirm"><i
                                                            class="fas fa-sync-alt"></i>
                                                        Reset
                                                        Nilai</button>
                                                </form>
                                            </div>
                                        </td>
                                        <div class="modal fade" id="isi-perilaku-{{ $perilaku->id }}">
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
                                                                @if ($perilaku->foto == null) src="{{ asset('assets/dist/img/blank.png') }}"
                                                                @else
                                                                src="{{ asset('/files' . '/' . $perilaku->foto) }}" @endif
                                                                alt="User profile picture">
                                                        </div>
                                                        <h3 class="widget-user-username">{{ $perilaku->name }}</h3>
                                                        <h5 class="widget-user-desc">{{ $perilaku->jabatan->nama }}</h5>
                                                    </div>
                                                    <div class="modal-body bg-light border-top">
                                                        <form action="/penilaian/perilaku-pegawai" method="POST"
                                                            enctype="multipart/form-data" class="form-inline">
                                                            @csrf
                                                            <input type="hidden" name="user_id"
                                                                value="{{ $perilaku->id }}">
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
                                                                <label class="col-sm-4 col-form-label">Disiplin</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" class="form-control"
                                                                        name="disiplin" min="0" max="100"
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
