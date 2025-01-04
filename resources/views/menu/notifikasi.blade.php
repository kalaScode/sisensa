<x-navbar></x-navbar>

<header class="py-3 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <nav class="flex mt-6 mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="/beranda"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-800 dark:text-gray-500 dark:hover:text-gray">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 1 1 1 1h2a1 1 0 1 1 1-1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Beranda
                </a>
            </li>
            <li class="inline-flex items-center text-sm font-medium text-gray-700">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                Notifikasi
            </li>
        </ol>
    </nav>

    <div class="mt-4 border-b border-gray-200">
        <nav class="flex justify-between item-center">
            <div class="flex space-x-4">
                <button class="border-b-2 border-blue-600 text-blue-600 px-1 py-2 text-sm font-medium">
                    Daftar
                </button>
            </div>
            @if (in_array($role, ['2', '3']))
                <div class="flex  items-center">
                    <a href="/buat-pengumuman">
                        <button
                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none font-medium rounded-lg text-sm px-3 py-1 text-center inline-flex items-center dark:bg-gray-700 dark:hover:bg-gray-800">
                            + Buat Pengumuman
                        </button>
                    </a>
                </div>
            @endif
        </nav>
    </div>
</header>



<main class="py-1 min-h-screen mb-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">
    <form action="{{ route('notifications.markAllRead') }}" method="POST">
        @csrf
        <button type="submit" class="absolute top-4 right-8 text-blue-600 hover:text-blue-700 text-sm font-medium">
            Tandai semua sudah dibaca
        </button>
    </form>

    <div class="flex items-center justify-between mt-4">
        <div>
            <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover"
                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none font-medium rounded-lg text-sm px-3 py-1 mb-4 text-center inline-flex items-center dark:bg-gray-700 dark:hover:bg-gray-800"
                type="button">
                Semua
                <svg class="w-2.5 h-2 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
        </div>
        <div id="dropdownHover"
            class="hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-800">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
                <li>
                    <a href="#" data-filter="semua"
                        class="filter-option block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Semua
                    </a>
                </li>
                <li>
                    <a href="#" data-filter="sudah-dibaca"
                        class="filter-option block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sudah
                        Dibaca</a>
                </li>
                <li>
                    <a href="#" data-filter="belum-dibaca"
                        class="filter-option block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belum
                        Dibaca</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="space-y-4">
        @foreach ($notifications as $notification)
            <div
                class="notification-card p-3 sm:p-4 rounded-lg bg-white border border-gray-200 {{ $notification->read_at ? 'sudah-dibaca' : 'belum-dibaca' }}">
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full">
                            @if ($notification->type === 'App\Notifications\PengumumanGeneral')
                                <i class="fas fa-bell text-yellow-500"></i> <!-- Ikon untuk PengumumanGeneral -->
                            @else
                                <i class="fa fa-users text-blue-600"></i> <!-- Ikon untuk tipe lainnya -->
                            @endif
                        </span>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="font-medium text-gray-900">
                                    {{ Str::limit($notification->data['message'], 50, '...') }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ Str::limit($notification->data['description'], 100, '...') }}
                                </p>
                                <span
                                    class="text-xs text-gray-400 mt-2 block">{{ $notification->created_at->diffForHumans() }}</span>
                                <a href="#" class="text-sm text-blue-600 view-detail"
                                    data-id="{{ $notification->id }}" data-modal-id="{{ $notification->id }}">Lihat
                                    Detail</a>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <div
                                    class="h-2 w-2 bg-blue-600 rounded-full {{ $notification->read_at ? 'bg-gray-600' : 'bg-yellow-100' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal untuk detail notifikasi -->
            <div id="modal-{{ $notification->id }}"
                class="modal fixed inset-0 bg-gray-500 bg-opacity-75 hidden flex items-center justify-center">
                <div class="modal-content bg-white p-6 rounded-lg max-w-4xl mx-auto">
                    <h3 class="text-xl font-medium text-gray-900">{{ $notification->data['message'] }}</h3>
                    <p class="mt-4 text-sm text-gray-500">{{ $notification->data['description'] }}</p>
                    <div class="mt-4 text-right">
                        <button class="close-modal text-blue-600 hover:text-blue-800">Tutup</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</main>

<x-footer class="pt-8"></x-footer>

<script>
    document.querySelectorAll('.filter-option').forEach(option => {
        option.addEventListener('click', function(e) {
            e.preventDefault();

            const filter = this.getAttribute('data-filter');
            const notificationCards = document.querySelectorAll('.notification-card');

            // Menampilkan semua notifikasi jika filter adalah "semua"
            if (filter === 'semua') {
                notificationCards.forEach(card => card.classList.remove('hidden'));
            }

            // Menampilkan hanya notifikasi yang sudah dibaca
            if (filter === 'sudah-dibaca') {
                notificationCards.forEach(card => {
                    if (card.classList.contains('sudah-dibaca')) {
                        card.classList.remove('hidden');
                    } else {
                        card.classList.add('hidden');
                    }
                });
            }

            // Menampilkan hanya notifikasi yang belum dibaca
            if (filter === 'belum-dibaca') {
                notificationCards.forEach(card => {
                    if (card.classList.contains('belum-dibaca')) {
                        card.classList.remove('hidden');
                    } else {
                        card.classList.add('hidden');
                    }
                });
            }

            // Update teks tombol filter untuk mencocokkan pilihan
            const button = document.querySelector('#dropdownHoverButton');
            button.textContent = this.textContent;

            // Menghapus panah yang sudah ada
            const existingArrow = button.querySelector('svg');
            if (existingArrow) {
                existingArrow.remove();
            }

            // Menambahkan panah ke tombol setelah teks
            const arrow = document.createElement('svg');
            arrow.setAttribute('class', 'w-2.5 h-2 mx-1'); // Ukuran panah
            arrow.setAttribute('aria-hidden', 'true');
            arrow.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
            arrow.setAttribute('fill', 'White');
            arrow.setAttribute('viewBox', '0 0 6 10');

            const path = document.createElement('path');
            path.setAttribute('stroke', 'white');
            path.setAttribute('stroke-linecap', 'round');
            path.setAttribute('stroke-linejoin', 'round');
            path.setAttribute('stroke-width', '2');
            path.setAttribute('d', 'm1 9 4 4 4-4');
            // Menambahkan path ke dalam arrow dan arrow ke tombol
            arrow.appendChild(path);
            button.appendChild(arrow);
        });
    });

    // Menangani klik pada "Lihat Detail"
    document.querySelectorAll('.view-detail').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const notificationId = this.getAttribute('data-id');

            // Mengirim permintaan AJAX untuk menandai notifikasi sebagai sudah dibaca
            fetch(`/notifications/${notificationId}/mark-as-read`, {
                    method: 'PATCH', // Pastikan menggunakan metode PATCH
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        id: notificationId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Jika berhasil, ubah status pada tampilan
                    document.querySelector(`#modal-${notificationId}`).classList.remove('hidden');
                    document.querySelector(`[data-id="${notificationId}"]`).closest(
                        '.notification-card').classList.add('sudah-dibaca');
                })
                .catch(error => console.log('Error:', error));
        });
    });

    // Menangani klik pada tombol "Tutup"
    document.querySelectorAll('.close-modal').forEach(button => {
        button.addEventListener('click', function() {
            const modal = this.closest('.modal');
            modal.classList.add('hidden');
            location.reload();
        });
    });
</script>
<style>
    .notification-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 100px;
    }

    .notification-card.hidden {
        display: none;
    }
</style>
