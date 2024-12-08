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

##langkah-langkah untuk push branch baru ke repository orang lain di GitHub atau GitLab:

---

### 1. Clone Repository (sudah dilakukan sebelumnya, lanjut step2)
Jika belum memiliki repository lokal, clone repository orang lain terlebih dahulu.

```bash
git clone <url-repo-orang-lain>
```

Contoh:
```bash
git clone https://github.com/username/repository-name.git
```

---

### 2. Buat Branch Baru di Lokal
Setelah masuk ke direktori repository lokal, buat branch baru untuk bekerja.

```bash
git checkout -b <nama-branch-baru>
```

Contoh:
```bash
git checkout -b feature-tambah-login
```

---

### 3. Lakukan Perubahan di Lokal
Edit file, tambahkan fitur, atau lakukan perubahan yang diperlukan. Setelah selesai:

- Tambahkan file ke staging:
  ```bash
  git add .
  ```
- Commit perubahan:
  ```bash
  git commit -m "Menambahkan fitur login"
  ```

---

###4. Push Branch Baru ke Repository Remote
Gunakan perintah berikut untuk push branch baru ke repository orang lain:

```bash
git push origin <nama-branch-baru>
```

Contoh:
```bash
git push origin feature-tambah-login
```

Jika branch belum ada di remote, Git akan membuat branch baru di remote.

---

###5. Buat Pull Request (PR)
Setelah branch berhasil di-push, buka repository di GitHub/GitLab dan buat Pull Request:

1. Masuk ke tab Pull Requests di halaman repository.
2. Klik New Pull Request.
3. Pilih branch Anda (misalnya, `feature-tambah-login`) sebagai source.
4. Jelaskan perubahan yang dilakukan, lalu submit Pull Request.

---

###6. Tunggu Review
Owner atau maintainer repository akan meninjau Pull Request Anda. Mereka bisa:
- Menerima dan merge branch Anda.
- Meminta perubahan atau revisi jika diperlukan.

---

###Catatan Penting
  - Hak Akses: Anda memerlukan akses push ke repository orang lain. Jika tidak memiliki akses:
  - Fork repository tersebut ke akun Anda sendiri.
  - Clone repository fork tersebut.
  - Push ke repository fork Anda.
  - Lakukan Pull Request dari repository Anda ke repository asli.
  - Nama Branch: Usahakan menggunakan nama branch yang deskriptif dan sesuai konvensi tim.


