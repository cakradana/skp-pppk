<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OutputController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenilaiController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanRencanaController;
use App\Http\Controllers\PenilaianPerilakuController;
use App\Http\Controllers\PengajuanRealisasiController;
use App\Http\Controllers\PenilaianRealisasiController;
use App\Http\Controllers\PersetujuanRencanaController;

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

// landing page
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    // halaman login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    // post login
    Route::post('/login', [LoginController::class, 'authenticate']);
});


Route::middleware(['auth'])->group(function () {
    // post logout
    Route::post('/logout', [LoginController::class, 'logout']);
    // halaman dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
    // halaman profil
    Route::get('/profil', [ProfilController::class, 'index']);
    // update profil
    Route::put('/profil/profilUpdate/{id}', [ProfilController::class, 'profilUpdate']);
    // update password
    Route::put('/profil/passwordUpdate/{id}', [ProfilController::class, 'passwordUpdate']);
    // update foto
    Route::put('/profil/fotoUpdate/{id}', [ProfilController::class, 'fotoUpdate']);
    // update ttd
    Route::put('/profil/ttdUpdate/{id}', [ProfilController::class, 'ttdUpdate']);
});

Route::middleware(['admin'])->group(function () {
    // resource periode
    Route::resource('/master/periode', PeriodeController::class)->except('show');
    // resource pegawai
    Route::resource('/master/pegawai', PegawaiController::class);
    // resource penilai
    Route::resource('/master/penilai', PenilaiController::class);
    // resource pangkat
    Route::resource('/master/pangkat', PangkatController::class)->except('show');
    // resource jabatan
    Route::resource('/master/jabatan', JabatanController::class)->except('show');
    // resource kegiatan
    Route::resource('/master/kegiatan', KegiatanController::class)->except('show');
    // resource output
    Route::resource('/master/output', OutputController::class)->except('show');
});


Route::middleware(['pegawai'])->group(function () {
    // resource rencana
    Route::resource('/pengajuan/rencana', PengajuanRencanaController::class);
    // tambah output
    Route::post('/tambah-output', [PengajuanRencanaController::class, 'tambahOutput']);
    // tambah kegiatan
    Route::post('/tambah-kegiatan', [PengajuanRencanaController::class, 'tambahKegiatan']);
    // cetak rencana
    Route::get('/pengajuan/rencana/cetak-rencana/{id}', [PengajuanRencanaController::class, 'cetak']);
    // resource pengajuan realisasi
    Route::resource('/pengajuan/realisasi', PengajuanRealisasiController::class);
    // isi realisasi per bulan
    Route::post('/pengajuan/realisasi/search/', [PengajuanRealisasiController::class, 'search']);
});

Route::middleware(['penilai'])->group(function () {
    // resource persetujuan rencana
    Route::resource('/persetujuan/rencana-pegawai', PersetujuanRencanaController::class);
    // setuju rencana
    Route::get('/persetujuan/rencana-pegawai/setuju/{id}', [PersetujuanRencanaController::class, 'setuju']);
    // tolak rencana
    Route::get('/persetujuan/rencana-pegawai/tolak/{id}', [PersetujuanRencanaController::class, 'tolak']);
    // resource penilaian realisasi
    Route::resource('/penilaian/realisasi-pegawai', PenilaianRealisasiController::class);
    // resource penilaian perilaku
    Route::resource('/penilaian/perilaku-pegawai', PenilaianPerilakuController::class);
});
