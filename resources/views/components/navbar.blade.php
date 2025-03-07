<nav class="fixed top-0 z-50 w-full lg:px-32 sm:px-6 bg-[#122036]/90 backdrop-blur-md shadow-lg">
    <div class="px-4 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <!-- Logo Section -->
            <div id="logo" class="flex items-center">
                <a href="/beranda" class="flex items-center">
                    <img src="/img/logo-sisensa.png" class="h-9" alt="sisensa" />
                </a>
            </div>

            <!-- Notification and Profile Section -->
            <div class="flex items-center space-x-4">
                <!-- Notification Icon -->
                <div class="relative">
                    <button id="notification-icon" data-dropdown-toggle="dropdownNotification"
                        class="relative inline-flex items-center mt-2 text-sm font-medium text-gray-300 hover:text-white focus:outline-none"
                        type="button">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
                            <path
                                d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
                        </svg>
                        @if ($unreadNotifications > 0)
                            <div id="notification-dot"
                                class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-4">
                            </div>
                        @endif

                    </button>
                    <!-- Notification Dropdown -->
                    <div id="dropdownNotification"
                        class="hidden z-20 w-96 bg-white divide-y divide-gray-100 rounded-lg shadow-md dark:bg-gray-800 dark:divide-gray-700"
                        aria-labelledby="notification-icon">
                        <div
                            class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                            Notifikasi
                        </div>
                        <div class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse ($notificationsNavbar as $notification)
                                <a href="/notifikasi"
                                    class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 w-full max-w-lg {{ $notification->read_at ? 'bg-gray-200 dark:bg-gray-800' : 'bg-gray-100 dark:bg-gray-700' }}">

                                    <!-- Foto Pengirim -->
                                    <div class="flex-shrink-0">
                                        <img class="rounded-full w-11 h-11 object-cover border-2 border-gray-300 dark:border-gray-600"
                                            src="{{ asset('storage/' . ($notification->data['sender_avatar'] ?? 'profil.jpg')) }}"
                                            alt="{{ $notification->data['sender_name'] ?? 'User Photo' }}">
                                    </div>

                                    <div class="w-full ps-3 relative">
                                        <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">
                                            {{ $notification->data['sender_name'] ?? 'Unknown User' }} -
                                            {{ $notification->data['sender_jabatan'] ?? 'Unknown Position' }}
                                        </div>
                                        <div class="text-gray-400 text-xs dark:text-gray-500">
                                            {{ $notification->data['message'] ?? 'No message' }}
                                        </div>
                                        <div class="text-xs text-blue-600 dark:text-blue-500">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </div>

                                        <!-- Ikon Centang di pojok kanan atas -->
                                        @if ($notification->read_at)
                                            <span class="absolute top-0 right-2 text-blue-600 dark:text-blue-400">
                                                <i class="fa-solid fa-check-double"></i> <!-- Ikon centang -->
                                            </span>
                                        @else
                                            <!-- Tombol Tandai Sudah Dibaca -->
                                            <form action="{{ route('notification.markAsRead', $notification->id) }}"
                                                method="POST" class="mt-2">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="absolute top-0 right-2 text-yellow-600 hover:text-yellow-800">
                                                    <i class="fa-solid fa-check-double"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </a>
                            @empty
                                <p class="text-center text-gray-500 py-4 dark:text-gray-400">Tidak ada notifikasi</p>
                            @endforelse
                        </div>
                        <a href="/notifikasi"
                            class="flex items-center justify-center py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                            <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2"
                                    d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            Lihat Semua
                        </a>
                    </div>
                </div>

                <!-- Profile Dropdown -->
                <div class="relative">
                    <button type="button"
                        class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        aria-expanded="false" data-dropdown-toggle="dropdown-user">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full object-cover border-2 border-[#F6CD61]"
                            src="{{ Auth::user()->Avatar ? asset('storage/' . Auth::user()->Avatar) : '/img/profil.jpg' }}"
                            alt="Foto Profil">
                    </button>
                    <div class="hidden z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-user">
                        <div class="px-4 py-3">
                            <p class="text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                            <p class="text-sm font-medium text-gray-500 truncate dark:text-gray-300">
                                {{ Auth::user()->email }}</p>
                        </div>
                        <ul class="py-1">
                            <li>
                                <a href="/profil"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600">Profil</a>
                            </li>
                            <li>
                                <form id="logout-form" method="POST" action="{{ route('logout') }}"
                                    style="display: none;">
                                    @csrf
                                </form>

                                <button id="logout-button"
                                    class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600">
                                    Keluar
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<script>
    document.getElementById('logout-button').addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah form submit otomatis

        // Menampilkan SweetAlert konfirmasi
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan keluar dari akun ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, keluar!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, lakukan submit form logout
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>
