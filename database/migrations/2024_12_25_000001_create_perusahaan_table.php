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
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id('id_Perusahaan'); // Primary key
            $table->string('nama_Perusahaan', 255); // Nama perusahaan
            $table->decimal('Longitude', 11, 8); // Longitude perusahaan
            $table->decimal('Latitude', 11, 8); // Latitude perusahaan
            $table->text('Alamat'); // Alamat perusahaan
            $table->string('no_Telp', 255); // Nomor telepon perusahaan
            $table->integer('minimal_Jamkerja'); // Minimal jam kerja
            $table->time('jam_Masuk'); // Jam masuk kerja
            $table->time('jam_Keluar'); // Jam keluar kerja
            $table->string('Logo', 255); // Path logo perusahaan
            $table->dateTime('created_At')->useCurrent(); // Waktu pembuatan
            $table->integer('created_By')->nullable(); // Dibuat oleh siapa
            $table->dateTime('updated_At')->nullable()->useCurrentOnUpdate(); // Waktu pembaruan
            $table->integer('updated_By')->nullable(); // Diperbarui oleh siapa
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};
