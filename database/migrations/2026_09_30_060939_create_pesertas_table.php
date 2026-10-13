<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('skema_id')->constrained('skemas')->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->text('alamat');
            $table->enum('status_sertifikasi', ['Lulus', 'Tidak Lulus', 'Pending'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
