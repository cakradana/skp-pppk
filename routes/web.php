<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenilaiController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RencanaController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\PengajuanRealisasiController;
use App\Http\Controllers\PenilaianRealisasiController;
use Illuminate\Support\Facades\Route;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// halaman login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// post login
Route::post('/login', [LoginController::class, 'authenticate']);
// post logout
Route::post('/logout', [LoginController::class, 'logout']);

// halaman profil
Route::get('/profil', [ProfilController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// resource periode
Route::resource('/master/periode', PeriodeController::class)->middleware('auth');

// resource pegawai
Route::resource('/master/pegawai', PegawaiController::class)->middleware('auth');

// resource penilai
Route::resource('/master/penilai', PenilaiController::class)->middleware('auth');

// resource pangkat
Route::resource('/master/pangkat', PangkatController::class)->except('show')->middleware('auth');

// resource jabatan
Route::resource('/master/jabatan', JabatanController::class)->except('show')->middleware('auth');

// resource kegiatan
Route::resource('/master/kegiatan', KegiatanController::class)->middleware('auth');

// resource rencana
Route::resource('/skp/rencana', RencanaController::class)->middleware('auth');

// resource persetujuan
Route::resource('/penilaian/persetujuan', PersetujuanController::class)->middleware('auth');
Route::get('/penilaian/persetujuan/setuju/{id}', [PersetujuanController::class, 'update']);


// resource pengajuan realisasi
Route::resource('/skp/realisasi', PengajuanRealisasiController::class)->middleware('auth');

// resource penilaian realisasi
Route::resource('/penilaian/prealisasi', PenilaianRealisasiController::class)->middleware('auth');
