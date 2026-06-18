<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpContactInfosTable extends Migration
{
    public function up()
    {
        Schema::create('emp_contact_infos', function (Blueprint $table) {
            $table->id();
            $table->string('ic_no')->nullable()->unique();
            $table->string('address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country_id')->nullable();
            $table->string('telephone_office')->nullable();
            $table->string('telephone_home')->nullable();
            $table->string('telephone_mobile')->nullable();
            $table->string('personal_email')->nullable();
            $table->string('name_ec')->nullable();
            $table->string('tel_ec')->nullable();
            $table->string('rs_ec')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('emp_contact_infos');
    }
}
