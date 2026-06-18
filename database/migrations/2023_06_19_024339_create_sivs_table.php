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
        Schema::create('sivs', function (Blueprint $table) {
            $table->id();

            // Request Stage
            $table->string('reference_for_request')->nullable();
            $table->dateTimeTz('request_date')->nullable();
            $table->string('request_accepted')->nullable();
            $table->string('deploy_to')->nullable();

            // Confirmed Request Stage
            $table->string('siv_no')->nullable();

            // Receiver
            $table->string('receiver_id')->nullable();

            $table->foreignId('receiver_location_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('receiver_signature')->nullable();

            $table->dateTimeTz('receiver_signature_date')->nullable();

            // Technical Team
            $table->foreignId('tt_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('tt_signed')->nullable();
            $table->string('tt_signature_date')->nullable();

            // Storekeeper
            $table->foreignId('storekeeper_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->constrained();
                // ->onUpdate('cascade')
                // ->onDelete('cascade');
                // Note: onUpdate and onDelete was removed because it shows error when migrating on Microsoft SQL.

            $table->string('storekeeper_signed')->nullable();
            $table->string('storekeeper_signature_date')->nullable();

            // Supervisor
            $table->foreignId('supervisor_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->constrained();
                // ->onUpdate('cascade')
                // ->onDelete('cascade');
                // Note: onUpdate and onDelete was removed because it shows error when migrating on Microsoft SQL.

            $table->string('supervisor_verified')->nullable();
            $table->string('supervisor_verification_date')->nullable();

            // Mana-Mana Staff DICT (SKs or TTs, other than final receiver - for internal)
            $table->string('mmsd_id')->nullable();
            $table->string('mmsd_confirmed')->nullable();
            $table->string('mmsd_confirm_date')->nullable();

            // Remarks
            $table->string('remarks')->nullable();

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
        Schema::dropIfExists('sivs');
    }
};
