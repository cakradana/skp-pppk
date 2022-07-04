<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rencana;
use App\Models\Realisasi;

class PengajuanRealisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $login = auth()->user();

        $disetujui = Rencana::where('user_id', $login->id)->where('status', 'disetujui')->get();

        if (count($disetujui) > 0) {
            $atribut = 'true';
        } else {
            $atribut = 'false';
        }

        // $rencana = Rencana::where('user_id', auth()->user()->id)->get();

        $rencana = Rencana::where('user_id', $login->id)->select(['kegiatan_id', 'output'])->groupBy(['kegiatan_id', 'output'])->get();

        // dd($waktu);

        return view('skp.realisasi.index', [
            "title" => "Pengajuan Realisasi SKP",
            "login" => $login,
            "rencanas" => $rencana,
            "atribut" => $atribut
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $login = auth()->user();

        $rencana = Rencana::where('user_id', $login->id)->select(['id', 'kegiatan_id', 'kuantitas', 'output', 'bulan'])->groupBy(['id', 'kegiatan_id', 'kuantitas', 'output', 'bulan'])->get();

        // $realisasi = Realisasi::where('')
        // dd($rencana);

        return view('skp.realisasi.create', [
            "title" => "Isi Realisasi Per Bulan",
            "rencanas" => $rencana
        ]);
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
