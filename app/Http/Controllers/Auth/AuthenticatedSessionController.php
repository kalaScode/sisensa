<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('beranda');  // Redirect setelah login berhasil
    }


    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil user berdasarkan email
        $user = \App\Models\User::where('email', $request->email)->first();

        // Tambahkan validasi untuk status akun
        if ($user && $user->status_Akun != 1) {
            throw ValidationException::withMessages([
                'email' => 'Akun Anda belum aktif. Silakan hubungi HRD',
            ]);
        }

        // Jika validasi status lolos, lanjutkan proses login
        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('beranda'); // Sesuaikan dengan route tujuan setelah login
        }

        // Jika login gagal
        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.',
        ]);

        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(route('beranda', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
