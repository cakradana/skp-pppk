<?php

namespace App\Http\Controllers;

use App\Models\User;
// use App\Models\Rencana;
use App\Models\Sasaran;
use Illuminate\Http\Request;

class PersetujuanRencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $pengajuans = Sasaran::where('penilai_id', $user->id)->select(['status', 'user_id'])->groupBy(['user_id', 'status'])->get();

        return view('penilaian.rencana.index', [
            "title" => "Persetujuan Rencana SKP",
            "user" => $user,
            "pengajuans" => $pengajuans
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();

        $disetujui = Sasaran::where('user_id', $id)->where('status', 'Disetujui')->get();
        if (count($disetujui) > 0) {
            $atribut = 'true';
        } else {
            $atribut = 'false';
        }
        $rencanas = Sasaran::where('user_id', $id)->select(['kegiatan_id', 'output'])->groupBy(['kegiatan_id', 'output'])->get();
        $pegawai = User::find($id);

        return view('penilaian.rencana.show', [
            'title' => "Detail Rencana SKP",
            "user" => $user,
            'pegawai' => $pegawai,
            'rencanas' => $rencanas,
            'atribut' => $atribut
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function setuju(Request $request, $id)
    {
        Sasaran::where('user_id', $id)->update([
            'status' => 'Disetujui'
        ]);

        return redirect('/persetujuan/rencana-pegawai')->with('toast_success', 'Pengajuan telah berhasil disetujui!');
    }

    public function tolak(Request $request, $id)
    {
        Sasaran::where('user_id', $id)->update([
            'status' => 'Belum Disetujui'
        ]);

        return redirect('/persetujuan/rencana-pegawai')->with('toast_success', 'Pengajuan telah berhasil ditolak!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
