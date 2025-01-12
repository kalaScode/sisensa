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
                            d="M19.707 9.293l-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414z" />
                    </svg>
                    Beranda
                </a>
            </li>
            <li class="inline-flex items-center text-sm font-medium text-gray-700">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 9l4-4-4-4" />
                </svg>
                Riwayat Karyawan
            </li>
            <li class="inline-flex items-center text-sm font-medium text-gray-700">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 9l4-4-4-4" />
                </svg>
                Presensi
            </li>
        </ol>
    </nav>

    <div class="flex-1 max-w-8xl w-full mx-auto py-8">
        <div class="bg-white rounded-lg shadow">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px">
                    <button class="px-6 py-4 text-sm font-medium text-custom border-b-2 border-[#122036]">Presensi</button>
                        <a href="/riwayat-cuti-karyawan">
                            <button
                                class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Cuti</button>
                        </a>
                </nav>
            </div>

            <div class="p-6">
                <div class="relative mb-6">
                    <form action="{{ route('riwayat-presensi-karyawan') }}" method="GET" class="flex flex-wrap items-center gap-4 mb-6">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-900 dark:text-black px-2">Status</label>
                            <select name="status" id="status" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-auto p-2.5" style="min-width: 150px;">
                                <option value="">Semua</option>
                                <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                        <div>
                            <label for="bagian" class="block text-sm font-medium text-gray-900 dark:text-black px-2">Jenis</label>
                            <select name="jenis" id="bagian" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-auto p-2.5" style="min-width: 150px;">
                                <option value="">Semua</option>
                                <option value="masuk" {{ request('jenis') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                                <option value="keluar" {{ request('jenis') == 'keluar' ? 'selected' : '' }}>Keluar</option>
                            </select>
                        </div>
                        <!-- Search Input -->
                        <div class="flex flex-col items-start">
                            <label for="search" class="block text-sm font-medium text-gray-900 dark:text-white px-2">Cari</label>
                            <div class="flex items-center ">
                                <input type="text" name="search" class="flex-grow px-4 py-2 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-200 rounded-l-lg" placeholder="Cari berdasarkan..." value="{{ request('search') }}" />
                                <!-- Search Button -->
                                <button type="submit" class="mx-4 bg-blue-500 text-white px-4 py-2 text-sm rounded-lg hover:bg-blue-800 transition">
                                    Cari  
                                </button>

                                <!-- Reset button -->
                                <button type="submit" class="bg-gray-600 text-white px-4 py-2 text-sm rounded-lg hover:bg-gray-800 transition">
                                    <a href="{{ route('riwayat-presensi-karyawan') }}">Reset</a>  
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="bg-white shadow rounded-lg overflow-x-auto">
                    @if ($presensi->isEmpty())
                        <div class="p-4 mb-4 text-sm text-yellow-800 bg-yellow-100 rounded-lg border-l-4 border-yellow-500"
                            role="alert">Presensi tidak ditemukan.</div>
                    @else
                        <table class="min-w-full bg-white border border-black">
                            <thead class="bg-[#122036] text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Nama
                                        Pengaju</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">
                                        Pemberi Persetujuan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">
                                        Waktu Pengajuan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">
                                        Jenis</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($presensi as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $item->user->name ?? 'Tidak diketahui' }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">ID: {{ $item->user_id }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $direktur }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $item->Waktu }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $item->Bagian }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if ($item->status_Presensi == 'Disetujui') 
                                                    bg-green-100 text-green-800
                                                @elseif ($item->status_Presensi == 'Menunggu') 
                                                    bg-yellow-100 text-yellow-800
                                                @elseif ($item->status_Presensi == 'Dibatalkan') 
                                                    bg-red-100 text-red-800
                                                @else 
                                                    bg-gray-100 text-gray-800
                                                @endif">
                                                {{ $item->status_Presensi }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <!-- Pagination -->
                <div class="mt-6 flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">{{ $presensi->firstItem() }}</span> sampai <span
                            class="font-medium">{{ $presensi->lastItem() }}</span> dari <span
                            class="font-medium">{{ $presensi->total() }}</span> data
                    </div>
                    <div class="flex space-x-2 items-center">
                        {{ $presensi->links() }} <!-- Pagination Laravel -->
                    </div>
                </div>
            </div>
        </div>
</main>