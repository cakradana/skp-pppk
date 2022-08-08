<?php

namespace App\Http\Controllers;

use App\Models\Sasaran;
use Illuminate\Http\Request;

class PenilaianRealisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);

        $user = auth()->user();

        $bulan = $request->bulan;

        if ($bulan == "Januari" || $bulan == null) {
            $pengajuans = Sasaran::where('penilai_id', $user->id)->select(['user_id', 'bulan'])->groupBy(['user_id', 'bulan'])->where('bulan', 'Januari')->get();
            $bulan = "Januari";
        } else {
            $pengajuans = Sasaran::where('penilai_id', $user->id)->select(['user_id', 'bulan'])->groupBy(['user_id', 'bulan'])->where('bulan', $bulan)->get();
        }

        $pengajuans = Sasaran::where('penilai_id', $user->id)->select(['user_id', 'bulan'])->groupBy(['user_id', 'bulan'])->where('bulan', $bulan)->get();


        // $status = Sasaran::where('penilai_id', $user->id)
        //     ->where('user_id', 1)
        //     ->select('realisasi_kuantitas')
        //     ->get();

        // dd($status);

        return view('penilaian.realisasi.index', [
            "title" => "Penilaian Realisasi SKP",
            "user" => $user,
            "selected" => $bulan,
            "pengajuans" => $pengajuans
        ]);



        $user = auth()->user();

        return view('penilaian.realisasi.index', [
            "title" => "Penilaian Realisasi SKP",
            "user" => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Models\Jabatan  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Models\Jabatan  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
