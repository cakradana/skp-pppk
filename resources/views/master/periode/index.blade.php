@extends('layouts.main')
@section('judul')
{{ $title }}
@endsection
@section('isi')
<div class="row">
    <div class="col">
        <a href="/master/periode/create" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Periode</a>
        <div class="card card-secondary card-outline">
            {{-- <div class="card-header">
                <h3 class="card-title mt-2">Data Master Periode</h3>
            </div> --}}
            <div class="card-body table-responsive p-0">
                <div class="" style="padding: 20px 20px 20px;">
                    <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th>Nama Periode</th>
                                <th>Tanggal Awal</th>
                                <th>Tanggal Akhir</th>
                                <th class="col-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periodes as $periode)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $periode->nama }}</td>
                                <td>{{Carbon\Carbon::parse($periode->awal)->isoFormat('D MMMM Y') }}</td>
                                <td>{{Carbon\Carbon::parse($periode->akhir)->isoFormat('D MMMM Y') }}</td>
                                <td>
                                    <a href="/master/periode/{{ $periode->id }}/edit"
                                        class="btn btn-warning text-white"><i class="fas fa-pen"></i> Edit</a>
                                    <form action="/master/periode/{{ $periode->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger delete-confirm"><i class="fas fa-trash"></i>
                                            Delete</button>
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