<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kkk_sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 200);
            $table->string('peringkat', 30); // Rendah, Menengah, PTE
            $table->unsignedTinyInteger('kluster');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kkk_sekolah');
    }
};
