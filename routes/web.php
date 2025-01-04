<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\Beranda;
use App\Http\Controllers\NotifikasiController;
use App\Http\Middleware\CheckRole;
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


Route::get('/presensi', function () {
    return view('page.ppresensi');
});
Route::get('/presensi/check', [PresensiController::class, 'check']);
Route::post('/presensi/store', [PresensiController::class, 'store'])->name('presensi.store');


// Route ke halaman cuti
Route::get('/cuti', function () {
    return view('page.pcuti');
});
// Route ke halaman daftar_karyawan
// Route::get('/daftar-karyawan', function () {
//     return view('page.pdaftar_karyawan')->name('karyawan.index');
// });
// Route::get('/daftar-karyawan', [karyawanController::class, 'index'])
//     ->middleware('auth')
//     ->name('daftar-karyawan');


// Route ke halaman edit_daftar_karyawan
// Route::get('/edit-daftar-karyawan', function () {
//     return view('page.pedit_daftar_karyawan');
// });

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


Route::get('/beranda', [Beranda::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('beranda');

Route::get('/notify', [Beranda::class, 'notify'])
    ->middleware(['auth', 'verified'])
    ->name('notify');

Route::get('/profil', [KaryawanController::class, 'getProfil'])
    ->middleware('auth')
    ->name('profil');

// Route ke halaman edit-profil;
Route::get('/edit-profil', [KaryawanController::class, 'getEditProfil'])
    ->middleware('auth')
    ->name('edit-profil');

Route::post('/upload-foto', [KaryawanController::class, 'uploadFoto'])->name('upload-foto');

// Route ke halaman persetujuan_akun;
Route::get('/persetujuan-akun', function () {
    return view('page.ppersetujuan-akun');
})
    ->middleware('auth')
    ->name('persetujuan-akun');

Route::prefix('daftar-karyawan')->group(function () {
    Route::get('/', [KaryawanController::class, 'index'])->name('daftar-karyawan');
    // Route::put('/edit/{user_id}', [KaryawanController::class, 'update'])->name('edit-karyawan');
    Route::delete('/{user_id}', [KaryawanController::class, 'destroy'])->name('delete-karyawan');
})->middleware('auth');

Route::put('/karyawan/edit/{id}', [KaryawanController::class, 'update'])
    ->middleware('auth')
    ->name('update-karyawan');

Route::get('persetujuan-akun/', [KaryawanController::class, 'persetujuan'])
    ->middleware('auth')
    ->name('persetujuan-akun');

Route::post('/ubah-status-akun/{user_id}', [KaryawanController::class, 'ubahStatusAkun'])
    ->middleware('auth')
    ->name('ubah-status-akun');

Route::post('/batalkan-akun/{user_id}', [KaryawanController::class, 'batalkanAkun'])
    ->middleware('auth')
    ->name('batalkan-akun');

Route::post('/karyawan/update-telepon', [KaryawanController::class, 'updateTelepon'])
    ->middleware('auth')
    ->name('update-telepon');

Route::post('/karyawan/update-alamat', [KaryawanController::class, 'updateAlamat'])
    ->middleware('auth')
    ->name('update-alamat');

// Route untuk halaman edit profil
Route::get('/edit-profil', [KaryawanController::class, 'editProfile'])
    ->middleware('auth')
    ->name('edit-profil');

// Route untuk update foto profil
Route::post('/update-avatar', [KaryawanController::class, 'updateAvatar'])
    ->middleware('auth')
    ->name('update-avatar');

Route::middleware('auth')->group(function () {
    Route::get('/notifikasi', [NotifikasiController::class, 'showNotifications'])->name('notifikasi');
    Route::get('/notifications/latest', [NotifikasiController::class, 'getLatestNotifications'])->name('notifications.latest');
    Route::post('/notifikasi/mark-all-read', [NotifikasiController::class, 'markAllRead'])->name('notifications.markAllRead');
    Route::patch('/notifications/{id}/mark-as-read', [NotifikasiController::class, 'markAsRead']);
});

Route::middleware('auth')->group(function () {
    Route::get('/buat-pengumuman', [NotifikasiController::class, 'create'])->name('pengumuman.create');
    Route::post('/buat-pengumuman', [NotifikasiController::class, 'store'])->name('pengumuman.store');
});


require __DIR__ . '/auth.php';
