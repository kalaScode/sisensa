<x-navbar></x-navbar>
<main class="max-w-7xl mx-auto sm:px-6 lg:px-36 py-6">
  <nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
      <li class="inline-flex items-center text-sm font-medium text-gray-700">
          <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
              viewBox="0 0 20 20">
              <path
                  d="M19.707 9.293l-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414z" />
          </svg>
          Dashboard
      </li>
  </ol>
  </nav>
  
  <!-- Welcome Section -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 my-4">
    <div class="lg:col-span-2">
        <div class="bg-gradient-to-r from-gray-800 to-gray-700 rounded-2xl p-6 text-white shadow-lg">
            <h1 class="text-2xl font-semibold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-white/80">Semoga hari Anda menyenangkan</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-4 shadow-lg backdrop-blur-sm">
        <div class="flex items-center space-x-3">
            <img class="h-14 w-14 rounded-full object-cover"
                src="{{ Auth::user()->perusahaan->Logo
                    ? asset('storage/' . Auth::user()->perusahaan->Logo)
                    : (Auth::user()->id_Perusahaan == 1
                        ? asset('/img/berkreasi.png')
                        : (Auth::user()->id_Perusahaan == 2
                            ? asset('/img/sft.png')
                            : (Auth::user()->id_Perusahaan == 3
                                ? asset('/img/limbers.png')
                                : (Auth::user()->id_Perusahaan == 4
                                    ? asset('/img/expert.png')
                                    : '#')))) }}"
                alt="Profile Perusahaan">
            <div>
                <h2 class="text-lg font-semibold">
                    {{ Auth::user()->perusahaan->nama_Perusahaan ?? 'Tidak ada perusahaan' }}
                </h2>
            </div>
        </div>
    </div>

</div>

    <!-- Statistics Cards -->
  <div class="container mt-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Pengguna -->
        <div class="bg-white rounded-2xl p-4 shadow-lg backdrop-blur-sm flex items-center space-x-4">
          <div class="bg-gray-500 p-2 rounded-2xl">
              <svg class="w-10 h-10 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"/>
              </svg>
          </div>
          <div>
              <h2 class="text-sm font-bold text-gray-700">Total Pengguna</h2>
              <p class="text-3xl font-bold text-black">{{ $total_pengguna }}</p>
          </div>
        </div>

        <!-- Pengguna Aktif -->
        <div class="bg-white rounded-2xl p-4 shadow-lg backdrop-blur-sm flex items-center space-x-4">
          <div class="bg-green-500 p-2 rounded-2xl">
              <svg class="w-10 h-10 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
              </svg>
          </div>
          <div>
            <h2 class="text-sm font-bold text-gray-700">Pengguna Aktif</h2>
            <p class="text-3xl font-bold text-black">{{ $pengguna_aktif }}</p>
          </div>
        </div>

        <!-- Total Role -->
        <div class="bg-white rounded-2xl p-4 shadow-lg backdrop-blur-sm flex items-center space-x-4">
          <div class="bg-yellow-500 p-2 rounded-2xl">
            <svg class="w-10 h-10 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
              <path d="M6 2c-1.10457 0-2 .89543-2 2v4c0 .55228.44772 1 1 1s1-.44772 1-1V4h12v7h-2c-.5523 0-1 .4477-1 1v2h-1c-.5523 0-1 .4477-1 1s.4477 1 1 1h5c.5523 0 1-.4477 1-1V3.85714C20 2.98529 19.3667 2 18.268 2H6Z"/>
              <path d="M6 11.5C6 9.567 7.567 8 9.5 8S13 9.567 13 11.5 11.433 15 9.5 15 6 13.433 6 11.5ZM4 20c0-2.2091 1.79086-4 4-4h3c2.2091 0 4 1.7909 4 4 0 1.1046-.8954 2-2 2H6c-1.10457 0-2-.8954-2-2Z"/>
            </svg>
          </div>
          <div>
            <h2 class="text-sm font-bold text-gray-700">Total Role</h2>
            <p class="text-3xl font-bold text-black">{{ $total_role }}</p>
          </div>
        </div>

        <!-- Aktivitas Hari Ini -->
        <div class="bg-white rounded-2xl p-4 shadow-lg backdrop-blur-sm flex items-center space-x-4">
          <div class="bg-pink-500 p-2 rounded-2xl">
            <svg class="w-10 h-10 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v15a1 1 0 0 0 1 1h15M8 16l2.5-5.5 3 3L17.273 7 20 9.667"/>
            </svg>
          </div>
          <div>
            <h2 class="text-sm font-bold text-gray-700">Sesi Aktif</h2>
            <p class="text-3xl font-bold text-black">{{ $activity_today }}</p>
          </div>
        </div>
    </div>
  </div>

  </div>
    <div>
      <!-- Role Distribution Chart -->
      <div class="bg-white rounded-2xl p-4 shadow-lg backdrop-blur-sm mx-auto" style="width: 40vw;">
        <canvas id="roleDistributionChart"></canvas>
      </div>
    </div>
  </div>
</main>
<x-footer></x-footer>

<script>
// Role Distribution Chart
const ctx = document.getElementById('roleDistributionChart').getContext('2d');
const data = @json($distribusi_role);

new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: data.map(item => item.nama_Otoritas),
        datasets: [{
            label: 'Jumlah Akun',
            data: data.map(item => item.jumlah),
            backgroundColor: ['#f87171', '#60a5fa', '#facc15', '#34d399', '#9b5de5'],
        }]
    },
    options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Distribusi Role',
            color: 'rgb(0, 0, 0)',
            font: {
              size: 24
            }
          },
          legend: {
              position: 'top',
              labels: {
                color: 'rgb(0, 0, 0)',
                font: {
                  size: 16
                }
              }
          }
        }
    }
});
</script>