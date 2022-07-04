<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master.jabatan.index', [
            "title" => "Master Jabatan",
            "jabatans" => Jabatan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.jabatan.create', [
            "title" => "Tambah Jabatan"
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
        $validatedData = $request->validate([
            'nama' => ['required', 'unique:jabatans']
        ]);

        Jabatan::create($validatedData);

        return redirect('/master/jabatan')->with('toast_success', 'Jabatan telah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        return view('master.jabatan.edit', [
            "title" => "Edit Jabatan",
            'jabatan' => $jabatan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Models\Jabatan  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $rules = [
            'nama' => ['required', 'unique:jabatans']
        ];

        $validatedData = $request->validate($rules);

        Jabatan::where('id', $jabatan->id)->update($validatedData);

        return redirect('/master/jabatan')->with('toast_success', 'Jabatan telah berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        Jabatan::destroy($jabatan->id);

        return redirect('/master/jabatan')->with('toast_success', 'Jabatan telah berhasil dihapus!');
    }
}
