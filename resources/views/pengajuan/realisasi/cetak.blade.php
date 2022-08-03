<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="generator" content="PhpSpreadsheet, https://github.com/PHPOffice/PhpSpreadsheet">
    <meta name="author" content="R. Cakradana A. Yudhatama" />
    <link rel="stylesheet" href="/assets/dist/css/cetak-realisasi.css">
</head>

<body>
    <style>
        @page {
            size: 25cm 35.7cm;
            margin: 2mm 2mm 2mm 2mm;
            /* change the margins as you want them to be. */
        }

        body {
            margin-left: 0.2in;
            margin-right: 0.2in;
            margin-top: 0.25in;
            margin-bottom: 0.25in;
            text-align: -webkit-center;
        }
    </style>
    <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">
        <col class="col0">
        <col class="col1">
        <col class="col2">
        <col class="col3">
        <col class="col4">
        <col class="col5">
        <col class="col6">
        <col class="col7">
        <col class="col8">
        <col class="col9">
        <col class="col10">
        <col class="col11">
        <col class="col12">
        <col class="col13">
        <col class="col14">
        <col class="col15">
        <col class="col16">
        <col class="col17">
        <tbody>
            <tr class="row0">
                <td class="column0 style11 s style11" colspan="18">PENILAIAN CAPAIAN SASARAN KERJA</td>
            </tr>
            <tr class="row1">
                <td class="column0 style11 s style11" colspan="18">PEGAWAI POLITEKNIK NEGERI CILACAP</td>
            </tr>
            <tr class="row2">
                <td class="column0 style12 null style12" colspan="18"></td>
            </tr>
            <tr class="row3">
                <td class="column0 style21 s style21" colspan="18">Jangka Waktu Penilaian, 1 Januari s.d. 31 Desember
                    2021</td>
            </tr>
            <tr class="row4">
                <td class="column0 style16 s style16" rowspan="2">NO</td>
                <td class="column1 style17 s style17" rowspan="2">I. Kegiatan Tugas Jabatan</td>
                <td class="column2 style18 s style18" rowspan="2">AK</td>
                <td class="column3 style16 s style16" colspan="6">TARGET</td>
                <td class="column9 style16 s style16" rowspan="2">AK</td>
                <td class="column10 style16 s style16" colspan="6">REALISASI</td>
                <td class="column16 style14 s style14" rowspan="2">PENGHI- TUNGAN</td>
                <td class="column17 style14 s style14" rowspan="2">NILAI CAPAIAN SKP</td>
            </tr>
            <tr class="row5">
                <td class="column3 style15 s style15" colspan="2">Kuant/ Output</td>
                <td class="column5 style10 s">Kual/Mutu</td>
                <td class="column6 style15 s style15" colspan="2">Waktu</td>
                <td class="column8 style10 s">Biaya</td>
                <td class="column10 style15 s style15" colspan="2">Kuant/ Output</td>
                <td class="column12 style10 s">Kual/Mutu</td>
                <td class="column13 style15 s style15" colspan="2">Waktu</td>
                <td class="column15 style10 s">Biaya</td>
            </tr>
            <?php 
                $total_nilai = 0;
                $banyak_kegiatan = \App\Models\Sasaran::where('user_id', $user->id)->select('kegiatan_id')->groupBy('kegiatan_id')->get()->count();
            ?>
            @foreach ($rencanas as $rencana)
            <?php 
                $target_kuantitas = \App\Models\Sasaran::where('user_id', $user->id)->where('kegiatan_id', $rencana->kegiatan_id)->select('target_kuantitas', $rencana->kuantitas)->sum('target_kuantitas');
                $realisasi_kuantitas = \App\Models\Sasaran::where('kegiatan_id', $rencana->kegiatan->id)->sum('realisasi_kuantitas');
                
                $target_waktu = \App\Models\Sasaran::where('user_id', $user->id)->where('kegiatan_id', $rencana->kegiatan_id)->count();
                $realisasi_waktu = \App\Models\Sasaran::where('user_id', $user->id)->where('kegiatan_id', $rencana->kegiatan_id)->whereNotNull('realisasi_kuantitas')->count();
                
                $realisasi_kualitas = \App\Models\Sasaran::where('user_id', $user->id)->where('kegiatan_id', $rencana->kegiatan_id)->whereNotNull('realisasi_kualitas')->value('realisasi_kualitas');

                $target_biaya = \App\Models\Sasaran::where('user_id', $user->id)->where('kegiatan_id', $rencana->kegiatan_id)->whereNotNull('target_biaya')->value('target_biaya');
                $realisasi_biaya = \App\Models\Sasaran::where('user_id', $user->id)->where('kegiatan_id', $rencana->kegiatan_id)->whereNotNull('realisasi_biaya')->value('realisasi_biaya');

                $aspek_kuantitas = $realisasi_kuantitas/$target_kuantitas*100;
                $aspek_kualitas = $realisasi_kualitas/$rencana->target_kualitas*100;

                $persen_waktu = 100-($realisasi_waktu/$target_waktu*100);
                if ($persen_waktu > 24) {
                    $aspek_waktu = 76-((((1.76*$target_waktu-$realisasi_waktu)/$target_waktu)*100)-100);
                } elseif ($persen_waktu < 24) {
                    $aspek_waktu = ((1.76*$target_waktu-$realisasi_waktu)/$target_waktu)*100;
                }

                if (!empty($target_biaya)) {
                    $persen_biaya = 100-($realisasi_biaya/$target_biaya*100);
                    if ($persen_biaya > 24) {
                    $aspek_biaya = 76-((((1.76*$target_biaya-$realisasi_biaya)/$target_biaya)*100)-100);
                    } elseif ($persen_biaya < 24) {
                    $aspek_biaya = ((1.76*$target_biaya-$realisasi_biaya)/$target_biaya)*100;
                    }
                } else {
                    $persen_biaya = null;
                    $aspek_biaya = null;    
                }

                $perhitungan = $aspek_kuantitas + $aspek_kualitas + $aspek_waktu + $aspek_biaya;

                if (!empty($target_biaya)) {
                    if ($realisasi_biaya == null) {
                        $nilai_skp = $perhitungan/3;
                    } else {
                        $nilai_skp = $perhitungan/4;
                    }
                } else {
                    $nilai_skp = $perhitungan/3;
                }

                $total_nilai += $nilai_skp;
            ?>
            <tr class="row6">
                <td class="column0 style2 s">{{ $loop->iteration }}</td>
                <td class="column1 style20 s" style="padding-left: 9px;">{{ $rencana->kegiatan->nama }}</td>
                <td class="column2 style4 s">{{ $rencana->kegiatan->ak}}</td>
                <td class="column3 style2 s">{{ $target_kuantitas }}</td>
                <td class="column4 style2 s">{{ $rencana->output->nama }}</td>
                <td class="column5 style2 s">{{ $rencana->target_kualitas }}</td>
                <td class="column6 style2 s">{{ $target_waktu }}</td>
                <td class="column7 style2 s">Bulan</td>
                <td class="column8 style5 s">{{ $target_biaya ? $target_biaya : '-' }}</td>
                <td class="column9 style2 s">{{ $rencana->kegiatan->ak * $realisasi_kuantitas}}</td>
                <td class="column10 style2 s">{{ $realisasi_kuantitas }}</td>
                <td class="column11 style2 s">{{ $rencana->output->nama }}</td>
                <td class="column12 style2 s">{{ $realisasi_kualitas }}</td>
                <td class="column13 style2 s">{{ $realisasi_waktu }}</td>
                <td class="column14 style2 s">Bulan</td>
                <td class="column15 style6 s">{{ $realisasi_biaya ? $realisasi_biaya : '-' }}</td>
                <td class="column16 style4 s">{{ $perhitungan }}</td>
                <td class="column17 style4 s">{{ round($nilai_skp, 2) }}</td>
            </tr>
            @endforeach
            <tr class="row7">
                <td class="column0 style2 null"></td>
                <td class="column1 style3 null"></td>
                <td class="column2 style4 null"></td>
                <td class="column3 style2 null"></td>
                <td class="column4 style1 null"></td>
                <td class="column5 style2 null"></td>
                <td class="column6 style2 null"></td>
                <td class="column7 style2 null"></td>
                <td class="column8 style5 null"></td>
                <td class="column9 style2 null"></td>
                <td class="column10 style2 null"></td>
                <td class="column11 style1 null"></td>
                <td class="column12 style2 null"></td>
                <td class="column13 style2 null"></td>
                <td class="column14 style2 null"></td>
                <td class="column15 style6 null"></td>
                <td class="column16 style4 null"></td>
                <td class="column17 style7 null"></td>
            </tr>
            <tr class="row8">
                <td class="column0 style18 s style18" colspan="17" rowspan="2">Nilai Capaian SKP</td>
                <td class="column17 style8 null">{{ round($total_nilai / $banyak_kegiatan, 2) }}</td>
            </tr>
            <tr class="row9">
                <td class="column17 style9 null">sangat baik</td>
            </tr>
            <tr class="row10">
                <td class="column0 style12 null style12" colspan="18"></td>
            </tr>
            <tr class="row11">
                <td class="column0 style12 null style12" colspan="12" rowspan="5"></td>
                <td class="column12 style13 s style13" colspan="6">Cilacap, {{ Carbon\Carbon::now()->isoFormat('D
                    MMMM Y') }}</td>
            </tr>
            <tr class="row12">
                <td class="column12 style13 s style13" colspan="6">Pejabat Penilai,</td>
            </tr>
            <tr class="row13">
                <td class="column12 style12 s style12" colspan="6"><img style="width:150px;margin:-10px"
                        src="{{ asset('/files'.'/'. $user->penilai->ttd) }}" alt="ttd_pjb">
                </td>
            </tr>
            <tr class="row14">
                <td class="column12 style19 s style19" colspan="6">{{ $user->penilai->name }}</td>
            </tr>
            <tr class="row15">
                <td class="column12 style12 s style12" colspan="6">{{ $user->penilai->nip }}</td>
            </tr>
        </tbody>
    </table>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>