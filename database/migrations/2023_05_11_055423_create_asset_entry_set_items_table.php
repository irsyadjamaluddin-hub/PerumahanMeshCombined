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
        Schema::create('asset_entry_set_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('asset_entry_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('name')
                ->nullable();

            $table->string('moe_reference')
                ->nullable();

            $table->string('serial_no')
                ->nullable();

            $table->foreignId('asset_category_code_id')
                ->nullable()
                ->constrained();
                // ->onUpdate('cascade')
                // ->onDelete('cascade');
                // Note: onUpdate and onDelete was removed because it shows error when migrating on Microsoft SQL.

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
        Schema::dropIfExists('asset_entry_set_items');
    }
};
