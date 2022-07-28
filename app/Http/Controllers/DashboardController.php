<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Kegiatan;
use App\Models\Pangkat;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->ttd == null) {
            $atribut = 'tdk ada ttd';
        } else {
            $atribut = 'ada ttd';
        }

        // dd($atribut);


        return view('dashboard.index', [
            "title" => "Dashboard",
            "atribut" => $atribut,
            'user' => $user,
            "pegawai" => User::where('role', 'Pegawai yang Dinilai')->count(),
            "pejabat" => User::where('role', 'Pejabat Penilai')->count(),
            "pangkat" => Pangkat::all()->count(),
            "jabatan" => Jabatan::all()->count(),
            "kegiatan" => Kegiatan::all()->count()
        ]);
    }
}
