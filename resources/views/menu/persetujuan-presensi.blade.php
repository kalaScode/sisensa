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
                <a href="{{ route('persetujuan-cuti.index') }}">
                    <button
                        class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Cuti</button>
                </a>
                <button class="px-6 py-4 text-sm font-medium text-custom border-b-2 border-[#122036]">Presensi</button>
            </nav>
        </div>

        <!-- Filter Status dan Cari Karyawan -->
        <div class="flex justify-between mb-6">
            <!-- Filter Status -->
            <form action="{{ route('persetujuan-cuti.index') }}" method="GET"
                class="flex items-center space-x-4 w-1/3">
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
