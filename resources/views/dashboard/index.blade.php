@extends('layouts.main')

@section('judul')
    Dashboard
@endsection

@section('isi')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
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
            <div class="small-box bg-info">
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
            <div class="small-box bg-info">
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
    </div>
@endsection