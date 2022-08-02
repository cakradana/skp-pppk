@extends('layouts.main')

@section('judul')
{{ $title }}
@endsection

@section('isi')
<div class="row">
    <div class="col">
        <a href="/master/kegiatan/create" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Kegiatan Tugas
            Jabatan</a>
        <div class="card card-secondary card-outline">
            {{-- <div class="card-header">
                <h3 class="card-title mt-2">Data Master Kegiatan Tugas Jabatan</h3>
            </div> --}}
            <div class="card-body table-responsive p-0">
                <div class="" style="padding: 20px 20px 20px;">
                    <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th>Jabatan</th>
                                <th>Nama Kegiatan Tugas Jabatan</th>
                                <th>AK</th>
                                <th class="col-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatans as $kegiatan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kegiatan->jabatan->nama }}</td>
                                <td>{{ $kegiatan->nama }}</td>
                                <td>{{ $kegiatan->ak }}</td>
                                <td>
                                    <a href="/master/kegiatan/{{ $kegiatan->id }}/edit"
                                        class="btn btn-sm btn-warning text-white"><i class="fas fa-pen"></i></a>
                                    <form action="/master/kegiatan/{{ $kegiatan->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger delete-confirm"><i
                                                class="fas fa-trash"></i></button>
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