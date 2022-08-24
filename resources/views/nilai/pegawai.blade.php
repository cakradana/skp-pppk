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
                            <thead>
                                <tr>
                                    <th colspan="3">Unsur yang dinilai</th>
                                    <th>Nilai</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>A</td>
                                    <td colspan="2">SKP</td>
                                    <td>{{ $nilai_skp }} x 60%</td>
                                    <td>{{ ($nilai_skp * 60) / 100 }}</td>
                                </tr>
                                <tr>
                                    <td rowspan="9">B</td>
                                    <td rowspan="9">Perilaku Kerja</td>
                                    <td>Orientasi Pelayanan</td>
                                    <td>{{ $orientasi_pelayanan }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Integritas</td>
                                    <td>{{ $integritas }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Komitmen</td>
                                    <td>{{ $komitmen }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Disiplin</td>
                                    <td>{{ $disiplin }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Kerjasama</td>
                                    <td>{{ $kerjasama }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Kepemimpinan</td>
                                    <td>{{ $kepemimpinan }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td>{{ $jumlah }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Rata Rata</td>
                                    <td>{{ $nilai_perilaku }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Nilai Perilaku Kerja</td>
                                    <td>{{ $nilai_perilaku }} x 40%</td>
                                    <td>{{ ($nilai_perilaku * 40) / 100 }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">NILAI PRESTASI KERJA</th>
                                    <th>{{ round($final, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
