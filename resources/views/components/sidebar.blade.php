<!-- Burger Menu Button -->
<button id="menu-toggle"
    class="fixed top-4 left-4 z-50 text-white bg-gray-800 p-2 rounded-lg hover:bg-gray-700 md:hidden">
    <i class="fa-solid fa-bars fa-xl"></i>
</button>

<!-- Sidebar -->
<div id="sidebar"
    class="fixed top-0 left-0 bottom-0 w-64 bg-gray-800 text-white z-40 transform -translate-x-full md:translate-x-0 md:block transition-transform duration-300">
    <div class="flex justify-between items-center p-5 ml-3">
        <img src="/img/logo-sisensa.png" alt="Sisensa" class="h-12">
        <button id="close-menu" class="text-white md:hidden">
            <i class="fa-solid fa-times fa-xl"></i>
        </button>
    </div>
    <ul>
        <li><a href="/dashboard" class="flex ml-5 mr-5 items-center gap-3 py-2 px-4 hover:bg-red-700 rounded"><i
                    class="fa-solid fa-tachometer-alt"></i> Dashboard</a></li>
        <li>
            <a href="/otorisasi" class="flex ml-5 mr-5  items-center gap-3 py-2 px-4 hover:bg-red-700 rounded">
                <i class="fa-solid fa-user-shield"></i>
                Kelola Otoritas
            </a>
        </li>
        <li>
            <a href="/otorisasi-karyawan" class="flex ml-5 mr-5  items-center gap-3 py-2 px-4 hover:bg-red-700 rounded">
                <i class="fa-solid fa-users-cog"></i>
                Kelola User
            </a>
        </li>
        <li>
            <a href="/profil" class="flex ml-5 mr-5  items-center gap-5 py-2 px-4 hover:bg-red-700 rounded">
                <i class="fa-solid fa-user"></i>
                Profil
            </a>
        </li>
        <li>
            <a href="#" id="logout-link"
                class="flex ml-5 mr-5 items-center gap-4 py-2 px-4 hover:bg-red-700 rounded">
                <i class="fa-solid fa-sign-out-alt"></i>
                Keluar
            </a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>

<!-- JavaScript for Menu Toggle -->
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const closeMenu = document.getElementById('close-menu');
    const sidebar = document.getElementById('sidebar');
    const logoutLink = document.getElementById('logout-link'); // Ambil elemen logout

    menuToggle.addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full'); // Tampilkan sidebar
        menuToggle.style.display = 'none'; // Sembunyikan tombol burger
    });

    closeMenu.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full'); // Sembunyikan sidebar
        menuToggle.style.display = 'block'; // Tampilkan tombol burger
    });

    // Opsional: Klik di luar sidebar untuk menutup
    document.addEventListener('click', (event) => {
        if (!sidebar.contains(event.target) && !menuToggle.contains(event.target) && !closeMenu.contains(event
                .target)) {
            sidebar.classList.add('-translate-x-full');
            menuToggle.style.display = 'block';
        }
    });

    // SweetAlert Logout Confirmation
    logoutLink.addEventListener('click', (event) => {
        event.preventDefault(); // Mencegah aksi default link (redirect)

        // Tampilkan konfirmasi SweetAlert
        Swal.fire({
            title: 'Apakah Anda yakin ingin keluar?',
            text: "Anda akan keluar dari akun ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika ya, lakukan submit form logout
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>
