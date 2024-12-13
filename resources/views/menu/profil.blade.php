<div class="min-h-screen flex flex-col">
    <x-navbar></x-navbar>
    <main class="flex-1 max-w-5xl mx-auto px-4 py-6 sm:px-6 lg:px-16">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Profil</h1>
        <div class="bg-gray-100 rounded-lg shadow p-6 max-w-lg mx-auto">
            <div class="relative w-24 h-24 mx-auto mb-4">
                <img src="/img/profil.jpg" 
                     alt="Foto Profil" 
                     class="w-full h-full rounded-full object-cover border-2 border-[#F6CD61]">
                <button class="absolute top-1 right-1 w-8 h-8 bg-[#F6CD61] rounded-full flex items-center justify-center shadow">
                    <a href="/edit-profil"><i class="fas fa-pencil-alt text-[#122036] placeholder-edit"></i></a>
                </button>
            </div>

            <div class="text-center mb-6">
                <h2 class="text-lg font-semibold text-[#122036] mb-1">Wilfa Afriyani</h2>
                <p class="text-sm text-[#122036]">Manajer Pemasaran Senior</p>
            </div>

            <div class="space-y-4">
                <div class="border-b border-gray-300 pb-3">
                    <p class="text-xs text-gray-500 mb-1">Nama Perusahaan</p>
                    <p class="text-[#122036] font-medium text-sm">PT Maju Bersama Indonesia</p>
                </div>

                <div class="border-b border-gray-300 pb-3">
                    <p class="text-xs text-gray-500 mb-1">Email</p>
                    <p class="text-[#122036] font-medium text-sm">wilfa_example@gmail.com</p>
                </div>

                <div class="border-b border-gray-300 pb-3">
                    <p class="text-xs text-gray-500 mb-1">Nomor Telepon</p>
                    <p class="text-[#122036] font-medium text-sm">+62 812-3456-7890</p>
                </div>

                <div class="border-b border-gray-300 pb-3">
                    <p class="text-xs text-gray-500 mb-1">Alamat</p>
                    <p class="text-[#122036] font-medium text-sm">Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Pemberi Persetujuan</p>
                    <p class="text-[#122036] font-medium text-sm">Ibu Siti Rahayu - Direktur Utama</p>
                </div>
            </div>
        </div>
    </main>
    <x-footer></x-footer>
</div>
