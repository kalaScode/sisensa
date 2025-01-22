<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\Beranda;
use App\Http\Controllers\NotifikasiController;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\OtorisasiController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CheckMenu;
use Illuminate\Support\Facades\Auth;


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

// Route::get('/welcome', function () {
//     return view('welcome');
// })->middleware('auth', 'verified')->name('welcome');

//Route untuk Presensi
Route::middleware('auth')->group(function () {
    Route::get('/presensi', function () {
        if (in_array(Auth::user()->id_Otoritas, [1, 2])) {
            return redirect()->route('dashboard'); // Arahkan ke halaman dashboard
        }
        return view('page.ppresensi');
    });

    Route::get('/presensi/check', [PresensiController::class, 'check']);

    Route::post('/presensi/store', [PresensiController::class, 'store'])->name('presensi.store');
});

// Route ke halaman cuti
Route::group(['middleware' => ['auth']], function () {
    Route::get('/cuti', [CutiController::class, 'index'])->name('cuti.index');
    Route::post('/cuti/ajukan', [CutiController::class, 'ajukanCuti'])->name('cuti.ajukan');
    Route::get('/cuti/saldo-sisa', [CutiController::class, 'getSaldoSisa']);
});


// Route ke halaman persetujuan
Route::group(['middleware' => ['auth', CheckMenu::class . ':Persetujuan']], function () {
    Route::get('/persetujuan-cuti', [PersetujuanController::class, 'index'])->name('persetujuan-cuti.index');
    Route::post('/persetujuan-cuti/terima/{id}', [PersetujuanController::class, 'terimaCuti'])->name('cuti.terima');
    Route::post('/persetujuan-cuti/tolak/{id}', [PersetujuanController::class, 'tolakCuti'])->name('cuti.tolak');
    Route::get('/persetujuan-cuti/terima/{id}', [PersetujuanController::class, 'terimaCuti'])->name('cuti.terima');
    Route::get('/persetujuan-cuti/tolak/{id}', [PersetujuanController::class, 'tolakCuti'])->name('cuti.tolak');
    Route::get('/persetujuan-presensi', [PresensiController::class, 'indexPresensi'])->name('persetujuan-presensi.index');
    // Route::post('/persetujuan-presensi/tolak/{id}', [PresensiController::class, 'tolakPresensi'])->name('presensi.tolak');
    // Route::get('/persetujuan-presensi/tolak/{id}', [PresensiController::class, 'tolakPresensi'])->name('presensi.tolak');
    Route::put('/persetujuan-presensi/tolak/{id}', [PresensiController::class, 'tolakPresensi'])->name('presensi.tolak');
});

// Route ke halaman riwayat presensi dan cuti pribadi
Route::middleware('auth')->group(function () {
    Route::get('/riwayat-presensi-pribadi', [RiwayatController::class, 'getPresensiPribadi'])->name('riwayat-presensi-pribadi');
    Route::get('/riwayat-cuti-pribadi', [RiwayatController::class, 'getCutiPribadi'])->name('riwayat-cuti-pribadi');
});


// Route ke halaman riwayat presensi dan cuti karyawan
Route::middleware(['auth', CheckMenu::class . ':riwayat_presensiKaryawan, riwayat_cutiKaryawan'])->group(function () {
    Route::get('/riwayat-presensi-karyawan', [RiwayatController::class, 'getPresensiKaryawan'])->name('riwayat-presensi-karyawan');
    Route::get('/riwayat-cuti-karyawan', [RiwayatController::class, 'getCutiKaryawan'])->name('riwayat-cuti-karyawan');
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
    Route::middleware(CheckMenu::class . ':edit_daftarKaryawan')->group(function () {
        Route::delete('/daftar-karyawan/{user_id}', [KaryawanController::class, 'destroy'])->name('delete-karyawan');
        Route::put('/karyawan/edit/{id}', [KaryawanController::class, 'updateDataKaryawan'])->name('update-karyawan');
    });
});

//Route untuk Persetujuan Akun
Route::middleware(['auth', CheckMenu::class . ':persetujuan_Akun'])->group(function () {
    Route::get('persetujuan-akun/', [KaryawanController::class, 'getPersetujuanAkun'])->name('persetujuan-akun');
    Route::post('/set-status-kerja/{userId}', [KaryawanController::class, 'setStatusKerja']);
    Route::post('/ubah-status-akun/{user_id}', [KaryawanController::class, 'ubahStatusAkun'])->name('ubah-status-akun');
    Route::post('/batalkan-akun/{user_id}', [KaryawanController::class, 'batalkanAkun'])->name('batalkan-akun');
});

//Route Untuk Edit Profil
Route::middleware('auth')->group(function () {
    Route::post('/karyawan/update-telepon', [KaryawanController::class, 'updateTelepon'])->name('update-telepon');
    Route::post('/karyawan/update-alamat', [KaryawanController::class, 'updateAlamat'])->name('update-alamat');
    Route::post('/karyawan/update-avatar', [KaryawanController::class, 'updateAvatar'])->name('update-avatar');
});

//Route Untuk Notifikasi
Route::middleware('auth')->group(function () {
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifications.index');
    // Route::get('/notifikasi', [NotifikasiController::class, 'showNotifications'])->name('notifikasi');
    Route::get('/notifications/latest', [NotifikasiController::class, 'getLatestNotifications'])->name('notifications.latest');
    Route::post('/notifikasi/mark-all-read', [NotifikasiController::class, 'markAllRead'])->name('notifications.markAllRead');
    Route::patch('/notifications/{id}/mark-as-read', [NotifikasiController::class, 'markAsRead'])->name('notification.markAsRead');
});

//Route untuk Buat Pengumuman
Route::middleware(['auth', CheckMenu::class . ':buat_Pengumuman',  CheckRole::class . '!:1,2'])->group(function () {
    Route::get('/buat-pengumuman', [NotifikasiController::class, 'create'])->name('pengumuman.create');
    Route::post('/buat-pengumuman', [NotifikasiController::class, 'store'])->name('pengumuman.store');
});

//Route untuk Otorisasi
Route::middleware(['auth', CheckRole::class . ':1,2'])->group(function () {
    Route::get('/otorisasi', [OtorisasiController::class, 'index'])->name('otorisasi.index');
    Route::get('/otorisasi-karyawan', [OtorisasiController::class, 'OtorisasiKaryawan'])->name('otorisasi-karyawan.index');
    Route::get('/user-roles/create', [OtorisasiController::class, 'createUserRole'])->name('user-roles.create');
    Route::put('/user-roles/{id}', [OtorisasiController::class, 'storeUserRole'])->name('user-roles.store');
});

//Route untuk Otorisasi Karyawan
Route::middleware(['auth', CheckRole::class . ':1,2'])->group(function () {
    Route::get('/roles/create', [OtorisasiController::class, 'create'])->name('roles.create');
    Route::post('/roles', [OtorisasiController::class, 'store'])->name('roles.store'); // Mengupdate role yang ada
    Route::put('roles/update/{id}', [OtorisasiController::class, 'update'])->name('roles.update');
    Route::delete('roles/hapus/{id}', [OtorisasiController::class, 'destroy'])->name('roles.destroy');
});

// Route ke halaman dashboard
Route::get('/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', CheckRole::class . ':1,2'])
    ->name('dashboard');

Route::post('/upload-image', [NotifikasiController::class, 'uploadImage'])->name('upload.image');

require __DIR__ . '/auth.php';
