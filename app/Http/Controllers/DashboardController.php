<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Kegiatan;
use App\Models\Pangkat;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('dashboard.index', [
            "title" => "Dashboard",
            'user' => $user,
            "pegawai" => User::where('role', 'Pegawai yang Dinilai')->count(),
            "pejabat" => User::where('role', 'Pejabat Penilai')->count(),
            "pangkat" => Pangkat::all()->count(),
            "jabatan" => Jabatan::all()->count(),
            "kegiatan" => Kegiatan::all()->count()
        ]);
    }
}
