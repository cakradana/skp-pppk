@extends('layouts.main')

@section('judul')
    {{ $title }}
@endsection

@section('isi')
    <div class="row">
        <div class="col">
            <form method="POST" action="/monitoring/rencana">
                @csrf
                <div class="form-inline">
                    <div class="input-group ml-1 mb-3 d-print-none" style="width: 25%">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Pilih Periode:</div>
                        </div>
                        <select class="form-control" name="periode">
                            <option hidden selected value="{{$periode}}">{{$periode}}</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary ml-1 mb-3 d-print-none"><i class="fas fa-search d-print-none"></i>
                        Proses
                    </button>
            </form>
        </div>
            <div class="card card-secondary card-outline">
                <div class="card-body table-responsive p-0">
                    <div class="" style="padding: 20px 20px 20px;">
                        <table id="data-table" class="table table-striped small table-bordered projects" style="width:100%">
                            <thead class="text-left">
                                <tr>
                                    <th rowspan="2" class="align-middle text-center">No</th>
                                    <th rowspan="2" class="align-middle text-center">NIP</th>
                                    <th rowspan="2" class="align-middle">Nama
                                        <br>
                                        <small>
                                            Jabatan
                                        </small>
                                    </th>
                                    <th colspan="2" class="align-middle text-center">Rencana SKP</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Pengajuan</th>
                                    <th class="text-center">Persetujuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawais as $pegawai)
                                    @php
                                        $status = \App\Models\Sasaran::where('user_id', $pegawai->id)->whereYear('updated_at', $periode)
                                            ->select('status')
                                            ->groupBy('status')
                                            ->value('status');
                                        if ($status == 'Disetujui') {
                                            $pengajuan = 'fas fa-check';
                                            $persetujuan = 'fas fa-check';
                                        } elseif ($status == null) {
                                            $pengajuan = 'fas fa-times';
                                            $persetujuan = 'fas fa-times';
                                        } elseif ($status == 'Belum Disetujui') {
                                            $pengajuan = 'fas fa-check';
                                            $persetujuan = 'fas fa-times';
                                        }
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-left">{{ $pegawai->nip }}</td>
                                        <td>{{ $pegawai->name }}
                                            <br>
                                            <small>
                                                {{ $pegawai->jabatan->nama }}
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <i class="{{ $pengajuan }}"></i>
                                        </td>
                                        <td class="text-center">
                                            <i class="{{ $persetujuan }}"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            
        </div>
    </div>
@endsection
