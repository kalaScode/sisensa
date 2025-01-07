<x-guest-layout>
    <p class="text-blue-200 text-center mb-8">Silakan daftarkan akun Anda</p>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        {{-- Dropdown perusahaan --}}
        <div>
            <x-input-label for="id_Perusahaan" :value="__('Perusahaan')" />
            <select id="id_Perusahaan" name="id_Perusahaan" class="block mt-1 w-full text-black">
                <option value="" enabled selected>{{ __('Pilih Perusahaan') }}</option>
                @foreach ($perusahaan as $p)
                    <option value="{{ $p->id_Perusahaan }}">{{ $p->nama_Perusahaan }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('id_Perusahaan')" class="mt-2" />
        </div>


        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- No Telepon --}}
        <div class="mt-4">
            <x-input-label for="no_Telp" :value="__('No Telepon')" />
            <x-text-input id="no_Telp" class="block mt-1 w-full" type="text" inputmode="numeric" name="no_Telp"
                :value="old('no_Telp')" required autocomplete="false" />
            <x-input-error :messages="$errors->get('no_Telp')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-300 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Sudah Punya Akun?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
