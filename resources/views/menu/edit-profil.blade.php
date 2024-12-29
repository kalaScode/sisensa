<div class="min-h-screen bg-gray-50">
    <x-navbar></x-navbar>
    <main class="max-w-7xl mx-auto sm:px-6 lg:px-36 py-10">
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="/beranda"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-800 dark:text-gray-500 dark:hover:text-gray">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Beranda
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <a href="/profil"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-800 dark:text-gray-500 dark:hover:text-gray">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        Profil
                    </a>
                </li>
                <li class="inline-flex items-center text-sm font-medium text-gray-700">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    Edit Profil
                </li>
            </ol>
        </nav>
        <div class="bg-[#122036] rounded-lg shadow p-6 max-w-lg mx-auto">
            <div class="relative w-24 h-24 mx-auto mb-4">
                <img src="{{ Storage::url(Auth::User()->Avatar) }}" alt="Foto Profil"
                    class="w-full h-full rounded-full object-cover border-2 border-[#F6CD61]">
                <button
                    class="absolute top-1 right-1 w-6 h-6 bg-[#F6CD61] rounded-full flex items-center justify-center shadow"
                    data-modal-target="foto-modal" data-modal-toggle="foto-modal">
                    <svg class="w-4 h-4 text-gray-800" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M7.5 4.586A2 2 0 0 1 8.914 4h6.172a2 2 0 0 1 1.414.586L17.914 6H19a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h1.086L7.5 4.586ZM10 12a2 2 0 1 1 4 0 2 2 0 0 1-4 0Zm2-4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <div class="text-center mb-6">
                <h2 class="text-xl font-semibold text-white mb-1">{{ Auth::user()->name }}</h2>
                <p class="text-sm text-gray-200">{{ Auth::user()->jabatan->nama_Jabatan }}</p>
            </div>

            <div class="space-y-4">
                <div class="border-b border-gray-600 pb-3">
                    <p class="text-xs text-gray-400 mb-1">Nama Perusahaan</p>
                    <p class="text-white font-medium text-sm">{{ Auth::user()->perusahaan->nama_Perusahaan }}</p>
                </div>

                <div class="border-b border-gray-600 pb-3">
                    <p class="text-xs text-gray-400 mb-1">Email</p>
                    <p class="text-white font-medium text-sm">{{ Auth::user()->email }}</p>
                </div>

                <!-- Nomor Telepon -->
                <div class="border-b border-gray-600 pb-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Nomor Telepon</p>
                            <p class="text-white font-medium text-sm">{{ Auth::user()->no_Telp }}</p>
                        </div>
                        <button data-modal-target="telepon-modal" data-modal-toggle="telepon-modal"
                            class="text-[#F6CD61] hover:text-white transition-colors">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="border-b border-gray-600 pb-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-400 mb-1">Alamat</p>
                            <p class="text-white font-medium text-sm">{{ Auth::user()->Alamat }}</p>
                        </div>
                        <button data-modal-target="alamat-modal" data-modal-toggle="alamat-modal"
                            class="text-[#F6CD61] hover:text-white transition-colors">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <p class="text-xs text-gray-400 mb-1">Pemberi Persetujuan</p>
                    <p class="text-white font-medium text-sm">{{ $pemberiPersetujuan }}</p>
                </div>
            </div>
        </div>
    </main>
</div>
<x-footer></x-footer>

<!-- Modal Foto -->
<div id="foto-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 justify-center items-center w-full h-screen bg-gray-900 bg-opacity-50">
    <div class="relative w-full max-w-md mx-auto bg-white rounded-lg shadow-lg">
        <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-700">Upload Foto Profil</h3>
            <form action="{{ route('upload-foto') }}" method="POST" enctype="multipart/form-data"
                class="mt-4 space-y-4">
                @csrf
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span>
                                or drag and drop</p>
                            <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input id="dropzone-file" type="file" name="Avatar" class="hidden" />
                    </label>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600"
                        data-modal-hide="foto-modal">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Telepon -->
<div id="telepon-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 justify-center items-center w-full h-screen bg-gray-900 bg-opacity-50">
    <div class="relative w-full max-w-md mx-auto bg-white rounded-lg shadow-lg">
        <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-700">Edit Nomor Telepon</h3>
            <form class="mt-4 space-y-4">
                <div>
                    <label for="kode-negara" class="block text-sm font-medium text-gray-700">Kode Negara</label>
                    <select id="kode-negara" name="kode-negara"
                        class="w-full p-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="+62" selected>+62 (Indonesia)</option>
                        <option value="+1">+1 (USA)</option>
                        <option value="+44">+44 (UK)</option>
                        <option value="+91">+91 (India)</option>
                    </select>
                </div>
                <div>
                    <label for="telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" id="telepon" name="telepon"
                        class="w-full p-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                        data-mask="telepon" placeholder="812-3456-7890" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600"
                        data-modal-hide="telepon-modal">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Alamat -->
<div id="alamat-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 justify-center items-center w-full h-screen bg-gray-900 bg-opacity-50">
    <div class="relative w-full max-w-md mx-auto bg-white rounded-lg shadow-lg">
        <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-700">Edit Alamat</h3>
            <form class="mt-4 space-y-4">
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" id="alamat" name="alamat"
                        class="w-full p-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                        value="Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600"
                        data-modal-hide="alamat-modal">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Event untuk membuka modal
        document.querySelectorAll('[data-modal-toggle]').forEach(button => {
            button.addEventListener('click', function() {
                const targetModal = document.getElementById(this.getAttribute(
                    'data-modal-target'));
                if (targetModal) {
                    targetModal.classList.remove('hidden');
                    targetModal.classList.add('flex');
                }
            });
        });

        // Event untuk menutup modal
        document.querySelectorAll('[data-modal-hide]').forEach(button => {
            button.addEventListener('click', function() {
                const modal = this.closest('.fixed');
                if (modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            });
        });
    });
</script>
