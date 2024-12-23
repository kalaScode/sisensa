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
            <li class="inline-flex items-center inline-flex items-center text-sm font-medium text-gray-700">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
                Daftar Karyawan
             </li>
        </ol>
    </nav>
    <div class="flex-1 max-w-8xl w-full mx-auto py-8">
        <div class="bg-white rounded-lg shadow">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px">
                    <button class="px-6 py-4 text-sm font-medium text-custom border-b-2 border-[#122036]">
                        Daftar Karyawan
                    </button>
                    @if ($role=='hrd')
                    <a href="/persetujuan-akun">
                        <button class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            Persetujuan Akun
                        </button>
                    </a>
                    @endif
                </nav>
            </div>

            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <div class="relative">
                        <input type="text" placeholder="Cari karyawan..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-custom focus:border-custom">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
                {{-- Tabel --}}
                <div class="bg-white shadow rounded-lg overflow-x-auto ">
                    <table class="min-w-full bg-white border boreder-black">
                        <thead class="bg-[#122036] text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white  tracking-wider">Nama Karyawan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white  tracking-wider">Jabatan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white  tracking-wider">Kontak</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white  tracking-wider">Status</th>
                                @if ($role=='hrd')
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white  tracking-wider">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full" src="#" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Raka AB Kharisma</div>
                                            <div class="text-sm text-gray-500">ID: KRY001</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Senior Developer</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">raka@sisensa.id</div>
                                    <div class="text-sm text-gray-500">+62 812-3456-7890</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                </td>
                                @if ($role=='hrd')
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <!-- Tombol Detail -->
                                    <button class="text-custom hover:text-custom-dark mr-3" onclick="openModal('Raka AB Kharisma', 'Senior Developer', 'Sisensa', 'raka@sisensa.id', '+62 812-3456-7890', 'Jl. Merdeka No. 10', '5')">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                                @endif
                            </tr>
                            <!-- Karyawan lainnya -->
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
</div>

<!-- Modal untuk menampilkan dan mengedit karyawan -->
<div id="modal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">Detail Karyawan</h3>
            <button class="text-gray-400 hover:text-gray-500" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="px-6 py-4">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input id="modal-nama" class="mt-1 text-gray-900 p-2 border border-gray-300 rounded" type="text">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <input id="modal-jabatan" class="mt-1 text-gray-900 p-2 border border-gray-300 rounded" type="text">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                    <input id="modal-perusahaan" class="mt-1 text-gray-900 p-2 border border-gray-300 rounded" type="text">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="modal-email" class="mt-1 text-gray-900 p-2 border border-gray-300 rounded" type="email">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input id="modal-telepon" class="mt-1 text-gray-900 p-2 border border-gray-300 rounded" type="tel">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input id="modal-alamat" class="mt-1 text-gray-900 p-2 border border-gray-300 rounded" type="text">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Persetujuan</label>
                    <input id="modal-persetujuan" class="mt-1 text-gray-900 p-2 border border-gray-300 rounded" type="text" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Saldo Cuti</label>
                    <input id="modal-saldo" class="mt-1 text-gray-900 p-2 border border-gray-300 rounded" type="number">
                </div>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
            <button class="!rounded-button px-4 py-2 border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50" onclick="closeModal()">
                Tutup
            </button>
            <button class="!rounded-button px-4 py-2 border border-blue-500 text-sm font-medium text-blue-700 hover:bg-blue-50" onclick="saveChanges()">Simpan Perubahan</button>
        </div>
    </div>
</div>

<script>
    // Simulasi Role HRD
    const userRole = 'HRD'; // Ganti dengan role sesuai
    const editButton = document.getElementById('edit-btn');

    // Menampilkan tombol Edit hanya untuk HRD
    if (userRole === 'HRD') {
        editButton.classList.remove('hidden');
    }

    // Membuka modal untuk melihat detail karyawan
    function openModal(nama, jabatan, perusahaan, email, telepon, alamat, saldo) {
        document.getElementById('modal-nama').textContent = nama;
        document.getElementById('modal-jabatan').textContent = jabatan;
        document.getElementById('modal-perusahaan').textContent = perusahaan;
        document.getElementById('modal-email').textContent = email;
        document.getElementById('modal-telepon').textContent = telepon;
        document.getElementById('modal-alamat').textContent = alamat;
        document.getElementById('modal-persetujuan').textContent = "Telah disetujui";
        document.getElementById('modal-saldo').textContent = saldo + " Hari";
        document.getElementById('modal').classList.remove('hidden');
    }

    // Menutup modal
    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    // Fungsi untuk mengedit karyawan
    function editKaryawan(nama, jabatan, perusahaan, email, telepon, alamat) {
        document.getElementById('modal-nama').value = nama;
        document.getElementById('modal-jabatan').value = jabatan;
        document.getElementById('modal-perusahaan').value = perusahaan;
        document.getElementById('modal-email').value = email;
        document.getElementById('modal-telepon').value = telepon;
        document.getElementById('modal-alamat').value = alamat;
        document.getElementById('modal').classList.remove('hidden');
    }

    // Simpan perubahan
    function saveChanges() {
        const nama = document.getElementById('modal-nama').value;
        const jabatan = document.getElementById('modal-jabatan').value;
        const perusahaan = document.getElementById('modal-perusahaan').value;
        const email = document.getElementById('modal-email').value;
        const telepon = document.getElementById('modal-telepon').value;
        const alamat = document.getElementById('modal-alamat').value;
        const saldo = document.getElementById('modal-saldo').value;

        // Proses penyimpanan atau update data di sini
        console.log('Data yang disimpan:', { nama, jabatan, perusahaan, email, telepon, alamat, saldo });

        closeModal();
    }
</script>
</main>

<x-footer></x-footer>
