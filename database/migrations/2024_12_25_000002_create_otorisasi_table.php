<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('otorisasi', function (Blueprint $table) {
            $table->id('id_Otoritas');
            $table->string('nama_Otoritas');
            $table->enum('Presensi', ['Ya', 'Tidak']);
            $table->enum('Cuti', ['Ya', 'Tidak']);
            $table->enum('daftar_Karyawan', ['Ya', 'Tidak']);
            $table->enum('edit_daftarKaryawan', ['Ya', 'Tidak']);
            $table->enum('Persetujuan', ['Ya', 'Tidak']);
            $table->enum('persetujuan_Akun', ['Ya', 'Tidak']);
            $table->enum('riwayat_presensiPribadi', ['Ya', 'Tidak']);
            $table->enum('riwayat_presensiKaryawan', ['Ya', 'Tidak']);
            $table->enum('riwayat_cutiPribadi', ['Ya', 'Tidak']);
            $table->enum('riwayat_cutiKaryawan', ['Ya', 'Tidak']);
            $table->dateTime('created_At')->useCurrent();
            $table->integer('created_By')->nullable();
            $table->dateTime('updated_At')->nullable()->useCurrentOnUpdate();
            $table->integer('updated_By')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otorisasi');
    }
};
