@extends('layouts.main')

@section('judul')
{{ $title }}
@endsection

@section('isi')
<div class="row">
    <div class="col">
        <a href="/master/penilai/create" class="btn btn-primary mb-3"><i class="fas fa-user-plus"></i> Tambah
            Penilai</a>
        <div class="card card-secondary card-outline">
            {{-- <div class="card-header">
                <h3 class="card-title mt-2">Data Master Penilai</h3>
            </div> --}}
            <div class="card-body table-responsive p-0">
                <div class="" style="padding: 20px 20px 20px;">
                    <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th>NIP</th>
                                <th>Nama Penilai</th>
                                <th class="col-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penilais as $penilai)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $penilai->nip }}</td>
                                <td>{{ $penilai->name }}</td>
                                <td><a href="/master/penilai/{{ $penilai->id }}" class="btn btn-success text-white"><i
                                            class="fas fa-eye"></i> Detail</a></td>
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