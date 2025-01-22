<div class="min-h-screen">
    {{-- Sidebar hanya tampil jika id_Otoritas adalah 1 atau 2 --}}
    @if (Auth::user()->id_Otoritas == 1 || Auth::user()->id_Otoritas == 2)
        <x-sidebar></x-sidebar>
    @endif

    {{-- Navbar hanya tampil jika id_Otoritas tidak sama dengan 1 atau 2 --}}
    @if (Auth::user()->id_Otoritas !== 1 && Auth::user()->id_Otoritas !== 2)
        <x-navbar></x-navbar>
    @endif
    <main class="max-w-7xl mx-auto sm:px-6 lg:px-36 py-10">
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                @if (Auth::user()->id_Otoritas !== 1 && Auth::user()->id_Otoritas !== 2)
                    <li class="inline-flex items-center">
                        <a href="/beranda"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-800 dark:text-gray-500 dark:hover:text-gray">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Beranda
                        </a>
                    </li>
                @else
                    <li class="inline-flex items-center hidden md:block">
                        <!-- Sembunyikan pada mobile, tampilkan pada desktop -->
                        <a href="/dashboard"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-800 dark:text-gray-500 dark:hover:text-gray">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            dashbo      
                        </a>
                    </li>
                @endif
                <li class="inline-flex items-center text-sm font-medium text-gray-700">
                    @if (Auth::user()->id_Otoritas !== 1 && Auth::user()->id_Otoritas !== 2)
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                    @endif
                    @if (Auth::user()->id_Otoritas == 1 || Auth::user()->id_Otoritas == 2)
                        <svg class="w-auto text-gray mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                clip-rule="evenodd" />
                        </svg>
                    @endif
                    Profil
                </li>
            </ol>
        </nav>
        <div class="bg-gray-100 rounded-lg shadow p-6 max-w-lg mx-auto">
            <div class="relative w-24 h-24 mx-auto mb-4">
                <img src="{{ Auth::user()->Avatar ? asset('storage/' . Auth::user()->Avatar) : '/img/profil.jpg' }}"
                    alt="Foto Profil" class="w-full h-full rounded-full object-cover border-2 border-[#F6CD61]">

                <button
                    class="absolute top-1 right-1 w-8 h-8 bg-[#F6CD61] rounded-full flex items-center justify-center shadow">
                    <a href="/edit-profil"><i class="fas fa-pencil-alt text-[#122036] placeholder-edit"></i></a>
                </button>
            </div>

            <div class="text-center mb-6">
                <h2 class="text-lg font-semibold text-[#122036] mb-1">{{ Auth::user()->name }}</h2>
                <p class="text-sm text-[#122036]">{{ Auth::user()->jabatan->nama_Jabatan }}</p>
            </div>

            <div class="space-y-4">
                <div class="border-b border-gray-300 pb-3">
                    <p class="text-xs text-gray-500 mb-1">Nama Perusahaan</p>
                    <p class="text-[#122036] font-medium text-sm">{{ Auth::user()->perusahaan->nama_Perusahaan }}</p>
                </div>

                <div class="border-b border-gray-300 pb-3">
                    <p class="text-xs text-gray-500 mb-1">Email</p>
                    <p class="text-[#122036] font-medium text-sm">{{ Auth::user()->email }}</p>
                </div>

                <div class="border-b border-gray-300 pb-3">
                    <p class="text-xs text-gray-500 mb-1">Nomor Telepon</p>
                    <p class="text-[#122036] font-medium text-sm">{{ Auth::user()->no_Telp }}</p>
                </div>

                <div class="border-b border-gray-300 pb-3">
                    <p class="text-xs text-gray-500 mb-1">Alamat</p>
                    <p class="text-[#122036] font-medium text-sm">{{ Auth::user()->Alamat }}</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Pemberi Persetujuan</p>
                    <p class="text-[#122036] font-medium text-sm">
                        {{ $pemberiPersetujuan }}
                    </p>
                </div>
            </div>
        </div>
    </main>
    {{-- Foooter hanya tampil jika id_Otoritas tidak sama dengan 1 atau 2 --}}
    @if (Auth::user()->id_Otoritas !== 1 && Auth::user()->id_Otoritas !== 2)
        <x-footer></x-footer>
    @endif
</div>
