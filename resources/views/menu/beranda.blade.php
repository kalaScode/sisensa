<x-navbar></x-navbar>
<main class="max-w-7xl mx-auto sm:px-6 lg:px-36 py-6">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center text-sm font-medium text-gray-700">
                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                </svg>
                Beranda
            </li>
        </ol>
    </nav>
    <!-- Welcome Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 my-4">
        <div class="lg:col-span-2">
            <div class="bg-gradient-to-r from-gray-800 to-gray-700 rounded-2xl p-6 text-white shadow-lg">
                <h1 class="text-2xl font-semibold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="text-white/80">Semoga hari Anda menyenangkan</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-lg backdrop-blur-sm">
            <div class="flex items-center space-x-3">
                <img class="h-14 w-14 rounded-full object-cover"
                    src="{{ Auth::user()->perusahaan->Logo
                        ? asset('storage/' . Auth::user()->perusahaan->Logo)
                        : (Auth::user()->id_Perusahaan == 1
                            ? asset('/img/berkreasi.png')
                            : (Auth::user()->id_Perusahaan == 2
                                ? asset('/img/sft.png')
                                : (Auth::user()->id_Perusahaan == 3
                                    ? asset('/img/limbers.png')
                                    : (Auth::user()->id_Perusahaan == 4
                                        ? asset('/img/expert.png')
                                        : '#')))) }}"
                    alt="Profile Perusahaan">
                <div>
                    <h2 class="text-lg font-semibold">
                        {{ Auth::user()->perusahaan->nama_Perusahaan ?? 'Tidak ada perusahaan' }}
                    </h2>
                </div>
            </div>
        </div>

    </div>

    <!-- Attendance and Announcement Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Left side: Pengumuman (2/3) -->
        <div class="lg:col-span-2 space-y-4 flex flex-col justify-between">
            <div class="glide flex-grow">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        @if ($latestNotification)
                            <li class="glide__slide">
                                <a href="\notifikasi"
                                    class="block bg-white rounded-2xl shadow-lg p-4 transition-transform duration-300 hover:shadow-md transition-shadow">
                                    <span
                                        class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs mb-1">Pengumuman</span>
                                    <h5 class="text-md font-semibold ml-1">
                                        {{ $latestNotification->data['message'] }}
                                    </h5>
                                    <p class="text-gray-600 text-xs ml-1">
                                        {{ Str::words($latestNotification->data['description'] ?? 'No description available', 10, '...') }}
                                    </p>
                                </a>

                            </li>
                        @else
                            <li class="glide__slide">
                                <div class="bg-white rounded-2xl shadow-lg p-4 backdrop-blur-sm">
                                    <p class="text-gray-600 text-xs">Tidak ada pengumuman terbaru.</p>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="glide__bullets mt-4" data-glide-el="controls[nav]">
                    <button class="glide__bullet" data-glide-dir="=0"></button>
                    <button class="glide__bullet" data-glide-dir="=1"></button>
                </div>
            </div>
        </div>

        <!-- Right side: Check In and Check Out (1/3) -->
        <div class="lg:col-span-1 flex space-x-4 justify-between">
            <!-- Masuk -->
            <div
                class="bg-gray-50 rounded-xl p-3 hover:shadow-md transition-all w-1/2 h-24 flex flex-col justify-center items-center">
                <div class="text-xl font-semibold text-[#1f2937] mb-1">
                    {{ $jamMasuk }}
                </div>
                <div class="text-sm text-gray-600 text-center">Masuk</div>
            </div>
            <!-- Lamakerja -->
            <div
                class="bg-gray-50 rounded-xl p-3 hover:shadow-md transition-all w-1/2 h-24 flex flex-col justify-center items-center">
                <div class="text-xl font-semibold text-yellow-500 mb-1">
                    {{ $lamaKerja }}
                </div>
                <div class="text-sm text-gray-600 text-center">Berjalan</div>
            </div>
            <!-- Keluar -->
            <div
                class="bg-gray-50 rounded-xl p-3 hover:shadow-md transition-all w-1/2 h-24 flex flex-col justify-center items-center">
                <div class="text-xl font-semibold text-green-500 mb-1">
                    {{ $jamKeluar }}
                </div>
                <div class="text-sm text-gray-600 text-center">Keluar</div>
            </div>
        </div>
    </div>

    </div>
    <div id="gallery" class="p-2">
        <!-- Grid wrapper -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 text-center">
            <!-- Card 1 -->
            <a href="/presensi"
                class="bg-white p-6 rounded-lg shadow-lg hover:shadow-md transition-shadow flex flex-col items-center">
                <div class="w-12 h-12 bg-[#122036] rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-sign-in-alt text-white text-xl"></i>
                </div>
                <h3 class="font-medium mb-1">Presensi</h3>
                <p class="text-sm text-gray-500">Catat kehadiran Anda</p>
            </a>
            <!-- Card 2 -->
            <a href="/cuti"
                class="bg-white p-6 rounded-lg shadow-lg hover:shadow-md transition-shadow flex flex-col items-center">
                <div class="w-12 h-12 bg-[#122036] rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-calendar-alt text-white text-xl"></i>
                </div>
                <h3 class="font-medium mb-1">Cuti</h3>
                <p class="text-sm text-gray-500">Ajukan cuti</p>
            </a>
            <!-- Card 3 -->
            <a href="/riwayat_pribadi"
                class="bg-white p-6 rounded-lg shadow-lg hover:shadow-md transition-shadow flex flex-col items-center">
                <div class="w-12 h-12 bg-[#122036] rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-history text-white text-xl"></i>
                </div>
                <h3 class="font-medium mb-1">Riwayat Pribadi</h3>
                <p class="text-sm text-gray-500">Lihat riwayat kehadiranmu</p>
            </a>
            <!-- Card 4 -->
            <a href="/daftar-karyawan"
                class="bg-white p-6 rounded-lg shadow-lg hover:shadow-md transition-shadow flex flex-col items-center">
                <div class="w-12 h-12 bg-[#122036] rounded-lg flex items-center justify-center mb-4">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <h3 class="font-medium mb-1">Daftar Karyawan</h3>
                <p class="text-sm text-gray-500">Lihat daftar karyawan</p>
            </a>
            <!-- Card 5 -->
            @if ($role == '3')
                <a href="/persetujuan-cuti"
                    class="bg-white p-6 rounded-lg shadow-lg hover:shadow-md transition-shadow flex flex-col items-center">
                    <div class="w-12 h-12 bg-[#122036] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
                            <path fill-rule="evenodd"
                                d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="font-medium mb-1">Persetujuan</h3>
                    <p class="text-sm text-gray-500">Memberikan persetujuan</p>
                </a>
            @endif
            <!-- Card 6 -->
            @if (in_array($role, ['3', '4']))
                <a href="/riwayat_karyawan"
                    class="bg-white p-6 rounded-lg shadow-lg hover:shadow-md transition-shadow flex flex-col items-center">
                    <div class="w-12 h-12 bg-[#122036] rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="font-medium mb-1">Riwayat Karyawan</h3>
                    <p class="text-sm text-gray-500">Riwayat Seluruh Karyawan</p>
                </a>
            @endif
        </div>
    </div>
</main>
<x-footer></x-footer>
