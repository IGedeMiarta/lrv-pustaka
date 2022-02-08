<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailBukuController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanAnggota;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PengarangController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PerpanjanganController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\StatusAnggotaController;
use App\Models\Anggota;
use App\Models\Kategori;
use App\Models\StatusAnggota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::resource('/', AuthController::class);

Route::group(['middleware' => ['auth']], function (){
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');

    Route::get('/dashboard',[DashboardController::class,'index']);
    Route::resource('/peminjaman', PeminjamanController::class);
    Route::resource('/pengembalian', PengembalianController::class);
    Route::resource('/perpanjangan',PerpanjanganController::class);
    Route::resource('/donasi',DonasiController::class);

    Route::resource('/anggota',AnggotaController::class);
    Route::get('/cetak-anggota/{id}',[AnggotaController::class,'cetak'])->name('cetak.anggota');
    Route::get('/kartu-anggota',[AnggotaController::class,'kartu'])->name('kartu.anggota');
    Route::post('/create-user',[AnggotaController::class,'users'])->name('anggota.user');

    Route::resource('/donatur',DonaturController::class);
    Route::resource('/status-anggota',StatusAnggotaController::class);

    Route::resource('/rak', RakController::class);
    Route::resource('/penerbit', PenerbitController::class);
    Route::resource('/pengarang', PengarangController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/buku', BukuController::class);
    Route::get('/kode-buku/{id}',[BukuController::class,'buku']);

    Route::resource('/detail-buku',DetailBukuController::class);
    Route::get('/details/{id}',[DetailBukuController::class,'create'])->name('details');

    Route::resource('/petugas',PetugasController::class);
    Route::post('/petugas-user',[PetugasController::class,'user'])->name('petugas.user');

    Route::get('laporan-peminjaman',[LaporanController::class,'peminjaman'])->name('laporan.peminjaman');
    Route::get('cetak-peminjaman',[LaporanController::class,'cetakpinjam']);
    Route::get('laporan-perpanjangan',[LaporanController::class,'perpanjangan'])->name('laporan.perpanjangan');
    Route::get('cetak-perpanjangan',[LaporanController::class,'cetakperpanjangan']);
    Route::get('laporan-pengembalian',[LaporanController::class,'pengembalian'])->name('laporan.pengembalian');
    Route::get('cetak-pengembalian',[LaporanController::class,'cetakpengembalian']);
    Route::get('laporan-donasi',[LaporanController::class,'donasi'])->name('laporan.donasi');
    Route::get('cetak-donasi',[LaporanController::class,'cetakdonasi']);

    Route::get('peminjaman-aktif',[PeminjamanAnggota::class,'peminjaman']);
    Route::get('peminjaman-history',[PeminjamanAnggota::class,'history']);
});