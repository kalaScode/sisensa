<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\Beranda;
use App\Http\Controllers\NotifikasiController;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');


// Route ke halaman login
Route::get('/', [Beranda::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('beranda');

//Route untuk Beranda
Route::get('/beranda', [Beranda::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('beranda');

//Route untuk Presensi
Route::middleware('auth')->group(function () {
    Route::get('/presensi', function () {
        return view('page.ppresensi');
    });

    Route::get('/presensi/check', [PresensiController::class, 'check']);

    Route::post('/presensi/store', [PresensiController::class, 'store'])->name('presensi.store');
});

// Route ke halaman cuti
Route::get('/cuti', function () {
    return view('page.pcuti');
});

// Route ke halaman persetujuan
Route::get('/persetujuan', function () {
    return view('page.ppersetujuan');
});

// Route ke halaman persetujuan
Route::get('/riwayat_pribadi', function () {
    return view('page.priwayat_pribadi');
});

// Route ke halaman persetujuan
Route::get('/riwayat_karyawan', function () {
    return view('page.priwayat_karyawan');
});

// Route ke halaman profil (pemberi persetujuan)
Route::get('/profil', [KaryawanController::class, 'getProfil'])
    ->middleware('auth')
    ->name('profil');

// Route ke halaman edit-profil (pemberi persetujuan)
Route::get('/edit-profil', [KaryawanController::class, 'getEditProfil'])
    ->middleware('auth')
    ->name('edit-profil');

//Route untuk Daftar Karyawan
Route::middleware('auth')->group(function () {
    Route::get('/daftar-karyawan', [KaryawanController::class, 'getDaftarKaryawan'])->name('daftar-karyawan');
    Route::delete('/daftar-karyawan/{user_id}', [KaryawanController::class, 'destroy'])->name('delete-karyawan');
    Route::put('/karyawan/edit/{id}', [KaryawanController::class, 'updateDataKaryawan'])->name('update-karyawan');
});

//Route untuk Persetujuan Akun
Route::middleware('auth')->group(function () {
    Route::get('persetujuan-akun/', [KaryawanController::class, 'getPersetujuanAkun'])->name('persetujuan-akun');
    Route::post('/ubah-status-akun/{user_id}', [KaryawanController::class, 'ubahStatusAkun'])->name('ubah-status-akun');
    Route::post('/batalkan-akun/{user_id}', [KaryawanController::class, 'batalkanAkun'])->name('batalkan-akun');
});

//Route Untuk Edit Profil
Route::middleware('auth')->group(function () {
    Route::post('/karyawan/update-telepon', [KaryawanController::class, 'updateTelepon'])->name('update-telepon');
    Route::post('/karyawan/update-alamat', [KaryawanController::class, 'updateAlamat'])->name('update-alamat');
    Route::post('/update-avatar', [KaryawanController::class, 'updateAvatar'])->name('update-avatar');
});

//Route Untuk Notifikasi
Route::middleware('auth')->group(function () {
    Route::get('/notifikasi', [NotifikasiController::class, 'showNotifications'])->name('notifikasi');
    Route::get('/notifications/latest', [NotifikasiController::class, 'getLatestNotifications'])->name('notifications.latest');
    Route::post('/notifikasi/mark-all-read', [NotifikasiController::class, 'markAllRead'])->name('notifications.markAllRead');
    Route::patch('/notifications/{id}/mark-as-read', [NotifikasiController::class, 'markAsRead'])->name('notification.markAsRead');
});

//Route untuk Buat Pengumuman
Route::middleware('auth')->group(function () {
    Route::get('/buat-pengumuman', [NotifikasiController::class, 'create'])->name('pengumuman.create');
    Route::post('/buat-pengumuman', [NotifikasiController::class, 'store'])->name('pengumuman.store');
});


require __DIR__ . '/auth.php';
