    <x-navbar></x-navbar>
    <main class="max-w-7xl mx-auto sm:px-6 lg:px-36 py-10">
        <div class="max-w-7xl mx-auto px-4 flex justify-center">
            <h1 class="text-3xl font-bold text-[#122036] text-center">Daftar Karyawan</h1>
        </div>
        <div class="mb-8 flex justify-end">
            <div class="relative w-1/3">
                <input type="text" placeholder="Cari karyawan berdasarkan nama, jabatan, atau informasi lainnya..." class="w-full pl-10 pr-3 py-2 text-sm border-2 border-custom rounded-lg focus:outline-none focus:border-custom" />
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border boreder-black">
                <thead class="bg-[#122036] text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Foto</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Nama</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Jabatan</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Telepon</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                        @if($role=='admin')
                            <th class="px-6 py-3 text-left text-sm font-semibold">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4"><img src="https://creatie.ai/ai/api/search-image?query=A professional headshot of an Indonesian businessman wearing a formal suit with a clean white background, looking confident and approachable&width=100&height=100&flag=c1a3b7fc-dc91-4c7f-b63c-bb7040ee0759" class="w-12 h-12 rounded-full object-cover" /></td>
                        <td class="px-6 py-4 text-sm font-medium text-[#122036]">Budi Santoso</td>
                        <td class="px-6 py-4 text-sm text-[#122036]">Direktur Utama</td>
                        <td class="px-6 py-4 text-sm text-gray-600">+62 812-3456-7890</td>
                        <td class="px-6 py-4 text-sm text-gray-600">budi.santoso@company.id</td>
                        @if ($role=='admin')
                            <td class="px-6 py-4"><a href="/edit_daftar_karyawan" class="inline-block px-3 py-1.5 bg-custom text-white text-sm rounded-lg hover:bg-opacity-90 transition-colors"><i class="fas fa-user-circle mr-2"></i>Lihat Detail</a></td>
                        @endif
                    </tr>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4"><img src="https://creatie.ai/ai/api/search-image?query=A professional headshot of an Indonesian businessman wearing a formal suit with a clean white background, looking confident and approachable&width=100&height=100&flag=c1a3b7fc-dc91-4c7f-b63c-bb7040ee0759" class="w-12 h-12 rounded-full object-cover" /></td>
                        <td class="px-6 py-4 text-sm font-medium text-[#122036]">Budi Santoso</td>
                        <td class="px-6 py-4 text-sm text-[#122036]">Direktur Utama</td>
                        <td class="px-6 py-4 text-sm text-gray-600">+62 812-3456-7890</td>
                        <td class="px-6 py-4 text-sm text-gray-600">budi.santoso@company.id</td>
                        @if ($role=='admin')
                        <td class="px-6 py-4"><a href="/edit_daftar_karyawan" class="inline-block px-3 py-1.5 bg-custom text-white text-sm rounded-lg hover:bg-opacity-90 transition-colors"><i class="fas fa-user-circle mr-2"></i>Lihat Detail</a></td>
                        @endif
                    </tr>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4"><img src="https://creatie.ai/ai/api/search-image?query=A professional headshot of an Indonesian businessman wearing a formal suit with a clean white background, looking confident and approachable&width=100&height=100&flag=c1a3b7fc-dc91-4c7f-b63c-bb7040ee0759" class="w-12 h-12 rounded-full object-cover" /></td>
                        <td class="px-6 py-4 text-sm font-medium text-[#122036]">Budi Santoso</td>
                        <td class="px-6 py-4 text-sm text-[#122036]">Direktur Utama</td>
                        <td class="px-6 py-4 text-sm text-gray-600">+62 812-3456-7890</td>
                        <td class="px-6 py-4 text-sm text-gray-600">budi.santoso@company.id</td>
                        @if ($role=='admin')
                        <td class="px-6 py-4"><a href="/edit_daftar_karyawan" class="inline-block px-3 py-1.5 bg-custom text-white text-sm rounded-lg hover:bg-opacity-90 transition-colors"><i class="fas fa-user-circle mr-2"></i>Lihat Detail</a></td>
                        @endif
                    </tr>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4"><img src="https://creatie.ai/ai/api/search-image?query=A professional headshot of an Indonesian businessman wearing a formal suit with a clean white background, looking confident and approachable&width=100&height=100&flag=c1a3b7fc-dc91-4c7f-b63c-bb7040ee0759" class="w-12 h-12 rounded-full object-cover" /></td>
                        <td class="px-6 py-4 text-sm font-medium text-[#122036]">Budi Santoso</td>
                        <td class="px-6 py-4 text-sm text-[#122036]">Direktur Utama</td>
                        <td class="px-6 py-4 text-sm text-gray-600">+62 812-3456-7890</td>
                        <td class="px-6 py-4 text-sm text-gray-600">budi.santoso@company.id</td>
                        @if ($role=='admin')
                        <td class="px-6 py-4"><a href="/edit_daftar_karyawan" class="inline-block px-3 py-1.5 bg-custom text-white text-sm rounded-lg hover:bg-opacity-90 transition-colors"><i class="fas fa-user-circle mr-2"></i>Lihat Detail</a></td>
                        @endif
                    </tr>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4"><img src="https://creatie.ai/ai/api/search-image?query=A professional headshot of an Indonesian businessman wearing a formal suit with a clean white background, looking confident and approachable&width=100&height=100&flag=c1a3b7fc-dc91-4c7f-b63c-bb7040ee0759" class="w-12 h-12 rounded-full object-cover" /></td>
                        <td class="px-6 py-4 text-sm font-medium text-[#122036]">Budi Santoso</td>
                        <td class="px-6 py-4 text-sm text-[#122036]">Direktur Utama</td>
                        <td class="px-6 py-4 text-sm text-gray-600">+62 812-3456-7890</td>
                        <td class="px-6 py-4 text-sm text-gray-600">budi.santoso@company.id</td>
                        @if ($role=='admin')
                        <td class="px-6 py-4"><a href="/edit_daftar_karyawan" class="inline-block px-3 py-1.5 bg-custom text-white text-sm rounded-lg hover:bg-opacity-90 transition-colors"><i class="fas fa-user-circle mr-2"></i>Lihat Detail</a></td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-8 flex justify-end">
            <nav class="flex items-center space-x-2">
                <button class="px-4 py-2 border-2 border-[#122036] text-[#122036] rounded-lg !rounded-button hover:bg-custom hover:text-white hover:border-custom">
                    <i class="fas fa-chevron-left mr-2"></i>
                    Sebelumnya
                </button>
                <button class="px-4 py-2 bg-custom border-2 border-custom text-white rounded-lg !rounded-button">1</button>
                <button class="px-4 py-2 border-2 border-[#122036] text-[#122036] rounded-lg !rounded-button hover:bg-custom hover:text-white hover:border-custom">2</button>
                <button class="px-4 py-2 border-2 border-[#122036] text-[#122036] rounded-lg !rounded-button hover:bg-custom hover:text-white hover:border-custom">3</button>
                <button class="px-4 py-2 border-2 border-[#122036] text-[#122036] rounded-lg !rounded-button hover:bg-custom hover:text-white hover:border-custom">
                    Selanjutnya
                    <i class="fas fa-chevron-right ml-2"></i>
                </button>
            </nav>
        </div>
    </main>

    <x-footer></x-footer>
    
