<x-navbar></x-navbar>
<main class="w-full mx-auto px-4 sm:px-6 lg:px-36 py-10">
    <div class="bg-white rounded-lg shadow-lg p-6 mb-20">
        <h2 class="text-lg font-medium mb-4 text-center">Status Presensi Hari Ini</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div class="flex items-center gap-2 justify-center bg-gray-100 p-4 rounded-lg">
                <i class="fas fa-sign-in-alt text-[#122036]"></i>
                <div>
                    <div class="text-sm text-gray-500">Jam Masuk</div>
                    <div class="font-medium">08:00</div>
                </div>
            </div>
            <div class="flex items-center gap-2 justify-center bg-gray-100 p-4 rounded-lg">
                <i class="fas fa-sign-out-alt text-[#122036]"></i>
                <div>
                    <div class="text-sm text-gray-500">Jam Keluar</div>
                    <div class="font-medium">17:00</div>
                </div>
            </div>
            <div class="flex items-center gap-2 justify-center bg-gray-100 p-4 rounded-lg">
                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                <div>
                    <div class="text-sm text-gray-500">Status</div>
                    <div class="font-medium text-green-500">Hadir</div>
                </div>
            </div>
        </div>
    </div>
    <div id="gallery" class="relative p-2 overflow-hidden">
        <!-- Carousel wrapper -->
        <div class="relative w-full h-auto">
        <!-- Carousel items -->
        <div id="carouselItems" class="flex mr-6 transition-transform duration-700 ease-[cubic-bezier(0.25, 1, 0.5, 1)]">
            <!-- Slide 1 -->
        <a href="/presensi" class="bg-white w-1/4 flex-shrink-0 p-6 rounded-lg shadow-lg hover:shadow-md transition-shadow flex flex-col items-center mx-1">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
            <i class="fas fa-sign-in-alt text-blue-600 text-xl"></i>
            </div>
            <h3 class="font-medium mb-1">Presensi</h3>
            <p class="text-sm text-gray-500">Catat kehadiran Anda</p>
        </a>
        <!-- Slide 2 -->
        <a href="/cuti" class="bg-white w-1/4 flex-shrink-0 p-6 rounded-lg shadow-lg hover:shadow-md transition-shadow flex flex-col items-center mx-1">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
            <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
            </div>
            <h3 class="font-medium mb-1">Cuti</h3>
            <p class="text-sm text-gray-500">Ajukan cuti</p>
        </a>
        <!-- Slide 3 -->
        <a href="/riwayat_pribadi" class="bg-white w-1/4 flex-shrink-0 p-6 rounded-lg shadow-lg hover:shadow-md transition-shadow flex flex-col items-center mx-1">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
            <i class="fas fa-history text-blue-600 text-xl"></i>
            </div>
            <h3 class="font-medium mb-1">Riwayat Pribadi</h3>
            <p class="text-sm text-gray-500">Lihat riwayat kehadiranmu</p>
        </a>
        <!-- Slide 4 -->
        <a href="/daftar_karyawan" class="bg-white w-1/4 flex-shrink-0 p-6 rounded-lg shadow-lg hover:shadow-md transition-shadow flex flex-col items-center mx-1">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
            <i class="fas fa-users text-blue-600 text-xl"></i>
            </div>
            <h3 class="font-medium mb-1">Daftar Karyawan</h3>
            <p class="text-sm text-gray-500">Lihat daftar karyawan</p>
        </a>
        <!-- Tambahan Menu (Slide 5) -->
        <a href="/persetujuan" class="bg-white w-1/4 flex-shrink-0 p-6 rounded-lg shadow-lg hover:shadow-md transition-shadow flex flex-col items-center mx-1">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-7 h-7 text-blue-600 dark:text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z"/>
                    <path fill-rule="evenodd" d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
                  </svg>                  
            </div>
            <h3 class="font-medium mb-1">Persetujuan</h3>
            <p class="text-sm text-gray-500">Memberikan persetujuan</p>
        </a>
        <!-- Tambahan Menu (Slide 6) -->
        <a href="/riwayat_karyawan" class="bg-white w-1/4 flex-shrink-0 p-6 rounded-lg shadow-lg hover:shadow-md transition-shadow flex flex-col items-center mx-1">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                </svg>                    
            </div>
            <h3 class="font-medium mb-1">Riwayat Karyawan</h3>
            <p class="text-sm text-gray-500">Riwayat Seluruh Karyawan</p>
        </a>
          </div>
        </div>
      
        <!-- Slider controls -->
        <button id="prevButton" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
          <span class="inline-flex items-center justify-center w-10 h-10 bg-white/30 group-hover:bg-white/50 rounded-full">
            <svg aria-hidden="true" class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
          </span>
        </button>
        <button id="nextButton" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
          <span class="inline-flex items-center justify-center w-10 h-10 bg-white/30 group-hover:bg-white/50 rounded-full">
            <svg aria-hidden="true" class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
            </svg>
          </span>
        </button>
      </div>
      
      <script>
        const items = document.getElementById('carouselItems');
        const nextButton = document.getElementById('nextButton');
        const prevButton = document.getElementById('prevButton');
    
        const slideWidth = items.children[0].offsetWidth + 16; // Lebar + margin antar item
        let isTransitioning = false;
        let autoSlideInterval;
    
        function moveNext() {
            if (isTransitioning) return;
            isTransitioning = true;
    
            // Pindahkan elemen pertama ke akhir
            const firstChild = items.firstElementChild;
            items.appendChild(firstChild);
    
            // Geser ke kiri
            items.style.transition = 'none';
            items.style.transform = `translateX(${slideWidth}px)`;
            setTimeout(() => {
                // Reset posisi tanpa animasi
                items.style.transition = 'transform 0.7s cubic-bezier(0.25, 1, 0.5, 1)';
                items.style.transform = 'translateX(0)';
                setTimeout(() => {
                    isTransitioning = false;
                }, 700);
            }, 0); // Sesuai durasi animasi
        }
    
        function movePrev() {
            if (isTransitioning) return;
            isTransitioning = true;
    
            // Pindahkan elemen terakhir ke awal
            const lastChild = items.lastElementChild;
            items.insertBefore(lastChild, items.firstChild);
    
            // Geser ke kanan (posisi awal)
            items.style.transition = 'none';
            items.style.transform = `translateX(-${slideWidth}px)`;
            setTimeout(() => {
                items.style.transition = 'transform 0.7s cubic-bezier(0.25, 1, 0.5, 1)';
                items.style.transform = 'translateX(0)';
                setTimeout(() => {
                    isTransitioning = false;
                }, 700);
            }, 0);
        }
    
        // Tambahkan event listener untuk tombol next dan prev
        nextButton.addEventListener('click', moveNext);
        prevButton.addEventListener('click', movePrev);
    
        // Tambahkan fitur slide otomatis
        function startAutoSlide() {
            autoSlideInterval = setInterval(() => {
                moveNext();
            }, 2000); // 2 detik
        }
    
        function stopAutoSlide() {
            clearInterval(autoSlideInterval);
        }
    
        // Mulai slide otomatis saat halaman dimuat
        startAutoSlide();
    
        // Hentikan slide otomatis saat kursor hover
        items.addEventListener('mouseover', stopAutoSlide);
        
        // Mulai lagi slide otomatis saat kursor keluar
        items.addEventListener('mouseout', startAutoSlide);
      </script>
    
        
           
</main>
<x-footer></x-footer>
