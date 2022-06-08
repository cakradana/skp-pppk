@extends('layouts.main')

@section('judul')
    Dashboard
@endsection

@section('isi')
    <div class="row">
        @can('Admin')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-white card-primary card-outline">
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
            <div class="small-box bg-white card-primary card-outline">
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
            <div class="small-box bg-white card-primary card-outline">
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
            <div class="small-box bg-white card-primary card-outline">
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
            <div class="small-box bg-white card-primary card-outline">
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
    </div>
@endsection