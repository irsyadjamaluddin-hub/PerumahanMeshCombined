<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivers', function (Blueprint $table) {
            $table->id();

            $table->string('name')
                ->nullable();

            $table->string('email')
                ->nullable();
            
            $table->string('phone_no')
                ->nullable();

            $table->foreignId('receiver_location_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('other_details')
                ->nullable();

            $table->string('deleted')
                ->nullable()
                ->default('no');

            $table->timestamp('deleted_at')
                ->nullable();
                
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
        Schema::dropIfExists('receivers');
    }
};
