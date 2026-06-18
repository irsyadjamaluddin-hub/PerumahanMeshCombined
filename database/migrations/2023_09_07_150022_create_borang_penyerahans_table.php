<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borang_penyerahans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('siv_id')
                ->nullable()
                ->references('id')
                ->on('sivs')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('bp_no')->nullable();

            $table->string('tt_processed')->nullable();
            $table->string('tt_response')->nullable();
            $table->string('tt_process_date')->nullable();
            $table->string('mmsd_processed')->nullable();
            $table->string('mmsd_response')->nullable();
            $table->string('mmsd_process_date')->nullable();
            $table->string('remark')->nullable();
            $table->string('supervisor_processed')->nullable();
            $table->string('supervisor_process_date')->nullable();
            $table->string('receiver_processed')->nullable();
            $table->string('receiver_process_date')->nullable();
            $table->string('pdf_name')->nullable();

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
        Schema::dropIfExists('borang_penyerahans');
    }
};
