<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Perilaku;
use Illuminate\Http\Request;

class PenilaianPerilakuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $perilakus = User::where('penilai_id', $user->id)->get();


        return view('penilaian.perilaku.index', [
            "title" => "Penilaian Perilaku Pegawai",
            "user" => $user,
            "perilakus" => $perilakus
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => ['required'],
            'penilai_id' => ['required'],
            'orientasi_pelayanan' => ['required'],
            'integritas' => ['required'],
            'komitmen' => ['required'],
            'disiplin' => ['required'],
            'kerjasama' => ['required'],
            'kepemimpinan' => ['required'],
        ]);

        Perilaku::create($validatedData);

        return back()->with('toast_success', 'Berhasil Tambah Perilaku');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perilaku = Perilaku::where('user_id', $id)->first();
        $perilaku->delete();

        return back()->with('toast_success', 'Berhasil Reset Perilaku');
    }
}
