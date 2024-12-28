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
        Schema::create('pengaturan_hari_kerja', function (Blueprint $table) {
            $table->id('id_Pengaturan'); ;
            $table->foreignId('id_Perusahaan')->constrained('perusahaan','id_Perusahaan')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users','user_id')->oDelete('cascade');
            $table->enum('Senin', ['Ya', 'Tidak']);
            $table->enum('Selasa', ['Ya', 'Tidak']);
            $table->enum('Rabu', ['Ya', 'Tidak']);
            $table->enum('Kamis', ['Ya', 'Tidak']);
            $table->enum('Jumat', ['Ya', 'Tidak']);
            $table->enum('Sabtu', ['Ya', 'Tidak']);
            $table->enum('Minggu', ['Ya', 'Tidak']);
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
        Schema::dropIfExists('pengaturan_hari_kerja');
    }
};
