<x-navbar></x-navbar>
<div class="w-full mx-auto px-4 sm:px-6 lg:px-36">
    <div class="w-full mx-auto px-4 sm:px-100 py-12 max-w-lg">
        <div class="bg-white rounded-lg border-2 border-gray-300 p-6 shadow-lg">
            <!-- Video Placeholder -->
            <div class="relative border-2 border-red-400 border-dashed rounded-lg h-80 flex items-center justify-center mb-4 overflow-hidden">
                <video id="video" autoplay muted playsinline class="w-full h-full object-cover rounded-lg"></video>
                <canvas id="canvas" class="absolute top-0 left-0 w-full h-full object-cover rounded-lg"></canvas>
                <p id="cameraMessage" class="absolute text-gray-500">Kamera belum aktif...</p>
            </div>

            <!-- Lokasi dan Jarak -->
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-5 h-5 mr-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c2.21 0 4-1.79 4-4s-1.79-4-4 4-4 1.79-4 4 1.79 4 4 4zm0 4c-5.25 0-8 2.48-8 4v1h16v-1c0-1.52-2.75-4-8-4z" />
                    </svg>
                    <span>Lokasi Saat Ini</span>
                </div>
                <div id="distanceText" class="text-sm text-gray-500">
                    Mengukur jarak...
                </div>
            </div>
            <div id="addressText" class="text-sm text-gray-500 mb-4">
                Mengambil lokasi Anda...
            </div>

            <!-- Peringatan -->
            <div class="bg-red-50 text-red-500 text-sm px-4 py-2 rounded-lg mb-4">
                <ul id="warningList" class="list-disc pl-4">
                    <li>Wajah harus terdeteksi</li>
                    <li>Jarak harus dalam radius 100 meter</li>
                </ul>
            </div>

            <!-- Tombol -->
            <div class="flex justify-between">
                <button id="cancelButton" class="bg-gray-200 text-gray-700 px-8 py-2 rounded-md hover:bg-gray-300 focus:outline-none">
                    Batal
                </button>
                <button id="toggleCamera" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none">
                    Aktifkan Kamera
                </button>
                <button id="finishButton" class="bg-yellow-400 text-[#122036] px-8 py-2 rounded-md hover:opacity-90 focus:outline-none" disabled>
                    Selesai
                </button>
            </div>
        </div>
    </div>
</div>
<x-footer></x-footer>

<!-- Face API -->
<script src="{{ asset('js/face-api.min.js') }}"></script>
<script>
window.onload = async function() {
    if (typeof faceapi === "undefined") {
        console.error('FaceAPI.js gagal dimuat!');
        return;
    }

    console.log("FaceAPI.js dimuat, memuat model...");
    await Promise.all([
        faceapi.nets.ssdMobilenetv1.loadFromUri('/models'),
        faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
        faceapi.nets.faceExpressionNet.loadFromUri('/models')
    ]);
    console.log("Model face-api berhasil dimuat.");

    let video = document.getElementById("video");
    let canvas = document.getElementById("canvas");
    let cameraMessage = document.getElementById("cameraMessage");
    let isCameraOn = false;
    let detectionInterval;

    let isFaceDetected = false;
    let isWithinRange = false;

    const targetLat = -6.2311505; // Latitude tujuan
    const targetLon = 106.8669003; // Longitude tujuan

    // Fungsi Haversine untuk hitung jarak
    function getDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Radius bumi dalam km
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;

        const a = 
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);

        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c * 1000; // Dalam meter
    }

    // Dapatkan lokasi Anda menggunakan API OpenStreetMap Nominatim
    async function getAddress(lat, lon) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`);
            const data = await response.json();
            return data.display_name || "lokasi Anda tidak ditemukan";
        } catch (error) {
            console.error("Gagal mendapatkan lokasi Anda:", error);
            return "Lokasi Anda tidak ditemukan";
        }
    }

    // Periksa lokasi
    async function checkLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(async (position) => {
                const userLat = position.coords.latitude;
                const userLon = position.coords.longitude;

                const distance = getDistance(userLat, userLon, targetLat, targetLon).toFixed(2);
                console.log("Jarak Anda:", distance, "meter");

                distanceText.innerText = `Jarak Anda: ${distance} meter`;
                isWithinRange = distance <= 100;

                const address = await getAddress(userLat, userLon);
                document.getElementById("addressText").innerText = `${address}`;

                updateUI();
            }, (error) => {
                console.error("Gagal mendapatkan lokasi:", error);
                distanceText.innerText = "Lokasi tidak ditemukan.";
                document.getElementById("addressText").innerText = "Gagal mendapatkan lokasi Anda.";
            }, {
                enableHighAccuracy: true,
                maximumAge: 0,
                timeout: 5000
            });
        } else {
            alert("Geolokasi tidak didukung oleh browser ini.");
        }
    }

    // Perbarui UI
    function updateUI() {
        const finishButton = document.getElementById("finishButton");
        const messages = [];

        if (!isFaceDetected) messages.push("Wajah harus terdeteksi");
        if (!isWithinRange) messages.push("Jarak harus dalam radius 100 meter");

        finishButton.disabled = !(isFaceDetected && isWithinRange);

        const warningList = document.getElementById("warningList");
        warningList.innerHTML = messages.map(msg => `<li>${msg}</li>`).join('');
    }

    // Mulai kamera
    const startCamera = async () => {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({
                video: { width: 1280, height: 720 },
                audio: false
            });
            video.srcObject = stream;
            video.play();
            cameraMessage.classList.add("hidden");

            detectionInterval = setInterval(detectFaces, 100);
            setInterval(checkLocation, 5000); // Periksa lokasi setiap 5 detik
            isCameraOn = true;
        } catch (error) {
            console.error("Tidak dapat mengakses kamera:", error);
        }
    };

    // Deteksi wajah
    async function detectFaces() {
        const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions());
        isFaceDetected = detections.some(d => d.score > 0.7);
        updateUI();

        const displaySize = { width: video.videoWidth, height: video.videoHeight };
        faceapi.matchDimensions(canvas, displaySize);
        const resizedDetections = faceapi.resizeResults(detections, displaySize);

        const ctx = canvas.getContext("2d");
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        faceapi.draw.drawDetections(canvas, resizedDetections);
    }

    // Tombol Aktifkan Kamera
    document.getElementById("toggleCamera").addEventListener("click", () => {
        if (!isCameraOn) {
            startCamera();
            document.getElementById("toggleCamera").innerText = "Matikan Kamera";
        } else {
            location.reload(); // Restart halaman
        }
    });

    // Tombol Batal
    document.getElementById("cancelButton").addEventListener("click", () => {
        window.location.href = "{{ route('menu_utama') }}";
    });
};
</script>
