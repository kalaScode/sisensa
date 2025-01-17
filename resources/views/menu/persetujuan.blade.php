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
    @if (session('error'))
        <div class="bg-red-500 text-white px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Content -->
    <div class="p-6 pt-2 bg-white shadow rounded-lg">
        <div class="border-b mb-2 border-gray-200">
            <nav class="flex -mb-px">
                <button class="px-6 py-4 text-sm font-medium text-custom border-b-2 border-[#122036]">Cuti</button>
                <a href="{{ route('persetujuan-presensi.index') }}">
                    <button
                        class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Presensi</button>
                </a>
            </nav>
        </div>

        <!-- Filter Status dan Cari Karyawan -->
        <div class="flex justify-between mb-6">
            <!-- Filter Status -->
            <form action="{{ route('persetujuan-cuti.index') }}" method="GET"
                class="flex items-center space-x-4 mr-3">
                <!-- Filter Status -->
                <div class="flex items-center w-full">
                    <select name="status" id="status" class="border-gray-300 rounded-md shadow-sm w-full pl-2 py-2">
                        <option value="">Semua Status</option>
                        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu
                        </option>
                        <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui
                        </option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <!-- Tombol Filter -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                    Filter
                </button>
            </form>


            <!-- Search Bar -->
            <div class="relative w-1/2">
                <form action="{{ route('persetujuan-cuti.index') }}" method="GET" class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input id="searchInput" name="search" type="text" value="{{ old('search', $search) }}"
                        placeholder="Cari karyawan..."
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-custom focus:border-custom w-full">
                </form>
            </div>
        </div>

        <!-- Daftar Karyawan -->
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            @if ($cuti->isEmpty())
                <div class="p-4 mb-4 text-sm text-yellow-800 bg-yellow-100 rounded-lg border-l-4 border-yellow-500"
                    role="alert">
                    Karyawan tidak ditemukan.
                </div>
            @else
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-[#122036] text-white">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-semibold">Nama</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold">Jenis Cuti</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold">Durasi Cuti</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold">Periode</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($cuti as $c)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                src="{{ $c->user->Avatar ? asset('storage/' . $c->user->Avatar) : 'storage/profil.jpg' }}"
                                                alt="Foto Profil" />
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $c->user->name ?? 'Nama Tidak Ditemukan' }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $c->user->jabatan->nama_Jabatan ?? 'Jabatan Tidak Ditemukan' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if ($c->jenis_Cuti === 'Cuti')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">{{ $c->jenis_Cuti }}</span>
                                    @elseif ($c->jenis_Cuti === 'Sakit')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">{{ $c->jenis_Cuti }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $c->tanggal_Mulai->diffInDays($c->tanggal_Selesai) + 1 }} hari
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $c->tanggal_Mulai->format('Y-m-d') }} s/d
                                    {{ $c->tanggal_Selesai->format('Y-m-d') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $c->status_Cuti == 'Menunggu' ? 'bg-yellow-100 text-yellow-800' : ($c->status_Cuti == 'Disetujui' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }} ">
                                        {{ $c->status_Cuti }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                                    <!-- Detail Button -->
                                    <button
                                        onclick="showDetailModal('{{ $c->user_id }}', '{{ $c->user->name }}', '{{ $c->Keterangan }}', '{{ asset('storage/' . $c->Attachment ?? '-') }}', '{{ $c->tanggal_Mulai->diffInDays($c->tanggal_Selesai) + 1 }}', '{{ $c->Feedback ?? '-' }}', '{{ $c->jenis_Cuti }}')"
                                        class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-info-circle"></i>
                                    </button>

                                    <!-- Tombol Terima dan Tolak hanya jika status_Cuti adalah "Menunggu" -->
                                    @if ($c->status_Cuti === 'Menunggu')
                                        <!-- Terima Button -->
                                        <button type="button" onclick="confirmTerima('{{ $c->id_Cuti }}')"
                                            class="text-green-600 hover:text-green-900">
                                            <i class="fas fa-check"></i>
                                        </button>

                                        <!-- Tolak Button -->
                                        <button type="button" onclick="confirmTolak('{{ $c->id_Cuti }}')"
                                            class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @endif
                                    {{-- Modal Feedback --}}
                                    <div id="feedbackModal-{{ $c->id_Cuti }}"
                                        class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                                        <div class="bg-white rounded-lg shadow-lg p-8 w-3/4 lg:w-2/5">
                                            <!-- Modal Header with Divider -->
                                            <div class="border-b pb-4 mb-4">
                                                <h2 class="text-2xl font-semibold text-gray-900">Tolak Pengajuan Cuti
                                                </h2>
                                            </div>

                                            <!-- Modal Content -->
                                            <form action="{{ route('cuti.tolak', ['id' => $c->id_Cuti]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="space-y-4 text-gray-800">
                                                    <div>
                                                        <strong class="text-dark-600">Alasan Penolakan<br></strong>
                                                        <textarea name="Feedback" rows="4" class="w-full border-gray-300 rounded-lg"></textarea>
                                                    </div>
                                                </div>
                                                <div class="mt-6 flex justify-between">
                                                    <button type="submit"
                                                        onclick="return confirmSubmitTolak('{{ $c->id_Cuti }}')"
                                                        class="px-5 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-opacity-50">
                                                        Kirim
                                                    </button>

                                                    <button type="button"
                                                        onclick="closeFeedbackModal('{{ $c->id_Cuti }}')"
                                                        class="px-5 py-2 text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none">
                                                        Batal
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Menampilkan <span class="font-medium">{{ $cuti->firstItem() }}</span> sampai <span
                class="font-medium">{{ $cuti->lastItem() }}</span> dari <span
                class="font-medium">{{ $cuti->total() }}</span> data
        </div>
        <div class="flex space-x-2 items-center">
            {{ $cuti->links() }}
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
            <div><strong class="text-dark-600">Keterangan<br></strong> <span id="modalKeterangan"></span></div>
            <div><strong class="text-dark-600">Durasi Cuti<br></strong> <span id="modalDurasi"></span></div>
            <div><strong class="text-dark-600">Lampiran<br></strong> <span id="modalAttachment"></span></div>
            <div><strong class="text-dark-600">Feedback<br></strong> <span id="modalFeedback"></span></div>
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
    function showDetailModal(userId, name, Keterangan, Attachment, durasi, Feedback, jenis_Cuti) {
        let attachmentContent;

        if (jenis_Cuti === 'Sakit' && Attachment) {
            attachmentContent = `
            <iframe src="${Attachment}" width="100%" height="400px" frameborder="0" style="border: none;"></iframe>
        `;
        } else {
            attachmentContent = 'Tidak ada Lampiran';
        }

        // Menyusun konten modal dengan detail karyawan
        document.getElementById('modalNama').innerText = name;
        document.getElementById('modalKeterangan').innerText = Keterangan;
        document.getElementById('modalDurasi').innerText = durasi + ' hari';
        document.getElementById('modalAttachment').innerHTML = attachmentContent;
        document.getElementById('modalFeedback').innerText = Feedback ? Feedback : '-';

        // Menampilkan modal
        document.getElementById('employeeDetailModal').classList.remove('hidden');
    }



    //Fungsi untuk menampilkan modal feedback
    function showFeedbackModal(id) {
        const modal = document.getElementById(`feedbackModal-${id}`);
        if (modal) {
            modal.classList.remove('hidden'); // Menampilkan modal
        } else {
            console.error('Modal tidak ditemukan');
        }
    }

    function closeFeedbackModal(id) {
        const modal = document.getElementById(`feedbackModal-${id}`);
        if (modal) {
            modal.classList.add('hidden'); // Menyembunyikan modal
        }
    }


    function closeModal() {
        document.getElementById('employeeDetailModal').classList.add('hidden');
    }

    function confirmTerima(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Anda akan menerima pengajuan cuti ini.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Terima',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim permintaan ke server
                const form = document.createElement('form');
                form.action = `/persetujuan-cuti/terima/${id}`;
                form.method = 'POST';
                form.innerHTML = `
                @csrf
            `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    function confirmTolak(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Anda akan menolak pengajuan cuti ini.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Tolak',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                // Tampilkan modal feedback untuk alasan penolakan
                showFeedbackModal(id);
            }
        });
    }

    function confirmSubmitTolak(id) {
        return Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin mengirim alasan penolakan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Kirim',
            cancelButtonText: 'Batal',
        }).then((result) => {
            return result.isConfirmed;
        });
    }
</script>
