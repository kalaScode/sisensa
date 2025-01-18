# sisensa

# Tugas RPL Kelompok 4 - 3SD1

## SISENSA

SISENSA merupakan Sistem Absensi Karyawan terintegrasi yang dapat mengelola presensi karyawan untuk berbagai perusahaan dengan pengaturan otoritas yang jelas. Sistem ini dilengkapi dengan formulir presensi dengan menggunakan fitur Face Detection dan Geofencing untuk memastikan karyawan hanya dapat melakukan presensi pada saat kamera mendeteksi wajah dan lokasi presensi sesuai dengan yang sudah ditentukan dengan batasan tertentu, serta pada waktu yang sudah ditentukan (untuk presensi masuk dan pulang berdasarkan jam kerja yang ditentukan perusahaan).

## Developers

- Ainul Fatimah
- Amanda Amelia Salsabila Sinaga
- Atikah Nurfadia
- Muhammad Akmil Triadi
- Rizky Alif Ichwanto
- Wafi Aulia Tsabitah
- Wahyu Satrio Widodo
- Wilfa Afriyani

## Tech Stack

Aplikasi ini dibangun dengan teknologi berikut:

- Backend:

    - PHP dengan Laravel untuk framework server-side.
    - MySQL untuk database.
    - Blade untuk templating engine.

- Frontend:

    - TailwindCSS untuk styling yang responsif dan fleksibel.
    - Flatpicker untuk kalender.

- Version Control:
    - Git untuk version control.
    - GitHub untuk repository dan CI/CD pipeline.

## Langkah Penggunaan

### Clone Repository

    git clone https://github.com/kalaScode/sisensa.git
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

Untuk konfigurasi pengaturan email, tambahkan parameter berikut di file .env:

    MAIL_MAILER=smtp
    MAIL_HOST=smtp.example.com
    MAIL_PORT=587
    MAIL_USERNAME=your-email@example.com
    MAIL_PASSWORD=your-email-password
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=no-reply@example.com
    MAIL_FROM_NAME="${APP_NAME}"

Ganti nilai sesuai dengan pengaturan layanan email yang Anda gunakan.

### Migrasi Database

Jalankan migrasi untuk membuat tabel di database:

    php artisan migrate

Jalankan seeder untuk membuat tabel di database:

    php artisan db:seed

### Menjalankan Aplikasi

Untuk menjalankan aplikasi, Anda dapat menggunakan perintah berikut untuk menjalankan server Laravel dan server frontend:

Sebelum menjalankan aplikasi, pastikan untuk membuat symbolic link untuk penyimpanan file dengan perintah berikut:

    php artisan storage:link

#### Backend

    php artisan serve

#### Frontend (hanya jika ReactJS jadi digunakan)

    npm run dev

Aplikasi backend akan berjalan di http://127.0.0.1:8000, sedangkan frontend (React) akan berjalan di http://localhost:3000.

> > > > > > > c2e9538 (initial commit)
