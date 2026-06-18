<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnugerahNonteachingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anugerah_pjawatan', function (Blueprint $table) {
            $table->id();

            // Foreign key to spjs table
            $table->unsignedBigInteger('pemegang_jawatan_id');

            $table->string('tahun', 4)->nullable();
            $table->string('nama_anugerah')->nullable();
            $table->string('peringkat')->nullable();
            $table->string('penganjur')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            // Foreign key constraint (IMPORTANT)
            $table->foreign('pemegang_jawatan_id')
                  ->references('id')
                  ->on('spjs')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anugerah_nonteaching');
    }
}
