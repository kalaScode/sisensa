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
        Schema::create('presensi', function (Blueprint $table) {
            $table->id('id_Presensi'); // Primary key
            $table->foreignId('user_id')->constrained('users','user_id')->onDelete('cascade');
            $table->enum('jenis_Presensi', ['Biasa', 'Dinas']); // Enum jenis presensi
            $table->date('Tanggal');
            $table->timestamp('Waktu')->useCurrent(); // Default current timestamp
            $table->decimal('Latitude', 11, 8)->nullable(); // Koordinat Latitude
            $table->decimal('Longitude', 11, 8)->nullable(); // Koordinat Longitude
            $table->string('Alamat', 255);
            $table->string('Keterangan', 255)->nullable(); // Nullable untuk kolom Keterangan
            $table->string('Foto', 255); // Path ke foto
            $table->enum('status_Presensi', ['Disetujui', 'Menunggu', 'Dibatalkan'])->default('Disetujui'); // Enum status presensi
            $table->enum('Bagian', ['Masuk', 'Keluar']); // Enum untuk bagian presensi
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
        Schema::dropIfExists('saldo_presensi');
    }
};
