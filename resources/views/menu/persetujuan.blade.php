<x-navbar></x-navbar>
<main class="w-full mx-auto px-4 sm:px-6 lg:px-36 py-10">
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6 backdrop-blur-lg bg-opacity-90">
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

    <div class="bg-white rounded-lg shadow-lg overflow-hidden backdrop-blur-lg bg-opacity-90">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pengajuan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Cuti</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
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

        <!-- Information Showing 1 to 10 of 20 results -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="text-sm text-gray-700">
                Showing <span class="font-semibold text-gray-900">1 to 10</span> of <span class="font-semibold text-gray-900">20</span> results
            </div>
            <div class="flex-1 flex justify-between sm:justify-end">
                <!-- Pagination Controls -->
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <!-- Previous Page Button -->
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Next</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M9.707 4.707a1 1 0 00-1.414 0L4 8.414a1 1 0 000 1.414l4 4a1 1 0 001.414-1.414L7.414 10h9.586a1 1 0 100-2H7.414l2.293-2.293a1 1 0 000-1.414z" clip-rule="evenodd" />
                        </svg>    
                    </a>

                    <!-- Pagination Numbers -->
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">1</a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">2</a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">3</a>

                    <!-- Next Page Button -->
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                    <span class="sr-only">Previous</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10.293 15.293a1 1 0 011.414 0l4-4a1 1 0 010-1.414l-4-4a1 1 0 00-1.414 1.414L12.586 9H3a1 1 0 100 2h9.586l-2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
</main>
<x-footer></x-footer>
