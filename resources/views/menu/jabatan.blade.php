<div class="flex flex-col md:flex-row">
    <x-sidebar class="hidden md:block"></x-sidebar>
    <!-- Main Container -->
    <div class="flex-1 p-4 mb-4 md:ml-64 md:p-5">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center text-sm font-medium text-gray-700">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M19.707 9.293l-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414z" />
                    </svg>
                    Kelola Jabatan
                </li>
            </ol>
        </nav>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @elseif (session('delete'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                {{ session('delete') }}
            </div>
        @endif

        <!-- Filter dan Search -->
        <div class="flex flex-col md:flex-row justify-between mb-4 mt-3 gap-4">
            <div class="mb-1 w-full">
                <form action="{{ route('jabatan.index') }}" method="GET"
                    class="flex flex-col md:flex-row items-center gap-4 w-full">
                    @if ($id_Otoritas == 1)
                        <select name="filter_perusahaan" class="border-gray-300 rounded-lg p-2 w-full md:w-auto">
                            <option value="">Semua Perusahaan</option>
                            @foreach ($perusahaans as $perusahaan)
                                <option value="{{ $perusahaan->id_Perusahaan }}"
                                    {{ request('filter_perusahaan') == $perusahaan->id_Perusahaan ? 'selected' : '' }}>
                                    {{ $perusahaan->nama_Perusahaan }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                    <div class="flex flex-row  gap-3 w-full">
                        <input type="text" name="search" placeholder="Cari Jabatan..."
                            class="border-gray-300 rounded-lg p-2 w-full md:w-auto" value="{{ request('search') }}" />
                        <button type="submit"
                            class="bg-blue-400 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
            <div class="flex justify-end w-full">
                <!-- Tambah Jabatan -->
                <button type="button" data-modal-target="modal-tambah-jabatan"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg  hover:bg-green-700 transition w-full md:w-auto">
                    + Tambah Jabatan
                </button>
            </div>
        </div>


        <!-- Tabel Jabatan -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-black">
                <thead class="bg-[#122036] text-white">
                    <tr>
                        <th class="px-4 py-2 md:px-6 md:py-3 text-left text-sm md:text-l font-semibold">Nama Perusahaan
                        </th>
                        <th class="px-4 py-2 md:px-6 md:py-3 text-left text-sm md:text-l font-semibold">Nama Jabatan
                        </th>
                        <th class="px-4 py-2 md:px-6 md:py-3 text-left text-sm md:text-l font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($jabatans as $jabatan)
                        <tr>
                            <td class="border border-gray-300 p-3">{{ $jabatan->perusahaan->nama_Perusahaan }}</td>
                            <td class="border border-gray-300 p-3">{{ $jabatan->nama_Jabatan }}</td>
                            <td class="border border-gray-300 p-3">
                                <form id="delete-form-{{ $jabatan->id_Jabatan }}"
                                    action="{{ route('jabatan.destroy', $jabatan->id_Jabatan) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition delete-button"
                                        data-form-id="delete-form-{{ $jabatan->id_Jabatan }}">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Menampilkan <span class="font-medium">{{ $jabatans->firstItem() }}</span> sampai <span
                    class="font-medium">{{ $jabatans->lastItem() }}</span> dari <span
                    class="font-medium">{{ $jabatans->total() }}</span> data
            </div>
            <div class="flex space-x-2 items-center">
                {{ $jabatans->links() }} <!-- Pagination Laravel -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Jabatan -->
<div id="modal-tambah-jabatan" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
        <form action="{{ route('jabatan.store') }}" method="POST">
            @csrf
            <h3 class="text-lg font-semibold mb-4">Tambah Jabatan</h3>
            <div class="mb-4">
                <label for="id_Perusahaan" class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                <select name="id_Perusahaan" id="id_Perusahaan" required class="border-gray-300 rounded-lg p-2 w-full"
                    {{ $id_Otoritas == 2 ? 'disabled' : '' }}>
                    @if ($id_Otoritas == 1)
                        <option value="">Pilih Perusahaan</option>
                        @foreach ($perusahaans as $perusahaan)
                            <option value="{{ $perusahaan->id_Perusahaan }}">{{ $perusahaan->nama_Perusahaan }}
                            </option>
                        @endforeach
                    @else
                        <option value="{{ $id_Perusahaan_User }}" selected>
                            {{ $perusahaans->firstWhere('id_Perusahaan', $id_Perusahaan_User)->nama_Perusahaan }}
                        </option>
                    @endif
                </select>

                @if ($id_Otoritas == 2)
                    <!-- Field hidden untuk tetap mengirimkan value -->
                    <input type="hidden" name="id_Perusahaan" value="{{ $id_Perusahaan_User }}">
                @endif
            </div>

            <div class="mb-4">
                <label for="nama_Jabatan" class="block text-sm font-medium text-gray-700">Nama Jabatan</label>
                <input type="text" name="nama_Jabatan" id="nama_Jabatan" required
                    class="border-gray-300 rounded-lg p-2 w-full">
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="document.getElementById('modal-tambah-jabatan').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-600">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    document.querySelector('[data-modal-target]').addEventListener('click', function() {
        document.getElementById('modal-tambah-jabatan').classList.remove('hidden');
    });

    // Hapus Jabatan
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah aksi submit form default

            const formId = this.dataset.formId;
            const form = document.getElementById(formId);

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit form secara manual jika dikonfirmasi
                }
            });
        });
    });

    // Notifikasi Simpan Berhasil
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
</script>
