<div class="min-h-screen bg-gray-50">
    {{-- Sidebar hanya tampil jika id_Otoritas adalah 1 atau 2 --}}
    @if (Auth::user()->id_Otoritas == 1 || Auth::user()->id_Otoritas == 2)
        <x-sidebar></x-sidebar>
    @endif

    {{-- Navbar hanya tampil jika id_Otoritas tidak sama dengan 1 atau 2 --}}
    @if (Auth::user()->id_Otoritas !== 1 && Auth::user()->id_Otoritas !== 2)
        <x-navbar></x-navbar>
    @endif
    <main class="max-w-7xl mx-auto sm:px-6 lg:px-36 py-10">
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                @if (Auth::user()->id_Otoritas !== 1 && Auth::user()->id_Otoritas !== 2)
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
                @else
                    <li class="inline-flex items-center hidden md:block">
                        <!-- Sembunyikan pada mobile, tampilkan pada desktop -->
                        <a href="/dashboard"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-800 dark:text-gray-500 dark:hover:text-gray">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                @endif

                <li class="inline-flex items-center">
                    <a href="/profil"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-800 dark:text-gray-500 dark:hover:text-gray">
                        @if (Auth::user()->id_Otoritas !== 1 && Auth::user()->id_Otoritas !== 2)
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                        @endif
                        @if (Auth::user()->id_Otoritas == 1 || Auth::user()->id_Otoritas == 2)
                            <svg class="w-auto text-gray mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                    clip-rule="evenodd" />
                            </svg>
                        @endif
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
            @if (session('success'))
                <div id="success-message" class="bg-green-500 text-white p-4 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div id="error-message" class="bg-red-500 text-white p-4 rounded-md mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="relative w-24 h-24 mx-auto mb-4">
                <img src="{{ Auth::user()->Avatar ? asset('storage/' . Auth::user()->Avatar) : '/img/profil.jpg' }}"
                    alt="Foto Profil" class="w-full h-full rounded-full object-cover border-2 border-[#F6CD61]">
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
{{-- Foooter hanya tampil jika id_Otoritas tidak sama dengan 1 atau 2 --}}
@if (Auth::user()->id_Otoritas !== 1 && Auth::user()->id_Otoritas !== 2)
    <x-footer></x-footer>
@endif

<!-- Modal Foto -->
<div id="foto-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-screen bg-gray-900 bg-opacity-50">
    <div class="relative w-full max-w-md mx-auto bg-white rounded-lg shadow-lg">
        <!-- Modal Header -->
        <div class="p-4 border-b">
            <h3 class="text-lg font-semibold text-gray-700">Upload Foto Profil</h3>
        </div>

        <!-- Modal Body -->
        <div class="p-4">
            <form id="avatar-form" action="{{ route('update-avatar') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <input type="file" id="avatar" name="avatar" accept="image/*"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                        required>
                    @error('avatar')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600"
                        data-modal-hide="foto-modal">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Unggah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Telepon -->
<div id="telepon-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-screen bg-gray-900 bg-opacity-50">
    <div class="relative w-full max-w-md mx-auto bg-white rounded-lg shadow-lg">
        <!-- Modal Header -->
        <div class="p-4 border-b">
            <h3 class="text-lg font-semibold text-gray-700">Edit Nomor Telepon</h3>
        </div>

        <!-- Modal Body -->
        <div class="p-4">
            <form action="{{ route('update-telepon') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Input Telepon -->
                <div>
                    <label for="telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" id="telepon" name="telepon"
                        class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="08XXXXXXXXXX" required>
                    @error('telepon')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4">
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
            <form action="{{ route('update-alamat') }}" method="POST" class="mt-4 space-y-4">
                @csrf
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" id="alamat" name="alamat"
                        class="w-full p-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('alamat', Auth::user()->Alamat) }}" required>
                    @error('alamat')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
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

    document.addEventListener('DOMContentLoaded', function() {
        const teleponInput = document.getElementById('telepon');
        teleponInput.addEventListener('input', function() {
            const regex = /^08\d{0,13}$/;
            if (!regex.test(this.value)) {
                this.setCustomValidity('Nomor telepon harus diawali 08 dan maksimal 15 karakter.');
            } else {
                this.setCustomValidity('');
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        // Cek jika ada pesan sukses atau error
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');

        // Menyembunyikan pesan sukses setelah 5 detik
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 5000); // 5000 ms = 5 detik
        }

        // Menyembunyikan pesan error setelah 5 detik
        if (errorMessage) {
            setTimeout(function() {
                errorMessage.style.display = 'none';
            }, 5000); // 5000 ms = 5 detik
        }
    });

    const avatarInput = document.getElementById('avatar');
    const form = document.getElementById('avatar-form');
    const modal = document.getElementById('foto-modal');

    avatarInput.addEventListener('change', function() {
        const file = this.files[0];

        // Validate file type and size
        const isImage = file && file.type.startsWith('image/');
        const isSizeValid = file && file.size <= 5 * 1024 * 1024; // 5MB in bytes

        // Set custom validity
        if (!isImage) {
            avatarInput.setCustomValidity('Format file harus jpg/jpeg/png.');
        } else if (!isSizeValid) {
            avatarInput.setCustomValidity('Ukuran file maksimal 5MB.');
        } else {
            avatarInput.setCustomValidity('');
        }
    });
</script>
