<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementnotificationTable extends Migration
{
    public function up()
    {
        Schema::create('announcementnotification', function (Blueprint $table) {
            $table->id();
            $table->string('ic_no')->nullable();
            $table->string('email')->nullable();
            $table->boolean('notification')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('announcementnotification');
    }
}
