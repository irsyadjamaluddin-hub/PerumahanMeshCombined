<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->text('news_file')->nullable();
            $table->text('news_file_path')->nullable();
            $table->string('news_title')->nullable();
            $table->string('news_name')->nullable();
            $table->date('news_date')->nullable();
            $table->text('news_content')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('news');
    }
}
