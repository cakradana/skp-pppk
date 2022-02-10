@extends('layouts.main')

@section('judul')
    Master Kegiatan Tugas Jabatan
@endsection

@section('isi')
    <div class="row">
        <div class="col">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <a href="/master/kegiatan/create" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Kegiatan Tugas Jabatan</a>
            <div class="card card-secondary card-outline">
                <div class="card-header">
                    <h3 class="card-title mt-2">Data Master Kegiatan Tugas Jabatan</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <div class="container" style="padding: 20px 20px 20px;">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="col-1">No</th>
                                    <th>Jabatan</th>
                                    <th>Nama Kegiatan Tugas Jabatan</th>
                                    <th class="col-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kegiatans as $kegiatan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kegiatan->jabatan->nama }}</td>
                                    <td>{{ $kegiatan->nama }}</td>
                                    <td>
                                        <a href="/master/kegiatan/{{ $kegiatan->id }}/edit" class="btn btn-warning"><i class="fas fa-pen"></i> Edit</a>
                                        <form action="/master/kegiatan/{{ $kegiatan->id }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" onclick="return confirm('Yakin?')"><i class="fas fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
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