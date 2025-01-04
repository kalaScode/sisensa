<x-guest-layout>
    <p class="text-blue-200 text-center mb-8">Silakan masuk ke akun Anda</p>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-300">{{ __('Ingat Saya') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-300 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 float-right"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa passwordmu?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="flex flex-col items-center mt-6">
            <!-- Tombol Masuk -->
            <x-primary-button class="w-1/2 py-3 text-white text-center font-medium hover:bg-blue-700 transition-all">
                {{ __('Masuk') }}
            </x-primary-button>

            <!-- Register Link -->
            <a class="mt-4 underline text-sm text-gray-300 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('register') }}">
                {{ __('Belum punya akun? Daftar di sini') }}
            </a>
        </div>


    </form>
</x-guest-layout>
