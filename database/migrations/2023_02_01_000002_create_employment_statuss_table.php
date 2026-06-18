<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentStatussTable extends Migration
{
    public function up()
    {
        Schema::create('employment_statuss', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('label');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employment_statuss');
    }
}
