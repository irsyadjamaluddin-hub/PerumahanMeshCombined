<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('housing2_zones', function (Blueprint $table) {
            $table->id();
            $table->string('nama');   // e.g. Zone 1, Zone 2, Zone 3
            $table->foreignId('ketua_staff_id')->nullable()->constrained('housing2_staff')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('housing2_zones');
    }
};
