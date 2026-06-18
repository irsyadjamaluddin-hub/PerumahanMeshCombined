<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlipkedatanganRaya2025Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slipkedatangan_raya2025', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan')->nullable();
            $table->string('nama')->nullable();
            $table->string('jawatan')->nullable();
            $table->string('nomborIc')->nullable();
            $table->string('gender')->nullable();
            $table->integer('telefon')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slipkedatangan_raya2025');
    }
}
