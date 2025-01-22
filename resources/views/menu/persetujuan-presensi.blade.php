<x-navbar></x-navbar>

<main class="w-full mx-auto px-4 sm:px-6 lg:px-36 py-10">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="/beranda" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-800">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M19.707 9.293l-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 1 1 2 0v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414z" />
                    </svg>
                    Beranda
                </a>
            </li>
            <li class="inline-flex items-center text-sm font-medium text-gray-700">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                Persetujuan
            </li>
        </ol>
    </nav>

    <!-- Pesan Error/Success -->
    @if (session('success'))
        <div class="bg-red-500 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Content -->
    <div class="p-6 pt-2 bg-white shadow rounded-lg">
        <div class="border-b mb-2 border-gray-200">
            <nav class="flex -mb-px">
                <button class="px-6 py-4 text-sm font-medium text-custom border-b-2 border-[#122036]">Presensi</button>
                <a href="{{ route('persetujuan-cuti.index') }}">
                    <button
                        class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Cuti</button>
                </a>
            </nav>
        </div>

        <!-- Filter Status dan Cari Karyawan -->
        <div class="flex justify-between mb-6">
            <!-- Filter Status -->
            <form action="{{ route('persetujuan-presensi.index') }}" method="GET"
                class="flex items-center space-x-4 mr-3">
                <!-- Filter Status -->
                <div class="flex items-center w-full">
                    <select name="status" id="status" class="border-gray-300 rounded-md shadow-sm w-full pl-2 py-2">
                        <option value="">Semua Status</option>
                        <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui
                        </option>
                        <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan
                        </option>
                    </select>
                </div>

                <!-- Tombol Filter -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                    Filter
                </button>
            </form>


            <!-- Search Bar -->
            <div class="relative w-1/2">
                <form action="{{ route('persetujuan-presensi.index') }}" method="GET" class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input id="searchInput" name="search" type="text" value="{{ old('search', $search) }}"
                        placeholder="Cari karyawan..."
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-custom focus:border-custom w-full">
                </form>
            </div>
        </div>


        <!-- Daftar Karyawan -->
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            @if ($presensi->isEmpty())
                <div class="p-4 mb-4 text-sm text-yellow-800 bg-yellow-100 rounded-lg border-l-4 border-yellow-500"
                    role="alert">
                    Karyawan tidak ditemukan.
                </div>
            @else
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-[#122036] text-white">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-semibold">Nama</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold">Jenis Presensi</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold">Tanggal</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold">Waktu</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold">Foto</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold">Bagian</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold">Lokasi Presensi</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($presensi as $p)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                src="{{ $p->user->Avatar ? asset('storage/' . $p->user->Avatar) : 'img/profil.jpg' }}"
                                                alt="Foto Profil" />
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $p->user->name ?? 'Nama Tidak Ditemukan' }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $p->user->jabatan->nama_Jabatan ?? 'Jabatan Tidak Ditemukan' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $p->jenis_Presensi }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $p->Tanggal }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $p->Waktu }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-1000">
                                    <img class="h-100 w-100"
                                        src="{{ $p->Foto ? asset('/' . $p->Foto) : 'Tidak Ada Foto' }}"
                                        alt="Foto Presensi" />

                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if ($p->Bagian === 'Masuk')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">{{ $p->Bagian }}</span>
                                    @elseif ($p->Bagian === 'Keluar')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">{{ $p->Bagian }}</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 truncate max-w-[400px]">
                                    {{ $p->Alamat ?? '-' }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $p->status_Presensi == 'Disetujui' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} ">
                                        {{ $p->status_Presensi }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                                    <!-- Detail Button -->
                                    <button
                                        onclick="showDetailModal('{{ $p->user_id }}', '{{ $p->user->name }}','{{ $p->jenis_Presensi }}','{{ $p->Tanggal }}', '{{ $p->Waktu }}', '{{ asset('/' . $p->Foto ?? '-') }}', '{{ $p->Alamat }}')"
                                        class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <!-- Tolak Button -->
                                    @if ($p->status_Presensi != 'Dibatalkan')
                                        <form id="form-tolak--{{ $p->id_Presensi }}"
                                            action="{{ route('presensi.tolak', [$p->id_Presensi]) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="button" class="text-red-600 hover:text-red-900"
                                                onclick="confirmTolak('{{ $p->id_Presensi }}')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</main>

<x-footer></x-footer>

{{-- Modal Detail Karyawan --}}
<div id="employeeDetailModal"
    class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden overflow-y-auto">
    <div class="bg-white rounded-lg shadow-lg p-8 w-3/4 lg:w-2/5 max-h-full overflow-y-auto h-3/4">
        <!-- Modal Header with Divider -->
        <div class="border-b pb-4 mb-4">
            <h2 class="text-2xl font-semibold text-gray-900">Detail Informasi Karyawan</h2>
        </div>

        <!-- Modal Content -->
        <div id="modalContent" class="space-y-4 text-gray-800">
            <div><strong class="text-dark-600">Nama Karyawan<br></strong> <span id="modalNama"></span></div>
            <div><strong class="text-dark-600">Jenis Presensi<br></strong> <span id="modalJenisPresensi"></span></div>
            <div><strong class="text-dark-600">Tanggal<br></strong> <span id="modalTanggal"></span></div>
            <div><strong class="text-dark-600">Waktu<br></strong> <span id="modalWaktu"></span></div>
            <div>
                <strong class="text-dark-600">Foto<br></strong>
                <img id="modalFoto" src="placeholder-image-url.jpg" alt="Foto Karyawan"
                    class="w-full max-w-sm rounded-lg">
            </div>
            <div><strong class="text-dark-600">Lokasi Presensi<br></strong> <span id="modalAlamat"></span></div>
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
    function showDetailModal(userId, name, jenis_Presensi, Tanggal, Waktu, Foto, Alamat) {
        // Menyusun konten modal dengan detail karyawan
        document.getElementById('modalNama').innerText = name;
        document.getElementById('modalJenisPresensi').innerText = jenis_Presensi;
        document.getElementById('modalTanggal').innerText = Tanggal;
        document.getElementById('modalWaktu').innerText = Waktu;
        document.getElementById('modalFoto').src = Foto ? Foto : '-';
        document.getElementById('modalAlamat').innerText = Alamat ? Alamat : '-';

        // Menampilkan modal
        document.getElementById('employeeDetailModal').classList.remove('hidden');
    }


    function closeModal() {
        document.getElementById('employeeDetailModal').classList.add('hidden');
    }

    function confirmTolak(idPresensi) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Presensi akan dibatalkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, batalkan!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form secara programatis
                document.getElementById('form-tolak--' + idPresensi).submit();
            }
        });
    }
</script>
