@extends('layouts.main')

@section('judul')
    {{ $title }}
@endsection

@section('isi')
    <div class="row">
        <div class="col">
            {{-- <a href="/pengajuan/rencana/create" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah
            Rencana</a>
        <a href="#cetak" class="btn btn-success mb-3"><i class="fas fa-file-pdf"></i> Cetak Rencana</a> --}}
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
                                    {{-- <th class="align-middle">
                                        Jangka Waktu
                                    </th> --}}
                                    <th class="text-center align-middle">
                                        Status
                                    </th>
                                    <th class="align-middle text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuans as $pengajuan)
                                    <tr>
                                        <td class="text-center align-middle">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ $pengajuan->nip }}
                                        </td>
                                        <td>
                                            <ul class="list-inline d-flex">
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar"
                                                        @if ($pengajuan->foto == null) src="{{ asset('assets/dist/img/blank.png') }}"
                                            @else
                                            src="{{ asset('/files' . '/' . $pengajuan->foto) }}" @endif
                                                        alt="User profile picture">
                                                </li>
                                                <li class="list-inline-item">
                                                    {{ $pengajuan->name }}
                                                    <br>
                                                    <small>
                                                        {{ $pengajuan->jabatan->nama }}
                                                    </small>
                                                </li>
                                            </ul>
                                        </td>
                                        {{-- <td class="align-middle">1 Jan s/d 31 Des 2022</td> --}}




                                        {{-- <td class="project_progress">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57"
                                            aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                        </div>
                                    </div>
                                    <small>
                                        57% Complete
                                    </small>
                                </td> --}}
                                        <td class="project-state align-middle">
                                            @php
                                                $status = \App\Models\Sasaran::where('penilai_id', $user->id)
                                                    ->where('user_id', $pengajuan->id)
                                                    ->select('status')
                                                    ->groupBy('status')
                                                    ->value('status');
                                                if ($status == 'Disetujui') {
                                                    $warna = 'success';
                                                    $setuju = 'btn-secondary disabled';
                                                    $cetak = 'btn-success';
                                                    $detail = 'btn-info';
                                                } elseif ($status == null) {
                                                    $status = 'Belum Mengajukan';
                                                    $warna = 'warning';
                                                    $setuju = 'btn-secondary disabled';
                                                    $cetak = 'btn-secondary disabled';
                                                    $detail = 'btn-secondary disabled';
                                                } else {
                                                    $warna = 'secondary';
                                                    $setuju = 'btn-primary';
                                                    $cetak = 'btn-secondary disabled';
                                                    $detail = 'btn-info';
                                                }
                                            @endphp
                                            <span class="badge badge-{{ $warna }}">{{ $status }}</span>
                                        </td>
                                        <td class="project-actions text-center">
                                            <a href="/persetujuan/rencana-pegawai/{{ $pengajuan->id }}"
                                                class="btn btn-sm {{ $detail }}"><i class="fas fa-search"></i></a>
                                            <a href="/persetujuan/rencana-pegawai/setuju/{{ $pengajuan->id }}"
                                                class="btn btn-sm {{ $setuju }}"><i class="fas fa-check"></i></a>
                                            <a href="/pengajuan/rencana/cetak-rencana/{{ $pengajuan->id }}"
                                                class="btn btn-sm {{ $cetak }}"><i class="fas fa-file-pdf"></i></a>
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
