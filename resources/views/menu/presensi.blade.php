@php
    $id_Perusahaan = Auth::user()->id_Perusahaan;
    $perusahaan = DB::table('perusahaan')
        ->select('Latitude', 'Longitude')
        ->where('id_Perusahaan', $id_Perusahaan) // Ganti 'id' dengan 'id_Perusahaan'
        ->first();
    $targetLat = $perusahaan->Latitude ?? null;
    $targetLon = $perusahaan->Longitude ?? null;
    $user_id = Auth::id(); // Ambil user_id yang sedang login
    $today = date('Y-m-d'); // Tanggal hari ini

    // Periksa apakah user sudah melakukan presensi hari ini
    $presensiHariIni = DB::table('presensi')
        ->where('user_id', $user_id)
        ->whereDate('Tanggal', $today)
        ->where('status_Presensi', 'Disetujui')
        ->exists();

    $statusPresensi = $presensiHariIni ? 'Keluar' : 'Masuk';
    $tipePresensiSebelumnya = DB::table('presensi')
        ->where('user_id', $user_id)
        ->whereDate('Tanggal', $today)
        ->where('status_Presensi', 'Disetujui')
        ->orderBy('Waktu', 'asc') // Ambil presensi pertama (Masuk)
        ->value('jenis_Presensi'); // Ambil jenis_Presensi ('office' atau 'outside')
@endphp


<!-- presensi.blade.php -->
<x-navbar></x-navbar>
<div id="successAlert" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6">
        <div class="flex items-center mb-4">
            <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <h2 class="text-xl font-bold text-gray-800">Presensi Berhasil</h2>
        </div>
        <p class="text-gray-600 text-sm mb-4">Presensi Anda telah berhasil disimpan.</p>
        <div class="flex justify-end">
            <button class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none"
                onclick="window.location.href = '{{ route('beranda') }}';">
                Kembali ke Beranda
            </button>
        </div>
    </div>
</div>

<div id="errorAlert" class="hidden fixed top-4 right-4 max-w-sm bg-white rounded-lg shadow-lg border-l-4 border-red-500 p-2" style="margin-top: 65px;">
    <div class="flex items-center">
        <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div>
            <h3 class="font-medium text-gray-900">Gagal Menyimpan Presensi</h3>
            <p id="errorMessage" class="text-sm text-gray-600 mt-1"></p>
        </div>
    </div>
</div>
<main class="w-full mx-auto mb-6 px-4 sm:px-6 lg:px-36 py-10" style="margin-top: -10px;">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="/beranda"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-800 dark:text-gray-500 dark:hover:text-gray">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
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
                Presensi
            </li>
        </ol>
    </nav>
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-36" style="margin-top: -32px;">
        
        <div id="alertContainer" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
            <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4" id="alertTitle">Presensi Tidak Diperlukan</h2>
                <p class="text-gray-600 text-sm mb-4" id="alertMessage">Anda sudah melakukan presensi akhir hari ini.</p>
                <div class="flex justify-end">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none"
                        onclick="window.location.href = '{{ route('beranda') }}';">Kembali ke Beranda</button>
                </div>
            </div>
        </div>
        <div class="w-full mx-auto px-4 sm:px-100 py-12 max-w-lg">
            <div class="bg-white rounded-lg border-2 border-gray-300 p-6 shadow-lg">
                <!-- Toggle Presensi -->
                <div class="mb-6">
                    <div class="mb-3 flex justify-between">
                        <!-- Jenis Presensi (left) -->
                        <div class="flex items-center">
                            <label for="presenceType" class="block text-sm font-medium text-gray-700">Jenis Presensi</label>
                        </div>
                    
                        <!-- Status Presensi (right) -->
                        <div class="flex items-center bg-green-100 px-2 py-2 rounded-lg">
                            <div class="block text-sm font-medium text-gray-700">Presensi {{ $statusPresensi }}</div>
                        </div>
                    </div>
                    <div class="relative">
                        <select id="presenceType"
                            class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md bg-gray-100"
                            {{ $tipePresensiSebelumnya ? 'disabled' : '' }}>
                            <option value="Biasa" {{ ($tipePresensiSebelumnya && $tipePresensiSebelumnya === 'Biasa') || (!$tipePresensiSebelumnya && old('presenceType') === 'Biasa') ? 'selected' : '' }}>Dalam Kantor</option>
                            <option value="Dinas" {{ ($tipePresensiSebelumnya && $tipePresensiSebelumnya === 'Dinas') || (!$tipePresensiSebelumnya && old('presenceType') === 'Dinas') ? 'selected' : '' }}>Dinas</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 9l6 6 6-6" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Video Placeholder -->
                <div
                    class="relative border-2 border-red-400 border-dashed rounded-lg h-80 flex items-center justify-center mb-4 overflow-hidden">
                    <video id="video" autoplay muted playsinline
                        class="w-full h-full object-cover rounded-lg"></video>
                    <canvas id="canvas" class="absolute top-0 left-0 w-full h-full object-cover rounded-lg"></canvas>
                    <p id="cameraMessage" class="absolute text-gray-500">Kamera belum aktif...</p>
                </div>

                <!-- Lokasi -->
                <div id="locationContainer" class="flex items-center justify-between mb-4">
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-5 h-5 mr-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 11c2.21 0 4-1.79 4-4s-1.79-4-4 4-4 1.79-4 4 1.79 4 4 4zm0 4c-5.25 0-8 2.48-8 4v1h16v-1c0-1.52-2.75-4-8-4z" />
                        </svg>
                        <span>Lokasi Anda</span>
                    </div>
                    <div id="distanceContainer" class="text-sm text-gray-500 hidden">
                        <span id="distanceText">Mengukur jarak...</span>
                    </div>
                </div>
                <div id="addressText" class="text-sm text-gray-500 mb-4">
                    Mengambil lokasi Anda...
                </div>

                <!-- Peringatan -->
                <div class="bg-red-50 text-red-500 text-sm px-4 py-2 rounded-lg mb-4">
                    <ul id="warningList" class="list-disc pl-4">
                        <li>Wajah harus terdeteksi</li>
                    </ul>
                </div>

                <!-- Keterangan -->
                <div class="mb-6">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan (Opsional)</label>
                    <textarea id="keterangan" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Masukkan keterangan jika ada..."></textarea>
                </div>

                <!-- Tombol -->
                <div class="flex justify-between flex-wrap gap-5">
                    <button id="cancelButton"
                        class="flex-1 bg-gray-200 text-gray-700 px-2 py-2 rounded-md hover:bg-gray-300 focus:outline-none">
                        Batal
                    </button>
                    <button id="finishButton"
                        class="flex-1 bg-yellow-400 text-[#122036] px-2 py-2 rounded-md hover:bg-yellow-500 focus:outline-none"
                        disabled>
                        Presensi
                    </button>
                </div>

            </div>
        </div>
    </div>
</main>
<x-footer></x-footer>

<!-- Add CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{ asset('js/face-api.min.js') }}"></script>
<script>
    function showAlert(title, message) {
        const alertContainer = document.getElementById("alertContainer");
        const alertTitle = document.getElementById("alertTitle");
        const alertMessage = document.getElementById("alertMessage");

        alertTitle.textContent = title;
        alertMessage.textContent = message;

        alertContainer.classList.remove("hidden");
    }
    function showSuccessAlert() {
    const successAlert = document.getElementById("successAlert");
    successAlert.classList.remove("hidden");
}

function showErrorAlert(message) {
    const errorAlert = document.getElementById("errorAlert");
    const errorMessage = document.getElementById("errorMessage");
    errorMessage.textContent = message;
    errorAlert.classList.remove("hidden");
    
    // Auto-hide error alert after 5 seconds
    setTimeout(() => {
        errorAlert.classList.add("hidden");
    }, 5000);
}

    window.onload = async function() {
        const response = await fetch('/presensi/check');
        const result = await response.json();

        if (result.alreadyFinalized) {
            showAlert(
                "Presensi Tidak Diperlukan",
                "Anda sudah melakukan presensi akhir hari ini. Klik tombol di bawah untuk kembali ke Beranda."
            );
            return; // Jangan lakukan inisialisasi lebih lanjut
        }

        if (typeof faceapi === "undefined") {
            console.error('FaceAPI.js gagal dimuat!');
            return;
        }

        await Promise.all([
            faceapi.nets.ssdMobilenetv1.loadFromUri('/models'),
            faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
        ]);

        let video = document.getElementById("video");
        let canvas = document.getElementById("canvas");
        let cameraMessage = document.getElementById("cameraMessage");
        let presenceType = document.getElementById("presenceType").value;
        let isCameraOn = false;
        let detectionInterval;
        let isFaceDetected = false;
        let isWithinRange = false;
        let currentLat = null;
        let currentLon = null;
        let currentAddress = null;
        let photoDataUrl = null;  // Menyimpan data URL foto

        const targetLat = {{ $targetLat ?? 'null' }};
        const targetLon = {{ $targetLon ?? 'null' }};
        if (targetLat === null || targetLon === null) {
            console.error('Target lokasi tidak ditemukan!');
            showErrorAlert('Lokasi target perusahaan tidak ditemukan. Silakan hubungi administrator.');
            return;
        }

        async function checkLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(async (position) => {
                    const userLat = position.coords.latitude;
                    const userLon = position.coords.longitude;
                    
                    currentLat = userLat;
                    currentLon = userLon;

                    const address = await getAddress(userLat, userLon);
                    currentAddress = address;
                    document.getElementById("addressText").innerText = `${address}`;

                    const distanceContainer = document.getElementById("distanceContainer");

                    if (presenceType === "Biasa") {
                        const distance = getDistance(userLat, userLon, targetLat, targetLon)
                            .toFixed(2);
                        document.getElementById("distanceText").innerText =
                            `Jarak Anda: ${distance} meter`;
                        isWithinRange = distance <= 100;
                        distanceContainer.classList.remove("hidden");
                    } else {
                        isWithinRange = true;
                        distanceContainer.classList.add("hidden");
                    }
                    updateUI();
                }, (error) => {
                    console.error('Gagal mendapatkan lokasi:', error);
                    document.getElementById("addressText").innerText =
                        "Gagal mendapatkan lokasi Anda.";
                }, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                });
            } else {
                document.getElementById("addressText").innerText =
                    "Geolokasi tidak didukung oleh browser ini.";
            }
        }

        async function getAddress(lat, lon) {
            try {
                const response = await fetch(
                    `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`);
                const data = await response.json();

                if (data && data.display_name) {
                    return data.display_name;
                } else {
                    throw new Error("Alamat tidak ditemukan");
                }
            } catch (error) {
                console.error("Gagal mendapatkan alamat:", error);
                return "Lokasi Anda tidak ditemukan";
            }
        }

        function getDistance(lat1, lon1, lat2, lon2) {
            const R = 6371;
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            const distance = R * c * 1000;
            return distance;
        }

        async function savePresensi() {
    try {
        const response = await fetch('/presensi/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                jenis_Presensi: document.getElementById("presenceType").value === 'Biasa' ? 'Biasa' : 'Dinas',
                Tanggal: new Date().toISOString().split('T')[0],
                Waktu: new Date().toISOString(),
                Latitude: currentLat,
                Longitude: currentLon,
                Alamat: currentAddress,
                Foto: photoDataUrl,
                Keterangan: document.getElementById("keterangan").value
            })
        });

        const result = await response.json();

        if (result.success) {
            showSuccessAlert();
        } else {
            showErrorAlert(result.message || 'Gagal menyimpan presensi');
        }
    } catch (error) {
        console.error('Error:', error);
        showErrorAlert('Terjadi kesalahan saat menyimpan presensi');
    }
}

function updateUI() {
    const finishButton = document.getElementById("finishButton");
    const messages = [];

    if (!isFaceDetected) messages.push("Wajah harus terdeteksi");
    if (presenceType === "Biasa" && !isWithinRange) {
        messages.push("Jarak harus dalam radius 100 meter");
    }

    // Tombol tidak lagi di-disable tetapi memunculkan pesan
    finishButton.disabled = false;

    const warningList = document.getElementById("warningList");
    warningList.innerHTML = messages.map(msg => `<li>${msg}</li>`).join('');
}


        async function startCamera() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        width: 1280,
                        height: 720
                    },
                    audio: false
                });
                video.srcObject = stream;
                video.play();
                cameraMessage.classList.add("hidden");
                detectionInterval = setInterval(detectFaces, 100);
                isCameraOn = true;
            } catch (error) {
                console.error("Tidak dapat mengakses kamera:", error);
            }
        }

        async function detectFaces() {
            const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions());
            isFaceDetected = detections.some(d => d.score > 0.7);
            updateUI();

            const displaySize = {
                width: video.videoWidth,
                height: video.videoHeight
            };
            faceapi.matchDimensions(canvas, displaySize);
            const resizedDetections = faceapi.resizeResults(detections, displaySize);

            const ctx = canvas.getContext("2d");
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            faceapi.draw.drawDetections(canvas, resizedDetections);
        }
        async function capturePhoto() {
            // Buat elemen canvas sementara
            const tempCanvas = document.createElement("canvas");
            const video = document.getElementById("video");
            const faceCanvas = document.getElementById("canvas");

            // Sesuaikan ukuran canvas sementara dengan ukuran video
            tempCanvas.width = video.videoWidth;
            tempCanvas.height = video.videoHeight;

            // Gambar video ke canvas sementara
            const ctx = tempCanvas.getContext("2d");
            ctx.drawImage(video, 0, 0, tempCanvas.width, tempCanvas.height);

            // Gabungkan gambar dari canvas deteksi wajah (jika ada)
            if (faceCanvas) {
                ctx.drawImage(faceCanvas, 0, 0, tempCanvas.width, tempCanvas.height);
            }

            // Konversi canvas menjadi base64 (image/png)
            const dataUrl = tempCanvas.toDataURL("image/png");
            photoDataUrl = dataUrl; // Simpan data foto untuk dikirimkan
        }

        document.getElementById("finishButton").addEventListener("click", async () => {
            const finishButton = document.getElementById("finishButton");
            if (!(isFaceDetected && (presenceType === "Dinas" || isWithinRange))) {
                showErrorAlert("Presensi gagal karena syarat belum terpenuhi. Perhatikan syarat presensi sebelum menekan tombol Presensi.");
                setTimeout(3000); // Tunggu 3 detik sebelum mengalihkan
                return;
            }

            // Jika semua syarat terpenuhi, lanjutkan menyimpan presensi
            capturePhoto();
            savePresensi();
        });

        document.getElementById("cancelButton").addEventListener("click", () => {
            window.location.href = "{{ route('beranda') }}";
        });

        document.getElementById("presenceType").addEventListener("change", (event) => {
            presenceType = event.target.value;
            checkLocation();
            updateUI();
        });

        startCamera();
        checkLocation();
    };
</script>