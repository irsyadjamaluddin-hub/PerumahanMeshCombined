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
        Schema::create('bin_card_entries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('bin_card_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // $table->string('date')
            //     ->nullable();

            // User, Vendor atau Receiver
            $table->string('user_type')
                ->nullable();

            $table->string('user_id')
                ->nullable();

            $table->string('in_quantity')
                ->nullable();

            $table->string('out_quantity')
                ->nullable();

            $table->string('balance_quantity')
                ->nullable();

            $table->string('reference_type')
                ->nullable();

            $table->string('reference_id')
                ->nullable();

            $table->foreignId('officer_in_charge_id')
                ->references('id')
                ->on('users')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('remarks')
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
        Schema::dropIfExists('bin_card_entries');
    }
};
