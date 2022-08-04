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

    // cetak rencana
    Route::get('/pengajuan/rencana/cetak-rencana/{id}', [PengajuanRencanaController::class, 'cetak']);
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
    // resource pengajuan realisasi
    Route::resource('/pengajuan/realisasi', PengajuanRealisasiController::class)->except('store');
    // post create
    Route::post('/pengajuan/realisasi', [PengajuanRealisasiController::class, 'create']);
    // reset realisasi
    Route::put('/pengajuan/realisasi/reset/{id}', [PengajuanRealisasiController::class, 'reset']);
    // cetak realisasi
    Route::get('/pengajuan/realisasi/cetak-realisasi/{id}', [PengajuanRealisasiController::class, 'cetak']);
});

Route::middleware(['penilai'])->group(function () {
    // resource persetujuan rencana
    Route::resource('/persetujuan/rencana-pegawai', PersetujuanRencanaController::class);
    // setuju rencana
    Route::get('/persetujuan/rencana-pegawai/setuju/{id}', [PersetujuanRencanaController::class, 'setuju']);
    // tolak rencana
    Route::get('/persetujuan/rencana-pegawai/tolak/{id}', [PersetujuanRencanaController::class, 'tolak']);

    // post index
    Route::post('/penilaian/realisasi-pegawai', [PenilaianRealisasiController::class, 'index']);
    // resource penilaian realisasi
    Route::resource('/penilaian/realisasi-pegawai', PenilaianRealisasiController::class)->except('store');
    // resource penilaian perilaku
    Route::resource('/penilaian/perilaku-pegawai', PenilaianPerilakuController::class);
});
