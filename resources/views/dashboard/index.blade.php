@extends('layouts.main')

@section('judul')
    {{ $title }}
@endsection

@section('isi')
    <div class="row">
        <div class="col">
            @if ($atribut == 'tdk ada ttd')
                <div class="alert alert-warning alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i>Anda Belum Melakukan Upload Tanda Tangan</h5>
                    Mohon upload tanda tangan anda terlebih dahulu <a href="profil/#tab-ttd"
                        class="text-decoration-none badge badge-warning text-white">di
                        sini</a>
                </div>
            @endif
        </div>



        <div class="col-lg-12 col-6">
            <div class="small-box bg-white card-primary card-outline">
                <div class="card-body">
                    {{-- <div class="jumbotron"> --}}
                    <h1 class="display-4">Hello, {{ auth()->user()->name }}</h1>
                    <p class="lead"></p>
                    <hr class="my-4">
                    <p>Selamat datang di Sistem Informasi Sasaran Kinerja Pegawai untuk PPPK di Politeknik
                        Negeri Cilacap</p>
                    <p class="lead">
                        {{-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> --}}
                    </p>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        @can('Admin')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-white card-primary card-outline-left">
                    <div class="inner">
                        <h3>{{ $pegawai }}</h3>
                        <p>Pegawai</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="/master/pegawai" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-white card-primary card-outline-left">
                    <div class="inner">
                        <h3>{{ $pejabat }}</h3>
                        <p>Pejabat Penilai</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <a href="/master/penilai" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-white card-primary card-outline-left">
                    <div class="inner">
                        <h3>{{ $pangkat }}</h3>
                        <p>Pangkat</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <a href="/master/pangkat" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-white card-primary card-outline-left">
                    <div class="inner">
                        <h3>{{ $jabatan }}</h3>
                        <p>Jabatan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <a href="/master/jabatan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-white card-primary card-outline-left">
                    <div class="inner">
                        <h3>{{ $kegiatan }}</h3>
                        <p>Kegiatan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <a href="/master/kegiatan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan

        @can('Pejabat Penilai')
            {{-- <div class="col-lg-12 col-6">
                <div class="small-box bg-white card-primary card-outline">
                    <div class="card-body">

                    </div>
                </div>
            </div> --}}
        @endcan

        @can('Pegawai yang Dinilai')
            {{-- <div class="col-lg-12 col-6">
                <div class="small-box bg-white card-primary card-outline">
                    <div class="card-body">

                    </div>
                </div>
            </div> --}}
        @endcan
    </div>
@endsection
