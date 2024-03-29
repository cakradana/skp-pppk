<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\User;
use App\Models\Pangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $user = auth()->user();

        return view('master.penilai.index', [
            "user" => $user,
            "title" => "Master Penilai",
            "penilais" => User::where('role', 'Pejabat Penilai')->get()
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

        return view('master.penilai.create', [
            "user" => $user,
            "title" => "Tambah Penilai",
            'pangkats' => Pangkat::all(),
            'jabatans' => Jabatan::all(),
            'atasan' => User::where('role', 'Atasan Pejabat Penilai')->first()
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
            'role' => ['required'],
            'name' => ['required'],
            'nip' => ['required', 'unique:users', 'min:18', 'numeric'],
            'pangkat_id' => ['required'],
            'jabatan_id' => ['required'],
            'password' => ['required'],
            'atasan_id' => ['required']
        ]);

        // if ($request->file('image')) {
        //     $validatedData['image'] = $request->file('image')->store('post-images');
        // }

        // $validatedData['user_id'] = auth()->user()->id;
        // $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/master/penilai')->with('toast_success', 'Penilai telah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $penilai)
    {
        $user = auth()->user();

        return view('master.penilai.show', [
            "user" => $user,
            'title' => "Detail Penilai",
            'penilai' => $penilai
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $penilai)
    {
        return view('master.penilai.edit', [
            "title" => "Edit Penilai",
            'penilai' => $penilai,
            'pangkats' => Pangkat::all(),
            'jabatans' => Jabatan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $penilai)
    {
        $rules = [
            'name' => ['required'],
            'pangkat_id' => ['required'],
            'jabatan_id' => ['required']
        ];

        if ($request->nip != $penilai->nip) {
            $rules['nip'] = ['required', 'unique:users', 'min:18', 'numeric'];
        }

        $validatedData = $request->validate($rules);

        User::where('id', $penilai->id)->update($validatedData);

        return redirect('/master/penilai')->with('toast_success', 'Penilai telah berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $penilai)
    {
        // dd($penilai->pegawai);

        if ($penilai->pegawai->first()) {
            return redirect('/master/penilai')->with('toast_error', 'Penilai tidak dapat dihapus!');
        }

        User::destroy($penilai->id);

        return redirect('/master/penilai')->with('toast_success', 'Penilai telah berhasil dihapus!');
    }
}
