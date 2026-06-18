<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSsmKodTable extends Migration
{
    public function up()
    {
        Schema::create('ssm_kod', function (Blueprint $table) {
            $table->id();
            $table->string('ic_no')->nullable();
            $table->string('nama')->nullable();
            $table->string('kod')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ssm_kod');
    }
}
