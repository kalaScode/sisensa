<div class="flex flex-col md:flex-row">
    <x-sidebar></x-sidebar>
    <div class="flex-1 md:ml-64 p-5">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center text-sm font-medium text-gray-700">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M19.707 9.293l-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414z" />
                    </svg>
                    Otorisasi
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


        <!-- Section: Tambah Role -->
        @if (Auth::user()->id_Otoritas == 1)
            <!-- Section: Tambah Role -->
            <div class="bg-white shadow rounded-lg p-5 sm:p-8 md:p-10 mb-8">
                <h2 class="text-lg md:text-xl font-semibold mb-3 text-gray-700">Tambah Role</h2>

                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nama_Otoritas" class="block text-sm text-gray-600 mb-2">Nama Role</label>
                        <input type="text" name="nama_Otoritas" id="nama_Otoritas" placeholder="Nama Role"
                            class="w-full border-gray-300 rounded-lg p-2 @error('nama_Otoritas') border-red-500 @enderror">
                        @error('nama_Otoritas')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm text-gray-600 mb-2">Pilih Akses Menu</label>
                        <div class="grid grid-cols-2 gap-4">
                            @php
                                $menus = [
                                    'Presensi',
                                    'Cuti',
                                    'Daftar Karyawan',
                                    'Edit Daftar Karyawan',
                                    'Persetujuan',
                                    'Persetujuan Akun',
                                    'Riwayat Presensi Pribadi',
                                    'Riwayat Presensi Karyawan',
                                    'Riwayat Cuti Pribadi',
                                    'Riwayat Cuti Karyawan',
                                    'Buat Pengumuman',
                                ];
                            @endphp

                            @foreach ($menus as $menu)
                                <div class="flex items-center">
                                    <input type="checkbox" name="add_menus[]" id="add_menu_{{ Str::slug($menu, '_') }}"
                                        value="{{ $menu }}" class="mr-2">
                                    <label for="add_menu_{{ Str::slug($menu, '_') }}"
                                        class="text-sm text-gray-600">{{ $menu }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        @endif


        <!-- Section: Daftar Role dan Izin -->
        <div class="bg-white shadow rounded-lg p-5 sm:p-8 md:p-10 overflow-x-auto">
            <h2 class="text-lg md:text-xl font-semibold mb-3 text-gray-700">Atur Akses Role</h2>
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full bg-white border border-black text-sm sm:text-base">
                    <thead class="bg-[#122036] text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-l font-semibold text-white tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-l font-semibold text-white tracking-wider">Akses
                                Menu
                            </th>
                            @if (Auth::user()->id_Otoritas == 1)
                                <th class="px-6 py-3 text-left text-l font-semibold text-white tracking-wider">Aksi
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allOtorisasi as $role)
                            <tr>
                                <td class="border border-gray-300 p-3">{{ $role->nama_Otoritas }}</td>
                                <!-- Akses Menu -->
                                <td class="border border-gray-300 p-3">
                                    <div class="flex flex-wrap gap-2">
                                        @if ($role->Presensi === 'Ya')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Presensi</span>
                                        @endif
                                        @if ($role->Cuti === 'Ya')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Cuti</span>
                                        @endif
                                        @if ($role->daftar_Karyawan === 'Ya')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Daftar
                                                Karyawan</span>
                                        @endif
                                        @if ($role->edit_daftarKaryawan === 'Ya')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Edit Daftar
                                                Karyawan</span>
                                        @endif
                                        @if ($role->Persetujuan === 'Ya')
                                            <span
                                                class="bg-green-100 text-green-800 px-2 py-1 rounded">Persetujuan</span>
                                        @endif
                                        @if ($role->persetujuan_Akun === 'Ya')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Persetujuan
                                                Akun</span>
                                        @endif
                                        @if ($role->riwayat_presensiPribadi === 'Ya')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Riwayat
                                                Presensi
                                                Pribadi</span>
                                        @endif
                                        @if ($role->riwayat_presensiKaryawan === 'Ya')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Riwayat
                                                Presensi
                                                Karyawan</span>
                                        @endif
                                        @if ($role->riwayat_cutiPribadi === 'Ya')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Riwayat Cuti
                                                Pribadi</span>
                                        @endif
                                        @if ($role->riwayat_cutiKaryawan === 'Ya')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Riwayat Cuti
                                                Karyawan</span>
                                        @endif
                                        @if ($role->buat_Pengumuman === 'Ya')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Buat
                                                Pengumuman</span>
                                        @endif
                                    </div>
                                </td>
                                @if (Auth::user()->id_Otoritas == 1)
                                    <td class="border border-gray-300 p-3 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <button onclick="openEditModal({{ json_encode($role) }})"
                                                class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">
                                                Edit
                                            </button>
                                            <form id="delete-role-form"
                                                action="{{ route('roles.destroy', $role->id_Otoritas) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" id="delete-button"
                                                    class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="border border-gray-300 p-3 text-center">Tidak ada data
                                    otorisasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if (Auth::user()->id_Otoritas == 1)
        <!-- Modal Edit -->
        <div id="editModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 w-full max-w-lg">
                <h2 class="text-lg font-semibold mb-4">Edit Role</h2>
                <form id="editForm" action="{{ route('roles.update', $role->id_Otoritas) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_Otoritas" id="modal_id_Otoritas">

                    <div class="mb-4">
                        <label for="modal_nama_Otoritas" class="block text-sm text-gray-600 mb-2">Nama
                            Role</label>
                        <input type="text" name="nama_Otoritas" id="modal_nama_Otoritas"
                            class="w-full border-gray-300 rounded-lg p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm text-gray-600 mb-2">Pilih Akses Menu</label>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($menus as $menu)
                                <div class="flex items-center">
                                    <input type="checkbox" name="edit_menus[]"
                                        id="edit_menu_{{ Str::slug($menu, '_') }}" value="{{ $menu }}"
                                        class="mr-2">
                                    <label for="edit_menu_{{ Str::slug($menu, '_') }}"
                                        class="text-sm text-gray-600">{{ $menu }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" onclick="closeEditModal()"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">
                            Batal
                        </button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>


<script>
    function openEditModal(role) {
        // Mengisi input teks
        document.getElementById('modal_id_Otoritas').value = role.id_Otoritas;
        document.getElementById('modal_nama_Otoritas').value = role.nama_Otoritas;

        // Mapping nama checkbox (spasi) dan key database (underscore)
        const menuMapping = {
            'Presensi': 'Presensi',
            'Cuti': 'Cuti',
            'Daftar Karyawan': 'daftar_Karyawan',
            'Edit Daftar Karyawan': 'edit_daftarKaryawan',
            'Persetujuan': 'Persetujuan',
            'Persetujuan Akun': 'persetujuan_Akun',
            'Riwayat Presensi Pribadi': 'riwayat_presensiPribadi',
            'Riwayat Presensi Karyawan': 'riwayat_presensiKaryawan',
            'Riwayat Cuti Pribadi': 'riwayat_cutiPribadi',
            'Riwayat Cuti Karyawan': 'riwayat_cutiKaryawan',
            'Buat Pengumuman': 'buat_Pengumuman',
        };

        // Reset semua checkbox dalam modal edit
        const checkboxes = document.querySelectorAll('#editModal input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });

        // Mengatur nilai checkbox berdasarkan data dari role
        checkboxes.forEach(checkbox => {
            const dbKey = menuMapping[checkbox.value];
            if (dbKey && role[dbKey] === 'Ya') {
                checkbox.checked = true;
            }
        });

        // Menampilkan modal
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // SweetAlert on Save (when the user submits the form)
    document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting immediately

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data role akan disimpan.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Submit the form if user confirms
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Use event delegation to target the dynamically rendered buttons
        document.querySelector('tbody').addEventListener('click', function(event) {
            // Check if the clicked element is the delete button
            if (event.target && event.target.id === 'delete-button') {
                event.preventDefault(); // Prevent default form submission

                const deleteForm = event.target.closest('form'); // Get the parent form of the button

                // Show SweetAlert confirmation
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Data yang dihapus tidak bisa dipulihkan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteForm.submit(); // Submit the form if confirmed
                    }
                });
            }
        });
    });
</script>
