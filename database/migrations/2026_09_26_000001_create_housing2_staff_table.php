<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('housing2_staff', function (Blueprint $table) {
            $table->id();
            $table->string('kod')->unique();     // e.g. AKR, AKR1..AKR18
            $table->string('nama');
            $table->string('no_kpp')->nullable();
            $table->text('tugas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('housing2_staff');
    }
};
