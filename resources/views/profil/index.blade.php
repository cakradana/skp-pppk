@extends('layouts.main')

@section('judul')
    Profil
@endsection

@section('isi')
<div class="row">
    <div class="col-md-4">
        <div class="card card-secondary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="https://source.unsplash.com/128x128?profile" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $pegawai->name }}</h3>
                <p class="text-muted text-center">{{ $pegawai->role }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item text-center">
                    <b>NIP</b><br><span>{{ $pegawai->nip }}</span>
                    </li>
                    <li class="list-group-item text-center">
                    <b>Pangkat, Gol. Ruang</b><br><span>{{ $pegawai->pangkat->nama }}</span>
                    </li>
                    <li class="list-group-item text-center">
                    <b>Jabatan</b><br><span>{{ $pegawai->jabatan->nama }}</span>
                    </li>
                </ul>
                <a href="/master/pegawai/{{ auth()->user()->id }}/edit" class="btn btn-primary btn-block"><b>Edit Profil</b></a>
            </div>
        </div>
    </div>
    @can('Pegawai yang Dinilai')
    <div class="col-md-4">
        <div class="card card-secondary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="https://source.unsplash.com/128x128?profile" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $pegawai->penilai->name }}</h3>
                <p class="text-muted text-center">{{ $pegawai->penilai->role }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item text-center">
                    <b>NIP</b><br><span>{{ $pegawai->penilai->nip }}</span>
                    </li>
                    <li class="list-group-item text-center">
                    <b>Pangkat, Gol. Ruang</b><br><span>{{ $pegawai->penilai->pangkat->nama }}</span>
                    </li>
                    <li class="list-group-item text-center">
                    <b>Jabatan</b><br><span>{{ $pegawai->penilai->jabatan->nama }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endcan
    @if($pegawai->can('Pegawai yang Dinilai') || $pegawai->can('Pejabat Penilai'))
    <div class="col-md-4">
        <div class="card card-secondary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="https://source.unsplash.com/128x128?profile" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $pegawai->atasan->name }}</h3>
                <p class="text-muted text-center">{{ $pegawai->atasan->role }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item text-center">
                    <b>NIP</b><br><span>{{ $pegawai->atasan->nip }}</span>
                    </li>
                    <li class="list-group-item text-center">
                    <b>Pangkat, Gol. Ruang</b><br><span>{{ $pegawai->atasan->pangkat->nama }}</span>
                    </li>
                    <li class="list-group-item text-center">
                    <b>Jabatan</b><br><span>{{ $pegawai->atasan->jabatan->nama }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection