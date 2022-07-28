@extends('layouts.main')

@section('judul')
{{ $title }}
@endsection

@section('isi')
<div class="row">
    <div class="col-md-4">
        <div class="card card-secondary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" @if($user->foto == NULL)
                    src="{{ asset('assets/dist/img/blank.png') }}"
                    @else
                    src="{{ asset('/files'.'/'. $user->foto) }}"
                    @endif
                    alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                <p class="text-muted text-center">{{ $user->role }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item text-center">
                        <b>NIP</b><br><span>{{ $user->nip }}</span>
                    </li>
                    <li class="list-group-item text-center">
                        <b>Pangkat, Gol. Ruang</b><br><span>{{ $user->pangkat->nama }}</span>
                    </li>
                    <li class="list-group-item text-center">
                        <b>Jabatan</b><br><span>{{ $user->jabatan->nama }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @can('Pegawai yang Dinilai')
    <div class="col-md-4">
        <div class="card card-secondary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" @if($user->penilai->foto == NULL)
                    src="{{ asset('assets/dist/img/blank.png') }}"
                    @else
                    src="{{ asset('/files'.'/'. $user->penilai->foto) }}"
                    @endif
                    alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $user->penilai->name }}</h3>
                <p class="text-muted text-center">{{ $user->penilai->role }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item text-center">
                        <b>NIP</b><br><span>{{ $user->penilai->nip }}</span>
                    </li>
                    <li class="list-group-item text-center">
                        <b>Pangkat, Gol. Ruang</b><br><span>{{ $user->penilai->pangkat->nama
                            }}</span>
                    </li>
                    <li class="list-group-item text-center">
                        <b>Jabatan</b><br><span>{{ $user->penilai->jabatan->nama }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endcan
    @if($user->can('Pegawai yang Dinilai') || $user->can('Pejabat Penilai'))
    <div class="col-md-4">
        <div class="card card-secondary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" @if($user->atasan->foto == NULL)
                    src="{{ asset('assets/dist/img/blank.png') }}"
                    @else
                    src="{{ asset('/files'.'/'. $user->atasan->foto) }}"
                    @endif
                    alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $user->atasan->name }}</h3>
                <p class="text-muted text-center">{{ $user->atasan->role }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item text-center">
                        <b>NIP</b><br><span>{{ $user->atasan->nip }}</span>
                    </li>
                    <li class="list-group-item text-center">
                        <b>Pangkat, Gol. Ruang</b><br><span>{{ $user->atasan->pangkat->nama
                            }}</span>
                    </li>
                    <li class="list-group-item text-center">
                        <b>Jabatan</b><br><span>{{ $user->atasan->jabatan->nama }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endif
    <div class="col-md-12">
        <div class="card card-secondary card-outline">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link" href="#tab-foto" data-toggle="tab">Foto</a>
                    </li>
                    <li class="nav-item"><a class="nav-link {{ Request::is('profil') ? 'active' : '' }}" href="#tab-ttd"
                            data-toggle="tab">Ttd</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#profil" data-toggle="tab">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#edit-password" data-toggle="tab">Password</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane" id="tab-foto">
                        <form class="form-horizontal" action="/profil/fotoUpdate/{{ $user->id }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Foto
                                    Profil</label>
                                <div class="col-sm-9 input-group">
                                    <input type="hidden" value="{{ $user->foto }}" name="foto_lama">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="foto" id="foto"
                                            accept="image/*" required>
                                        <label class="custom-file-label" for="customFile">Pilih
                                            File</label>
                                    </div>
                                    <div class="input-group-append">
                                        <input type="submit" class="input-group-text bg-warning" value="Upload">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane {{ Request::is('profil') ? 'active' : '' }}" id="tab-ttd">
                        <div class="text-center mb-3">
                            <img src="{{ asset('/files'.'/'. $user->ttd) }}" class="border border-primary"
                                style="width: 10%" alt="user-ttd">
                        </div>
                        <form class="form-horizontal" action="/profil/ttdUpdate/{{ $user->id }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanda
                                    Tangan</label>
                                <div class="col-sm-9 input-group">
                                    <input type="hidden" value="{{ $user->ttd }}" name="ttd_lama">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="ttd" id="ttd"
                                            accept="image/*" required>
                                        <label class="custom-file-label" for="customFile">Pilih
                                            File</label>
                                    </div>
                                    <div class="input-group-append">
                                        <input type="submit" class="input-group-text bg-warning" value="Upload">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="edit-password">
                        <form action="/profil/passwordUpdate/{{ $user->id }}" method="POST" class="mb-0"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password Lama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="oldPassword" name="oldPassword"
                                        placeholder="Password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password Baru</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="newPasswordA"
                                        placeholder="Password Baru" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Konfirmasi Password</label>
                                <div class="col-sm-9">
                                    <input type="password"
                                        class="form-control @error('newPasswordB') is-invalid @enderror"
                                        name="newPasswordB" placeholder="Konfirmasi Password" required>
                                    <div class="invalid-feedback">
                                        @error('newPasswordB')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i>
                                    Simpan</button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane" id="profil">
                        <form action="/profil/profilUpdate/{{ $user->id }}" method="POST" class="mb-0"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group row d-none">
                                <label for="role" class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <select class="form-control @error('role') is-invalid @enderror" name="role">
                                        @if (old('role', $user->role) == $user->role)
                                        <option value="{{ $user->role }}" selected>{{ $user->role }}</option>
                                        <option value="Pegawai yang Dinilai">Pegawai yang Dinilai</option>
                                        <option value="Pejabat Penilai">Pejabat Penilai</option>
                                        <option value="Atasan Pejabat Penilai">Atasan Pejabat Penilai</option>
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('role')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $user->name) }}">
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
                                    <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip"
                                        name="nip" value="{{ old('nip', $user->nip) }}">
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
                                        name="pangkat_id">
                                        @foreach ($pangkats as $pangkat)
                                        @if (old('pangkat_id', $user->pangkat_id) == $pangkat->id)
                                        <option value="{{ $pangkat->id }}" selected>{{ $pangkat->nama }}
                                        </option>
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
                                        name="jabatan_id">
                                        @foreach ($jabatans as $jabatan)
                                        @if (old('jabatan_id', $user->jabatan_id) == $jabatan->id)
                                        <option value="{{ $jabatan->id }}" selected>{{ $jabatan->nama }}
                                        </option>
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
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i>
                                    Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="row">

</div>
@endsection