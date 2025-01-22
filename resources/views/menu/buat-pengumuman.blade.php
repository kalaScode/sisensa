<x-navbar></x-navbar>
<header class="max-w-7xl px-4 sm:px-6 lg:px-36 py-3">
    <nav class="flex mt-6 mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="/beranda"
                    class="inline-flex items-center text-xs sm:text-sm font-medium text-gray-700 hover:text-blue-800 dark:text-gray-500 dark:hover:text-gray">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 1 1 1 1h2a1 1 0 1 1 1-1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Beranda
                </a>
            </li>
            <li class="inline-flex items-center">
                <a href="/notifikasi"
                    class="inline-flex items-center text-xs sm:text-sm font-medium text-gray-700 hover:text-blue-800 dark:text-gray-500 dark:hover:text-gray">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    Notifikasi
                </a>
            </li>
            <li class="inline-flex items-center text-xs sm:text-sm font-medium text-gray-700">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                Buat Pengumuman
            </li>
        </ol>
    </nav>
</header>
<header class="max-w-7xl px-4 sm:px-6 lg:px-36 py-2">
    <h1 class="text-2xl font-semibold text-gray-800">Buat Pengumuman</h1>
</header>

<main class="max-w-7xl px-4 sm:px-6 lg:px-36 py-2">
    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="mb-4 text-green-500">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pengumuman.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Pengumuman</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('judul') border-red-500 @enderror">
            @error('judul')
                <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="isi_pengumuman" class="block text-sm font-medium text-gray-700">Isi Pengumuman</label>
            <textarea id="isi_pengumuman" name="isi_pengumuman" rows="4"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('isi_pengumuman') border-red-500 @enderror">{{ old('isi_pengumuman') }}</textarea>
            @error('isi_pengumuman')
                <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4 flex justify-end">
            <button type="submit"
                class="py-2 px-4 sm:py-1.5 sm:px-3 text-sm sm:text-xs bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Kirim Pengumuman
            </button>
        </div>

    </form>
</main>

<x-footer></x-footer>

<script src="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.umd.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#isi_pengumuman'), {
            toolbar: ['bold', 'italic'],
            simpleUpload: {
                uploadUrl: '/upload-image',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        })
        .then(editor => {
            console.log('Editor berhasil diinisialisasi');
            editor.plugins.get('FileRepository').createUploadAdapter = loader => {
                return {
                    upload: () => {
                        console.log('Mengunggah gambar...');
                        const data = new FormData();
                        data.append('upload', loader.file);

                        return fetch('/upload-image', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                                body: data
                            })
                            .then(response => {
                                console.log('Respons diterima:', response);
                                return response.json();
                            })
                            .then(result => {
                                console.log('Hasil upload:', result);
                                return {
                                    default: result.url
                                };
                            })
                            .catch(error => {
                                console.error('Error upload:', error);
                            });
                    }
                };
            };
        })
        .catch(error => {
            console.error('CKEditor gagal diinisialisasi:', error);
        });
</script>
