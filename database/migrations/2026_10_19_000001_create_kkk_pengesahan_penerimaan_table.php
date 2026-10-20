<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * (KKK1) Pengesahan Penerimaan Kunci Kira-Kira — filled in by the school when it
 * hands in its balance-sheet report. Replaces the Unit Audit Dalaman Microsoft Form.
 * Options for each field live in config/kkk_pengesahan.php.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::create('kkk_pengesahan_penerimaan', function (Blueprint $table) {
            $table->id();
            $table->string('kluster', 20);
            $table->string('nama_sekolah', 200);
            $table->string('kategori', 30);       // Baru, Query Received 1-4
            $table->string('jenis', 50);          // Yuran / Kantin / Rampaian combination
            $table->string('tempoh', 30);         // Januari - Jun, Julai - Disember
            $table->unsignedSmallInteger('tahun');
            $table->string('nama_penghantar', 150);
            $table->string('jawatan', 150);
            $table->string('no_tel', 20);
            $table->timestamps();

            $table->index(['kluster', 'tahun']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('kkk_pengesahan_penerimaan');
    }
};
