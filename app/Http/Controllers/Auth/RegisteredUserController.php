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
use Carbon\Carbon;

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

        // Buat akun user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_Perusahaan' => $request->id_Perusahaan,
            'no_Telp' => $request->no_Telp,
            'status_Akun' => 0,
        ]);

        // Set atribut tambahan setelah user berhasil dibuat
        $user->created_at = Carbon::now('GMT+7')->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
        $user->updated_at = $user->created_at;
        $user->save();

        // Trigger event registered
        event(new Registered($user));

        return redirect()->route('login')->with('status', 'Registrasi berhasil! Silahkan verifikasi email melalui link pada email anda.');
    }
}
