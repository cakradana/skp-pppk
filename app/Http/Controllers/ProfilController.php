<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\Pangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('profil.index', [
            "title" => "Profil",
            "user" => $user,
            'pangkats' => Pangkat::all(),
            'jabatans' => Jabatan::all(),
        ]);
    }

    public function profilUpdate(Request $request, User $id)
    {
        // dd($request)->all();

        $rules = [
            'role' => ['required'],
            'name' => ['required'],
            'pangkat_id' => ['required'],
            'jabatan_id' => ['required'],
        ];

        if ($request->nip != $id->nip) {
            $rules['nip'] = ['required', 'unique:users', 'max:18'];
        }

        $validatedData = $request->validate($rules);

        // dd($validatedData);

        User::where('id', $id->id)->update($validatedData);

        return redirect('/profil')->with('toast_success', 'Profil telah berhasil diubah!');
    }

    public function passwordUpdate(Request $request, $id)
    {
        // dd($request)->all();

        $user = User::findOrFail($id);

        // dd($user)->all();


        $rules = [
            'oldPassword' => 'required',
            'newPasswordA' => 'required',
            'newPasswordB' => 'required_with:newPasswordA|same:newPasswordA'
        ];



        $validatedData = $request->validate($rules);
        // dd($validatedData);

        if (Hash::check($validatedData['oldPassword'], $user->password)) {
            $user->fill([
                'password' => Hash::make($validatedData['newPasswordA'])
            ])->save();

            return redirect('/profil')->with('toast_success', 'Password telah berhasil diubah!');
        } else {
            return redirect('/profil')->with('toast_error', 'Password lama tidak cocok');
        }
    }

    public function fotoUpdate(Request $request, $id)
    {
        // dd($request)->all;

        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5000',
        ], [
            'foto.required' => 'Foto harus diisi',
            'foto.image' => 'Foto harus berupa gambar (jpeg, png, jpg)',
            'foto.mimes' => 'Foto harus berupa gambar (jpeg, png, jpg)',
            'foto.max' => 'Foto tidak boleh lebih dari 5MB',
        ]);

        $file = $request->file('foto');
        $ext = $file->extension();
        $filename = $file->storeAs('/foto', uniqid() . '-' . date('Y') . date('m') . date('d') . '.' . $ext, ['disk' => 'foto']);

        User::where('id', $id)
            ->update([
                'foto' => $filename,
            ]);
        if (Auth::user()->foto != NULL) {
            $path = public_path() . "/files/" . $request->foto_lama;
            unlink($path);
        }
        return back()->with('toast_success', 'Foto berhasil diperbarui');
    }

    public function ttdUpdate(Request $request, $id)
    {
        // dd($request)->all;

        $request->validate([
            'ttd' => 'required|image|mimes:jpeg,png,jpg|max:5000',
        ], [
            'ttd.required' => 'Tanda Tangan harus diisi',
            'ttd.image' => 'Tanda Tangan harus berupa gambar (jpeg, png, jpg)',
            'ttd.mimes' => 'Tanda Tangan harus berupa gambar (jpeg, png, jpg)',
            'ttd.max' => 'Tanda Tangan tidak boleh lebih dari 5MB',
        ]);

        $file = $request->file('ttd');
        $ext = $file->extension();
        $filename = $file->storeAs('/ttd', uniqid() . '-' . date('Y') . date('m') . date('d') . '.' . $ext, ['disk' => 'ttd']);

        User::where('id', $id)
            ->update([
                'ttd' => $filename,
            ]);
        if (Auth::user()->ttd != NULL) {
            $path = public_path() . "/files/" . $request->ttd_lama;
            unlink($path);
        }
        return back()->with('toast_success', 'Tanda Tangan berhasil diperbarui');
    }
}
