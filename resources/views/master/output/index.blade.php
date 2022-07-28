@extends('layouts.main')

@section('judul')
{{ $title }}
@endsection

@section('isi')
<div class="row">
    <div class="col">
        <a href="/master/output/create" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Output</a>
        <div class="card card-secondary card-outline">
            {{-- <div class="card-header">
                <h3 class="card-title mt-2">Data Master Pangkat</h3>
            </div> --}}
            <div class="card-body table-responsive p-0">
                <div class="" style="padding: 20px 20px 20px;">
                    <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th>Nama Output</th>
                                <th class="col-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($outputs as $output)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $output->nama }}</td>
                                <td>
                                    <a href="/master/output/{{ $output->id }}/edit" class="btn btn-warning"><i
                                            class="fas fa-pen"></i> Edit</a>
                                    <form action="/master/output/{{ $output->id }}" method="POST" class="d-inline">
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