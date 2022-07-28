<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        return view('master.kegiatan.index', [
            "user" => $user,
            "title" => "Master Kegiatan Tugas Jabatan",
            "kegiatans" => Kegiatan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        return view('master.kegiatan.create', [
            "user" => $user,
            "title" => "Tambah Kegiatan Tugas Jabatan",
            'jabatans' => Jabatan::all()
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
            'jabatan_id' => ['required'],
            'nama' => ['required'],
            'ak' => ['required']
        ]);

        // if ($request->file('image')) {
        //     $validatedData['image'] = $request->file('image')->store('post-images');
        // }

        // $validatedData['user_id'] = auth()->user()->id;
        // $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Kegiatan::create($validatedData);

        return redirect('/master/kegiatan')->with('toast_success', 'Kegiatan Tugas Jabatan telah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kegiatan $kegiatan)
    {
        $user = auth()->user();
        return view('master.kegiatan.edit', [
            "user" => $user,
            "title" => "Edit Kegiatan Tugas Jabatan",
            'kegiatan' => $kegiatan,
            'jabatans' => Jabatan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $rules = [
            'jabatan_id' => ['required'],
        ];

        if ($request->nama != $kegiatan->nama) {
            $rules['nama'] = ['required', 'unique:kegiatans'];
        }

        $validatedData = $request->validate($rules);

        Kegiatan::where('id', $kegiatan->id)->update($validatedData);

        return redirect('/master/kegiatan')->with('toast_success', 'Kegiatan Tugas Jabatan telah berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kegiatan  $kegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatan $kegiatan)
    {
        // dd($kegiatan);
        if ($kegiatan->sasaran->first()) {
            return redirect('/master/kegiatan')->with('toast_error', 'Kegiatan Tugas Jabatan tidak dapat dihapus!');
        }
        Kegiatan::destroy($kegiatan->id);
        return redirect('/master/kegiatan')->with('toast_success', 'Kegiatan Tugas Jabatan telah berhasil dihapus!');
    }
}
