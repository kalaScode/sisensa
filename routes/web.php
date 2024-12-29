<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\Beranda;
use App\Http\Middleware\CheckRole;
use PHPUnit\Framework\Attributes\Group;

// Route ke halaman login
Route::get('/', [Beranda::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('beranda');


Route::get('/presensi', function () {
    return view('page.ppresensi');
});

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
})->name('persetujuan-akun');

Route::prefix('daftar-karyawan')->group(function () {
    Route::get('/', [KaryawanController::class, 'index'])->name('daftar-karyawan');
    // Route::put('/edit/{user_id}', [KaryawanController::class, 'update'])->name('edit-karyawan');
    Route::delete('/{user_id}', [KaryawanController::class, 'destroy'])->name('delete-karyawan');
})->middleware('auth');

Route::put('/karyawan/edit/{id}', [KaryawanController::class, 'update'])
    ->middleware('auth')
    ->name('update-karyawan');

Route::get('persetujuan-akun/', [KaryawanController::class, 'persetujuan'])->name('persetujuan-akun');

Route::post('/ubah-status-akun/{user_id}', [KaryawanController::class, 'ubahStatusAkun'])->name('ubah-status-akun');

Route::post('/batalkan-akun/{user_id}', [KaryawanController::class, 'batalkanAkun'])->name('batalkan-akun');



require __DIR__ . '/auth.php';
