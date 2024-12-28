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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->foreignid('id_Perusahaan')->constrained('perusahaan','id_Perusahaan')->onDelete('cascade');
            $table->foreignId('id_Otoritas')->constrained('otorisasi','id_Otoritas')->onDelete('cascade')->default('3');
            $table->foreignId('id_Jabatan')->constrained('jabatan','id_Jabatan')->onDelete('cascade')->default('4');
            $table->string('name');
            $table->string('no_Telp', 255);
            $table->text('Alamat');
            $table->enum('status_Kerja', ['Tetap', 'Kontrak'])->default('Tetap');
            $table->boolean('status_Akun')->default(0); 
            $table->string('Avatar', 255);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->integer('updated_By')->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};