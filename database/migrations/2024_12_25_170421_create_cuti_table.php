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
        Schema::create('cuti', function (Blueprint $table) {
            $table->id('id_Cuti'); // Primary key
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->enum('jenis_Cuti', ['Cuti', 'Sakit']); // Enum jenis cuti
            $table->date('tanggal_Mulai');
            $table->date('tanggal_Selesai');
            $table->text('Keterangan');
            $table->string('Attachment', 255)->nullable();
            $table->enum('status_Cuti', ['Disetujui', 'Menunggu', 'Ditolak'])->default('Menunggu'); // Enum status cuti
            $table->text('Feedback')->nullable();
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
        Schema::dropIfExists('cuti');
    }
};
