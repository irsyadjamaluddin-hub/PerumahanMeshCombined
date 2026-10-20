<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kkk_kuiri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekod_id')->constrained('kkk_rekod')->cascadeOnDelete();
            $table->unsignedTinyInteger('pusingan'); // 1, 2, 3
            $table->date('tarikh_dihadapkan');
            $table->date('tarikh_jawapan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unique(['rekod_id', 'pusingan'], 'kkk_kuiri_unik');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kkk_kuiri');
    }
};
