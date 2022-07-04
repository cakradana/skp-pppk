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
    @page { margin-left: 0.7in; margin-right: 0.7in; margin-top: 0.75in; margin-bottom: 0.75in; }
    body { margin-left: 0.7in; margin-right: 0.7in; margin-top: 0.75in; margin-bottom: 0.75in; }
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
                <td class="column0 style8 s style8" colspan="11">FORMULIR SASARAN KERJA</td>
            </tr>
            <tr class="row1">
                <td class="column0 style8 f style8" colspan="11">PEGAWAI POLITEKNIK NEGERI CILACAP</td>
            </tr>
            <tr class="row2">
                <td class="column0 style9 null"></td>
                <td class="column1 style9 null"></td>
                <td class="column2 style9 null"></td>
                <td class="column3 style9 null"></td>
                <td class="column4 style9 null"></td>
                <td class="column5 style9 null"></td>
                <td class="column6 style9 null"></td>
                <td class="column7 style9 null"></td>
                <td class="column8 style9 null"></td>
                <td class="column9 style9 null"></td>
                <td class="column10 style9 null"></td>
            </tr>
            <tr class="row3">
                <td class="column0 style10 s">NO</td>
                <td class="column1 style57 s style58" colspan="2">I. PEJABAT PENILAI</td>
                <td class="column3 style59 null"></td>
                <td class="column4 style10 s">NO</td>
                <td class="column5 style43 s style45" colspan="6">II. PEGAWAI NEGERI SIPIL YANG DINILAI</td>
            </tr>
            <tr class="row4">
                <td class="column0 style11 n">1</td>
                <td class="column1 style60 s">Nama</td>
                <td class="column2 style48 s style47" colspan="2">{{ $login->penilai->name }}</td>
                <td class="column4 style12 n">1</td>
                <td class="column5 style46 s style47" colspan="2">Nama</td>
                <td class="column7 style48 s style47" colspan="4">{{ $login->name }}</td>
            </tr>
            <tr class="row5">
                <td class="column0 style13 n">2</td>
                <td class="column1 style61 s">NIP</td>
                <td class="column2 style51 s style50" colspan="2">{{ $login->penilai->nip }}</td>
                <td class="column4 style14 n">2</td>
                <td class="column5 style49 s style50" colspan="2">NIP</td>
                <td class="column7 style51 s style53" colspan="4">{{ $login->nip }}</td>
            </tr>
            <tr class="row6">
                <td class="column0 style13 n">3</td>
                <td class="column1 style61 s">Pangkat/Gol.Ruang</td>
                <td class="column2 style62 s style50" colspan="2">{{ $login->penilai->pangkat->nama }}</td>
                <td class="column4 style14 n">3</td>
                <td class="column5 style49 s style50" colspan="2">Pangkat/Gol.Ruang</td>
                <td class="column7 style51 s style53" colspan="4">{{ $login->pangkat->nama }}</td>
            </tr>
            <tr class="row7">
                <td class="column0 style13 n">4</td>
                <td class="column1 style61 s">Jabatan</td>
                <td class="column2 style62 s style50" colspan="2">{{ $login->penilai->jabatan->nama }}</td>
                <td class="column4 style14 n">4</td>
                <td class="column5 style49 s style50" colspan="2">Jabatan</td>
                <td class="column7 style51 s style53" colspan="4">{{ $login->jabatan->nama }}</td>
            </tr>
            <tr class="row8">
                <td class="column0 style15 n">5</td>
                <td class="column1 style61 s">Unit Kerja</td>
                <td class="column2 style63 s style64" colspan="2">Politeknik Negeri Cilacap</td>
                <td class="column4 style16 n">5</td>
                <td class="column5 style54 s style55" colspan="2">Unit Kerja</td>
                <td class="column7 style56 s style55" colspan="4">Politeknik Negeri Cilacap</td>
            </tr>
            <tr class="row9">
                <td class="column0 style17 s style18" rowspan="2">NO</td>
                <td class="column1 style57 s style66" colspan="3" rowspan="2">III. KEGIATAN TUGAS JABATAN</td>
                <td class="column4 style19 s style42" rowspan="2">AK</td>
                <td class="column5 style19 s style19" colspan="6">TARGET</td>
            </tr>
            <tr class="row10">
                <td class="column5 style20 s style21" colspan="2">KUANT/OUTPUT</td>
                <td class="column7 style22 s">KUAL/MUTU</td>
                <td class="column8 style20 s style20" colspan="2">WAKTU</td>
                <td class="column10 style23 s">BIAYA</td>
            </tr>
            @foreach ($rencanas as $rencana)
            <?php 
                $kuantitas = \App\Models\Rencana::where('user_id', $login->id)->where('kegiatan_id', $rencana->kegiatan_id)->select('kuantitas', $rencana->kuantitas)->sum('kuantitas');
                $waktu = \App\Models\Rencana::where('user_id', $login->id)->where('kegiatan_id', $rencana->kegiatan_id)->count();
            ?>
            <tr class="row11">
                <td class="column0 style24 n">{{$loop->iteration }}</td>
                <td class="column1 style67 s style69" colspan="3">{{ $rencana->kegiatan->nama }}</td>
                <td class="column4 style1 s">{{ $rencana->kegiatan->ak * $kuantitas }}</td>
                <td class="column5 style25 s">{{ $kuantitas }}</td>
                <td class="column6 style26 s">{{ $rencana->output }}</td>
                <td class="column7 style27 s">100</td>
                <td class="column8 style28 s">{{ $waktu }}</td>
                <td class="column9 style28 s">Bln</td>
                <td class="column10 style29 s">-</td>
            </tr>
            @endforeach
            <tr class="row12">
                <td class="column0 style24 null"></td>
                <td class="column1 style70 null style70" colspan="3"></td>
                <td class="column4 style5 null"></td>
                <td class="column5 style25 null"></td>
                <td class="column6 style26 null"></td>
                <td class="column7 style27 null"></td>
                <td class="column8 style28 null"></td>
                <td class="column9 style28 null"></td>
                <td class="column10 style29 null"></td>
            </tr>
            <tr class="row13">
                <td class="column0 style2 null"></td>
                <td class="column1 style70 s style70" colspan="3">JUMLAH</td>
                <td class="column4 style5 null"></td>
                <td class="column5 style3 null"></td>
                <td class="column6 style4 null"></td>
                <td class="column7 style1 null"></td>
                <td class="column8 style28 null"></td>
                <td class="column9 style28 null"></td>
                <td class="column10 style6 null"></td>
            </tr>
            <tr class="row14">
                <td class="column0 style30 null"></td>
                <td class="column1 style7 null"></td>
                <td class="column2 style7 null"></td>
                <td class="column3 style31 null"></td>
                <td class="column4 style30 null"></td>
                <td class="column5 style30 null"></td>
                <td class="column6 style32 null"></td>
                <td class="column7 style33 null"></td>
                <td class="column8 style30 null"></td>
                <td class="column9 style30 null"></td>
                <td class="column10 style34 null"></td>
            </tr>
            <tr class="row15">
                <td class="column0 style35 null"></td>
                <td class="column1 style35 null"></td>
                <td class="column2 style35 null"></td>
                <td class="column3 style35 null"></td>
                <td class="column4 style35 null"></td>
                <td class="column5 style35 null"></td>
                <td class="column6 style36 s style36" colspan="5">tmpt, tgl bln thn</td>
            </tr>
            <tr class="row16">
                <td class="column0 style36 s style36" colspan="3">Pejabat Penilai,</td>
                <td class="column3 style37 null"></td>
                <td class="column4 style35 null"></td>
                <td class="column5 style38 null"></td>
                <td class="column6 style36 s style36" colspan="5">Pegawai Yang Dinilai</td>
            </tr>
            <tr class="row17">
                <td class="column0 style35 null"></td>
                <td class="column1 style35 null"></td>
                <td class="column2 style35 null"></td>
                <td class="column3 style35 null"></td>
                <td class="column4 style35 null"></td>
                <td class="column5 style35 null"></td>
                <td class="column6 style35 null"></td>
                <td class="column7 style35 null"></td>
                <td class="column8 style35 null"></td>
                <td class="column9 style35 null"></td>
                <td class="column10 style35 null"></td>
            </tr>
            <tr class="row18">
                <td class="column0 style35 null"></td>
                <td class="column1 style35 null"></td>
                <td class="column2 style35 null"></td>
                <td class="column3 style35 null"></td>
                <td class="column4 style35 null"></td>
                <td class="column5 style35 null"></td>
                <td class="column6 style35 null"></td>
                <td class="column7 style35 null"></td>
                <td class="column8 style35 null"></td>
                <td class="column9 style35 null"></td>
                <td class="column10 style35 null"></td>
            </tr>
            <tr class="row19">
                <td class="column0 style35 null"></td>
                <td class="column1 style35 null"></td>
                <td class="column2 style35 null"></td>
                <td class="column3 style35 null"></td>
                <td class="column4 style35 null"></td>
                <td class="column5 style35 null"></td>
                <td class="column6 style35 null"></td>
                <td class="column7 style35 null"></td>
                <td class="column8 style35 null"></td>
                <td class="column9 style35 null"></td>
                <td class="column10 style35 null"></td>
            </tr>
            <tr class="row20">
                <td class="column0 style39 f style39" colspan="3">{{ $login->penilai->name }}</td>
                <td class="column3 style40 null"></td>
                <td class="column4 style40 null"></td>
                <td class="column5 style41 null"></td>
                <td class="column6 style39 f style39" colspan="5">{{ $login->name }}</td>
            </tr>
            <tr class="row21">
                <td class="column0 style36 f style36" colspan="3">{{ $login->penilai->nip }}</td>
                <td class="column3 style35 null"></td>
                <td class="column4 style35 null"></td>
                <td class="column5 style35 null"></td>
                <td class="column6 style36 f style36" colspan="5">{{ $login->nip }}</td>
            </tr>
            </tbody>
        </table>
        <script type="text/javascript">
            window.print();
        </script>
    </body>
</html>
