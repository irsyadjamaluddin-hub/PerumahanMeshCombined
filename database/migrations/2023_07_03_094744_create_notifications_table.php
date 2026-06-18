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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sender_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('receiver_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->constrained();
                // ->onUpdate('cascade')
                // ->onDelete('cascade');
                // Note: onUpdate and onDelete was removed because it shows error when migrating on Microsoft SQL.

            $table->foreignId('receiver_role_id')
                ->nullable()
                ->references('id')
                ->on('roles')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('message')->nullable();
            $table->string('read')->nullable();

            $table->string('reference_type')->nullable();
            $table->string('reference_id')->nullable();

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
        Schema::dropIfExists('notifications');
    }
};
