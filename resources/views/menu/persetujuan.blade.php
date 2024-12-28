<x-navbar></x-navbar>
<main class="w-full mx-auto mb-6 px-4 sm:px-6 lg:px-36 py-10 ">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="/beranda" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-800 dark:text-gray-500 dark:hover:text-gray">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Beranda
                </a>
            </li>
            <li class="inline-flex items-center text-sm font-medium text-gray-700">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
                Persetujuan
             </li>
        </ol>
    </nav>
    
    <div class="bg-white rounded-lg shadow-lg p-6 my-6 backdrop-blur-lg bg-opacity-90">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select class="w-full border-gray-300 rounded-md shadow-sm !rounded-button">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Disetujui</option>
                    <option value="rejected">Ditolak</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Karyawan</label>
                <div class="relative">
                    <input type="text" class="w-full pl-10 pr-4 py-2 border-gray-300 rounded-md shadow-sm !rounded-button" placeholder="Masukkan nama karyawan..."/>
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                <input type="date" class="w-full border-gray-300 rounded-md shadow-sm !rounded-button"/>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white shadow rounded-lg overflow-x-auto overflow-x-auto ">
        <table class="min-w-full bg-white border boreder-black">
            <thead class="bg-[#122036] text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Tanggal Pengajuan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Jenis Cuti</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Durasi</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Periode</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Repeat this row for 20 people -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover" src="https://img.freepik.com/free-photo/young-male-posing-isolated-against-blank-studio-wall_273609-12356.jpg" alt="Budi Santoso"/>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Budi Santoso</div>
                                    <div class="text-sm text-gray-500">IT Department</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-02-20</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Cuti Tahunan</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3 hari</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-01 s/d 2024-03-03</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="bg-green-500 text-white px-3 py-1 rounded-md !rounded-button mr-2">Setujui</button>
                            <button class="bg-soft-red text-white px-3 py-1 rounded-md !rounded-button">Tolak</button>
                        </td>
                    </tr>
                    <!-- Data Karyawan 2 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover" src="https://img.freepik.com/free-photo/young-female-posing_273609-12456.jpg" alt="Siti Aisyah"/>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Siti Aisyah</div>
                                    <div class="text-sm text-gray-500">HR Department</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-02-22</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Cuti Sakit</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2 hari</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-03 s/d 2024-03-04</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="bg-green-500 text-white px-3 py-1 rounded-md !rounded-button mr-2">Setujui</button>
                            <button class="bg-soft-red text-white px-3 py-1 rounded-md !rounded-button">Tolak</button>
                        </td>
                    </tr>
                    <!-- Repeat similar rows up to 20 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover" src="https://img.freepik.com/free-photo/young-male-posing_273609-12567.jpg" alt="John Doe"/>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">John Doe</div>
                                    <div class="text-sm text-gray-500">Marketing Department</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-01</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Cuti Tahunan</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5 hari</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-10 s/d 2024-03-14</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="bg-green-500 text-white px-3 py-1 rounded-md !rounded-button mr-2">Setujui</button>
                            <button class="bg-soft-red text-white px-3 py-1 rounded-md !rounded-button">Tolak</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover" src="https://img.freepik.com/free-photo/young-male-posing_273609-12478.jpg" alt="Rudi Pratama"/>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Rudi Pratama</div>
                                    <div class="text-sm text-gray-500">Finance Department</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-05</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Cuti Sakit</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4 hari</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-10 s/d 2024-03-13</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="bg-green-500 text-white px-3 py-1 rounded-md !rounded-button mr-2">Setujui</button>
                            <button class="bg-soft-red text-white px-3 py-1 rounded-md !rounded-button">Tolak</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover" src="https://img.freepik.com/free-photo/young-woman-smiling_273609-12522.jpg" alt="Sari Mulyani"/>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Sari Mulyani</div>
                                    <div class="text-sm text-gray-500">HR Department</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-02-25</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Cuti Melahirkan</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">14 hari</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-01 s/d 2024-03-14</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="bg-green-500 text-white px-3 py-1 rounded-md !rounded-button mr-2">Setujui</button>
                            <button class="bg-soft-red text-white px-3 py-1 rounded-md !rounded-button">Tolak</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover" src="https://img.freepik.com/free-photo/young-woman-smiling-outside_273609-12633.jpg" alt="Dewi Kusuma"/>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Dewi Kusuma</div>
                                    <div class="text-sm text-gray-500">Marketing Department</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-01</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Cuti Tahunan</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5 hari</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-05 s/d 2024-03-09</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="bg-green-500 text-white px-3 py-1 rounded-md !rounded-button mr-2">Setujui</button>
                            <button class="bg-soft-red text-white px-3 py-1 rounded-md !rounded-button">Tolak</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover" src="https://img.freepik.com/free-photo/young-man-smiling_273609-12714.jpg" alt="Ahmad Zaki"/>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Ahmad Zaki</div>
                                    <div class="text-sm text-gray-500">IT Department</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-02</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Cuti Sakit</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2 hari</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-07 s/d 2024-03-08</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="bg-green-500 text-white px-3 py-1 rounded-md !rounded-button mr-2">Setujui</button>
                            <button class="bg-soft-red text-white px-3 py-1 rounded-md !rounded-button">Tolak</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover" src="https://img.freepik.com/free-photo/young-woman-laughing_273609-12845.jpg" alt="Lina Pratiwi"/>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Lina Pratiwi</div>
                                    <div class="text-sm text-gray-500">Sales Department</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-01</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Cuti Tahunan</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6 hari</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-12 s/d 2024-03-17</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="bg-green-500 text-white px-3 py-1 rounded-md !rounded-button mr-2">Setujui</button>
                            <button class="bg-soft-red text-white px-3 py-1 rounded-md !rounded-button">Tolak</button>
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
</main>
<x-footer></x-footer>
