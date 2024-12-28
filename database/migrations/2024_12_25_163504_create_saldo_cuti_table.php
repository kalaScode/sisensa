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
        Schema::create('saldo_cuti', function (Blueprint $table) {
            $table->id('id_Saldocuti'); // Primary key
            $table->foreignId('user_id')->constrained('users','user_id')->onDelete('cascade');
            $table->year('Tahun'); // Year(4)
            $table->integer('saldo_Awal')->default(12);
            $table->integer('saldo_Terpakai')->default(0);
            $table->integer('saldo_Sisa')->default(12);
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
        Schema::dropIfExists('saldo_cuti');
    }
};
