<x-navbar></x-navbar>
<main class="max-w-7xl mx-auto sm:px-6 lg:px-36 py-10">
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
            <li class="inline-flex items-center text-sm font-medium text-gray-700">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
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
                    @if ($role == 4)
                        <!-- Perbaiki penggunaan operator pembanding -->
                        <a href="{{ route('persetujuan-akun') }}">
                            <button
                                class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                Persetujuan Akun
                            </button>
                        </a>
                    @endif
                </nav>
            </div>

            <div class="p-6">
                {{-- Search --}}
                <div class="relative mb-6">
                    <form action="{{ route('daftar-karyawan') }}" method="GET" class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input id="searchInput" name="search" type="text" value="{{ old('search', $search) }}"
                            placeholder="Cari karyawan..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-custom focus:border-custom">
                    </form>
                </div>

                {{-- Tabel --}}
                <div class="bg-white shadow rounded-lg overflow-x-auto ">
                    <table class="min-w-full bg-white border border-black">
                        <thead class="bg-[#122036] text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Nama
                                    Karyawan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Jabatan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Kontak
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Status
                                </th>
                                @if ($role == 4)
                                    <!-- Perbaiki penggunaan operator pembanding -->
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Aksi
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($karyawan as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <img src="{{ Auth::user()->Avatar ? asset('storage/' . Auth::user()->Avatar) : '/img/profil.jpg' }}"
                                                    alt="Foto Profil">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                                                <div class="text-sm text-gray-500">ID: {{ $item->user_id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $item->jabatan->nama_Jabatan ?? 'Tidak ada jabatan' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $item->email }}</div>
                                        <div class="text-sm text-gray-500">{{ $item->no_Telp }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $item->status_Kerja == 'Tetap' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $item->status_Kerja }}
                                        </span>
                                    </td>
                                    @if ($role == 4)
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <!-- Tombol Info (untuk membuka modal) -->
                                            <button type="button" data-modal-target="edit-modal"
                                                data-modal-toggle="edit-modal"
                                                class="text-custom hover:text-custom-dark mr-3"
                                                data-id="{{ $item->user_id }}" data-name="{{ $item->name }}"
                                                data-perusahaan="{{ $item->perusahaan->nama_Perusahaan }}"
                                                data-jabatan="{{ $item->jabatan->nama_Jabatan ?? '' }}"
                                                data-email="{{ $item->email }}" data-telepon="{{ $item->no_Telp }}"
                                                data-alamat="{{ $item->Alamat }}"
                                                data-statuskerja="{{ $item->status_Kerja }}"
                                                data-statusakun="{{ $item->status_Akun }}"
                                                data-saldo="{{ $item->saldoCuti->saldo_Sisa ?? 12 }}"
                                                onclick="openModal(this)">
                                                <i class="fas fa-info-circle"></i>
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('delete-karyawan', $item->user_id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirmDeletion(event, '{{ $item->name }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
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
                            class="font-medium">{{ $karyawan->total() }}</span> hasil
                    </div>
                    <div>
                        {{ $karyawan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->

<div id="edit-modal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 z-50 hidden w-full h-full bg-gray-600 bg-opacity-50 items-center justify-center">
    <div class="relative w-full max-w-2xl h-auto mx-auto bg-gray-900 mt-20 rounded-lg shadow-xl overflow-hidden">
        <div class="p-6 max-h-[80vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-white">Detail Karyawan</h3>
                <!-- Close Button -->
                <button type="button" class="text-gray-400 hover:text-gray-600 text-2xl" onclick="closeModal()">
                    ×
                </button>
            </div>
            <!-- Modal Form -->
            <form action="{{ route('update-karyawan', $item->user_id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" id="user_id">

                <!-- Nama -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-300">Nama</label>
                    <input type="text" id="name" name="name"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-custom focus:border-custom">
                </div>

                <!-- Perusahaan -->
                <div class="mb-4">
                    <label for="perusahaan" class="block text-sm font-medium text-gray-300">Perusahaan</label>
                    <input type="text" id="perusahaan" name="perusahaan"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-custom focus:border-custom"
                        readonly>
                </div>

                <!-- Jabatan -->
                <div class="mb-4">
                    <label for="jabatan" class="block text-sm font-medium text-gray-300">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-custom focus:border-custom">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                    <input type="email" id="email" name="email"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-custom focus:border-custom"
                        readonly>
                </div>

                <!-- Status Kerja -->
                <div class="mb-4">
                    <label for="status_Kerja" class="block text-sm font-medium text-gray-300">Status Kerja</label>
                    <div class="mt-1">
                        <label class="text-gray-400">
                            <input type="radio" id="status_Kerja_Tetap" name="status_Kerja" value="Tetap"
                                class="mr-2">
                            Tetap
                        </label>
                        <label class="ml-4 text-gray-400">
                            <input type="radio" id="status_Kerja_Kontrak" name="status_Kerja" value="Kontrak"
                                class="mr-2">
                            Kontrak
                        </label>
                    </div>
                </div>

                <!-- Status Akun -->
                <div class="mb-4">
                    <label for="status_Akun" class="block text-sm font-medium text-gray-300">Status Akun</label>
                    <div class="mt-1">
                        <label class="text-gray-400">
                            <input type="radio" id="status_Akun_Active" name="status_Akun" value="1"
                                class="mr-2">
                            Aktif
                        </label>
                        <label class="ml-4 text-gray-400">
                            <input type="radio" id="status_Akun_Inactive" name="status_Akun" value="0"
                                class="mr-2">
                            Nonaktif
                        </label>
                    </div>
                </div>

                <!-- No Telepon -->
                <div class="mb-4">
                    <label for="no_Telp" class="block text-sm font-medium text-gray-300">No Telepon</label>
                    <input type="text" id="no_Telp" name="no_Telp"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-custom focus:border-custom">
                </div>

                <!-- Alamat -->
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-300">Alamat</label>
                    <textarea id="alamat" name="alamat"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-custom focus:border-custom"></textarea>
                </div>

                <!-- Saldo Cuti -->
                <div class="mb-4">
                    <label for="saldo" class="block text-sm font-medium text-gray-300">Saldo Cuti</label>
                    <input type="number" id="saldo" name="saldo"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-custom focus:border-custom"
                        readonly>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4">
                    <!-- Tombol Tutup -->
                    <button type="button" class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500"
                        onclick="cancelChanges()">Tutup</button>

                    <!-- Tombol Simpan -->
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600"
                        onclick="return confirmSave()">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- JavaScript -->
<script>
    function openModal(button) {
        // Mengisi data modal dengan data dari tombol
        document.getElementById('user_id').value = button.getAttribute('data-id');
        document.getElementById('name').value = button.getAttribute('data-name');
        document.getElementById('perusahaan').value = button.getAttribute('data-perusahaan');
        document.getElementById('jabatan').value = button.getAttribute('data-jabatan');
        document.getElementById('email').value = button.getAttribute('data-email');
        document.getElementById('no_Telp').value = button.getAttribute('data-telepon');
        document.getElementById('alamat').value = button.getAttribute('data-alamat');
        document.getElementById('saldo').value = button.getAttribute('data-saldo');

        // Mengisi status kerja berdasarkan nilai yang diterima
        var statusKerja = button.getAttribute('data-statuskerja');
        if (statusKerja === "Tetap") {
            document.getElementById('status_Kerja_Tetap').checked = true;
        } else if (statusKerja === "Kontrak") {
            document.getElementById('status_Kerja_Kontrak').checked = true;
        }

        // Mengisi status akun berdasarkan nilai yang diterima (1 untuk aktif, 0 untuk nonaktif)
        var statusAkun = button.getAttribute('data-statusakun');
        if (statusAkun === "1") {
            document.getElementById('status_Akun_Active').checked = true;
        } else if (statusAkun === "0") {
            document.getElementById('status_Akun_Inactive').checked = true;
        }

        // Menampilkan modal
        document.getElementById('edit-modal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        window.location.href = '/daftar-karyawan';
    }

    // Fungsi untuk membatalkan perubahan (tanpa modal)
    function cancelChanges() {
        window.location.href = '/daftar-karyawan';
    }

    // Fungsi untuk konfirmasi sebelum menyimpan
    function confirmSave() {
        return confirm('Apakah Anda yakin ingin menyimpan perubahan?');
    }
</script>


<x-footer></x-footer>
