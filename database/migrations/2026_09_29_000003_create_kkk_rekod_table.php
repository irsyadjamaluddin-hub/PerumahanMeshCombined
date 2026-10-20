<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kkk_rekod', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sekolah_id')->constrained('kkk_sekolah')->cascadeOnDelete();
            $table->unsignedSmallInteger('tahun_kewangan');
            $table->unsignedTinyInteger('penggal'); // 1 or 2
            $table->string('kategori', 30); // Kantin, Yuran, Rampaian
            $table->date('tarikh_diterima')->nullable();
            $table->date('tarikh_tfv')->nullable();
            $table->string('status', 30)->default('belum_diterima');
            $table->string('kerani_nama', 150)->nullable();
            $table->string('pegawai_nama', 150)->nullable();
            $table->text('catatan')->nullable();
            $table->boolean('locked')->default(false);
            $table->timestamps();

            $table->unique(['sekolah_id', 'tahun_kewangan', 'penggal', 'kategori'], 'kkk_rekod_unik');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kkk_rekod');
    }
};
