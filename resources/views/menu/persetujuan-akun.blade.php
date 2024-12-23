<x-navbar></x-navbar>
<main class="max-w-7xl mx-auto sm:px-6 lg:px-36 py-10">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="/menu_utama" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-800 dark:text-gray-500 dark:hover:text-gray">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Beranda
                </a>
            </li>
            <li class="inline-flex items-center">
                <a href="/daftar_karyawan" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-800 dark:text-gray-500 dark:hover:text-gray">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    Daftar Karyawan
                </a>
            </li>
            <li class="inline-flex items-center inline-flex items-center text-sm font-medium text-gray-700">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    Persetujuan Akun
            </li>
        </ol>
    </nav>
    <div class="flex-1 max-w-8xl w-full mx-auto py-8">
        <div class="bg-white rounded-lg shadow">
            <!-- Navigation Tabs -->
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px">
                    <a href="/daftar_karyawan">
                        <button class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            Daftar Karyawan
                        </button>
                    </a>
                    <button class="px-6 py-4 text-sm font-medium text-custom border-b-2 border-[#122036]">
                        Persetujuan Akun
                    </button>
                </nav>
            </div>

            <!-- Content -->
            <div class="p-6">
                <!-- Search Bar -->
                <div class="flex justify-between items-center mb-6">
                    <div class="relative">
                        <input 
                            type="text" 
                            placeholder="Cari pengajuan akun..." 
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-custom focus:border-custom" 
                        />
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Table -->
                <div class="bg-white shadow rounded-lg overflow-x-auto overflow-x-auto ">
                    <table class="min-w-full bg-white border boreder-black">
                        <thead class="bg-[#122036] text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Nama Karyawan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Jabatan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Tanggal Pengajuan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full" src="https://creatie.ai/ai/api/search-image?query=professional%20headshot&width=40&height=40&flag=10ee3d36-bb0a-41ad-8b70-73bfb5574d78" alt=""/>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Budi Santoso</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">budi.santoso@sisensa.id</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Marketing Manager</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">2024-02-20</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-green-600 hover:text-green-900 mr-3">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari <span class="font-medium">15</span> data
                    </div>
                    <div class="flex space-x-2 items-center">
                        <button class="rounded-lg px-4 py-2 border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-custom">Sebelumnya</button>
                        <button class="rounded-lg px-4 py-2 border border-gray-300 bg-[#122036] text-white text-sm font-medium">1</button>
                        <button class="rounded-lg px-4 py-2 border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-custom">2</button>
                        <button class="rounded-lg px-4 py-2 border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-custom">Selanjutnya</button>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Detail Karyawan</h3>
                <button class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="px-6 py-4">
                <form>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-custom focus:border-custom"/>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ID Karyawan</label>
                            <input type="text" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-custom focus:border-custom"/>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                            <input type="text" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-custom focus:border-custom"/>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-custom focus:border-custom"/>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <input type="tel" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-custom focus:border-custom"/>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-custom focus:border-custom">
                                <option>Aktif</option>
                                <option>Non-aktif</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button class="!rounded-button px-4 py-2 border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Batal
                </button>
                <button class="!rounded-button px-4 py-2 bg-[#FACC15] text-custom text-sm font-medium hover:bg-[#F59E0B]">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</main>

<x-footer></x-footer>
