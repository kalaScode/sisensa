<x-navbar></x-navbar>

<main class="max-w-7xl mx-auto sm:px-6 lg:px-36 py-10">
    <div class="max-w-7xl mx-auto px-4 flex justify-center">
        <h1 class="text-3xl font-bold text-[#122036] text-center">Riwayat Pribadi</h1>
    </div>

    <!-- Menu Tabs -->
    <div class="flex border-b border-gray-200 mb-4">
        <a href="#" class="px-4 py-2 text-sm font-medium text-gray-700 border-b-2 border-black tab-link" data-tab="presensi">
            Presensi
        </a>
        <a href="#" class="px-4 py-2 text-sm font-medium text-gray-700 border-b-2 border-black tab-link" data-tab="cuti">
            Cuti
        </a>
        <a href="#" class="px-4 py-2 text-sm font-medium text-gray-700 border-b-2 border-black tab-link" data-tab="visualisasi">
            Visualisasi
        </a>
    </div>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Presensi Tab -->
        <div id="presensi" class="tab-pane">
            <!-- Filter Dropdown -->
            <div class="flex flex-wrap items-center justify-between space-y-4 mb-4">
                <div class="flex space-x-4">
                    <div>
                        <label for="statusPresensi" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="statusPresensi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="Semua Status">Semua Status</option>
                            <option value="Diterima">Diterima</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    <div>
                        <label for="jenisPresensi" class="block text-sm font-medium text-gray-700">Jenis</label>
                        <select id="jenisPresensi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="Semua Jenis">Semua Jenis</option>
                            <option value="Masuk">Masuk</option>
                            <option value="Keluar">Keluar</option>
                        </select>
                    </div>
                </div>
                <!-- Search Field -->
                <div class="relative">
                    <input type="text" id="cariPresensi" placeholder="Cari..." class="w-full pl-10 pr-3 py-2 text-sm border-2 border-custom rounded-lg focus:outline-none focus:border-custom" />
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            <!-- Table -->
            <div class="bg-white shadow rounded-lg">
                <table class="min-w-full bg-white border boreder-black">
                    <thead class="bg-[#122036] text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Nama Pengaju</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Pemberi Persetujuan</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Waktu Pengajuan</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Jenis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rizky Alif Ichwanto</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Teguh Raharjo</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2024-02-20 08:00</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Diterima</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Masuk</td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rizky Alif Ichwanto</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Teguh Raharjo</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2024-02-20 17:00</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Keluar</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-8 flex justify-end">
                <nav class="flex items-center space-x-2">
                    <button class="px-4 py-2 border-2 border-[#122036] text-[#122036] rounded-lg hover:bg-custom hover:text-white hover:border-custom">
                        <i class="fas fa-chevron-left mr-2"></i>
                        Sebelumnya
                    </button>
                    <button class="px-4 py-2 bg-custom border-2 border-custom text-white rounded-lg">1</button>
                    <button class="px-4 py-2 border-2 border-[#122036] text-[#122036] rounded-lg hover:bg-custom hover:text-white hover:border-custom">2</button>
                    <button class="px-4 py-2 border-2 border-[#122036] text-[#122036] rounded-lg hover:bg-custom hover:text-white hover:border-custom">3</button>
                    <button class="px-4 py-2 border-2 border-[#122036] text-[#122036] rounded-lg hover:bg-custom hover:text-white hover:border-custom">
                        Selanjutnya
                        <i class="fas fa-chevron-right ml-2"></i>
                    </button>
                </nav>
            </div>
        </div>


        <!-- Cuti Tab -->
        <div id="cuti" class="tab-pane hidden">
            <!-- Filter Dropdown -->
            <div class="flex flex-wrap items-center justify-between space-y-4 mb-4">
                <div class="flex space-x-4">
                    <div>
                        <label for="statusDropdown" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="statusDropdown" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="Semua Status">Semua Status</option>
                            <option value="Diterima">Diterima</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    <div>
                        <label for="jenisDropdown" class="block text-sm font-medium text-gray-700">Jenis</label>
                        <select id="jenisDropdown" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="Semua Jenis">Semua Jenis</option>
                            <option value="Masuk">Cuti</option>
                            <option value="Keluar">Sakit</option>
                        </select>
                    </div>
                </div>
                <!-- Search Field -->
                <div class="relative">
                    <input type="text" placeholder="Cari..." class="w-full pl-10 pr-3 py-2 text-sm border-2 border-custom rounded-lg focus:outline-none focus:border-custom" />
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            <!-- Table -->
            <div class="bg-white shadow rounded-lg">
                <table class="min-w-full bg-white border boreder-black">
                    <thead class="bg-[#122036] text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Nama Pengaju</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Pemberi Persetujuan</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Waktu Pengajuan</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Jenis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rizky Alif Ichwanto</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Teguh Raharjo</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2024-02-20 08:00</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Diterima</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Cuti</td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rizky Alif Ichwanto</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Teguh Raharjo</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2024-02-20 17:00</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Sakit</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-8 flex justify-end">
                <nav class="flex items-center space-x-2">
                    <button class="px-4 py-2 border-2 border-[#122036] text-[#122036] rounded-lg hover:bg-custom hover:text-white hover:border-custom">
                        <i class="fas fa-chevron-left mr-2"></i>
                        Sebelumnya
                    </button>
                    <button class="px-4 py-2 bg-custom border-2 border-custom text-white rounded-lg">1</button>
                    <button class="px-4 py-2 border-2 border-[#122036] text-[#122036] rounded-lg hover:bg-custom hover:text-white hover:border-custom">2</button>
                    <button class="px-4 py-2 border-2 border-[#122036] text-[#122036] rounded-lg hover:bg-custom hover:text-white hover:border-custom">3</button>
                    <button class="px-4 py-2 border-2 border-[#122036] text-[#122036] rounded-lg hover:bg-custom hover:text-white hover:border-custom">
                        Selanjutnya
                        <i class="fas fa-chevron-right ml-2"></i>
                    </button>
                </nav>
            </div>
        </div>

        <!-- Visualisasi Tab -->
        <div id="visualisasi" class="tab-pane hidden">
            <!-- Grid for Visualization -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tren Presensi -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Tren Presensi</h3>
                    <!-- Placeholder for Chart -->
                    <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between mb-5">
                            <div>
                                <button id="dropdownDefaultButton"
                                    data-dropdown-toggle="lastDaysdropdown"
                                    data-dropdown-placement="bottom" type="button" class="px-3 py-2 inline-flex items-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Mingguan<svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg></button>
                                <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mingguan</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Bulanan</a>
                                        </li>
                                        <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tahunan</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="line-chart"></div>
                        <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-2.5">
                            <div class="pt-5">
                                <a href="#" class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-3.5 h-3.5 text-white me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                        <path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-3 15H4.828a1 1 0 0 1 0-2h6.238a1 1 0 0 1 0 2Zm0-4H4.828a1 1 0 0 1 0-2h6.238a1 1 0 1 1 0 2Z" />
                                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                                    </svg>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Distribusi Cuti -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Distribusi Cuti</h3>
                    <!-- Placeholder for Chart -->
                    <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

                        <div class="flex justify-between items-start w-full">
                            <div class="flex-col items-center">
                                <div>
                                    <button id="dropdownDefaultButton"
                                        data-dropdown-toggle="tahundropdown"
                                        data-dropdown-placement="bottom" type="button" class="px-3 py-2 inline-flex items-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">2024<svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg></button>
                                    <div id="tahundropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2022</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2023</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2024</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="dateRangeDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-80 lg:w-96 dark:bg-gray-700 dark:divide-gray-600">
                                    <div class="p-3" aria-labelledby="dateRangeButton">
                                        <div date-rangepicker datepicker-autohide class="flex items-center">
                                            <div class="relative">
                                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                    </svg>
                                                </div>
                                                <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Start date">
                                            </div>
                                            <span class="mx-2 text-gray-500 dark:text-gray-400">to</span>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                    </svg>
                                                </div>
                                                <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="End date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Line Chart -->
                        <div class="py-2" id="pie-chart"></div>
                        <div class="">
                            <a href="#" class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-3.5 h-3.5 text-white me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                    <path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-3 15H4.828a1 1 0 0 1 0-2h6.238a1 1 0 0 1 0 2Zm0-4H4.828a1 1 0 0 1 0-2h6.238a1 1 0 1 1 0 2Z" />
                                    <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                                </svg>
                                Download
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-between space-x-4 mt-8" id="button-container">
        <button type="button" class="!rounded-button w-1/3 bg-gray-200 text-gray-700 px-4 py-2 font-semibold hover:bg-gray-300 transition-all" onclick="history.back()">Kembali</button>
    </div>
</main>

<x-footer></x-footer>

<script>
    document.querySelectorAll('.tab-link').forEach((tabLink) => {
        tabLink.addEventListener('click', (e) => {
            e.preventDefault();

            // Reset active tabs
            document.querySelectorAll('.tab-link').forEach(link => link.classList.remove('border-black', 'text-gray-700'));
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.add('hidden'));

            // Set active tab
            tabLink.classList.add('border-black', 'text-gray-700');
            document.querySelector(`#${tabLink.getAttribute('data-tab')}`).classList.remove('hidden');
        });
    });

    const options = {
        chart: {
            height: "100%",
            maxWidth: "100%",
            type: "line",
            fontFamily: "Inter, sans-serif",
            dropShadow: {
                enabled: false,
            },
            toolbar: {
                show: false,
            },
        },
        tooltip: {
            enabled: true,
            x: {
                show: false,
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: 6,
        },
        grid: {
            show: true,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: -26
            },
        },
        series: [{
            name: "Clicks",
            data: [6500, 6418, 6456, 6526, 6356, 6456],
            color: "#1A56DB",
        }, ],
        legend: {
            show: false
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            categories: ['01 Feb', '02 Feb', '03 Feb', '04 Feb', '05 Feb', '06 Feb', '07 Feb'],
            labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                }
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            show: false,
        },
    }

    if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("line-chart"), options);
        chart.render();
    }


    const getChartOptions = () => {
        return {
            series: [1, 2, 9],
            colors: ["#1C64F2", "#16BDCA", "#9061F9"],
            chart: {
                height: 420,
                width: "100%",
                type: "pie",
            },
            stroke: {
                colors: ["white"],
                lineCap: "",
            },
            plotOptions: {
                pie: {
                    labels: {
                        show: true,
                    },
                    size: "100%",
                    dataLabels: {
                        offset: -25
                    }
                },
            },
            labels: ["Sakit", "Izin", "Sisa Cuti"],
            dataLabels: {
                enabled: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                },
            },
            legend: {
                position: "bottom",
                fontFamily: "Inter, sans-serif",
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value
                    },
                },
            },
            xaxis: {
                labels: {
                    formatter: function(value) {
                        return value
                    },
                },
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
            },
        }
    }

    if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
        chart.render();
    }
</script>