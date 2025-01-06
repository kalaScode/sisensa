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
                    <table class="min-w-full bg-white border border-black">
                        <thead class="bg-[#122036] text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Nama
                                    Karyawan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Jabatan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Tanggal
                                    Pengajuan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Status
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
                                                <img src="{{ Auth::user()->Avatar ? asset('storage/' . Auth::user()->Avatar) : '/img/profil.jpg' }}"
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
                                        <div class="text-sm text-gray-900">{{ $k->jabatan->nama_Jabatan }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $k->created_at }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $k->status_Akun == 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $k->status_Akun == 0 ? 'Menunggu' : 'Disetujui' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('ubah-status-akun', $k->user_id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Apakah Anda menyetujui akun ini?');">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900 mr-3">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('batalkan-akun', $k->user_id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Apakah Anda ingin membatalkan pengajuan akun ini?');">
                                            @csrf
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-times"></i>
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
                        Menampilkan <span class="font-medium">{{ $karyawan->firstItem() }}</span> sampai <span
                            class="font-medium">{{ $karyawan->lastItem() }}</span> dari <span
                            class="font-medium">{{ $karyawan->total() }}</span> data
                    </div>
                    <div class="flex space-x-2 items-center">
                        {{ $karyawan->links() }} <!-- Pagination Laravel -->
                    </div>
                </div>
            </div>
        </div>
</main>

<x-footer></x-footer>
