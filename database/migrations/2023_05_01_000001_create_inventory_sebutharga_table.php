<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventorySebuthargaTable extends Migration
{
    public function up()
    {
        Schema::create('inventory_sebutharga', function (Blueprint $table) {
            $table->id();
            $table->string('bil_sh')->nullable();
            $table->string('bil_po')->nullable();
            $table->string('pembekal')->nullable();
            $table->string('emel_pembekal')->nullable();
            $table->string('email_status')->nullable();
            $table->timestamp('emailsent_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_sebutharga');
    }
}
