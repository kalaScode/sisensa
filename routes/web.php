<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarKaryawan;
use App\Http\Controllers\Beranda;
use App\Http\Controllers\UserController;

// Route ke halaman login
Route::get('/', function () {
    return view('login');
})->name('login');

// Route ke halaman register
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/presensi', function () {
    return view('page.ppresensi');
});

// Route ke halaman cuti
Route::get('/cuti', function () {
    return view('page.pcuti');
});
// // Route ke halaman daftar_karyawan
// Route::get('/daftar_karyawan', function () {
//     return view('page.pdaftar_karyawan');
// });
Route::get('/daftar_karyawan',[DaftarKaryawan::class,'index']);

// Route ke halaman edit_daftar_karyawan
Route::get('/edit_daftar_karyawan', function () {
    return view('page.pedit_daftar_karyawan');
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

// Route ke halaman menu_utama
// Route::get('/menu_utama', function () {
//     return view('page.pmenu_utama');
// })->name('menu_utama');

Route::get('/menu_utama',[Beranda::class,'index'])->name('menu_utama');;

// Route ke halaman profil;
Route::get('/profil', function () {
    return view('page.pprofil');
})->name('profil');

// Route ke halaman edit-profil;
Route::get('/edit-profil', function () {
    return view('page.pedit-profil');
})->name('edit-profil');

// Proses login (contoh)
Route::post('/login', function () {
    // Di sini bisa ditambahkan validasi login
    return redirect()->route('menu_utama');
})->name('login.process');

// Route ke halaman persetujuan_akun;
Route::get('/persetujuan-akun', function () {
    return view('page.ppersetujuan-akun');
})->name('persetujuan-akun');