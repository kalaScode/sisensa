<x-navbar></x-navbar>
<main class="max-w-7xl sm:px-6 lg:px-36 py-10">
    <nav class="flex" aria-label="Breadcrumb">
        <!-- Breadcrumb -->
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="/beranda" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-800">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M19.707 9.293l-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414z" />
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
                Cuti
            </li>
        </ol>
    </nav>
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-36 py-10">
        <div class="w-full mx-auto space-y-6">
            @if (session('success'))
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pengajuan Berhasil',
                            text: '{{ session('success') }}',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#3085d6',
                        });
                    });
                </script>
            @endif
            <!-- Informasi Saldo Cuti -->
            <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-200">
                <h2 class="text-lg font-semibold mb-4">Informasi Saldo Cuti</h2>
                <div class="grid grid-cols-2 gap-3">
                    <!-- Saldo Cuti Tahunan -->
                    <div class="p-4 bg-blue-50 rounded-xl">
                        <div class="text-sm text-gray-600 mb-1">Saldo Cuti Tahunan</div>
                        <div class="text-3xl font-bold text-custom">
                            {{ Auth::user()->saldo_cuti->saldo_Awal ?? 0 }}
                        </div>
                    </div>

                    <!-- Cuti Terpakai -->
                    <div class="p-4 bg-gray-50 rounded-xl">
                        <div class="text-sm text-gray-600 mb-1">Cuti Terpakai</div>
                        <div class="text-3xl font-bold text-gray-700">
                            {{ Auth::user()->saldo_cuti->saldoTerpakai ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Pengajuan Cuti -->
            <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-200">
                <h2 class="text-lg font-bold mb-6">Form Pengajuan Cuti</h2>
                <form method="POST" action="{{ route('cuti.ajukan') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Tanggal Cuti -->
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Tanggal Cuti</label>
                    <div class="relative max-w-sm mb-4 ml-2">
                        <!-- Ikon Kalender -->
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <!-- Input Field -->
                        <input type="text" id="tanggalCuti" name="tanggalCuti"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 pl-10 py-2"
                            placeholder="Pilih rentang tanggal" required />
                    </div>


                    <!-- Jenis Cuti -->
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Cuti</label>
                        <div class="space-y-3 ml-2">
                            <div class="flex items-center">
                                <input type="radio" name="jenis_Cuti" id="annual" value="Cuti"
                                    class="h-4 w-4 text-custom border-gray-300 focus:ring-custom" checked />
                                <label for="annual" class="ml-3 text-sm text-gray-700">Cuti Tahunan</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="jenis_Cuti" id="sick" value="Sakit"
                                    class="h-4 w-4 text-custom border-gray-300 focus:ring-custom" />
                                <label for="sick" class="ml-3 text-sm text-gray-700">Cuti Sakit</label>
                            </div>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-4 mr-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                        <textarea rows="4" name="Keterangan"
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-custom focus:ring-custom px-3 py-2 ml-2"
                            placeholder="Masukkan keterangan cuti..."></textarea>
                    </div>

                    <!-- Unggah Surat Keterangan -->
                    <div id="fileUpload" class="block mb-4" x-data="{ showFileUpload: false }" x-show="showFileUpload">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Unggah Surat Keterangan
                            Sakit</label>
                        <div
                            class="mt-1 ml-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-custom">
                            <div class="space-y-1 text-center">
                                <i id="upload-icon"
                                    class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3 cursor-pointer hover:text-blue-600"></i>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-custom hover:text-blue-600 focus-within:outline-none">
                                        <input type="file" id="file-upload" name="Attachment" class="sr-only"
                                            onchange="displayFileName(event)" />
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PDF, JPG, PNG hingga 10MB</p>
                                <p id="file-name" class="text-xs text-gray-500"></p> <!-- Menampilkan nama file -->
                            </div>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="flex justify-between space-x-4 ml-2">
                        <a href="{{ route('beranda') }}"
                            class="w-1/3 px-6 py-2.5 rounded-md text-custom border border-custom hover:bg-gray-100 font-medium text-sm flex items-center justify-center">
                            Kembali
                        </a>
                        <button type="submit"
                            class="w-1/3 px-6 py-2.5 rounded-md bg-gray-700 text-white hover:bg-gray-900 font-medium text-sm">
                            Ajukan Cuti
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>
<x-footer></x-footer>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    //Script Untuk Tanggal
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil saldo cuti dari backend
        fetch('/cuti/saldo-sisa')
            .then(response => response.json())
            .then(data => {
                const saldoSisa = data.saldo_sisa;

                // Inisialisasi Flatpickr
                flatpickr('#tanggalCuti', {
                    mode: 'range', // Mode range untuk rentang tanggal
                    dateFormat: 'Y-m-d', // Format tanggal
                    minDate: 'today', // Mulai dari hari ini
                    maxDate: new Date().fp_incr(30), // Contoh: 30 hari ke depan
                    onClose: function(selectedDates, dateStr, instance) {
                        // Hitung jumlah hari yang dipilih
                        const dayCount = (selectedDates[1] - selectedDates[0]) / (1000 * 60 *
                            60 * 24) + 1;

                        if (dayCount > saldoSisa) {
                            // Tampilkan SweetAlert
                            Swal.fire({
                                icon: 'warning',
                                title: 'Saldo Cuti Tidak Cukup',
                                text: `Anda hanya memiliki ${saldoSisa} hari cuti tersisa.`,
                                confirmButtonText: 'Mengerti',
                                confirmButtonColor: '#3085d6',
                            }).then(() => {
                                instance
                                    .clear(); // Hapus pilihan setelah dialog ditutup
                            });
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching saldo sisa:', error);

                // Tampilkan notifikasi error menggunakan SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal mengambil data saldo cuti. Silakan coba lagi.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33',
                });
            });
    });

    //Script untuk unggah dokumen
    document.getElementById('upload-icon').addEventListener('click', function() {
        document.getElementById('file-upload').click();
    });

    function displayFileName(event) {
        const file = event.target.files[0];
        if (file) {
            document.getElementById('file-name').innerText = `Nama File: ${file.name}`;
        } else {
            document.getElementById('file-name').innerText = '';
        }
    }

    //Script untuk menampilkan unggah file
    document.querySelectorAll('input[name="jenis_Cuti"]').forEach((radio) => {
        radio.addEventListener('change', function() {
            document.getElementById('fileUpload').style.display = this.value === 'Sakit' ? 'block' :
                'none';
        });
    });
</script>
