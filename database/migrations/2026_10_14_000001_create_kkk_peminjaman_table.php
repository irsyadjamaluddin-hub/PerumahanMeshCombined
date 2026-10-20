<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Borang Permohonan Peminjaman Dokumen Kunci Kira-Kira Kewangan Sekolah (FRRV).
 * One row per borang; each signature block on the paper form is a
 * nama / jawatan / tarikh triple here.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::create('kkk_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('no_borang', 30)->unique();
            $table->json('jenis'); // Yuran, Kantin, Rampaian (one or more)
            $table->string('tujuan', 20); // semakan, pengauditan, lain
            $table->string('tujuan_lain', 255)->nullable();
            $table->date('tarikh_permohonan');
            $table->string('status', 30)->default('dipohon');

            // Pemohon
            $table->string('pemohon_nama', 150);
            $table->string('pemohon_jawatan', 150)->nullable();

            // Dibenarkan oleh: Ketua Sub Unit Pentadbiran dan Perkhidmatan Korporat
            $table->string('dibenarkan_nama', 150)->nullable();
            $table->string('dibenarkan_jawatan', 150)->nullable();
            $table->date('tarikh_dibenarkan')->nullable();
            $table->text('sebab_ditolak')->nullable();

            // Dikeluarkan oleh: Pengawas Bilik dan Stor KKK
            $table->string('dikeluarkan_nama', 150)->nullable();
            $table->string('dikeluarkan_jawatan', 150)->nullable();
            $table->date('tarikh_dikeluarkan')->nullable();

            // Diterima oleh: pemohon (dokumen diterima dengan sempurna)
            $table->string('diterima_nama', 150)->nullable();
            $table->string('diterima_jawatan', 150)->nullable();
            $table->date('tarikh_diterima')->nullable();

            // Dikembalikan oleh: pemohon
            $table->string('dikembalikan_nama', 150)->nullable();
            $table->string('dikembalikan_jawatan', 150)->nullable();
            $table->date('tarikh_dikembalikan')->nullable();

            // Diterima (pemulangan) oleh: Pengawas Bilik dan Stor KKK
            $table->string('diterima_stor_nama', 150)->nullable();
            $table->string('diterima_stor_jawatan', 150)->nullable();
            $table->date('tarikh_diterima_stor')->nullable();
            $table->text('catatan_semakan')->nullable();

            $table->timestamps();
        });

        Schema::create('kkk_peminjaman_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('kkk_peminjaman')->cascadeOnDelete();
            $table->unsignedTinyInteger('bil');
            $table->foreignId('sekolah_id')->constrained('kkk_sekolah')->cascadeOnDelete();
            $table->unsignedTinyInteger('penggal')->nullable(); // 1 or 2; null = setahun
            $table->unsignedSmallInteger('tahun_kewangan');
            $table->timestamps();
        });

        Schema::table('kkk_log_audit', function (Blueprint $table) {
            $table->foreignId('peminjaman_id')->nullable()->after('rekod_id')->constrained('kkk_peminjaman')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('kkk_log_audit', function (Blueprint $table) {
            $table->dropConstrainedForeignId('peminjaman_id');
        });
        Schema::dropIfExists('kkk_peminjaman_item');
        Schema::dropIfExists('kkk_peminjaman');
    }
};
