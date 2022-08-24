<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Perilaku;
use App\Models\Sasaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NilaiPrestasiKerjaController extends Controller
{
    public function pegawai()
    {
        $user = auth()->user();

        $nilai = Nilai::where('user_id', $user->id)->first();

        $nilai_skp = $nilai->nilai_skp;

        $nilai_perilaku = $nilai->nilai_perilaku;

        $perilaku = Perilaku::where('user_id', $user->id)->first();

        $orientasi_pelayanan = $perilaku->orientasi_pelayanan;
        $integritas = $perilaku->integritas;
        $komitmen = $perilaku->komitmen;
        $disiplin = $perilaku->disiplin;
        $kerjasama = $perilaku->kerjasama;
        $kepemimpinan = $perilaku->kepemimpinan;

        $jumlah = $orientasi_pelayanan + $integritas + $komitmen + $disiplin + $kerjasama + $kepemimpinan;

        $final = (($nilai_skp * 60) / 100) + (($nilai_perilaku * 40) / 100);

        $nilaiPrestasi['nilai_prestasi'] = round($final, 2);

        Nilai::where('user_id', $user->id)->update($nilaiPrestasi);

        return view('nilai.pegawai', [
            "title" => "Nilai Prestasi Kerja",
            "final" => $final,
            "jumlah" => $jumlah,
            "nilai_skp" => $nilai_skp,
            "nilai_perilaku" => $nilai_perilaku,
            "orientasi_pelayanan" => $orientasi_pelayanan,
            "integritas" => $integritas,
            "komitmen" => $komitmen,
            "disiplin" => $disiplin,
            "kerjasama" => $kerjasama,
            "kepemimpinan" => $kepemimpinan,
            'user' => $user,
        ]);
    }

    public function penilai()
    {
        $user = auth()->user();

        $pegawais = Nilai::where('penilai_id', $user->id)->get();

        return view('nilai.penilai', [
            "title" => "Nilai Prestasi Kerja",
            'pegawais' => $pegawais,
            'user' => $user,
        ]);
    }

    public function monitor_rencana(Request $request)
    {
        if ($request->periode == null) {
            $periode = 2022;
        } else {
            $periode = $request->periode;
        }

        $user = auth()->user();

        $pegawais = User::where('role', 'Pegawai yang Dinilai')->get();

        return view('monitoring.rencana', [
            'title' => "Monitoring Rencana Pegawai",
            'periode' => $periode,
            'user' => $user,
            'pegawais' => $pegawais
        ]);
    }

    public function monitor_nilai(Request $request)
    {
        // dd($request->all());

        if ($request->periode == null) {
            $periode = 2022;
        } else {
            $periode = $request->periode;
        }

        $user = auth()->user();

        $pegawais = Nilai::whereYear('updated_at', $periode)->get();

        return view('monitoring.nilai', [
            "title" => "Monitoring Nilai Pegawai",
            'periode' => $periode,
            'user' => $user,
            'pegawais' => $pegawais
        ]);
    }
}
