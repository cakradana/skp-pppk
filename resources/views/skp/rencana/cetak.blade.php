<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="generator" content="PhpSpreadsheet, https://github.com/PHPOffice/PhpSpreadsheet">
    <meta name="author" content="R. Cakradana A. Yudhatama" />
    <link rel="stylesheet" href="/assets/dist/css/cetak-rencana.css">
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
        <tbody>
            <tr class="row0">
                <td class="column0 style10 s style10" colspan="11">FORMULIR SASARAN KERJA</td>
            </tr>
            <tr class="row1">
                <td class="column0 style10 f style10" colspan="11">PEGAWAI POLITEKNIK NEGERI CILACAP</td>
            </tr>
            <tr class="row2">
                <td class="column0 style8 null style8" colspan="11"></td>
            </tr>
            <tr class="row3">
                <td class="column0 style28 s">NO</td>
                <td class="column1 style29 s style29" colspan="3">I. PEJABAT PENILAI</td>
                <td class="column4 style28 s">NO</td>
                <td class="column5 style29 s style29" colspan="6">II. PEGAWAI YANG DINILAI</td>
            </tr>
            <tr class="row4">
                <td class="column0 style4 n">1</td>
                <td class="column1 style14 s">Nama</td>
                <td class="column2 style15 s style15" colspan="2">{{ $user->penilai->name }}</td>
                <td class="column4 style4 n">1</td>
                <td class="column5 style15 s style15" colspan="2">Nama</td>
                <td class="column7 style15 s style15" colspan="4">{{ $user->name }}</td>
            </tr>
            <tr class="row5">
                <td class="column0 style4 n">2</td>
                <td class="column1 style14 s">NIP</td>
                <td class="column2 style16 s style15" colspan="2">{{ $user->penilai->nip }}</td>
                <td class="column4 style4 n">2</td>
                <td class="column5 style15 s style15" colspan="2">NIP</td>
                <td class="column7 style16 s style16" colspan="4">{{ $user->nip }}</td>
            </tr>
            <tr class="row6">
                <td class="column0 style4 n">3</td>
                <td class="column1 style14 s">Pangkat/Gol.Ruang</td>
                <td class="column2 style15 s style15" colspan="2">{{ $user->penilai->pangkat->nama }}</td>
                <td class="column4 style4 n">3</td>
                <td class="column5 style15 s style15" colspan="2">Pangkat/Gol.Ruang</td>
                <td class="column7 style16 s style16" colspan="4">{{ $user->pangkat->nama }}</td>
            </tr>
            <tr class="row7">
                <td class="column0 style4 n">4</td>
                <td class="column1 style14 s">Jabatan</td>
                <td class="column2 style15 s style15" colspan="2">{{ $user->penilai->jabatan->nama }}</td>
                <td class="column4 style4 n">4</td>
                <td class="column5 style15 s style15" colspan="2">Jabatan</td>
                <td class="column7 style16 s style16" colspan="4">{{ $user->jabatan->nama }}</td>
            </tr>
            <tr class="row8">
                <td class="column0 style4 n">5</td>
                <td class="column1 style14 s">Unit Kerja</td>
                <td class="column2 style5 s style5" colspan="2">Politeknik Negeri Cilacap</td>
                <td class="column4 style4 n">5</td>
                <td class="column5 style15 s style15" colspan="2">Unit Kerja</td>
                <td class="column7 style15 s style15" colspan="4">Politeknik Negeri Cilacap</td>
            </tr>
            <tr class="row9">
                <td class="column0 style6 s style6" rowspan="2">NO</td>
                <td class="column1 style13 s style13" colspan="3" rowspan="2">III. KEGIATAN TUGAS JABATAN</td>
                <td class="column4 style6 s style7" rowspan="2">AK</td>
                <td class="column5 style6 s style6" colspan="6">TARGET</td>
            </tr>
            <tr class="row10">
                <td class="column5 style17 s style17" colspan="2">KUANT/OUTPUT</td>
                <td class="column7 style18 s">KUAL/MUTU</td>
                <td class="column8 style17 s style17" colspan="2">WAKTU</td>
                <td class="column10 style18 s">BIAYA</td>
            </tr>
            @foreach ($rencanas as $rencana)
            <?php 
            $kuantitas = \App\Models\Rencana::where('user_id', $user->id)->where('kegiatan_id', $rencana->kegiatan_id)->select('kuantitas', $rencana->kuantitas)->sum('kuantitas');
            $waktu = \App\Models\Rencana::where('user_id', $user->id)->where('kegiatan_id', $rencana->kegiatan_id)->count();
        ?>
            <tr class="row11">
                <td class="column0 style4 n">{{$loop->iteration }}</td>
                <td class="column1 style5 s style5" colspan="3">{{ $rencana->kegiatan->nama }}</td>
                <td class="column4 style1 s">{{ $rencana->kegiatan->ak * $kuantitas }}</td>
                <td class="column5 style4 s">{{ $kuantitas }}</td>
                <td class="column6 style19 s">{{ $rencana->output }}</td>
                <td class="column7 style2 s">100</td>
                <td class="column8 style3 s">{{ $waktu }}</td>
                <td class="column9 style3 s">Bln</td>
                <td class="column10 style20 s">-</td>
            </tr>
            @endforeach
            <tr class="row12">
                <td class="column0 style4 null"></td>
                <td class="column1 style5 null style5" colspan="3"></td>
                <td class="column4 style1 null"></td>
                <td class="column5 style4 null"></td>
                <td class="column6 style19 null"></td>
                <td class="column7 style2 null"></td>
                <td class="column8 style3 null"></td>
                <td class="column9 style3 null"></td>
                <td class="column10 style20 null"></td>
            </tr>
            <tr class="row13">
                <td class="column0 style21 null"></td>
                <td class="column1 style22 s style22" colspan="3">JUMLAH</td>
                <td class="column4 style21 null"></td>
                <td class="column5 style21 null"></td>
                <td class="column6 style23 null"></td>
                <td class="column7 style21 null"></td>
                <td class="column8 style24 null"></td>
                <td class="column9 style24 null"></td>
                <td class="column10 style25 null"></td>
            </tr>
            <tr class="row14">
                <td class="column0 style9 null style9" colspan="4"></td>
                <td class="column4 style9 null style9" colspan="7"></td>
            </tr>
            <tr class="row15">
                <td class="column0 style11 null style11" colspan="4"></td>
                <td class="column4 style11 s style11" colspan="7">Cilacap, {{ Carbon\Carbon::now()->isoFormat('D
                    MMMM Y')
                    }}</td>
            </tr>
            <tr class="row16">
                <td class="column0 style11 s style11" colspan="4">Pejabat Penilai,</td>
                <td class="column4 style11 s style11" colspan="7">Pegawai Yang Dinilai</td>
            </tr>
            <tr class="row17">
                <td class="column0 style26 s style26" colspan="4"><img style="width:200px;margin:-50px"
                        src="{{ asset('/files'.'/'. $user->penilai->ttd) }}" alt="ttd_pjb">
                </td>
                <td class="column4 style26 s style26" colspan="7"><img style="width:200px;margin:-50px"
                        src="{{ asset('/files'.'/'. $user->ttd) }}" alt="ttd_pgw"></td>
            </tr>
            <tr class="row20">
                <td class="column0 style12 f style12" colspan="4">{{ $user->penilai->name }}</td>
                <td class="column4 style12 f style12" colspan="7">{{ $user->name }}</td>
            </tr>
            <tr class="row21">
                <td class="column0 style11 f style11" colspan="4">{{ $user->penilai->nip }}</td>
                <td class="column4 style27 f style27" colspan="7">{{ $user->nip }}</td>
            </tr>
        </tbody>
    </table>
    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>