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
        Schema::create('asset_category_codes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('main_asset_category_code_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('code');
            $table->string('name');
            
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
        Schema::dropIfExists('asset_category_codes');
    }
};
