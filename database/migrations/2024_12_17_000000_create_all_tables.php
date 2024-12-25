<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    public function up()
    {
        // Tabel cuti
        Schema::create('cuti', function (Blueprint $table) {
            $table->id('id_cuti');
            $table->unsignedBigInteger('id_user');
            $table->enum('jenis_cuti', ['cuti', 'sakit']);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('keterangan')->nullable();
            $table->string('attachment')->nullable();
            $table->enum('status_approved', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->text('feedback')->nullable();
        });

        // Tabel jabatan
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id('id_jabatan');
            $table->string('nama_jabatan', 50);
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });

        // Tabel notifikasi
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id('id_notifikasi');
            $table->unsignedBigInteger('id_user');
            $table->string('judul', 255);
            $table->text('pesan');
            $table->enum('status', ['terbaca', 'belum_terbaca'])->default('belum_terbaca');
            $table->timestamps();
        });

        // Tabel pengaturan_hari_kerja
        Schema::create('pengaturan_hari_kerja', function (Blueprint $table) {
            $table->id('id_pengaturan');
            $table->enum('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']);
            $table->boolean('is_libur')->default(false);
            $table->timestamps();
        });

        // Tabel perusahaan
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id('id_perusahaan');
            $table->string('nama_perusahaan', 255);
            $table->string('alamat', 255)->nullable();
            $table->string('telepon', 15)->nullable();
            $table->timestamps();
        });

        // Tabel presensi
        Schema::create('presensi', function (Blueprint $table) {
            $table->id('id_presensi');
            $table->unsignedBigInteger('id_user');
            $table->date('tanggal');
            $table->time('jam_masuk');
            $table->time('jam_keluar')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Tabel saldo_cuti
        Schema::create('saldo_cuti', function (Blueprint $table) {
            $table->id('id_saldo');
            $table->unsignedBigInteger('id_user');
            $table->integer('jumlah_cuti');
            $table->timestamps();
        });

        // Tabel user
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('company_code', 255);
            $table->string('nama', 255);
            $table->string('email', 255)->unique();
            $table->string('phone', 255);
            $table->string('password', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('saldo_cuti');
        Schema::dropIfExists('presensi');
        Schema::dropIfExists('perusahaan');
        Schema::dropIfExists('pengaturan_hari_kerja');
        Schema::dropIfExists('notifikasi');
        Schema::dropIfExists('jabatan');
        Schema::dropIfExists('cuti');
    }
}


