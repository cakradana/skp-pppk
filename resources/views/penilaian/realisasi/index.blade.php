@extends('layouts.main')

@section('judul')
    {{ $title }}
@endsection

@section('isi')
    <div class="row">
        <div class="col">
            {{-- <form method="POST" action="/penilaian/realisasi-pegawai">
                @csrf
                <div class="form-inline">
                    <div class="input-group ml-1 mb-3 d-print-none" style="width: 25%">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Pilih Bulan:</div>
                        </div>
                        <select class="form-control" name="bulan">
                            <option hidden selected value="{{ old('bulan') }}">{{ $selected }}</option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary ml-1 mb-3 d-print-none"><i
                            class="fas fa-search d-print-none"></i>
                        Proses</button>
            </form>
        </div> --}}
            <div class="card card-secondary card-outline">
                <div class="card-body table-responsive p-0">
                    <div class="" style="padding: 20px 20px 20px;">
                        <table class="table table-striped small table-bordered projects">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center" style="width: 1%">
                                        No
                                    </th>
                                    <th class="align-middle text-center">
                                        NIP
                                    </th>
                                    <th>
                                        Nama
                                        <br>
                                        <small>
                                            Jabatan
                                        </small>
                                    </th>
                                    <th class="align-middle text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawais as $pegawai)
                                    <tr>
                                        <td class="text-center align-middle">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $pegawai->nip }}
                                        </td>
                                        <td>
                                            <ul class="list-inline d-flex">
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar"
                                                        @if ($pegawai->foto == null) src="{{ asset('assets/dist/img/blank.png') }}"
                                        @else
                                        src="{{ asset('/files' . '/' . $pegawai->foto) }}" @endif
                                                        alt="User profile picture">
                                                </li>
                                                <li class="list-inline-item">
                                                    {{ $pegawai->name }}
                                                    <br>
                                                    <small>
                                                        {{ $pegawai->jabatan->nama }}
                                                    </small>
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="project-actions text-center">
                                            <div class="d-inline-flex" style="inline-size:max-content; gap:3px;">
                                                <a href="/penilaian/realisasi-pegawai/{{ $pegawai->id }}/edit"
                                                    class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                                                    Isi
                                                    Penilaian Realisasi</a>
                                                {{-- <form action="/pengajuan/realisasi/reset/{{ $pengajuan->id }}"
                                                    method="POST" enctype="multipart/form-data" class="">
                                                    @method('put')
                                                    @csrf
                                                    <button
                                                        class="text-white btn btn-sm btn-warning text-white reset-realisasi-confirm"><i
                                                            class="fas fa-sync-alt"></i> Reset Penilaian
                                                    </button>
                                                </form> --}}
                                            </div>
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
