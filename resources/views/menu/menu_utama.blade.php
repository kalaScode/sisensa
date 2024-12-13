<x-navbar></x-navbar>
<body class="bg-gray-50 min-h-screen font-['Plus_Jakarta_Sans']">
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="lg:col-span-2">
                <div class="bg-gradient-to-r from-gray-800 to-gray-700 rounded-2xl p-8 text-white shadow-lg">
                    <h1 class="text-3xl font-bold mb-2">Selamat Datang, Wafi Aulia!</h1>
                    <p class="text-white/80">Semoga hari Anda menyenangkan</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-lg backdrop-blur-sm">
                <div class="flex items-center space-x-4">
                    <img class="h-16 w-16 rounded-full object-cover" src="https://i1.rgstatic.net/ii/profile.image/11431281211065375-1702306328054_Q512/Wafi-Aulia-Tsabitah.jpg" alt="Profile">
                    <div>
                        <h2 class="text-xl font-semibold">Wafi Aulia</h2>
                        <p class="text-gray-600">Data Scientist</p>
                        <p class="text-gray-500">Data & AI Division</p>
                    </div>
                </div>
            </div>
        </div>

          <!-- Attendance Status -->
          <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h3 class="text-lg font-semibold mb-4">Status Presensi Hari Ini</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-2xl p-6 hover:shadow-md transition-all">
                        <div class="text-4xl font-bold text-[#1f2937] mb-2">08:00</div>
                        <div class="text-gray-600">Check In</div>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-6 hover:shadow-md transition-all">
                        <div class="text-4xl font-bold text-green-500 mb-2">17:00</div>
                        <div class="text-gray-600">Check Out</div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="mb-8">
        <div class="glide">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    <li class="glide__slide">
                        <div class="bg-white rounded-2xl shadow-lg p-6 backdrop-blur-sm">
                            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm mb-2">Pengumuman</span>
                            <h4 class="text-lg font-semibold mb-2">Libur Hari Raya Idul Fitri</h4>
                            <p class="text-gray-600">Libur Hari Raya Idul Fitri akan berlangsung dari tanggal 10-14 April 2024</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="glide__bullets mt-4" data-glide-el="controls[nav]">
                <button class="glide__bullet" data-glide-dir="=0"></button>
                <button class="glide__bullet" data-glide-dir="=1"></button>
            </div>
        </div>
        </div>
        <!-- Quick Access Section -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            <a href="#" class="bg-white p-8 rounded-2xl shadow-lg text-center hover:shadow-xl transition-all backdrop-blur-sm">
                <i class="fas fa-clock text-3xl text-gray-800 mb-4"></i>
                <h3 class="font-semibold">Presensi</h3>
            </a>
            <a href="./cuti" class="bg-white p-8 rounded-2xl shadow-lg text-center hover:shadow-xl transition-all backdrop-blur-sm">
                <i class="fas fa-calendar-alt text-3xl text-gray-800 mb-4"></i>
                <h3 class="font-semibold">Pengajuan Cuti</h3>
            </a>
            <a href="./persetujuan" class="bg-white p-8 rounded-2xl shadow-lg text-center hover:shadow-xl transition-all backdrop-blur-sm">
                <i class="fas fa-history text-3xl text-gray-800 mb-4"></i>
                <h3 class="font-semibold">Riwayat Kehadiran</h3>
            </a>
            <a href="./cuti" class="bg-white p-8 rounded-2xl shadow-lg text-center hover:shadow-xl transition-all backdrop-blur-sm">
                <i class="fas fa-calendar-check text-3xl text-gray-800 mb-4"></i>
                <h3 class="font-semibold">Riwayat Cuti</h3>
            </a>
            <a href="#" class="bg-white p-8 rounded-2xl shadow-lg text-center hover:shadow-xl transition-all backdrop-blur-sm">
                <i class="fas fa-users text-3xl text-gray-800 mb-4"></i>
                <h3 class="font-semibold">Daftar Karyawan</h3>
            </a>
            <a href="#" class="bg-white p-8 rounded-2xl shadow-lg text-center hover:shadow-xl transition-all backdrop-blur-sm">
                <i class="fas fa-user-cog text-3xl text-gray-800 mb-4"></i>
                <h3 class="font-semibold">Pengaturan</h3>
            </a>
        </div>
    </main>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
<x-footer></x-footer>
