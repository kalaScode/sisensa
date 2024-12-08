<x-navbar></x-navbar>
<div cclass="w-full mx-auto px-4 sm:px-6 lg:px-36 py-10">
    <div class="w-full mx-auto px-4 sm:px-100 py-28 max-w-lg">
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
                <div class="text-sm text-gray-500">
                    Mengukur jarak...
                </div>
            </div>

            <!-- Peringatan -->
            <div class="bg-red-50 text-red-500 text-sm px-4 py-2 rounded-lg mb-4">
                <ul class="list-disc pl-4">
                    <li>Wajah harus terdeteksi</li>
                    <li>Jarak harus dalam radius 100 meter</li>
                </ul>
            </div>

            <!-- Tombol -->
            <div class="flex justify-between">
                <button id="cancelButton" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 focus:outline-none">
                    Batal
                </button>
                <button id="toggleCamera" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none">
                    Aktifkan Kamera
                </button>
                <button id="finishButton" class="bg-yellow-400 text-[#122036] px-4 py-2 rounded-md hover:opacity-90 focus:outline-none">
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
    
    // Muat model face-api
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

    // Membersihkan canvas
    const clearCanvas = () => {
        const ctx = canvas.getContext("2d");
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    };

    // Mulai kamera
    const startCamera = async () => {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({
                video: { width: 1280, height: 720 },
                audio: false
            });
            video.srcObject = stream;
            video.play();
            video.classList.remove("hidden");
            canvas.classList.remove("hidden");
            cameraMessage.classList.add("hidden");

            detectionInterval = setInterval(detectFaces, 100);
            isCameraOn = true;
        } catch (error) {
            console.error("Tidak dapat mengakses kamera:", error);
        }
    };

    // Berhenti kamera
    const stopCamera = () => {
        const stream = video.srcObject;
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
        }
        video.classList.add("hidden");
        canvas.classList.add("hidden");
        cameraMessage.classList.remove("hidden");
        clearInterval(detectionInterval);
        clearCanvas();
        isCameraOn = false;
    };

    // Deteksi wajah
    async function detectFaces() {
        const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions());
        const displaySize = { width: video.videoWidth, height: video.videoHeight };
        faceapi.matchDimensions(canvas, displaySize);
        const resizedDetections = faceapi.resizeResults(detections, displaySize);

        clearCanvas();
        faceapi.draw.drawDetections(canvas, resizedDetections);
        //faceapi.draw.drawFaceExpressions(canvas, resizedDetections);
    }

    // Toggle kamera
    document.getElementById("toggleCamera").addEventListener("click", () => {
        if (!isCameraOn) {
            startCamera();
            document.getElementById("toggleCamera").innerText = "Matikan Kamera";
        } else {
            stopCamera();
            document.getElementById("toggleCamera").innerText = "Aktifkan Kamera";
        }
    });
    
    //Tombol Batal
    document.getElementById("cancelButton").addEventListener("click", () => {
        window.location.href = "{{ route('menu_utama') }}";
    });

    document.getElementById("finishButton").addEventListener("click", () => {
        window.location.href = "{{ route('menu_utama') }}";
    });
};
</script>
