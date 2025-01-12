<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\RegistrasiPengguna;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Perusahaan;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $perusahaan = Perusahaan::all(); // Ambil data perusahaan
        return view('auth.register', compact('perusahaan'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'id_Perusahaan' => ['required', 'integer'],
            'no_Telp' => ['required', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_Perusahaan' => $request->id_Perusahaan,
            'no_Telp' => $request->no_Telp,
            'status_Akun' => 0,
        ]);
        $sender = $user;

        $sender = $user;

        $hrd = User::where('id_Perusahaan', $user->id_Perusahaan)
            ->where('id_Otoritas', 4) // Anda bisa sesuaikan role dengan field yang sesuai
            ->first();

        if ($hrd) {
            // Mengirimkan notifikasi ke HRD
            $hrd->notify(new RegistrasiPengguna($user, $sender));
        }

        event(new Registered($user));

        return redirect()->route('login')->with('status', 'Registrasi berhasil! Silahkan Tunggu Konfirmasi HRD.');
    }
}
