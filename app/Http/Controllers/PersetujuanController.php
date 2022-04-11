<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rencana;

class PersetujuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $pengajuans = Rencana::where('penilai_id', $user->id)->select(['status', 'user_id'])->groupBy(['user_id', 'status'])->get();
        // $list = $pengajuan->user()->get();

        return view('penilaian.rencana.index', [
            "title" => "Persetujuan Rencana SKP",
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

        return view('penilaian.rencana.show', [
            'title' => "Detail Rencana SKP",
            'rencanas' => Rencana::where('penilai_id', $user->id)->get()
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
    public function update(Request $request, $id)
    {
        Rencana::where('user_id', $id)->update([
            'status' => 'disetujui'
        ]);

        return redirect('/penilaian/persetujuan')->with('success', 'Pengajuan telah berhasil diupdate!');
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
