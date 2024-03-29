<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Pangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master.pegawai.index', [
            "title" => "Master Pegawai",
            "pegawais" => User::where('role', 'Pegawai yang Dinilai')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.pegawai.create', [
            "title" => "Tambah Pegawai",
            'pangkats' => Pangkat::all(),
            'jabatans' => Jabatan::all(),
            'penilais' => User::where('role', 'Pejabat Penilai')->get(),
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
            'penilai_id' => ['required'],
            'atasan_id' => ['required']
        ]);

        // if ($request->file('image')) {
        //     $validatedData['image'] = $request->file('image')->store('post-images');
        // }

        // $validatedData['user_id'] = auth()->user()->id;
        // $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);
        $nilaiData['user_id'] = $user->id;
        $nilaiData['penilai_id'] = $validatedData['penilai_id'];
        Nilai::create($nilaiData);

        return redirect('/master/pegawai')->with('toast_success', 'Pegawai telah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $pegawai)
    {
        return view('master.pegawai.show', [
            'title' => "Detail Pegawai",
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $pegawai)
    {
        return view('master.pegawai.edit', [
            "title" => "Edit Pegawai",
            'pegawai' => $pegawai,
            'pangkats' => Pangkat::all(),
            'jabatans' => Jabatan::all(),
            'penilais' => User::where('role', 'Pejabat Penilai')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $pegawai)
    {
        $rules = [
            'role' => ['required'],
            'name' => ['required'],
            'pangkat_id' => ['required'],
            'jabatan_id' => ['required'],
            'penilai_id' => ['required']
        ];

        if ($request->nip != $pegawai->nip) {
            $rules['nip'] = ['required', 'unique:users', 'min:18', 'numeric'];
        }

        $validatedData = $request->validate($rules);

        User::where('id', $pegawai->id)->update($validatedData);

        return redirect('/master/pegawai')->with('toast_success', 'Pegawai telah berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $pegawai)
    {
        // dd($pegawai->penilai);

        User::destroy($pegawai->id);

        return redirect('/master/pegawai')->with('toast_success', 'Pegawai telah berhasil dihapus!');
    }
}
