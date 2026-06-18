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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();

            $table->string('name')
                ->nullable();

            $table->foreignId('asset_type_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('initial_quantity')
                ->nullable();

            // $table->foreignId('quantity_unit_id')
            //     ->nullable()
            //     ->constrained()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');

            // $table->string('unit_price')
            //     ->nullable();
                
            // $table->foreignId('srv_id')
            //     ->nullable()
            //     ->constrained()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            
            $table->foreignId('asset_category_code_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('assets');
    }
};
