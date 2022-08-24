@extends('layouts.main')

@section('judul')
    {{ $title }}
@endsection

@section('isi')
    <div class="row">
        <div class="col">
            <div class="card card-secondary card-outline">
                <div class="card-body table-responsive p-0">
                    <div class="" style="padding: 20px 20px 20px;">
                        <table id="" class="table table-striped small table-bordered projects" style="width:100%">
                            <thead class="text-left">
                                <tr>
                                    <th class="align-middle text-center">No</th>
                                    <th class="align-middle text-left">NIP</th>
                                    <th class="align-middle">Nama
                                        <br>
                                        <small>
                                            Jabatan
                                        </small>
                                    </th>
                                    <th class="align-middle col-2 text-center">Nilai Prestasi Kerja</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawais as $pegawai)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="text-left align-middle">{{ $pegawai->user->nip }}</td>
                                        <td>
                                            {{ $pegawai->user->name }}
                                            <br>
                                            <small>
                                                {{ $pegawai->user->jabatan->nama }}
                                            </small>
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $pegawai->nilai_prestasi }}
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
