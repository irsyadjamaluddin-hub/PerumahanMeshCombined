<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementTable extends Migration
{
    public function up()
    {
        Schema::create('announcement', function (Blueprint $table) {
            $table->id();
            $table->string('announcement_title')->nullable();
            $table->string('announcement_date')->nullable();
            $table->string('announcement_icon')->nullable();
            $table->text('announcement_content')->nullable();
            $table->string('anouncement_file')->nullable();
            $table->string('announcement_file_path')->nullable();
            $table->text('pdf_file')->nullable();
            $table->text('pdf_file_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('announcement');
    }
}
