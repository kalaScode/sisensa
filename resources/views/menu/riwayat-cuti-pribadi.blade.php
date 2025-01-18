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
                Riwayat Pribadi
            </li>
            <li class="inline-flex items-center text-sm font-medium text-gray-700">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 9l4-4-4-4" />
                </svg>
                Cuti
            </li>
        </ol>
    </nav>

    <div class="flex-1 max-w-8xl w-full mx-auto py-8">
        <div class="bg-white rounded-lg shadow">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px">
                    <a href="/riwayat-presensi-pribadi">
                        <button class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Presensi</button>
                    </a>
                    <button class="px-6 py-4 text-sm font-medium text-custom border-b-2 border-[#122036]">Cuti</button>
                </nav>
            </div>

            <div class="p-6">
                <div class="relative mb-6">
                    <div class="flex flex-wrap items-center gap-4 mb-6">
                        <form action="{{ route('riwayat-cuti-pribadi') }}" method="GET" class="flex flex-wrap items-center gap-4">
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
                                    <option value="cuti" {{ request('jenis') == 'cuti' ? 'selected' : '' }}>Cuti</option>
                                    <option value="sakit" {{ request('jenis') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                </select>
                            </div>
                            <!-- Dropdown untuk Tahun -->
                            <div>
                            <label for="year" class="block text-sm font-medium text-gray-900 dark:text-black px-2">Tahun</label>
                                <select name="year" id="cuti-dropdown"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-auto p-2.5" style="min-width: 100px;">
                                    <option value="2025" {{ request('year') == 2025 ? 'selected' : '' }}>2025</option>
                                    <option value="2024" {{ request('year') == 2024 ? 'selected' : '' }}>2024</option>
                                    <option value="2023" {{ request('year') == 2023 ? 'selected' : '' }}>2023</option>
                                    <option value="2022" {{ request('year') == 2022 ? 'selected' : '' }}>2022</option>
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
                                        <a href="{{ route('riwayat-cuti-pribadi') }}">Reset</a>  
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- Tombol toggle -->
                        <div class="flex justify-end ml-auto mt-5">
                            <button id="toggleTableButton" class="hidden bg-yellow-500 text-black px-4 py-2 text-sm rounded-lg hover:bg-yellow-800 transition">
                                Tabel
                            </button>
                            <button id="toggleChartButton" class="bg-yellow-500 text-black px-4 py-2 text-sm rounded-lg hover:bg-yellow-800 transition">
                                Grafik
                            </button>
                        </div>
                    </div>
                </div>

                <div id="table-container" class="">
                    <div class="bg-white shadow rounded-lg overflow-x-auto">
                        @if ($cuti->isEmpty())
                            <div class="p-4 mb-4 text-sm text-yellow-800 bg-yellow-100 rounded-lg border-l-4 border-yellow-500"
                                role="alert">Cuti tidak ditemukan.</div>
                        @else
                            <table class="min-w-full bg-white border border-black">
                                <thead class="bg-[#122036] text-white">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">Nama
                                            Pengaju</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">
                                            Pemberi Persetujuan</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">
                                            Periode Cuti</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">
                                            Jenis</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-white tracking-wider">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($cuti as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 flex-shrink-0">
                                                        <img src="{{ Auth::user()->Avatar ? asset('storage/' . Auth::user()->Avatar) : '/img/profil.jpg' }}"
                                                            alt="Foto Profil"
                                                            class="w-full h-full rounded-full object-cover border-2 border-[#F6CD61]">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $item->user->name ?? 'Tidak diketahui' }}</div>
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
                                                {{ \Carbon\Carbon::parse($item->tanggal_Mulai)->format('Y-m-d') }} s.d. 
                                                {{ \Carbon\Carbon::parse($item->tanggal_Selesai)->format('Y-m-d') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->jenis_Cuti == 'Cuti' ? 'bg-blue-100 text-blue-800' : 'bg-orange-100 text-orange-800' }}">
                                                    {{ $item->jenis_Cuti }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if ($item->status_Cuti == 'Disetujui') 
                                                        bg-green-100 text-green-800
                                                    @elseif ($item->status_Cuti == 'Menunggu') 
                                                        bg-yellow-100 text-yellow-800
                                                    @elseif ($item->status_Cuti == 'Ditolak') 
                                                        bg-red-100 text-red-800
                                                    @else 
                                                        bg-gray-100 text-gray-800
                                                    @endif">
                                                    {{ $item->status_Cuti }}
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
                            Menampilkan <span class="font-medium">{{ $cuti->firstItem() }}</span> sampai <span
                                class="font-medium">{{ $cuti->lastItem() }}</span> dari <span
                                class="font-medium">{{ $cuti->total() }}</span> data
                        </div>
                        <div class="flex space-x-2 items-center">
                            {{ $cuti->links() }} <!-- Pagination Laravel -->
                        </div>
                    </div>
                </div>

                <!-- Container Utama -->
                <div id="chart-container" class="hidden relative">
                    <div class="chart-container flex items-center justify-center" style="width:100%; height:400px;">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('myChart').getContext('2d');
        const tableContainer = document.getElementById('table-container');
        const chartContainer = document.getElementById('chart-container');
        const toggleChartButton = document.getElementById('toggleChartButton');
        const toggleTableButton = document.getElementById('toggleTableButton');

        const totalCuti = {{ $cutiData->total_cuti ?? 0 }}; // Cuti total
        const totalSakit = {{ $cutiData->total_sakit ?? 0 }}; // Sakit total

        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Cuti', 'Sakit'],
                datasets: [{
                    label: 'Jumlah',
                    data: [totalCuti, totalSakit],
                    backgroundColor: [
                        'rgba(21, 70, 167, 0.55)',
                        'rgba(255, 92, 0, 0.55)',
                    ],
                    borderColor: [
                        'rgba(21, 70, 167, 1)',
                        'rgba(255, 92, 0, 1)',
                    ],
                    borderWidth: 1
                },
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 16,
                                weight: 'bold',
                            },
                            color: 'black',
                        }
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Cuti dan Sakit Tahun {{ $year }}',
                        font: {
                            size: 18,
                            weight: 'bold',
                        },
                        color: '#333',
                    },
                },
            }
        });

        // Toggle functionality
        toggleChartButton.addEventListener('click', () => {
            tableContainer.classList.add('hidden');
            chartContainer.classList.remove('hidden');
            toggleChartButton.classList.add('hidden');
            toggleTableButton.classList.remove('hidden');
        });

        toggleTableButton.addEventListener('click', () => {
            chartContainer.classList.add('hidden');
            tableContainer.classList.remove('hidden');
            toggleTableButton.classList.add('hidden');
            toggleChartButton.classList.remove('hidden');
        });
    });
</script>