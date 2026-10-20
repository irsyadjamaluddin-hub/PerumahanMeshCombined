<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('housing2_zone_mukims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zone_id')->constrained('housing2_zones')->cascadeOnDelete();
            $table->string('daerah');
            $table->string('mukim');
            $table->foreignId('rs_staff_id')->nullable()->constrained('housing2_staff');
            $table->foreignId('iq_staff_id')->nullable()->constrained('housing2_staff');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('housing2_zone_mukims');
    }
};
