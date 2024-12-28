import "./bootstrap";
import "flowbite";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

function createStars() {
    const starfield = document.getElementById("starfield");
    const numberOfStars = 100;

    for (let i = 0; i < numberOfStars; i++) {
        const star = document.createElement("div");
        star.className = "star";

        const size = Math.random() * 3;
        star.style.width = `${size}px`;
        star.style.height = `${size}px`;

        star.style.left = `${Math.random() * 100}%`;
        star.style.top = `${Math.random() * 100}%`;
        star.style.animationDelay = `${Math.random() * 2}s`;

        starfield.appendChild(star);
    }
}

createStars();

document.addEventListener("mousemove", (e) => {
    const stars = document.querySelectorAll(".star");
    const mouseX = e.clientX / window.innerWidth;
    const mouseY = e.clientY / window.innerHeight;

    stars.forEach((star) => {
        const rect = star.getBoundingClientRect();
        const starX = (rect.left + rect.width / 2) / window.innerWidth;
        const starY = (rect.top + rect.height / 2) / window.innerHeight;

        const deltaX = (mouseX - starX) * 20;
        const deltaY = (mouseY - starY) * 20;

        star.style.transform = `translate(${deltaX}px, ${deltaY}px)`;
    });
});

import $ from "jquery"; // Pastikan jQuery sudah terpasang

$(document).ready(function () {
    // Fungsi untuk menangani pencarian karyawan
    $("#searchInput").on("input", function () {
        let searchQuery = $(this).val(); // Ambil nilai input pencarian

        // Lakukan AJAX request
        $.ajax({
            url: "{{ route('daftar-karyawan') }}", // URL yang benar
            type: "GET",
            data: {
                search: searchQuery, // Kirimkan parameter pencarian
            },
            success: function (response) {
                // Update isi tabel dengan hasil pencarian
                $("#employeeList").html(response); // Ganti tabel dengan data yang diterima
            },
            error: function (xhr, status, error) {
                console.error(
                    "Terjadi kesalahan saat melakukan pencarian: ",
                    error,
                );
            },
        });
    });
});
