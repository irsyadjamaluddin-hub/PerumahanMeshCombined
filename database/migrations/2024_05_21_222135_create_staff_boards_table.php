<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('staff_boards', function (Blueprint $table) {
            $table->id();

            $table->string('message');
            $table->string('meridiem')->nullable();
            $table->string('date')->nullable();
            $table->string('status')->nullable();

            $table->foreignId('staff_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_boards');
    }
};
