<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpisKpiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spis_kpi', function (Blueprint $table) {
            $table->id();
            $table->string('owner');
            $table->string('title');
            $table->string('blueprint_link')->nullable();
            $table->string('goal')->nullable();
            $table->string('strategic_objective')->nullable();
            $table->string('kra')->nullable();
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
        Schema::dropIfExists('spis_kpi');
    }
}
