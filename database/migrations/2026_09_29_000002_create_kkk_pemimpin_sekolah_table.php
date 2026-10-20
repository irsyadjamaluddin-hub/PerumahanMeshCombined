<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kkk_pemimpin_sekolah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sekolah_id')->constrained('kkk_sekolah')->cascadeOnDelete();
            $table->string('nama', 200);
            $table->string('jawatan', 30); // Pengetua, Guru Besar
            $table->date('tarikh_lantikan')->nullable();
            $table->date('tarikh_tamat')->nullable();
            $table->boolean('semasa')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kkk_pemimpin_sekolah');
    }
};
