<?php

use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\KeuanganKasController;
use App\Http\Controllers\Admin\KontenController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\TentangKamiController;
use App\Http\Controllers\Admin\UnitUsahaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Route;

// Landing page (publik)
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/tentang-kami', [LandingController::class, 'tentangKami'])->name('landing.tentang');
Route::get('/berita', [LandingController::class, 'berita'])->name('landing.berita');
Route::get('/berita/{berita}', [LandingController::class, 'beritaDetail'])->name('landing.berita.detail');
Route::get('/pengumuman', [LandingController::class, 'pengumuman'])->name('landing.pengumuman');
Route::get('/pengumuman/{pengumuman}', [LandingController::class, 'pengumumanDetail'])->name('landing.pengumuman.detail');
Route::get('/unit-usaha/{unitUsaha}', [LandingController::class, 'unitUsahaDetail'])->name('landing.unitUsaha.detail');

Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
    // Manajemen User
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::patch('/user/{user}/activate', [UserController::class, 'activate'])->name('user.activate');

    // Manajemen Konten
    Route::get('/konten', [KontenController::class, 'index'])->name('konten');
    Route::post('/konten', [KontenController::class, 'store'])->name('konten.store');
    Route::put('/konten/{konten}', [KontenController::class, 'update'])->name('konten.update');
    Route::delete('/konten/{konten}', [KontenController::class, 'destroy'])->name('konten.destroy');

    // Manajemen Tentang Kami
    Route::get('/tentangKami', [TentangKamiController::class, 'index'])->name('tentangKami');
    Route::post('/tentangKami', [TentangKamiController::class, 'store'])->name('tentangKami.store');
    Route::put('/tentangKami/{tentangKami}', [TentangKamiController::class, 'update'])->name('tentangKami.update');
    Route::delete('/tentangKami/{tentangKami}', [TentangKamiController::class, 'destroy'])->name('tentangKami.destroy');

    // Manajemen Unit Usaha
    Route::get('/unitUsaha', [UnitUsahaController::class, 'index'])->name('unitUsaha');
    Route::post('/unitUsaha', [UnitUsahaController::class, 'store'])->name('unitUsaha.store');
    Route::put('/unitUsaha/{unitUsaha}', [UnitUsahaController::class, 'update'])->name('unitUsaha.update');
    Route::delete('/unitUsaha/{unitUsaha}', [UnitUsahaController::class, 'destroy'])->name('unitUsaha.destroy');

    // Manajemen Keanggotaan
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota');
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::put('/anggota/{anggota}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{anggota}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
    Route::patch('/anggota/{anggota}/activate', [AnggotaController::class, 'activate'])->name('anggota.activate');

    // Manajemen Keuangan Kas
    Route::get('/keuangan-kas', [KeuanganKasController::class, 'index'])->name('keuangan-kas.index');
    Route::get('/keuangan-kas/export', [KeuanganKasController::class, 'export'])->name('keuangan-kas.export');
    Route::post('/keuangan-kas', [KeuanganKasController::class, 'store'])->name('keuangan-kas.store');
    Route::get('/keuangan-kas/{keuanganKa}/edit', [KeuanganKasController::class, 'edit'])->name('keuangan-kas.edit');
    Route::put('/keuangan-kas/{keuanganKa}', [KeuanganKasController::class, 'update'])->name('keuangan-kas.update');
    Route::delete('/keuangan-kas/{keuanganKa}', [KeuanganKasController::class, 'destroy'])->name('keuangan-kas.destroy');

    // Manajemen Berita
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::put('/berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');
    Route::patch('/berita/{berita}/publish', [BeritaController::class, 'publish'])->name('berita.publish');

    // Manajemen Pengumuman
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::put('/pengumuman/{pengumuman}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/{pengumuman}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
    Route::patch('/pengumuman/{pengumuman}/publish', [PengumumanController::class, 'publish'])->name('pengumuman.publish');
});
