# sisensa
Tugas RPL Kelompok 4
=======
## SISENSA

SISENSA merupakan Sistem Absensi Karyawan terintegrasi yang dapat mengelola presensi karyawan untuk berbagai perusahaan dengan pengaturan otoritas yang jelas. Sistem ini dilengkapi dengan formulir presensi dengan menggunakan fitur Face Detection dan Geofencing untuk memastikan karyawan hanya dapat melakukan presensi pada saat kamera mendeteksi wajah dan lokasi presensi sesuai dengan yang sudah ditentukan dengan batasan tertentu, serta pada waktu yang sudah ditentukan (untuk presensi masuk dan pulang berdasarkan jam kerja yang ditentukan perusahaan).

## Developers

-   Nama Developer 1
-   Nama Developer 2
-   Nama Developer 3
-   Nama Developer 4
-   Nama Developer 5
-   Nama Developer 6
-   Nama Developer 7
-   Nama Developer 8

## Tech Stack

Aplikasi ini dibangun dengan teknologi berikut:

-   Backend:

    -   PHP dengan Laravel untuk framework server-side.
    -   MySQL untuk database.
    -   Blade untuk templating engine.

-   Frontend:
    -   TailwindCSS untuk styling yang responsif dan fleksibel.
    -   FullCalendar untuk kalender interaktif.

-   Version Control:
    -   Git untuk version control.
    -   GitHub untuk repository dan CI/CD pipeline.

## Langkah Penggunaan

### Clone Repository

    git clone https://gitlab.com/username/repository-name.git
    cd repository-name

### Install Dependencies

Setelah repository berhasil di-clone, install dependensi backend dan frontend:

#### Backend:

Pastikan Anda sudah memiliki PHP dan Composer terinstall di sistem Anda. Jalankan perintah berikut untuk menginstall dependensi Laravel:

    composer install

#### Frontend

Pastikan Anda sudah menginstall Node.js dan npm di sistem Anda. Install dependensi frontend dengan:

    npm install

### Konfigurasi Environment

Buat file .env di root project (salin dari .env.example) dan sesuaikan pengaturan database dan environment lainnya:

    cp .env.example .env
    php artisan key:generate

### Migrasi Database

Jalankan migrasi untuk membuat tabel di database:

    php artisan migrate

### Menjalankan Aplikasi

Untuk menjalankan aplikasi, Anda dapat menggunakan perintah berikut untuk menjalankan server Laravel dan server frontend:

#### Backend

    php artisan serve

#### Frontend (hanya jika ReactJS jadi digunakan)

    npm run dev

Aplikasi backend akan berjalan di http://127.0.0.1:8000, sedangkan frontend (React) akan berjalan di http://localhost:3000.
>>>>>>> c2e9538 (initial commit)
