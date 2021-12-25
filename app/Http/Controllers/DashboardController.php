<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pangkat;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            "title" => "Dashboard",
            "pegawai" => User::all()->count(),
            "pangkat" => Pangkat::all()->count(),
            "jabatan" => Jabatan::all()->count()
        ]);
    }
}
