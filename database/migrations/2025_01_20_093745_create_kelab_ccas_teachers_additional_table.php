<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelabCcasTeachersAdditionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelab_ccas_teachers_additional', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('kelab_cca_id'); // Foreign key or required field
            $table->text('add_nama_guru')->nullable();
            $table->text('add_ic_no_guru')->nullable();
            $table->text('add_guru_position')->nullable();
            $table->text('add_jantina')->nullable();
            $table->text('add_no_tel_guru')->nullable();
            $table->text('add_email')->nullable();
            $table->timestamps(); // Adds created_at and updated_at columns

            // If kelab_cca_id is a foreign key:
            // $table->foreign('kelab_cca_id')->references('id')->on('kelab_ccas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelab_ccas_teachers_additional');
    }
}
