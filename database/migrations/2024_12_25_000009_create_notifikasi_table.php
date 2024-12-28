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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->increments('id_Notifikasi');
            $table->foreignId('user_id')->constrained('users','user_id')->onDelete('cascade');
            $table->enum('jenis_Notifikasi', ['Persetujuan', 'Umum']);
            $table->string('judul_Notifikasi');
            $table->text('isi_Notifikasi');
            $table->enum('status_Baca', ['Ya', 'Tidak']);
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
        Schema::dropIfExists('notifikasi');
    }
};
