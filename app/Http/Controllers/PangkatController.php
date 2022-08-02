<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master.pangkat.index', [
            "title" => "Master Pangkat",
            "pangkats" => Pangkat::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.pangkat.create', [
            "title" => "Tambah Pangkat"
        ]);
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
            'nama' => ['required', 'unique:pangkats']
        ]);

        Pangkat::create($validatedData);

        return redirect('/master/pangkat')->with('toast_success', 'Pangkat telah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function show(Pangkat $pangkat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function edit(Pangkat $pangkat)
    {
        return view('master.pangkat.edit', [
            "title" => "Edit Pangkat",
            'pangkat' => $pangkat
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pangkat $pangkat)
    {
        $rules = [
            'nama' => ['required', 'unique:pangkats']
        ];

        $validatedData = $request->validate($rules);

        Pangkat::where('id', $pangkat->id)->update($validatedData);

        return redirect('/master/pangkat')->with('toast_success', 'Pangkat telah berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pangkat $pangkat)
    {
        // dd($pangkat->users);

        if ($pangkat->users->first()) {
            return redirect('/master/pangkat')->with('toast_error', 'Pangkat tidak dapat dihapus!');
        }

        Pangkat::destroy($pangkat->id);

        return redirect('/master/pangkat')->with('toast_success', 'Pangkat telah berhasil dihapus!');
    }
}
