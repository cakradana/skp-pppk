<?php

namespace App\Http\Controllers;

use App\Models\Sasaran;
use App\Models\User;
use Illuminate\Http\Request;

class PenilaianRealisasiController extends Controller
{
    public function index(Request $request)
    {

        // dd($request);

        $user = auth()->user();

        // $bulan = $request->bulan;

        // if ($bulan == "Januari" || $bulan == null) {
        //     $pengajuans = Sasaran::where('penilai_id', $user->id)->select(['user_id', 'bulan'])->groupBy(['user_id', 'bulan'])->where('bulan', 'Januari')->whereNotNull('realisasi_kuantitas')->get();
        //     $bulan = "Januari";
        // } else {
        //     $pengajuans = Sasaran::where('penilai_id', $user->id)->select(['user_id', 'bulan'])->groupBy(['user_id', 'bulan'])->where('bulan', $bulan)->whereNotNull('realisasi_kuantitas')->get();
        // }

        $pengajuans = Sasaran::where('penilai_id', $user->id)->select(['user_id'])->groupby('user_id')->get();


        return view('penilaian.realisasi.index', [
            "title" => "Penilaian Realisasi SKP",
            "user" => $user,
            // "selected" => $bulan,
            "pengajuans" => $pengajuans
        ]);



        $user = auth()->user();

        return view('penilaian.realisasi.index', [
            "title" => "Penilaian Realisasi SKP",
            "user" => $user
        ]);
    }

    public function create()
    {
        // 
    }

    public function store(Request $request)
    {
        // 
    }

    public function show($id)
    {
        //
    }

    public function edit($id, Request $request)
    {
        $penilai = auth()->user();

        $bulan = $request->bulan;

        // $pengajuans = Sasaran::where('penilai_id', $user->id)->where('user_id', $id)->get();

        if ($bulan == "Semua Bulan" || $bulan == null) {
            $pengajuans = Sasaran::where('user_id', $id)->get();
            $bulan = "Semua Bulan";
        } else {
            $pengajuans = Sasaran::where('user_id', $id)->where('bulan', $bulan)->get();
        }

        $user = User::find($id);

        return view('penilaian.realisasi.edit', [
            "title" => "Penilaian Realisasi SKP " . $user->name,
            "user" => $penilai,
            "pegawai" => $user,
            "selected" => $bulan,
            "pengajuans" => $pengajuans
        ]);
    }

    public function update(Request $request, $id)
    {
        // 
    }

    public function destroy($id)
    {
        //
    }
}
