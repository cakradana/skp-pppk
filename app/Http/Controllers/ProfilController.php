<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        return view('profil.index', [
            "title" => "Profil",
            "pegawai" => auth()->user()
        ]);
    }
}
