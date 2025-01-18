<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\RegistrasiPengguna;

class VerifyEmailController extends Controller
{
    /**
     * Handle the email verification request.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $user = User::findOrFail($request->route('id')); // Cari user berdasarkan ID dari URL

        // Validasi hash email
        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            abort(403, 'Link verifikasi tidak valid.');
        }

        // Tandai email sebagai terverifikasi jika belum terverifikasi
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));

            // Kirimkan notifikasi ke HRD (jika perlu)
            $hrd = User::where('id_Perusahaan', $user->id_Perusahaan)
                ->where('id_Otoritas', 4)  // Sesuaikan ID role untuk HRD
                ->first();
            if ($hrd) {
                $hrd->notify(new RegistrasiPengguna($user, $user)); // Kirim notifikasi tanpa user login
            }
        }

        return redirect()->route('login')->with('status', 'Email Anda berhasil diverifikasi. Anda dapat Login setelah akun anda disetujui oleh HRD. Persetujuan Akun akan diberitahukan melalui Email');
    }
}
