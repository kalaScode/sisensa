<div class="min-h-screen bg-gray-50">
    <x-navbar></x-navbar>
    <main class="max-w-md mx-auto px-4 py-6">
        <div class="bg-[#122036] rounded-lg shadow-md p-6">
            <div class="relative w-24 h-24 mx-auto mb-4">
                <img src="/img/profil.jpg" 
                     alt="Foto Profil" 
                     class="w-full h-full rounded-full object-cover border-2 border-[#F6CD61]">
                <button class="absolute top-1 right-1 w-6 h-6 bg-[#F6CD61] rounded-full flex items-center justify-center shadow">
                    <svg class="w-4 h-4 text-gray-800" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M7.5 4.586A2 2 0 0 1 8.914 4h6.172a2 2 0 0 1 1.414.586L17.914 6H19a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h1.086L7.5 4.586ZM10 12a2 2 0 1 1 4 0 2 2 0 0 1-4 0Zm2-4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>

            <div class="text-center mb-6">
                <h2 class="text-xl font-semibold text-white mb-1">Wilfa Afriyani</h2>
                <p class="text-sm text-gray-200">Manajer Pemasaran Senior</p>
            </div>

            <div class="space-y-4">
                <div class="border-b border-gray-600 pb-3">
                    <p class="text-xs text-gray-400 mb-1">Nama Perusahaan</p>
                    <p class="text-white font-medium text-sm">PT Maju Bersama Indonesia</p>
                </div>

                <div class="border-b border-gray-600 pb-3">
                    <p class="text-xs text-gray-400 mb-1">Email</p>
                    <p class="text-white font-medium text-sm">wilfa_example@gmail.com</p>
                </div>

                <!-- Nomor Telepon -->
                <div class="border-b border-gray-600 pb-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Nomor Telepon</p>
                            <p class="text-white font-medium text-sm">+62 812-3456-7890</p>
                        </div>
                        <button data-modal-target="telepon-modal" data-modal-toggle="telepon-modal" class="text-[#F6CD61] hover:text-white transition-colors">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="border-b border-gray-600 pb-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Alamat</p>
                            <p class="text-white font-medium text-sm">Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220</p>
                        </div>
                        <button data-modal-target="alamat-modal" data-modal-toggle="alamat-modal" class="text-[#F6CD61] hover:text-white transition-colors">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <p class="text-xs text-gray-400 mb-1">Pemberi Persetujuan</p>
                    <p class="text-white font-medium text-sm">Ibu Siti Rahayu - Direktur Utama</p>
                </div>
            </div>
        </div>
    </main>
</div>
<x-footer></x-footer>

<!-- Modal Telepon -->
<div id="telepon-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 justify-center items-center w-full h-screen bg-gray-900 bg-opacity-50">
    <div class="relative w-full max-w-md mx-auto bg-white rounded-lg shadow-lg">
        <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-700">Edit Nomor Telepon</h3>
            <form class="mt-4 space-y-4">
                <div>
                    <label for="telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" id="telepon" name="telepon" class="w-full p-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" data-mask="telepon" value="+62 812-3456-7890" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600" data-modal-hide="telepon-modal">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Alamat -->
<div id="alamat-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 justify-center items-center w-full h-screen bg-gray-900 bg-opacity-50">
    <div class="relative w-full max-w-md mx-auto bg-white rounded-lg shadow-lg">
        <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-700">Edit Alamat</h3>
            <form class="mt-4 space-y-4">
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="w-full p-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" value="Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600" data-modal-hide="alamat-modal">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Terapkan InputMask untuk semua input telepon
        const teleponInputs = document.querySelectorAll('[data-mask="telepon"]');
        teleponInputs.forEach(input => {
            Inputmask({ mask: '+62-999-9999-9999', placeholder: '' }).mask(input);
        });
    });
</script>
