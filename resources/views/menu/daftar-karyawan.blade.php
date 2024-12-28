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
            <li class="inline-flex items-center inline-flex items-center text-sm font-medium text-gray-700">
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
                    @if ($role = '3')
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
                                @if ($role == '3')
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
                                                <img class="h-10 w-10 rounded-full"
                                                    src="{{ $item->foto ?? '/path/to/default-avatar.jpg' }}"
                                                    alt="Avatar">
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
                                    @if ($role == '3')
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <!-- Tombol Info (untuk membuka modal) -->
                                            <!-- Modal toggle -->
                                            <button data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                                                class="text-custom hover:text-custom-dark mr-3"
                                                data-action="{{ route('edit-karyawan', $item->user_id) }}"
                                                data-id="{{ $item->user_id }}" data-name="{{ $item->name }}"
                                                data-jabatan="{{ $item->jabatan->nama_Jabatan }}"
                                                data-email="{{ $item->email }}" data-telepon="{{ $item->no_Telp }}"
                                                data-perusahaan="{{ $item->perusahaan->nama_Perusahaan }}"
                                                data-statuskerja="{{ $item->status_Kerja }}"
                                                data-statusakun="{{ $item->status_Akun }}"
                                                data-alamat="{{ $item->alamat }}"
                                                data-saldo="{{ $item->saldoCuti->saldo_Sisa ?? 0 }}"
                                                onclick="openModal(this)" type="button">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                            {{-- <button class="text-custom hover:text-custom-dark mr-3"
                                                data-id="{{ $item->user_id }}" data-name="{{ $item->name }}"
                                                data-jabatan="{{ $item->jabatan->nama_Jabatan }}"
                                                data-email="{{ $item->email }}" data-telepon="{{ $item->no_Telp }}"
                                                data-perusahaan="{{ $item->perusahaan->nama_Perusahaan }}"
                                                data-statuskerja="{{ $item->status_Kerja }}"
                                                data-statusakun="{{ $item->status_Akun }}"
                                                data-alamat="{{ $item->alamat }}"
                                                data-saldo="{{ $item->saldoCuti->saldo_Sisa ?? 0 }}"
                                                onclick="openModal(this)">
                                                <i class="fas fa-info-circle"></i>
                                            </button> --}}

                                            <!-- Tombol Hapus (dengan konfirmasi) -->
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
                            class="font-medium">{{ $karyawan->total() }}</span> data
                    </div>
                    <div class="flex space-x-2 items-center">
                        {{ $karyawan->links() }} <!-- Pagination Laravel -->
                    </div>
                </div>
</main>


<!-- Main modal -->
<!-- Edit Modal -->
<div id="edit-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full h-full overflow-x-hidden overflow-y-auto bg-black bg-opacity-50">
    <div class="relative w-full max-w-2xl max-h-full bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Edit Data Karyawan
            </h3>
            <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="edit-modal">
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                    aria-hidden="true">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
        <!-- Modal body -->
        <form id="formKaryawan" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="modal-id" name="id">
            <div class="p-4 space-y-4">
                <input type="hidden" name="user_id" id="edit-user-id">
                <div class="mb-4">
                    <label for="modal-nama" class="block text-sm font-medium text-gray-700">Nama
                        Lengkap</label>
                    <input id="modal-nama" name="nama"
                        class="mt-1 text-gray-900 p-2 border border-gray-300 rounded w-full" type="text"
                        value="{{ old('nama', $item->name) }}">
                </div>

                <div class="mb-4">
                    <label for="modal-perusahaan" class="block text-sm font-medium text-gray-700">Perusahaan
                    </label>
                    <input id="modal-perusahaan" name="perusahaan"
                        class="mt-1 text-gray-900 p-2 border border-gray-300 rounded w-full" type="text"
                        value="{{ old('perusahaan', $item->perusahaan->nama_Perusahaan ?? '') }}">
                </div>

                <div class="mb-4">
                    <label for="modal-jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <input id="modal-jabatan" name="jabatan"
                        class="mt-1 text-gray-900 p-2 border border-gray-300 rounded w-full" type="text"
                        value="{{ old('jabatan', $item->jabatan->nama_Jabatan ?? '') }}">
                </div>

                <div class="mb-4">
                    <label for="modal-statuskerja" class="block text-sm font-medium text-gray-700">Status
                        Kerja</label>
                    <div class="mt-1 text-gray-900 p-2 border border-gray-300 rounded w-full flex space-x-4">
                        <label>
                            <input type="radio" id="status-tetap" name="statuskerja" value="Tetap"
                                {{ old('statuskerja', $item->status_Kerja) == 'Tetap' ? 'checked' : '' }}>Tetap
                        </label>
                        <label>
                            <input type="radio" id="status-kontrak" name="statuskerja" value="Kontrak"
                                {{ old('statuskerja', $item->status_Kerja) == 'Kontrak' ? 'checked' : '' }}>Kontrak

                        </label>
                    </div>
                </div>

                <div class="mt-2">
                    <label for="statusakun" class="block text-sm font-medium text-gray-700">Status Akun</label>
                    <div class="mt-1">
                        <input type="radio" id="status-aktif" name="statusakun" value="1"
                            {{ old('statusakun', $item->status_Akun) == 1 ? 'checked' : '' }}> Aktif
                        <input type="radio" id="status-non-aktif" name="statusakun" value="0"
                            {{ old('statusakun', $item->status_Akun) == 0 ? 'checked' : '' }}> Non-Aktif
                    </div>
                </div>


                <div class="mb-4">
                    <label for="modal-email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="modal-email" name="email"
                        class="mt-1 text-gray-900 p-2 border border-gray-300 rounded w-full" type="email"
                        value="{{ old('email', $item->email) }}">
                </div>

                <div class="mb-4">
                    <label for="modal-telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
                    <input id="modal-telepon" name="telepon"
                        class="mt-1 text-gray-900 p-2 border border-gray-300 rounded w-full" type="text"
                        value="{{ old('telepon', $item->no_Telp) }}">
                </div>

                <div class="mb-4">
                    <label for="modal-alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea id="modal-alamat" name="alamat" class="mt-1 text-gray-900 p-2 border border-gray-300 rounded w-full">{{ old('alamat', $item->alamat) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="modal-saldo" class="block text-sm font-medium text-gray-700">Saldo
                        Cuti</label>
                    <!-- Input Saldo -->
                    <input id="modal-saldo" name="saldo"
                        class="mt-1 text-gray-900 p-2 border border-gray-300 rounded w-full" type="number"
                        value="{{ old('saldo', $item->saldoCuti->saldo_Sisa ?? 0) }}">
                </div>

                <!-- Tambahkan field lain sesuai kebutuhan -->
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" onclick="confirmSave()
                    class="text-white bg-blue-700
                    hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm
                    px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Simpan
                </button>
                <button type="button"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                    onclick="closeModal()">Batal</button>
            </div>
        </form>
    </div>
</div>


<!-- Modal untuk Edit Karyawan -->
{{-- <div id="modal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow-lg w-1/3">
        <h2 class="text-xl font-bold mb-4">Edit Karyawan</h2>
        <form id="formKaryawan" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="modal-id" name="id">

            <div class="mb-4">
                <label for="modal-nama" class="block text-sm font-medium text-gray-700">Nama
                    Lengkap</label>
                <input id="modal-nama" name="nama"
                    class="mt-1 text-gray-900 p-2 border border-gray-300 rounded w-full" type="text"
                    value="{{ old('nama', $item->name) }}">
            </div>

            <div class="mb-4">
                <label for="modal-perusahaan" class="block text-sm font-medium text-gray-700">Perusahaan
                </label>
                <input id="modal-perusahaan" name="perusahaan"
                    class="mt-1 text-gray-900 p-2 border border-gray-300 rounded w-full" type="text"
                    value="{{ old('perusahaan', $item->perusahaan->nama_Perusahaan ?? '') }}">
            </div>

            <div class="mb-4">
                <label for="modal-jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                <input id="modal-jabatan" name="jabatan"
                    class="mt-1 text-gray-900 p-2 border border-gray-300 rounded w-full" type="text"
                    value="{{ old('jabatan', $item->jabatan->nama_Jabatan ?? '') }}">
            </div>

            <div class="mb-4">
                <label for="modal-statuskerja" class="block text-sm font-medium text-gray-700">Status
                    Kerja</label>
                <div class="mt-1 text-gray-900 p-2 border border-gray-300 rounded w-full flex space-x-4">
                    <label>
                        <input type="radio" id="status-tetap" name="statuskerja" value="Tetap"
                            {{ old('statuskerja', $item->status_Kerja) == 'Tetap' ? 'checked' : '' }}>Tetap
                    </label>
                    <label>
                        <input type="radio" id="status-kontrak" name="statuskerja" value="Kontrak"
                            {{ old('statuskerja', $item->status_Kerja) == 'Kontrak' ? 'checked' : '' }}>Kontrak

                    </label>
                </div>
            </div>

            <div class="mt-2">
                <label for="statusakun" class="block text-sm font-medium text-gray-700">Status Akun</label>
                <div class="mt-1">
                    <input type="radio" id="status-aktif" name="statusakun" value="1"
                        {{ old('statusakun', $item->status_Akun) == 1 ? 'checked' : '' }}> Aktif
                    <input type="radio" id="status-non-aktif" name="statusakun" value="0"
                        {{ old('statusakun', $item->status_Akun) == 0 ? 'checked' : '' }}> Non-Aktif
                </div>
            </div>


            <div class="mb-4">
                <label for="modal-email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="modal-email" name="email"
                    class="mt-1 text-gray-900 p-2 border border-gray-300 rounded w-full" type="email"
                    value="{{ old('email', $item->email) }}">
            </div>

            <div class="mb-4">
                <label for="modal-telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
                <input id="modal-telepon" name="telepon"
                    class="mt-1 text-gray-900 p-2 border border-gray-300 rounded w-full" type="text"
                    value="{{ old('telepon', $item->no_Telp) }}">
            </div>

            <div class="mb-4">
                <label for="modal-alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea id="modal-alamat" name="alamat" class="mt-1 text-gray-900 p-2 border border-gray-300 rounded w-full">{{ old('alamat', $item->alamat) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="modal-saldo" class="block text-sm font-medium text-gray-700">Saldo
                    Cuti</label>
                <!-- Input Saldo -->
                <input id="modal-saldo" name="saldo"
                    class="mt-1 text-gray-900 p-2 border border-gray-300 rounded w-full" type="number"
                    value="{{ old('saldo', $item->saldoCuti->saldo_Sisa ?? 0) }}">
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeModal()"
                    class="bg-gray-600 text-white px-4 py-2 rounded">Tutup</button>
                <button type="button" onclick="confirmSave()"
                    class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div> --}}

<script>
    function openModal(button) {
        const data = button.dataset;

        console.log(data); // Debug: Cek apakah data yang diterima benar

        if (data) {
            document.getElementById('modal-id').value = data.id;
            document.getElementById('modal-nama').value = data.name;
            document.getElementById('modal-jabatan').value = data.jabatan;
            document.getElementById('modal-perusahaan').value = data.perusahaan;

            if (data.statuskerja === 'Tetap') {
                document.getElementById('status-tetap').checked = true;
            } else if (data.statuskerja === 'Kontrak') {
                document.getElementById('status-kontrak').checked = true;
            }

            if (data.statusakun === '1') {
                document.getElementById('status-aktif').checked = true;
            } else if (data.statusakun === '0') {
                document.getElementById('status-nonaktif').checked = true;
            }

            document.getElementById('modal-email').value = data.email;
            document.getElementById('modal-telepon').value = data.telepon;
            document.getElementById('modal-alamat').value = data.alamat;
            document.getElementById('modal-saldo').value = data.saldo;

            const form = document.getElementById('formKaryawan');
            form.action = data.action;

            document.getElementById('edit-modal').classList.remove('hidden');
        }
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    function confirmSave() {
        const form = document.getElementById('formKaryawan');
        const formData = new FormData(form); // Ambil data dari form

        fetch(form.action, {
                method: 'PUT', // Sesuaikan metode (POST/PUT)
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, // Laravel CSRF token
                    'Accept': 'application/json' // Meminta respons JSON
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json(); // Ambil error JSON jika status bukan OK
                }
                return response.json(); // Jika OK, ambil data response
            })
            .then(data => {
                if (data.errors) {
                    // Jika ada error validasi, tampilkan error tersebut
                    const errorMessages = Object.values(data.errors).join(', ');
                    alert('Kesalahan: ' + errorMessages);
                } else {
                    // Jika berhasil
                    alert('Perubahan berhasil disimpan!');
                    closeModal(); // Fungsi untuk menutup modal
                    location.reload(); // Refresh halaman
                }
            })
            .catch(error => {
                console.error('Error saat memperbarui data:', error);
                alert('Terjadi kesalahan saat menyimpan perubahan. Silakan coba lagi.');
            });
    }
</script>


<x-footer></x-footer>
