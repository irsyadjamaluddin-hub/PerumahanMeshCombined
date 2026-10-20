<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekods', function (Blueprint $table) {
            $table->id();
            $table->string('jenis')->index();              // register key, see config/perumahan.php
            $table->string('jenis_permohonan')->nullable(); // Pemohon only: RS or Mendapatkan Perumahan
            $table->string('status')->nullable();
            $table->json('data');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekods');
    }
};
