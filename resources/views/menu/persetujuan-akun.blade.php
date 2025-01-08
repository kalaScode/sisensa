<x-navbar></x-navbar>
<main class="max-w-7xl sm:px-6 lg:px-36 py-10">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="/beranda"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-800 dark:text-gray-500 dark:hover:text-gray">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Beranda
                </a>
            </li>
            <li class="inline-flex items-center">
                <a href="/daftar-karyawan"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-800 dark:text-gray-500 dark:hover:text-gray">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    Daftar Karyawan
                </a>
            </li>
            <li class="inline-flex items-center text-sm font-medium text-gray-700">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
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
                    <a href="/daftar-karyawan">
                        <button
                            class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
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
                <div class="relative mb-6">
                    <form action="{{ route('persetujuan-akun') }}" method="GET" class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input id="searchInput" name="search" type="text" value="{{ old('search', $search) }}"
                            placeholder="Cari karyawan..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-custom focus:border-custom">
                    </form>

                </div>

                <!-- Table -->
                <div class="bg-white shadow rounded-lg overflow-x-auto ">
                    @if ($karyawan->isEmpty())
                        <div class="p-4 mb-4 text-sm text-yellow-800 bg-yellow-100 rounded-lg border-l-4 border-yellow-500"
                            role="alert">
                            Karyawan tidak ditemukan.
                        </div>
                    @else
                        <table class="min-w-full bg-white border border-black">
                            <thead class="bg-[#122036] text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Nama
                                        Karyawan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">
                                        Email
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">
                                        Jabatan
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">
                                        Tanggal
                                        Pengajuan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($karyawan as $k)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0">
                                                    <img src="{{ $k->Avatar ? asset('storage/' . $k->Avatar) : '/img/profil.jpg' }}"
                                                        alt="Foto Profil"
                                                        class="w-full h-full rounded-full object-cover border-2 border-[#F6CD61]">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $k->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $k->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $k->jabatan ? $k->jabatan->nama_Jabatan : 'none' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($k->created_at)->format('d M Y') }}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $k->status_Akun == 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                                {{ $k->status_Akun == 0 ? 'Menunggu' : 'Disetujui' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                <!-- Detail Button -->
                                                <button
                                                    onclick="showDetailModal('{{ $k->user_id }}', '{{ $k->name }}', '{{ $k->email }}', '{{ $k->perusahaan ? $k->perusahaan->nama_Perusahaan : 'none' }}', '{{ $k->no_Telp }}', '{{ $k->status_Kerja }}', '{{ $k->created_at }}')"
                                                    class="text-blue-600 hover:text-blue-900">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>

                                                <!-- Ubah Status Button -->
                                                <form class="ubah-status-form"
                                                    action="{{ route('ubah-status-akun', $k->user_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-green-600 hover:text-green-900">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>

                                                <!-- Batalkan Akun Button -->
                                                <form class="batalkan-akun-form"
                                                    action="{{ route('batalkan-akun', $k->user_id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
                <!-- Pagination -->
                <div class="mt-6 flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">{{ $karyawan->firstItem() }}</span> sampai <span
                            class="font-medium">{{ $karyawan->lastItem() }}</span> dari <span
                            class="font-medium">{{ $karyawan->total() }}</span> data
                    </div>
                    <div class="flex space-x-2 items-center">
                        {{ $karyawan->links() }} <!-- Pagination Laravel -->
                    </div>
                    @endif
                </div>
            </div>
        </div>
</main>

<x-footer></x-footer>

<!-- Modal for employee detail -->
<div id="employeeDetailModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-8 w-3/4 lg:w-2/5">
        <!-- Modal Header with Divider -->
        <div class="border-b pb-4 mb-4">
            <h2 class="text-2xl font-semibold text-gray-900">Detail Informasi Karyawan</h2>
        </div>

        <!-- Modal Content -->
        <div id="modalContent" class="space-y-4 text-gray-800">

        </div>

        <!-- Modal Footer with Close Button -->
        <div class="mt-6 text-right">
            <button onclick="closeModal()"
                class="px-5 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-opacity-50">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk menampilkan modal dengan detail informasi karyawan
    function showDetailModal(userId, name, email, perusahaan, noTelp, statusKerja, createdAt) {
        // Format createdAt untuk menampilkan hanya tanggal
        const formattedDate = new Date(createdAt).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        // Menyusun konten modal dengan detail karyawan
        const modalContent = `
        <div class="space-y-3">
            <div><strong class="text-dark-600">Nama Karyawan<br></strong> ${name}</div>
            <div><strong class="text-dark-600">Email<br></strong> ${email}</div>
            <div><strong class="text-dark-600">Perusahaan<br></strong> ${perusahaan}</div>
            <div><strong class="text-dark-600">Nomor Telepon<br></strong> ${noTelp}</div>
            <div><strong class="text-dark-600">Status Kerja<br></strong> ${statusKerja}</div>
            <div><strong class="text-dark-600">Tanggal Pengajuan<br></strong> ${formattedDate}</div>
        </div>
    `;

        // Menyeting konten modal
        document.getElementById('modalContent').innerHTML = modalContent;

        // Menampilkan modal
        document.getElementById('employeeDetailModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        document.getElementById('employeeDetailModal').classList.add('hidden');
    }

    // Menangani konfirmasi SweetAlert saat form disubmit
    document.addEventListener('submit', function(event) {
        if (event.target.matches('.ubah-status-form') || event.target.matches('.batalkan-akun-form')) {
            event.preventDefault(); // Mencegah submit default

            let action = '';
            let message = '';
            let title = '';
            let icon = '';

            // Tentukan pesan konfirmasi berdasarkan form yang disubmit
            if (event.target.matches('.ubah-status-form')) {
                title = 'Apakah Anda yakin?';
                message = 'Apakah Anda ingin mengubah status akun ini?';
                icon = 'question';
                action = 'ubah-status-akun';
            } else if (event.target.matches('.batalkan-akun-form')) {
                title = 'Batalkan akun?';
                message = 'Apakah Anda ingin membatalkan pengajuan akun ini?';
                icon = 'warning';
                action = 'batalkan-akun';
            }

            // Tampilkan SweetAlert konfirmasi
            Swal.fire({
                title: title,
                text: message,
                icon: icon,
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form jika konfirmasi diterima
                    event.target.submit();
                }
            });
        }
    });
</script>
