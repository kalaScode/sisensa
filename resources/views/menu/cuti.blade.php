<x-navbar></x-navbar>

<div class="w-full mx-auto px-4 sm:px-6 lg:px-36 py-10">
    <div class="w-full mx-auto space-y-6">
        <!-- Informasi Saldo Cuti -->
        <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-200">
            <h2 class="text-lg font-semibold mb-4">Informasi Saldo Cuti</h2>
            <div class="grid grid-cols-2 gap-3">
                <div class="p-4 bg-blue-50 rounded-xl">
                    <div class="text-sm text-gray-600 mb-1">Saldo Cuti Tahunan</div>
                    <div class="text-3xl font-bold text-custom">12 Hari</div>
                </div>
                <div class="p-4 bg-gray-50 rounded-xl">
                    <div class="text-sm text-gray-600 mb-1">Cuti Terpakai</div>
                    <div class="text-3xl font-bold text-gray-700">3 Hari</div>
                </div>
            </div>
        </div>

        <!-- Form Pengajuan Cuti -->
        <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-200">
            <h2 class="text-lg font-semibold mb-6">Form Pengajuan Cuti</h2>
            <form class="space-y-6">
                <!-- Tanggal Mulai dan Selesai -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-custom focus:ring-custom" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-custom focus:ring-custom" required />
                    </div>
                </div>

                <!-- Jenis Cuti -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Cuti</label>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <input type="radio" name="leave_type" id="annual" class="h-4 w-4 text-custom border-gray-300 focus:ring-custom" checked />
                            <label for="annual" class="ml-3 text-sm text-gray-700">Cuti Tahunan</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" name="leave_type" id="sick" class="h-4 w-4 text-custom border-gray-300 focus:ring-custom" />
                            <label for="sick" class="ml-3 text-sm text-gray-700">Cuti Sakit</label>
                        </div>
                    </div>
                </div>

                <!-- Keterangan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <textarea rows="4" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-custom focus:ring-custom" placeholder="Masukkan keterangan cuti..."></textarea>
                </div>

                <!-- Unggah Surat Keterangan -->
                <div id="fileUpload" class="block">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Unggah Surat Keterangan Sakit</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-custom">
                        <div class="space-y-1 text-center">
                            <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3"></i>
                            <div class="flex text-sm text-gray-600">
                                <!-- Link label to the input file by setting the same id in the input and for in the label -->
                                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-custom hover:text-custom-dark focus-within:outline-none">
                                    <span>Unggah file</span>
                                    <!-- Add id="file-upload" to match the label for -->
                                    <input type="file" id="file-upload" class="sr-only" />
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PDF, JPG, PNG hingga 10MB</p>
                        </div>
                    </div>
                </div>


                <!-- Button -->
                <div class="flex justify-between space-x-4">
                    <button type="button" class="w-1/3 px-6 py-2.5 rounded-md text-custom border border-custom hover:bg-gray-50 font-medium text-sm">Kembali</button>
                    <button type="submit" class="w-1/3 px-6 py-2.5 rounded-md bg-custom text-white hover:bg-custom/90 font-medium text-sm">Ajukan Cuti</button>
                </div>
            </form>
        </div>

        <!-- Status Pengajuan Terakhir -->
        <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-200">
            <h2 class="text-lg font-semibold mb-4">Status Pengajuan Terakhir</h2>
            <div class="relative pb-12">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <span class="h-8 w-8 rounded-full bg-custom flex items-center justify-center">
                            <i class="fas fa-check text-white text-sm"></i>
                        </span>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-900">Menunggu Persetujuan</h3>
                        <p class="text-sm text-gray-500">Pengajuan Cuti Tahunan - 24 Maret 2024</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-footer></x-footer>
