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
                    <form action="{{ route('riwayat-cuti-pribadi') }}" method="GET" class="flex flex-wrap items-center gap-4 mb-6">
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
                </div>


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
                                                    <img src="{{ $item->Avatar ? asset('storage/' . $item->Avatar) : '/img/profil.jpg' }}"
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
                                            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('Y-m-d') }} s.d. 
                                            {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('Y-m-d') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
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
        </div>
    </div>
    <div class="flex-1 max-w-8xl w-full mx-auto py-8 relative">
        <div class="bg-white rounded-lg shadow p-4 inline-block">
            <!-- Dropdown untuk Tahun -->
            <div class="absolute top-4 left-4">
                <select name="cuti-dropdown" id="cuti-dropdown"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-auto p-2.5">
                    <option value="th2022" {{ $year == 2022 ? 'selected' : '' }}>2022</option>
                    <option value="th2023" {{ $year == 2023 ? 'selected' : '' }}>2023</option>
                    <option value="th2024" {{ $year == 2024 ? 'selected' : '' }}>2024</option>
                    <option value="th2025" {{ $year == 2025 ? 'selected' : '' }}>2025</option>
                </select>
            </div>

            <!-- Container Utama -->
            <div class="relative" style="width:30vw;">
                <!-- Pie Chart -->
                <div class="chart-container flex items-center justify-center">
                    <canvas id="myChart"></canvas>
                </div>

                <!-- Sisa Saldo Cuti -->
                <div class="absolute bottom-1 right-1 bg-blue-50 p-4 rounded-xl shadow-lg">
                    <div class="text-sm text-gray-600 mb-1">Sisa Saldo Cuti Anda</div>
                    <div class="text-xl font-bold text-custom">
                        {{ Auth::user()->saldo_cuti->saldo_Sisa ?? 0 }} Hari
                    </div>
                </div>

                <!-- Tidak ada informasi pengambilan cuti pada tahun ini -->
                @if ($cutiData->isEmpty())
                    <div class="absolute top-40 left-1/2 transform -translate-x-1/2 bg-yellow-100 p-4 rounded-xl shadow-lg">
                        <div class="text-sm text-gray-600">Tidak ada informasi pengambilan cuti di tahun ini</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('myChart').getContext('2d');
        const data = @json($cutiData->pluck('total'));
        const labels = @json($cutiData->pluck('jenis_Cuti'));

        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah:',
                    data: data,
                    backgroundColor: [
                        'rgba(54, 163, 235, 0.55)',
                        'rgba(255, 99, 133, 0.55)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right', 
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
                        text: 'Distribusi Jenis Cuti Tahun {{ $year }}',
                        font: {
                            size: 18,
                            weight: 'bold',
                        },
                        color: '#333',
                    },
                },
            }
        });

        document.getElementById('cuti-dropdown').addEventListener('change', function () {
            const year = this.value.replace('th', ''); // Ambil tahun dari dropdown
            const url = `{{ route('riwayat-cuti-pribadi') }}?year=${year}`;
            window.location.href = url; // Redirect ke URL baru dengan parameter tahun
        });
    });
</script>