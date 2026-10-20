<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('iqdata', function (Blueprint $table) {
            $table->string('status_rumah')->nullable();
        });
    }

    public function down()
    {
        Schema::table('iqdata', function (Blueprint $table) {
            $table->dropColumn('status_rumah');
        });
    }
};
