<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodatasTable extends Migration
{
    public function up()
    {
        Schema::create('biodatas', function (Blueprint $table) {
            $table->id();
            $table->string('ic_no')->nullable()->unique();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('gender_id')->nullable();
            $table->string('ic_color_id')->nullable();
            $table->string('marital_status_id')->nullable();
            $table->string('country_id')->nullable();
            $table->string('department_id')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('cluster_id')->nullable();
            $table->string('service_status_id')->nullable();
            $table->string('division_id')->nullable();
            $table->string('allowance_category_id')->nullable();
            $table->string('employment_status_id')->nullable();
            $table->string('race_id')->nullable();
            $table->string('religion_id')->nullable();
            $table->string('citizenship_id')->nullable();
            $table->string('ministry_id')->nullable();
            $table->string('bahagian_id')->nullable();
            $table->string('vac_info')->nullable();
            $table->string('vac_dose')->nullable();
            $table->string('vac_boost')->nullable();
            $table->string('vulnerable_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('biodatas');
    }
}
