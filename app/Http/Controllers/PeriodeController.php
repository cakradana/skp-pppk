<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        return view('master.periode.index', [
            "title" => "Master Periode",
            "periodes" => Periode::all()
        ]);
    }

    public function create()
    {
        return view('master.periode.create', [
            "title" => "Tambah Periode"
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required'],
            'awal' => ['required'],
            'akhir' => ['required']
        ]);

        Periode::create($validatedData);

        return redirect('/master/periode')->with('success', 'Periode telah berhasil ditambahkan!');
    }

    public function show()
    {
        // 
    }

    public function edit(Periode $periode)
    {
        return view('master.periode.edit', [
            "title" => "Edit Periode",
            'periode' => $periode
        ]);
    }

    public function update(Request $request, Periode $periode)
    {
        $rules = [
            'nama' => ['required'],
            'awal' => ['required'],
            'akhir' => ['required']
        ];

        $validatedData = $request->validate($rules);

        Periode::where('id', $periode->id)->update($validatedData);

        return redirect('/master/periode')->with('success', 'Periode telah berhasil diubah!');
    }

    public function destroy(Periode $periode)
    {
        Periode::destroy($periode->id);

        return redirect('/master/periode')->with('success', 'Periode telah berhasil dihapus!');
    }
}
