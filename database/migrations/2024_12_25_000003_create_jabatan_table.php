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
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id('id_Jabatan');
            $table->foreignid('id_Perusahaan')->constrained('perusahaan','id_Perusahaan')->onDelete('cascade');
            $table->string('nama_Jabatan');
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
        Schema::dropIfExists('jabatan');
    }
};
